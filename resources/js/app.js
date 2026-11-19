import i18next from 'i18next';
import enTranslations from '../locales/en.json';
import idTranslations from '../locales/id.json';

// Bilingual (EN / ID) Language Switcher using i18next
const I18N_STORAGE_KEY = 'tiara_portfolio_lang';
let currentLanguage = 'en';

export function updateDOMTranslations() {
    // Set <html lang="...">
    document.documentElement.lang = currentLanguage;

    // Update text content for elements with data-i18n
    const elements = document.querySelectorAll('[data-i18n]');
    elements.forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (key && i18next.exists(key)) {
            el.textContent = i18next.t(key);
        }
    });

    // Update attributes (e.g. data-i18n-attr="aria-label:exp.prev_aria")
    const attrElements = document.querySelectorAll('[data-i18n-attr]');
    attrElements.forEach(el => {
        const spec = el.getAttribute('data-i18n-attr');
        if (!spec) return;
        const [attrName, key] = spec.split(':');
        if (attrName && key && i18next.exists(key)) {
            el.setAttribute(attrName, i18next.t(key));
        }
    });

    // Update Switcher UI Buttons (active state)
    const allLangButtons = document.querySelectorAll('[data-lang-btn]');
    allLangButtons.forEach(btn => {
        const btnLang = btn.getAttribute('data-lang-btn');
        const isActive = btnLang === currentLanguage;
        btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        if (isActive) {
            btn.className = 'lang-btn px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full transition-all duration-200 cursor-pointer bg-[#233B53] text-white shadow-2xs font-bold';
        } else {
            btn.className = 'lang-btn px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full transition-all duration-200 cursor-pointer text-[#1C2430]/70 hover:text-[#233B53] font-semibold';
        }
    });
}

export function setLanguage(lang) {
    if (lang !== 'en' && lang !== 'id') return;
    currentLanguage = lang;
    try {
        localStorage.setItem(I18N_STORAGE_KEY, lang);
    } catch (e) {
        // localStorage might be unavailable in private browsing
    }

    i18next.changeLanguage(lang, (err) => {
        if (err) {
            console.error('Error changing i18next language:', err);
            return;
        }
        updateDOMTranslations();
        // If project modal is currently open, re-render with new language
        const projModal = document.getElementById('project-modal');
        if (projModal && !projModal.classList.contains('pointer-events-none') && typeof renderProjectModalContent === 'function') {
            renderProjectModalContent();
        }
    });
}

async function initLanguageSwitcher() {
    let savedLang = 'en';
    try {
        savedLang = localStorage.getItem(I18N_STORAGE_KEY) || 'en';
    } catch (e) {
        savedLang = 'en';
    }
    if (savedLang !== 'en' && savedLang !== 'id') {
        savedLang = 'en';
    }
    currentLanguage = savedLang;

    await i18next.init({
        lng: savedLang,
        fallbackLng: 'en',
        debug: false,
        resources: {
            en: { translation: enTranslations },
            id: { translation: idTranslations }
        },
        interpolation: {
            escapeValue: false
        }
    });

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

    // Apply initial translations
    updateDOMTranslations();
}

// Initialize Project Carousel — Infinite Loop with DOM Cloning
function initProjectCarousel() {
    const container = document.getElementById('projects-grid');
    if (!container) return;

    const realCards = Array.from(container.querySelectorAll('.project-card-item'));
    const total = realCards.length;
    if (total === 0) return;

    const CLONE_COUNT = 2;

    // Prepend clones of last N real cards in correct sequence [total-2, total-1]
    // Append clones of first N real cards in correct sequence [0, 1]
    for (let i = 0; i < CLONE_COUNT; i++) {
        const cloneFront = realCards[total - CLONE_COUNT + i].cloneNode(true);
        cloneFront.classList.add('proj-clone');
        cloneFront.setAttribute('data-project-index', String(total - CLONE_COUNT + i));
        const frontBtn = cloneFront.querySelector('[data-project-open-btn]');
        if (frontBtn) frontBtn.setAttribute('data-project-open-btn', String(total - CLONE_COUNT + i));
        container.insertBefore(cloneFront, realCards[0]);
    }
    for (let i = 0; i < CLONE_COUNT; i++) {
        const cloneBack = realCards[i].cloneNode(true);
        cloneBack.classList.add('proj-clone');
        cloneBack.setAttribute('data-project-index', String(i));
        const backBtn = cloneBack.querySelector('[data-project-open-btn]');
        if (backBtn) backBtn.setAttribute('data-project-open-btn', String(i));
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
    window.scrollProjectsByStep = function (step) {
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

    // Click on card or arrow button:
    // - If dragged recently: ignore click to prevent conflict with dragging/swiping
    // - If arrow button clicked: open popup directly for this project
    // - If inactive card clicked: bring it to center
    // - If active card clicked: open project detail popup modal
    allCards.forEach((card, i) => {
        card.addEventListener('click', (e) => {
            // Ignore click if user was dragging/swiping the carousel
            if (isCarouselDragging) return;

            const realIndex = ((i - CLONE_COUNT) % total + total) % total;

            // Direct click on the arrow button inside card
            const openBtn = e.target.closest('[data-project-open-btn]');
            if (openBtn) {
                e.preventDefault();
                e.stopPropagation();
                if (window.openProjectModal) {
                    window.openProjectModal(realIndex);
                }
                return;
            }

            // Click anywhere else on the card
            if (!card.classList.contains('is-active')) {
                currentIndex = i;
                centerCard(currentIndex, true);
                setTimeout(handleLoopJump, 450);
            } else {
                // Card is already centered & active: open popup!
                if (window.openProjectModal) {
                    window.openProjectModal(realIndex);
                }
            }
        });
    });

    // Init: jump to first real card instantly
    setTimeout(() => centerCard(currentIndex, false), 50);

    window.addEventListener('resize', () => centerCard(currentIndex, false));
}

// Flag to prevent click conflicts during drag/swipe
let isCarouselDragging = false;

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
        let hasMoved = false;

        // Mouse Drag Events
        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            hasMoved = false;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
            setTimeout(() => { isCarouselDragging = false; }, 80);
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
            if (hasMoved) {
                isCarouselDragging = true;
                setTimeout(() => { isCarouselDragging = false; }, 120);
            } else {
                isCarouselDragging = false;
            }
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            const x = e.pageX - slider.offsetLeft;
            const dist = Math.abs(x - startX);
            if (dist > 5) {
                hasMoved = true;
                isCarouselDragging = true;
            }
            e.preventDefault();
            const walk = (x - startX) * 1.6;
            slider.scrollLeft = scrollLeft - walk;
        });

        // Touch Swipe Events for mobile / touch devices
        let touchStartX = 0;
        let touchScrollLeft = 0;
        let touchMoved = false;

        slider.addEventListener('touchstart', (e) => {
            touchMoved = false;
            touchStartX = e.touches[0].pageX - slider.offsetLeft;
            touchScrollLeft = slider.scrollLeft;
        }, { passive: true });

        slider.addEventListener('touchmove', (e) => {
            const touchX = e.touches[0].pageX - slider.offsetLeft;
            if (Math.abs(touchX - touchStartX) > 8) {
                touchMoved = true;
                isCarouselDragging = true;
            }
            const walk = (touchX - touchStartX) * 1.2;
            slider.scrollLeft = touchScrollLeft - walk;
        }, { passive: true });

        slider.addEventListener('touchend', () => {
            if (touchMoved) {
                isCarouselDragging = true;
                setTimeout(() => { isCarouselDragging = false; }, 120);
            } else {
                isCarouselDragging = false;
            }
        });
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
window.copyToClipboard = function (text, label = 'Text') {
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
    toast.className = `flex items-center gap-3 px-4 py-3 rounded-2xl shadow-xl transition-all duration-300 transform translate-y-4 opacity-0 text-sm font-medium border backdrop-blur-md ${type === 'success'
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
let savedCertScrollPosition = 0;

window.openCertificateModal = function (imageSrc, fileSrc, isPdf, title, issuer, badge) {
    const modal = document.getElementById('cert-modal');
    const modalCard = document.getElementById('cert-modal-card');
    const modalBody = document.getElementById('cert-modal-body');
    const modalImg = document.getElementById('cert-modal-img');
    const modalTitle = document.getElementById('cert-modal-title');
    const modalIssuer = document.getElementById('cert-modal-issuer');
    const modalBadge = document.getElementById('cert-modal-badge');
    const modalDownload = document.getElementById('cert-modal-download');
    const modalDownloadText = document.getElementById('cert-modal-download-text');

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
    }
    if (modalDownloadText) {
        const key = isPdf ? 'cert.modal_open_pdf' : 'cert.modal_open_image';
        const fallback = isPdf ? 'Open PDF' : 'Open Image';
        modalDownloadText.textContent = (typeof i18next !== 'undefined' && i18next.exists(key)) ? i18next.t(key) : fallback;
    }

    // Reset internal scroll of modal body
    if (modalBody) {
        modalBody.scrollTop = 0;
    }

    // Lock background scroll completely and prevent scroll chaining
    savedCertScrollPosition = window.pageYOffset || document.documentElement.scrollTop || 0;
    document.body.style.position = 'fixed';
    document.body.style.top = `-${savedCertScrollPosition}px`;
    document.body.style.left = '0';
    document.body.style.right = '0';
    document.body.style.width = '100%';
    document.body.style.overflow = 'hidden';

    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');
    if (modalCard) {
        modalCard.classList.remove('scale-95');
        modalCard.classList.add('scale-100');
    }
};

window.closeCertificateModal = function () {
    const modal = document.getElementById('cert-modal');
    const modalCard = document.getElementById('cert-modal-card');

    if (!modal) return;

    modal.classList.remove('opacity-100', 'pointer-events-auto');
    modal.classList.add('opacity-0', 'pointer-events-none');
    if (modalCard) {
        modalCard.classList.remove('scale-100');
        modalCard.classList.add('scale-95');
    }

    // Instantly restore background scroll position without auto-scroll or animation
    const targetScroll = savedCertScrollPosition;
    const htmlEl = document.documentElement;
    const originalScrollBehavior = htmlEl.style.scrollBehavior;
    htmlEl.style.scrollBehavior = 'auto';

    document.body.style.position = '';
    document.body.style.top = '';
    document.body.style.left = '';
    document.body.style.right = '';
    document.body.style.width = '';
    document.body.style.overflow = '';

    window.scrollTo({
        top: targetScroll,
        left: 0,
        behavior: 'instant'
    });

    htmlEl.style.scrollBehavior = originalScrollBehavior;
};

// ==========================================
// Project Detail Popup Modal
// ==========================================
let projectsList = [];
let activeProjectIndex = 0;
let activeProjectImgIndex = 0;
let savedScrollPosition = 0;

function parseProjectsData() {
    if (projectsList.length) return projectsList;
    const scriptEl = document.getElementById('portfolio-projects-data');
    if (scriptEl && scriptEl.textContent) {
        try {
            projectsList = JSON.parse(scriptEl.textContent);
        } catch (e) {
            console.error('Failed to parse portfolio projects data:', e);
            projectsList = [];
        }
    }
    return projectsList;
}

window.openProjectModal = function (index) {
    parseProjectsData();
    if (!projectsList.length) return;

    const modal = document.getElementById('project-modal');
    const modalCard = document.getElementById('project-modal-card');
    if (!modal) return;

    // Bounds check
    const idx = parseInt(index, 10);
    if (isNaN(idx) || idx < 0 || idx >= projectsList.length) return;

    activeProjectIndex = idx;
    activeProjectImgIndex = 0;

    renderProjectModalContent();

    // Reset popup scroll body to top
    const modalBody = document.getElementById('project-modal-body');
    if (modalBody) {
        modalBody.scrollTop = 0;
    }

    // Save background scroll position and lock body completely (desktop & mobile)
    savedScrollPosition = window.pageYOffset || document.documentElement.scrollTop || 0;
    document.body.style.position = 'fixed';
    document.body.style.top = `-${savedScrollPosition}px`;
    document.body.style.left = '0';
    document.body.style.right = '0';
    document.body.style.width = '100%';
    document.body.style.overflow = 'hidden';

    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100', 'pointer-events-auto');
    if (modalCard) {
        modalCard.classList.remove('scale-95');
        modalCard.classList.add('scale-100');
    }
};

window.closeProjectModal = function () {
    const modal = document.getElementById('project-modal');
    const modalCard = document.getElementById('project-modal-card');
    if (!modal) return;

    modal.classList.remove('opacity-100', 'pointer-events-auto');
    modal.classList.add('opacity-0', 'pointer-events-none');
    if (modalCard) {
        modalCard.classList.remove('scale-100');
        modalCard.classList.add('scale-95');
    }

    // Instantly restore background scroll position without auto-scroll or animation
    const targetScroll = savedScrollPosition;
    const htmlEl = document.documentElement;
    const originalScrollBehavior = htmlEl.style.scrollBehavior;
    htmlEl.style.scrollBehavior = 'auto';

    document.body.style.position = '';
    document.body.style.top = '';
    document.body.style.left = '';
    document.body.style.right = '';
    document.body.style.width = '';
    document.body.style.overflow = '';

    window.scrollTo({
        top: targetScroll,
        left: 0,
        behavior: 'instant'
    });

    htmlEl.style.scrollBehavior = originalScrollBehavior;
};

window.navigateProjectModal = function (step) {
    parseProjectsData();
    const newIdx = activeProjectIndex + step;
    if (newIdx < 0 || newIdx >= projectsList.length) return;

    activeProjectIndex = newIdx;
    activeProjectImgIndex = 0;
    renderProjectModalContent();

    // Reset popup body scroll to the top when switching projects
    const modalBody = document.getElementById('project-modal-body');
    if (modalBody) {
        modalBody.scrollTop = 0;
    }
};

function renderProjectModalContent() {
    const project = projectsList[activeProjectIndex];
    if (!project) return;

    // Localized translations from i18next if available
    const translatedTitle = i18next.exists(`proj.${activeProjectIndex}.title`)
        ? i18next.t(`proj.${activeProjectIndex}.title`)
        : project.title;

    const translatedDesc = i18next.exists(`proj.${activeProjectIndex}.desc`)
        ? i18next.t(`proj.${activeProjectIndex}.desc`)
        : project.description;

    // Elements
    const titleEl = document.getElementById('project-modal-title');
    const categoryEl = document.getElementById('project-modal-category');
    const methodologyEl = document.getElementById('project-modal-methodology');
    const overviewEl = document.getElementById('project-modal-overview');
    const imgEl = document.getElementById('project-modal-image');
    const imgFallback = document.getElementById('project-modal-image-fallback');
    const imgControls = document.getElementById('project-modal-img-controls');
    const imgCounter = document.getElementById('project-modal-img-counter');
    const assetsSec = document.getElementById('project-modal-assets-section');
    const linksEl = document.getElementById('project-modal-links');
    const techEl = document.getElementById('project-modal-tech');
    const prevBtn = document.getElementById('project-modal-prev-btn');
    const nextBtn = document.getElementById('project-modal-next-btn');
    const currIdxEl = document.getElementById('project-modal-current-idx');
    const totalCountEl = document.getElementById('project-modal-total-count');

    // 1. Project Image
    const images = project.images && project.images.length ? project.images : (project.image ? [project.image] : []);
    if (images.length > 0) {
        if (activeProjectImgIndex >= images.length) activeProjectImgIndex = 0;
        imgEl.src = images[activeProjectImgIndex];
        imgEl.alt = translatedTitle;
        if (project.image_position) {
            imgEl.style.objectPosition = project.image_position;
        } else {
            imgEl.style.objectPosition = 'center top';
        }
        imgEl.classList.remove('hidden');
        if (imgFallback) imgFallback.classList.add('hidden');

        // Multi-image navigation
        if (images.length > 1) {
            if (imgControls) imgControls.classList.remove('hidden');
            if (imgCounter) imgCounter.textContent = `${activeProjectImgIndex + 1} / ${images.length}`;

            const prevImgBtn = document.getElementById('project-modal-img-prev');
            const nextImgBtn = document.getElementById('project-modal-img-next');
            if (prevImgBtn) {
                prevImgBtn.onclick = (e) => {
                    e.stopPropagation();
                    activeProjectImgIndex = (activeProjectImgIndex - 1 + images.length) % images.length;
                    renderProjectModalContent();
                };
            }
            if (nextImgBtn) {
                nextImgBtn.onclick = (e) => {
                    e.stopPropagation();
                    activeProjectImgIndex = (activeProjectImgIndex + 1) % images.length;
                    renderProjectModalContent();
                };
            }
        } else {
            if (imgControls) imgControls.classList.add('hidden');
        }
    } else {
        imgEl.classList.add('hidden');
        if (imgControls) imgControls.classList.add('hidden');
        if (imgFallback) imgFallback.classList.remove('hidden');
    }

    // Header Category Badge
    if (categoryEl) categoryEl.textContent = project.category || 'Project';

    // 2. Project Assets & Repositories Links
    const rawUrl = (project.url || '').trim();
    const docUrl = (project.documentation_url || '').trim();
    const projectDocUrl = (project.document_url || '').trim();
    const srsUrl = (project.srs_url || '').trim();
    const isUrlInvalid = !rawUrl || ['#', 'internal', 'none'].includes(rawUrl.toLowerCase()) || rawUrl.toLowerCase().includes('not publicly available');
    const isDocInvalid = !docUrl || ['#', 'none'].includes(docUrl.toLowerCase());
    const isProjectDocInvalid = !projectDocUrl || ['#', 'none'].includes(projectDocUrl.toLowerCase());
    const isSrsInvalid = !srsUrl || ['#', 'none'].includes(srsUrl.toLowerCase());

    if (isUrlInvalid && isDocInvalid && isProjectDocInvalid && isSrsInvalid) {
        if (assetsSec) assetsSec.classList.add('hidden');
        if (linksEl) linksEl.innerHTML = '';
    } else {
        if (assetsSec) assetsSec.classList.remove('hidden');
        if (linksEl) {
            let linksHtml = '';
            const iconSvg = `<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>`;

            if (!isUrlInvalid) {
                let label = i18next.t('proj.modal_view_link') || 'Open Project Link';
                if (rawUrl.includes('figma.com')) {
                    label = i18next.t('proj.modal_view_figma') || 'View Figma Design';
                } else if (rawUrl.includes('github.com')) {
                    label = i18next.t('proj.modal_view_github') || 'View GitHub Repository';
                } else if (rawUrl.includes('drive.google.com')) {
                    label = i18next.t('proj.modal_view_demo') || 'Project Files';
                }

                linksHtml += `
                    <a href="${rawUrl}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#DCEAF7] text-[#233B53] hover:bg-[#233B53] hover:text-white border border-[#E6ECF1] transition-all shadow-2xs group">
                        <span>${label}</span>
                        <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">${iconSvg}</span>
                    </a>
                `;
            }

            if (!isDocInvalid) {
                const docLabel = i18next.t('proj.modal_view_docs') || 'Documentation';
                const docIconSvg = `<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>`;

                linksHtml += `
                    <a href="${docUrl}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#FAFAF7] text-[#233B53] hover:bg-[#233B53] hover:text-white border border-[#E6ECF1] transition-all shadow-2xs group">
                        <span>${docLabel}</span>
                        <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">${docIconSvg}</span>
                    </a>
                `;
            }

            if (!isProjectDocInvalid) {
                const docLabel = i18next.t('proj.modal_view_doc') || 'Document';
                const docIconSvg = `<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>`;

                linksHtml += `
                    <a href="${projectDocUrl}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#FAFAF7] text-[#233B53] hover:bg-[#233B53] hover:text-white border border-[#E6ECF1] transition-all shadow-2xs group">
                        <span>${docLabel}</span>
                        <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">${docIconSvg}</span>
                    </a>
                `;
            }

            if (!isSrsInvalid) {
                const srsLabel = i18next.t('proj.modal_view_srs') || 'SRS Document';
                const srsIconSvg = `<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>`;

                linksHtml += `
                    <a href="${srsUrl}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#FAFAF7] text-[#233B53] hover:bg-[#233B53] hover:text-white border border-[#E6ECF1] transition-all shadow-2xs group">
                        <span>${srsLabel}</span>
                        <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">${srsIconSvg}</span>
                    </a>
                `;
            }

            linksEl.innerHTML = linksHtml;
        }
    }

    // 3. Project Title
    if (titleEl) titleEl.textContent = translatedTitle;

    // 2. Project Period (below title in subtle, compact style)
    const periodWrapper = document.getElementById('project-modal-period-wrapper');
    const periodEl = document.getElementById('project-modal-period');
    if (project.period) {
        if (periodEl) periodEl.textContent = project.period;
        if (periodWrapper) periodWrapper.classList.remove('hidden');
    } else {
        if (periodWrapper) periodWrapper.classList.add('hidden');
    }

    // 4. Project Overview
    if (overviewEl) overviewEl.textContent = translatedDesc;

    // 5. My Contributions (Synchronized with Work Experience data for Diklat & SKJ, or project.contributions)
    const contributionsSec = document.getElementById('project-modal-contributions-section');
    const contributionsEl = document.getElementById('project-modal-contributions');

    // Resolve contribution points dynamically
    let contributionPoints = [];
    if (project.id === 'education-training-module' || activeProjectIndex === 0) {
        // Diklat (Jan–May 2026): Reuse descriptions from Work Experience index 1
        const p0 = i18next.exists('exp.1.point_0') ? i18next.t('exp.1.point_0') : null;
        const p1 = i18next.exists('exp.1.point_1') ? i18next.t('exp.1.point_1') : null;
        const p2 = i18next.exists('exp.1.point_2') ? i18next.t('exp.1.point_2') : null;
        contributionPoints = [p0, p1, p2].filter(Boolean);
    } else if (project.id === 'skj-module' || activeProjectIndex === 1) {
        // SKJ (Aug–Dec 2025): Reuse descriptions from Work Experience index 2
        const p0 = i18next.exists('exp.2.point_0') ? i18next.t('exp.2.point_0') : null;
        const p1 = i18next.exists('exp.2.point_1') ? i18next.t('exp.2.point_1') : null;
        const p2 = i18next.exists('exp.2.point_2') ? i18next.t('exp.2.point_2') : null;
        contributionPoints = [p0, p1, p2].filter(Boolean);
    } else if (project.id === 'timun-mas-folktale-ar' || activeProjectIndex === 2) {
        // Timun Mas AR: localized contributions from i18n
        const p0 = i18next.exists('proj.2.contribution_0') ? i18next.t('proj.2.contribution_0') : null;
        const p1 = i18next.exists('proj.2.contribution_1') ? i18next.t('proj.2.contribution_1') : null;
        const p2 = i18next.exists('proj.2.contribution_2') ? i18next.t('proj.2.contribution_2') : null;
        contributionPoints = [p0, p1, p2].filter(Boolean);
        if (contributionPoints.length === 0 && project.contributions) {
            contributionPoints = project.contributions;
        }
    } else if (project.id === 'susu-bahagia-ecommerce' || activeProjectIndex === 3) {
        // Susu Bahagia: localized contributions from i18n
        const p0 = i18next.exists('proj.3.contribution_0') ? i18next.t('proj.3.contribution_0') : null;
        const p1 = i18next.exists('proj.3.contribution_1') ? i18next.t('proj.3.contribution_1') : null;
        contributionPoints = [p0, p1].filter(Boolean);
        if (contributionPoints.length === 0 && project.contributions) {
            contributionPoints = project.contributions;
        }
    } else if (project.id === 'arabic-sign-language-recognition' || activeProjectIndex === 4) {
        // Arabic Hand Language: localized contributions from i18n
        const p0 = i18next.exists('proj.4.contribution_0') ? i18next.t('proj.4.contribution_0') : null;
        const p1 = i18next.exists('proj.4.contribution_1') ? i18next.t('proj.4.contribution_1') : null;
        const p2 = i18next.exists('proj.4.contribution_2') ? i18next.t('proj.4.contribution_2') : null;
        contributionPoints = [p0, p1, p2].filter(Boolean);
        if (contributionPoints.length === 0 && project.contributions) {
            contributionPoints = project.contributions;
        }
    } else if (project.id === 'connection-bracelet-barcode' || activeProjectIndex === 5) {
        // Connection Bracelet: localized contributions from i18n
        const p0 = i18next.exists('proj.5.contribution_0') ? i18next.t('proj.5.contribution_0') : null;
        const p1 = i18next.exists('proj.5.contribution_1') ? i18next.t('proj.5.contribution_1') : null;
        const p2 = i18next.exists('proj.5.contribution_2') ? i18next.t('proj.5.contribution_2') : null;
        contributionPoints = [p0, p1, p2].filter(Boolean);
        if (contributionPoints.length === 0 && project.contributions) {
            contributionPoints = project.contributions;
        }
    } else if (project.id === 'shawarma-station' || activeProjectIndex === 6) {
        // Shawarma Station: localized contributions from i18n
        const p0 = i18next.exists('proj.6.contribution_0') ? i18next.t('proj.6.contribution_0') : null;
        const p1 = i18next.exists('proj.6.contribution_1') ? i18next.t('proj.6.contribution_1') : null;
        const p2 = i18next.exists('proj.6.contribution_2') ? i18next.t('proj.6.contribution_2') : null;
        contributionPoints = [p0, p1, p2].filter(Boolean);
        if (contributionPoints.length === 0 && project.contributions) {
            contributionPoints = project.contributions;
        }
    } else if (project.id === 'pandu-application' || activeProjectIndex === 7) {
        // Pandu: localized contributions from i18n
        const p0 = i18next.exists('proj.7.contribution_0') ? i18next.t('proj.7.contribution_0') : null;
        const p1 = i18next.exists('proj.7.contribution_1') ? i18next.t('proj.7.contribution_1') : null;
        const p2 = i18next.exists('proj.7.contribution_2') ? i18next.t('proj.7.contribution_2') : null;
        contributionPoints = [p0, p1, p2].filter(Boolean);
        if (contributionPoints.length === 0 && project.contributions) {
            contributionPoints = project.contributions;
        }
    } else if (project.id === 'verdant-restaurant' || activeProjectIndex === 8) {
        // Verdant: localized contributions from i18n
        const p0 = i18next.exists('proj.8.contribution_0') ? i18next.t('proj.8.contribution_0') : null;
        const p1 = i18next.exists('proj.8.contribution_1') ? i18next.t('proj.8.contribution_1') : null;
        const p2 = i18next.exists('proj.8.contribution_2') ? i18next.t('proj.8.contribution_2') : null;
        contributionPoints = [p0, p1, p2].filter(Boolean);
        if (contributionPoints.length === 0 && project.contributions) {
            contributionPoints = project.contributions;
        }
    } else if (project.id === 'fastplanner' || activeProjectIndex === 9) {
        // FastPlanner: localized contributions from i18n
        const p0 = i18next.exists('proj.9.contribution_0') ? i18next.t('proj.9.contribution_0') : null;
        const p1 = i18next.exists('proj.9.contribution_1') ? i18next.t('proj.9.contribution_1') : null;
        const p2 = i18next.exists('proj.9.contribution_2') ? i18next.t('proj.9.contribution_2') : null;
        const p3 = i18next.exists('proj.9.contribution_3') ? i18next.t('proj.9.contribution_3') : null;
        contributionPoints = [p0, p1, p2, p3].filter(Boolean);
        if (contributionPoints.length === 0 && project.contributions) {
            contributionPoints = project.contributions;
        }
    } else if (project.contributions && Array.isArray(project.contributions) && project.contributions.length > 0) {
        contributionPoints = project.contributions;
    }

    if (contributionPoints.length > 0) {
        if (contributionsSec) contributionsSec.classList.remove('hidden');
        if (contributionsEl) {
            contributionsEl.innerHTML = contributionPoints.map(item => `
                <div class="flex items-start gap-2 text-xs text-stone-600 leading-relaxed">
                    <span class="text-[#233B53] font-bold mt-0.5 shrink-0">✦</span>
                    <span>${item}</span>
                </div>
            `).join('');
        }
    } else {
        if (contributionsSec) contributionsSec.classList.add('hidden');
        if (contributionsEl) contributionsEl.innerHTML = '';
    }

    // 6. Tech Stack Tags
    if (techEl) {
        const techs = project.technology || [];
        techEl.innerHTML = techs.map(t => `
            <span class="px-2.5 py-1 rounded-lg text-[10.5px] font-bold font-mono bg-[#FAFAF7] text-[#1C2430] border border-[#E6ECF1] shadow-2xs">
                ${t}
            </span>
        `).join('');
    }

    // 3. Sticky Footer Navigation States: Hide PREV on first, hide NEXT on last, keep layout centered
    if (prevBtn) {
        prevBtn.disabled = activeProjectIndex === 0;
        prevBtn.classList.toggle('invisible', activeProjectIndex === 0);
        prevBtn.classList.toggle('pointer-events-none', activeProjectIndex === 0);
    }
    if (nextBtn) {
        nextBtn.disabled = activeProjectIndex === (projectsList.length - 1);
        nextBtn.classList.toggle('invisible', activeProjectIndex === (projectsList.length - 1));
        nextBtn.classList.toggle('pointer-events-none', activeProjectIndex === (projectsList.length - 1));
    }
    if (currIdxEl) currIdxEl.textContent = activeProjectIndex + 1;
    if (totalCountEl) totalCountEl.textContent = projectsList.length;
}

// Global button carousel scroller helper
window.scrollCarousel = function (containerId, offset) {
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
            const copiedText = i18next.t('contact.email_copied') || 'Copied!';

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
                const originalText = i18next.t('contact.copy_email') || 'Copy Email';
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
    const certModal = document.getElementById('cert-modal');
    const certBackdrop = document.getElementById('cert-modal-backdrop');
    if (certBackdrop) {
        certBackdrop.addEventListener('click', () => {
            window.closeCertificateModal();
        });
    }

    // Close project modal on backdrop click or Escape key
    const projModal = document.getElementById('project-modal');
    const projBackdrop = document.getElementById('project-modal-backdrop');
    if (projBackdrop) {
        projBackdrop.addEventListener('click', () => {
            window.closeProjectModal();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (certModal && !certModal.classList.contains('pointer-events-none')) {
                window.closeCertificateModal();
            }
            if (projModal && !projModal.classList.contains('pointer-events-none')) {
                window.closeProjectModal();
            }
        }
    });
});
