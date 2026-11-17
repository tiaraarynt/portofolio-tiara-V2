import { translations } from './translations.js';

// Bilingual (EN / ID) Language Switcher
const I18N_STORAGE_KEY = 'tiara_portfolio_lang';
let currentLanguage = 'en';

export function setLanguage(lang) {
    if (!translations[lang]) return;
    currentLanguage = lang;
    try {
        localStorage.setItem(I18N_STORAGE_KEY, lang);
    } catch (e) {
        // localStorage might be unavailable in private browsing
    }

    // Set <html lang="...">
    document.documentElement.lang = lang;

    // Update text content for elements with data-i18n
    const elements = document.querySelectorAll('[data-i18n]');
    elements.forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (translations[lang] && translations[lang][key] !== undefined) {
            el.textContent = translations[lang][key];
        }
    });

    // Update attributes (e.g. data-i18n-attr="aria-label:exp.prev_aria")
    const attrElements = document.querySelectorAll('[data-i18n-attr]');
    attrElements.forEach(el => {
        const spec = el.getAttribute('data-i18n-attr');
        if (!spec) return;
        const [attrName, key] = spec.split(':');
        if (attrName && key && translations[lang] && translations[lang][key] !== undefined) {
            el.setAttribute(attrName, translations[lang][key]);
        }
    });

    // Update Switcher UI Buttons (active state)
    const allLangButtons = document.querySelectorAll('[data-lang-btn]');
    allLangButtons.forEach(btn => {
        const btnLang = btn.getAttribute('data-lang-btn');
        const isActive = btnLang === lang;
        btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        if (isActive) {
            btn.className = 'lang-btn px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full transition-all duration-200 cursor-pointer bg-[#233B53] text-white shadow-2xs font-bold';
        } else {
            btn.className = 'lang-btn px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full transition-all duration-200 cursor-pointer text-[#1C2430]/70 hover:text-[#233B53] font-semibold';
        }
    });
}

function initLanguageSwitcher() {
    let savedLang = 'en';
    try {
        savedLang = localStorage.getItem(I18N_STORAGE_KEY) || 'en';
    } catch (e) {
        savedLang = 'en';
    }

    // Attach click listeners to all language switcher buttons (desktop & mobile)
    document.addEventListener('click', (e) => {
        const targetBtn = e.target.closest('[data-lang-btn]');
        if (targetBtn) {
            e.preventDefault();
            const lang = targetBtn.getAttribute('data-lang-btn');
            if (lang && lang !== currentLanguage) {
                setLanguage(lang);
            }
        }
    });

    // Apply initial language
    setLanguage(savedLang);
}

// Initialize Project Carousel — Infinite Loop with DOM Cloning
function initProjectCarousel() {
    const container = document.getElementById('projects-grid');
    if (!container) return;

    const realCards = Array.from(container.querySelectorAll('.project-card-item'));
    const total = realCards.length;
    if (total === 0) return;

    const CLONE_COUNT = 2;

    // Prepend clones of last N real cards, append clones of first N real cards
    for (let i = CLONE_COUNT - 1; i >= 0; i--) {
        const cloneFront = realCards[total - 1 - i].cloneNode(true);
        cloneFront.classList.add('proj-clone');
        cloneFront.removeAttribute('data-project-index');
        container.insertBefore(cloneFront, container.firstChild);
    }
    for (let i = 0; i < CLONE_COUNT; i++) {
        const cloneBack = realCards[i].cloneNode(true);
        cloneBack.classList.add('proj-clone');
        cloneBack.removeAttribute('data-project-index');
        container.appendChild(cloneBack);
    }

    const allCards = Array.from(container.querySelectorAll('.project-card-item'));
    const dots = document.querySelectorAll('[data-proj-dot]');
    let currentIndex = CLONE_COUNT; // index into allCards for the first real card
    let isJumping = false;

    function centerCard(index, animate) {
        const card = allCards[index];
        if (!card) return;
        const containerW = container.offsetWidth;
        const target = card.offsetLeft - containerW / 2 + card.offsetWidth / 2;
        if (!animate) {
            // Instant jump without smooth scroll
            container.style.scrollBehavior = 'auto';
            container.scrollLeft = target;
            container.style.scrollBehavior = '';
        } else {
            container.scrollTo({ left: target, behavior: 'smooth' });
        }
        updateActiveState(index);
    }

    function updateActiveState(centerIdx) {
        allCards.forEach((c, i) => {
            c.classList.toggle('is-active', i === centerIdx);
        });
        const realIdx = ((centerIdx - CLONE_COUNT) % total + total) % total;
        dots.forEach((dot, i) => {
            const isActive = i === realIdx;
            dot.classList.toggle('bg-[#233B53]', isActive);
            dot.classList.toggle('ring-1', isActive);
            dot.classList.toggle('ring-[#233B53]/20', isActive);
            dot.classList.toggle('w-7', isActive);
            dot.classList.toggle('bg-[#C4D7E8]', !isActive);
            dot.classList.toggle('w-2', !isActive);
        });
    }

    function handleLoopJump() {
        if (isJumping) return;
        if (currentIndex < CLONE_COUNT) {
            isJumping = true;
            currentIndex = currentIndex + total;
            centerCard(currentIndex, false);
            setTimeout(() => { isJumping = false; }, 50);
        } else if (currentIndex >= CLONE_COUNT + total) {
            isJumping = true;
            currentIndex = currentIndex - total;
            centerCard(currentIndex, false);
            setTimeout(() => { isJumping = false; }, 50);
        }
    }

    // Scroll listener: detect closest card → set active → handle loop jump
    let scrollTimer;
    container.addEventListener('scroll', () => {
        if (isJumping) return;
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(() => {
            const containerCenter = container.scrollLeft + container.offsetWidth / 2;
            let closest = currentIndex;
            let minDist = Infinity;
            allCards.forEach((card, i) => {
                const cardCenter = card.offsetLeft + card.offsetWidth / 2;
                const dist = Math.abs(cardCenter - containerCenter);
                if (dist < minDist) { minDist = dist; closest = i; }
            });
            currentIndex = closest;
            updateActiveState(currentIndex);
            handleLoopJump();
        }, 80);
    }, { passive: true });

    // Nav arrow buttons (called from Blade onclick)
    window.scrollProjectsByStep = function(step) {
        currentIndex += step;
        // Wrap around if out of bounds (allCards.length includes clones)
        if (currentIndex < 0) currentIndex = CLONE_COUNT + total - 1;
        if (currentIndex >= allCards.length) currentIndex = CLONE_COUNT;
        centerCard(currentIndex, true);
        setTimeout(handleLoopJump, 450);
    };

    // Dot click navigation
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            currentIndex = i + CLONE_COUNT;
            centerCard(currentIndex, true);
        });
    });

    // Click on side (inactive) card to bring it center
    allCards.forEach((card, i) => {
        card.addEventListener('click', (e) => {
            if (!card.classList.contains('is-active') && !e.target.closest('a')) {
                currentIndex = i;
                centerCard(currentIndex, true);
                setTimeout(handleLoopJump, 450);
            }
        });
    });

    // Init: jump to first real card instantly
    setTimeout(() => centerCard(currentIndex, false), 50);

    window.addEventListener('resize', () => centerCard(currentIndex, false));
}

// Drag and Touch to scroll horizontally for Netflix-style carousels
function initDragToScroll() {
    const sliders = [
        document.getElementById('exp-scroll-container'),
        document.getElementById('projects-grid')
    ];

    sliders.forEach(slider => {
        if (!slider) return;

        let isDown = false;
        let startX;
        let scrollLeft;

        // Mouse Drag Events
        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.6;
            slider.scrollLeft = scrollLeft - walk;
        });

        // Touch Swipe Events for mobile / touch devices
        let touchStartX = 0;
        let touchScrollLeft = 0;

        slider.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].pageX - slider.offsetLeft;
            touchScrollLeft = slider.scrollLeft;
        }, { passive: true });

        slider.addEventListener('touchmove', (e) => {
            const touchX = e.touches[0].pageX - slider.offsetLeft;
            const walk = (touchX - touchStartX) * 1.2;
            slider.scrollLeft = touchScrollLeft - walk;
        }, { passive: true });
    });
}

// Interactive Parallax Background & Section Gradient Accents
function initParallaxGradients() {
    // Respect user's motion preferences
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const orbs = document.querySelectorAll('.parallax-orb');
    const sectionGradients = document.querySelectorAll('.section-gradient-accent');
    if (!orbs.length && !sectionGradients.length) return;

    const isTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);
    let mouseX = 0;
    let mouseY = 0;
    let currentMouseX = 0;
    let currentMouseY = 0;
    let ticking = false;

    function renderParallax() {
        const scrollY = window.pageYOffset || document.documentElement.scrollTop;

        // Animate global background orbs
        orbs.forEach((orb) => {
            const speed = parseFloat(orb.dataset.speed || '0.05');
            const axis = orb.dataset.axis || 'y';

            const yOffset = scrollY * speed;
            const xMouse = isTouch ? 0 : currentMouseX * speed * 30;
            const yMouse = isTouch ? 0 : currentMouseY * speed * 30;

            if (axis === 'both') {
                orb.style.transform = `translate3d(${xMouse.toFixed(1)}px, ${(yOffset + yMouse).toFixed(1)}px, 0)`;
            } else if (axis === 'x') {
                orb.style.transform = `translate3d(${xMouse.toFixed(1)}px, 0, 0)`;
            } else {
                orb.style.transform = `translate3d(0, ${(yOffset + yMouse).toFixed(1)}px, 0)`;
            }
        });

        // Animate localized section gradient accents based on viewport visibility
        const viewHeight = window.innerHeight;
        sectionGradients.forEach((grad) => {
            const parent = grad.parentElement;
            if (!parent) return;
            const rect = parent.getBoundingClientRect();
            if (rect.top < viewHeight && rect.bottom > 0) {
                const speed = parseFloat(grad.dataset.speed || '0.04');
                const progress = (viewHeight - rect.top) / (viewHeight + rect.height);
                const shiftY = (progress - 0.5) * speed * 350;
                const shiftX = isTouch ? 0 : currentMouseX * speed * 80;
                grad.style.transform = `translate3d(${shiftX.toFixed(1)}px, ${shiftY.toFixed(1)}px, 0)`;
            }
        });

        ticking = false;
    }

    // Scroll listener with RAF throttle
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(renderParallax);
            ticking = true;
        }
    }, { passive: true });

    // Desktop interactive mouse cursor shift
    if (!isTouch) {
        window.addEventListener('mousemove', (e) => {
            mouseX = (e.clientX / window.innerWidth) - 0.5;
            mouseY = (e.clientY / window.innerHeight) - 0.5;

            // Gentle smoothing
            currentMouseX += (mouseX - currentMouseX) * 0.15;
            currentMouseY += (mouseY - currentMouseY) * 0.15;

            if (!ticking) {
                requestAnimationFrame(renderParallax);
                ticking = true;
            }
        }, { passive: true });
    }

    // Initial render
    renderParallax();
}

// Copy to Clipboard with Toast Notification
window.copyToClipboard = function(text, label = 'Text') {
    const successMsg = `✨ ${text} copied to clipboard!`;

    navigator.clipboard.writeText(text).then(() => {
        showToast(successMsg);
    }).catch(err => {
        console.error('Failed to copy:', err);
        showToast('Failed to copy to clipboard.', 'error');
    });
};

// Toast notification helper
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `flex items-center gap-3 px-4 py-3 rounded-2xl shadow-xl transition-all duration-300 transform translate-y-4 opacity-0 text-sm font-medium border backdrop-blur-md ${
        type === 'success' 
            ? 'bg-stone-900/90 text-stone-100 border-[#233B53]/50' 
            : 'bg-rose-900/90 text-rose-100 border-rose-700/50'
    }`;
    toast.innerHTML = `
        <span class="inline-block w-2 h-2 rounded-full bg-[#233B53] animate-pulse"></span>
        <span>${message}</span>
    `;

    container.appendChild(toast);

    // Animate in
    requestAnimationFrame(() => {
        toast.classList.remove('translate-y-4', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
    });

    // Animate out after 3.5s
    setTimeout(() => {
        toast.classList.remove('translate-y-0', 'opacity-100');
        toast.classList.add('translate-y-2', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 3500);
}

// Project Filter by Category
function initProjectFilter() {
    const filterButtons = document.querySelectorAll('[data-filter-btn]');
    const projectCards = document.querySelectorAll('[data-project-category]');

    if (!filterButtons.length) return;

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const category = btn.getAttribute('data-filter-btn');

            // Update active button state
            filterButtons.forEach(b => {
                b.classList.remove('bg-[#1F3D2B]', 'text-white', 'shadow-xs');
                b.classList.add('bg-stone-100', 'text-stone-700');
            });

            btn.classList.remove('bg-stone-100', 'text-stone-700');
            btn.classList.add('bg-[#1F3D2B]', 'text-white', 'shadow-xs');

            // Filter items with smooth animation
            projectCards.forEach(card => {
                const cardCat = card.getAttribute('data-project-category');
                if (category === 'all' || cardCat.toLowerCase().includes(category.toLowerCase())) {
                    card.style.display = 'flex';
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.96)';
                    setTimeout(() => {
                        card.style.transition = 'all 0.3s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
}

// Mobile Menu Toggle
function initMobileMenu() {
    const toggleBtn = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu');
    const links = document.querySelectorAll('.mobile-nav-link');

    if (!toggleBtn || !menu) return;

    toggleBtn.addEventListener('click', () => {
        const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
        toggleBtn.setAttribute('aria-expanded', !isExpanded);
        menu.classList.toggle('hidden');
    });

    links.forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.add('hidden');
            toggleBtn.setAttribute('aria-expanded', 'false');
        });
    });
}

// Sticky Navbar scroll effects (slight padding adjustment, subtle shadow, and backdrop blur)
function initStickyNavbar() {
    const navbarHeader = document.getElementById('navbar-header');
    const navbarPill = document.getElementById('navbar-pill');

    if (!navbarHeader || !navbarPill) return;

    let isScrolled = false;

    const handleScroll = () => {
        const scrolled = window.scrollY > 20;
        if (scrolled === isScrolled) return;
        isScrolled = scrolled;

        if (isScrolled) {
            navbarHeader.classList.remove('pt-3', 'sm:pt-4');
            navbarHeader.classList.add('pt-2');

            navbarPill.classList.remove('py-2.5', 'sm:py-3', 'shadow-xs');
            navbarPill.classList.add('py-2', 'sm:py-2.5', 'shadow-md', 'shadow-stone-900/5', 'bg-white/95');
        } else {
            navbarHeader.classList.remove('pt-2');
            navbarHeader.classList.add('pt-3', 'sm:pt-4');

            navbarPill.classList.remove('py-2', 'sm:py-2.5', 'shadow-md', 'shadow-stone-900/5', 'bg-white/95');
            navbarPill.classList.add('py-2.5', 'sm:py-3', 'shadow-xs');
        }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
}

// Back to Top button controller
function initBackToTop() {
    const backToTopBtn = document.getElementById('back-to-top');
    if (!backToTopBtn) return;

    let isVisible = false;

    const handleScroll = () => {
        const shouldShow = window.scrollY > 300;
        if (shouldShow === isVisible) return;
        isVisible = shouldShow;

        if (isVisible) {
            backToTopBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-3');
            backToTopBtn.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
        } else {
            backToTopBtn.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            backToTopBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-3');
        }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Certificate Preview Modal
window.openCertificateModal = function(imageSrc, fileSrc, isPdf, title, issuer, badge) {
    const modal = document.getElementById('cert-modal');
    const modalCard = document.getElementById('cert-modal-card');
    const modalImg = document.getElementById('cert-modal-img');
    const modalTitle = document.getElementById('cert-modal-title');
    const modalIssuer = document.getElementById('cert-modal-issuer');
    const modalBadge = document.getElementById('cert-modal-badge');
    const modalDownload = document.getElementById('cert-modal-download');

    if (!modal) return;

    if (modalTitle) modalTitle.textContent = title || '';
    if (modalIssuer) modalIssuer.textContent = issuer || '';
    if (modalBadge) {
        modalBadge.textContent = badge || 'Certificate';
        modalBadge.style.display = badge ? 'inline-block' : 'none';
    }
    if (modalImg) {
        modalImg.src = imageSrc || fileSrc;
        modalImg.alt = title || 'Certificate';
    }
    if (modalDownload) {
        modalDownload.href = fileSrc || imageSrc;
        modalDownload.textContent = isPdf ? 'Open PDF' : 'Open Image';
    }

    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');
    if (modalCard) {
        modalCard.classList.remove('scale-95');
        modalCard.classList.add('scale-100');
    }
    document.body.classList.add('overflow-hidden');
};

window.closeCertificateModal = function() {
    const modal = document.getElementById('cert-modal');
    const modalCard = document.getElementById('cert-modal-card');

    if (!modal) return;

    modal.classList.remove('opacity-100', 'pointer-events-auto');
    modal.classList.add('opacity-0', 'pointer-events-none');
    if (modalCard) {
        modalCard.classList.remove('scale-100');
        modalCard.classList.add('scale-95');
    }
    document.body.classList.remove('overflow-hidden');
};

// Global button carousel scroller helper
window.scrollCarousel = function(containerId, offset) {
    const container = document.getElementById(containerId);
    if (container) {
        container.scrollBy({ left: offset, behavior: 'smooth' });
    }
};

// Smooth Scroll Reveal & Staggered Animations using IntersectionObserver
function initScrollReveal() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('.reveal-section, .reveal-item').forEach(el => {
            el.classList.add('is-revealed');
        });
        return;
    }

    const sections = document.querySelectorAll('main > div > section');
    sections.forEach((section, idx) => {
        section.classList.add('reveal-section');
        // Initial hero visible immediately to prevent layout shift or perceived lag
        if (idx === 0) {
            section.classList.add('is-revealed');
        }
    });

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                
                // Animate child cards with a refined stagger effect
                const cards = entry.target.querySelectorAll('.clean-card, .project-card-item');
                cards.forEach((card, index) => {
                    card.style.transitionDelay = `${index * 60}ms`;
                    card.classList.add('is-revealed');
                });

                obs.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -40px 0px'
    });

    sections.forEach((section, idx) => {
        if (idx > 0) {
            observer.observe(section);
        }
    });
}

// Copy Email to Clipboard Feature with Visual Feedback
function initCopyEmail() {
    const copyBtn = document.getElementById('copy-email-btn');
    if (!copyBtn) return;

    let resetTimer = null;

    copyBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        e.stopPropagation();

        const email = copyBtn.getAttribute('data-email') || 'tiaraariyantoputrii@gmail.com';
        const textSpan = document.getElementById('copy-email-text');
        const iconSvg = document.getElementById('copy-email-icon');

        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(email);
            } else {
                // Fallback for non-https or restricted environments
                const tempInput = document.createElement('textarea');
                tempInput.value = email;
                tempInput.style.position = 'fixed';
                tempInput.style.opacity = '0';
                document.body.appendChild(tempInput);
                tempInput.focus();
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
            }

            // Visual Success State
            const currentLang = document.documentElement.lang || 'en';
            const copiedText = (translations[currentLang] && translations[currentLang]['contact.email_copied']) || 'Copied!';
            
            if (textSpan) {
                textSpan.textContent = copiedText;
            }

            copyBtn.classList.remove('bg-[#FAFAF7]', 'text-[#233B53]', 'border-[#E6ECF1]');
            copyBtn.classList.add('bg-emerald-500', 'text-white', 'border-emerald-600', 'shadow-xs');

            if (iconSvg) {
                // Checkmark icon
                iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />';
            }

            if (resetTimer) clearTimeout(resetTimer);
            resetTimer = setTimeout(() => {
                const revertLang = document.documentElement.lang || 'en';
                const originalText = (translations[revertLang] && translations[revertLang]['contact.copy_email']) || 'Copy Email';
                if (textSpan) {
                    textSpan.textContent = originalText;
                }
                copyBtn.classList.remove('bg-emerald-500', 'text-white', 'border-emerald-600', 'shadow-xs');
                copyBtn.classList.add('bg-[#FAFAF7]', 'text-[#233B53]', 'border-[#E6ECF1]');
                if (iconSvg) {
                    // Restore copy icon
                    iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />';
                }
            }, 2000);

        } catch (err) {
            console.error('Failed to copy email:', err);
        }
    });
}

// Active Navbar Link Highlighting based on Scroll Position (ScrollSpy)
function initActiveNavbarSpy() {
    const navLinks = document.querySelectorAll('#navbar-links .nav-pill-item');
    const mobileLinks = document.querySelectorAll('#mobile-menu .mobile-nav-link');
    const sections = document.querySelectorAll('section[id]');

    if (!navLinks.length || !sections.length) return;

    let currentActiveId = '';

    const updateActiveNav = () => {
        const scrollPosition = window.scrollY + 140; // Offset below sticky header

        let activeSectionId = '';
        sections.forEach(sec => {
            const top = sec.offsetTop;
            const height = sec.offsetHeight;
            if (scrollPosition >= top && scrollPosition < top + height) {
                activeSectionId = sec.getAttribute('id');
            }
        });

        // Fallback for top of page
        if (!activeSectionId && window.scrollY < 200) {
            activeSectionId = 'hero';
        }

        if (activeSectionId === currentActiveId) return;
        currentActiveId = activeSectionId;

        navLinks.forEach(link => {
            const href = link.getAttribute('href') || '';
            const isMatch = href === `#${activeSectionId}`;
            link.classList.toggle('is-active-nav', isMatch);
        });

        mobileLinks.forEach(link => {
            const href = link.getAttribute('href') || '';
            const isMatch = href === `#${activeSectionId}`;
            link.classList.toggle('is-active-nav', isMatch);
        });
    };

    window.addEventListener('scroll', updateActiveNav, { passive: true });
    updateActiveNav();
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    initLanguageSwitcher();
    initCopyEmail();
    initStickyNavbar();
    initBackToTop();
    initProjectFilter();
    initMobileMenu();
    initDragToScroll();
    initProjectCarousel();
    initParallaxGradients();
    initScrollReveal();
    initActiveNavbarSpy();

    // Close certificate modal on backdrop click or Escape key
    const modal = document.getElementById('cert-modal');
    const backdrop = document.getElementById('cert-modal-backdrop');
    if (backdrop) {
        backdrop.addEventListener('click', () => {
            window.closeCertificateModal();
        });
    }
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('pointer-events-none')) {
            window.closeCertificateModal();
        }
    });
});
