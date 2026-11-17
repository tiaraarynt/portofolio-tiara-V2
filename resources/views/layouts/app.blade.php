<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $portfolio['personal']['full_name'] }} — {{ $portfolio['personal']['role'] }}. {{ $portfolio['personal']['short_bio'] }}">
    <meta name="keywords" content="portfolio, tiara ariyanto putri, software engineer, ui ux designer, ipb university, web developer">
    <meta property="og:title" content="Tiara Ariyanto Putri — Software Engineer">
    <meta property="og:description" content="{{ $portfolio['personal']['short_bio'] }}">
    <meta property="og:type" content="website">

    <title>Tiara Ariyanto Putri — Software Engineer</title>
    
    <!-- Browser Theme Color: Midnight Navy (#233B53) -->
    <meta name="theme-color" content="#233B53">
    <meta name="msapplication-TileColor" content="#233B53">

    <!-- Favicon Suite: Generated from User Image with cache-busting -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=7">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=7">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/favicon.png?v=7">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=7">
    <link rel="shortcut icon" href="/favicon.ico?v=7">

    <!-- Google Fonts: Plus Jakarta Sans, Playfair Display (Serif) & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600;1,700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Devicon Icons -->
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAFAF7] text-[#1C2430] font-sans antialiased selection:bg-[#DCEAF7] selection:text-[#233B53] min-h-screen flex flex-col relative w-full overflow-x-clip">

    <!-- Ambient Interactive Parallax Background Layer (Navy × Powder Blue × Butter Cream) -->
    <div id="parallax-bg" class="fixed inset-0 -z-10 pointer-events-none overflow-hidden w-full max-w-full" aria-hidden="true">
        <!-- Subtle warm off-white canvas wash -->
        <div class="absolute inset-0 bg-[#FAFAF7]"></div>

        <!-- Parallax Floating Subtle Gradient Orbs -->
        <div class="parallax-orb absolute -top-28 -left-24 w-72 sm:w-[32rem] lg:w-[36rem] h-72 sm:h-[32rem] lg:h-[36rem] rounded-full bg-[#233B53]/5 blur-3xl" data-speed="0.05" data-axis="both"></div>
        <div class="parallax-orb absolute top-1/4 -right-28 w-80 sm:w-[34rem] lg:w-[40rem] h-80 sm:h-[34rem] lg:h-[40rem] rounded-full bg-[#DCEAF7]/60 blur-3xl" data-speed="-0.04" data-axis="both"></div>
        <div class="parallax-orb absolute top-2/3 -left-32 w-72 sm:w-[32rem] lg:w-[38rem] h-72 sm:h-[32rem] lg:h-[38rem] rounded-full bg-[#FFF3D6]/70 blur-3xl" data-speed="0.04" data-axis="both"></div>
        <div class="parallax-orb absolute -bottom-24 right-1/4 w-80 sm:w-[36rem] lg:w-[42rem] h-80 sm:h-[36rem] lg:h-[42rem] rounded-full bg-[#DCEAF7]/50 blur-3xl" data-speed="-0.05" data-axis="both"></div>
    </div>

    <!-- Navigation Header (Clean, Formal, Compact Minimalist Navbar) -->
    <header id="navbar-header" class="sticky top-0 z-50 w-full pt-2 sm:pt-3 px-3 sm:px-6 lg:px-8 flex justify-center transition-all duration-300">
        <nav id="navbar-pill" class="w-full max-w-[1280px] px-3.5 sm:px-5 py-1.5 sm:py-2 rounded-full bg-white border border-[#E6ECF1] shadow-xs flex items-center justify-between transition-all duration-300 gap-2">
            
            <!-- Left: Logo with initial 'T' and Full Name on One Line -->
            <a href="#hero" class="flex items-center gap-2 group shrink-0 whitespace-nowrap">
                <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-[#233B53] text-white flex items-center justify-center font-bold text-xs sm:text-sm tracking-tight shadow-xs group-hover:bg-[#162637] transition-colors shrink-0">
                    T
                </span>
                <span class="font-extrabold text-[#1C2430] tracking-tight text-xs sm:text-[13.5px] lg:text-sm group-hover:text-[#233B53] transition-colors whitespace-nowrap">
                    Tiara Ariyanto Putri
                </span>
            </a>

            <!-- Center: Navigation Links (Desktop Compact Font Sizes & Spacing) -->
            <div id="navbar-links" class="hidden md:flex items-center gap-1.5 lg:gap-2 text-[11.5px] lg:text-xs font-semibold tracking-wide text-stone-600">
                <a href="#education" class="nav-pill-item px-2.5 lg:px-3 py-1 rounded-full hover:text-[#233B53] hover:bg-[#DCEAF7] transition-all whitespace-nowrap">Education</a>
                <a href="#experience" class="nav-pill-item px-2.5 lg:px-3 py-1 rounded-full hover:text-[#233B53] hover:bg-[#DCEAF7] transition-all whitespace-nowrap">Experience</a>
                <a href="#projects" class="nav-pill-item px-2.5 lg:px-3 py-1 rounded-full hover:text-[#233B53] hover:bg-[#DCEAF7] transition-all whitespace-nowrap">Projects</a>
                <a href="#certifications" class="nav-pill-item px-2.5 lg:px-3 py-1 rounded-full hover:text-[#233B53] hover:bg-[#DCEAF7] transition-all whitespace-nowrap">Certifications</a>
                <a href="#skills" class="nav-pill-item px-2.5 lg:px-3 py-1 rounded-full hover:text-[#233B53] hover:bg-[#DCEAF7] transition-all whitespace-nowrap">Skills</a>
                <a href="#contact" class="nav-pill-item px-2.5 lg:px-3 py-1 rounded-full hover:text-[#233B53] hover:bg-[#DCEAF7] transition-all whitespace-nowrap">Contact</a>
            </div>

            <!-- Right: Action CTA & Mobile Menu Toggle (Prevent Wrapping) -->
            <div class="flex items-center gap-2 shrink-0">
                <a href="#contact" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 lg:px-4 py-1 sm:py-1.5 rounded-full bg-[#233B53] hover:bg-[#162637] text-white text-[11px] lg:text-xs font-bold tracking-tight transition-all shadow-xs active:scale-95 whitespace-nowrap shrink-0">
                    <span class="whitespace-nowrap">Get in Touch</span>
                    <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <!-- Mobile Hamburger Toggle -->
                <button 
                    id="mobile-menu-toggle"
                    type="button" 
                    class="md:hidden w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-[#E6ECF1] bg-white flex items-center justify-center text-[#1C2430] hover:text-[#233B53] hover:border-[#233B53]/40 transition-colors shrink-0"
                    aria-label="Toggle navigation menu"
                    aria-expanded="false"
                >
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </nav>

        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="hidden md:hidden absolute top-full left-3 right-3 mt-2 p-4 rounded-2xl bg-white/95 backdrop-blur-md border border-[#E6ECF1] shadow-lg flex flex-col gap-1 transition-all z-50">
            <a href="#education" class="mobile-nav-link px-3 py-2 rounded-xl text-xs font-semibold text-[#1C2430] hover:bg-[#DCEAF7] hover:text-[#233B53] transition-colors">Education</a>
            <a href="#experience" class="mobile-nav-link px-3 py-2 rounded-xl text-xs font-semibold text-[#1C2430] hover:bg-[#DCEAF7] hover:text-[#233B53] transition-colors">Experience</a>
            <a href="#projects" class="mobile-nav-link px-3 py-2 rounded-xl text-xs font-semibold text-[#1C2430] hover:bg-[#DCEAF7] hover:text-[#233B53] transition-colors">Projects</a>
            <a href="#certifications" class="mobile-nav-link px-3 py-2 rounded-xl text-xs font-semibold text-[#1C2430] hover:bg-[#DCEAF7] hover:text-[#233B53] transition-colors">Certifications</a>
            <a href="#skills" class="mobile-nav-link px-3 py-2 rounded-xl text-xs font-semibold text-[#1C2430] hover:bg-[#DCEAF7] hover:text-[#233B53] transition-colors">Skills</a>
            <a href="#contact" class="mobile-nav-link px-3 py-2 rounded-xl text-xs font-semibold text-[#1C2430] hover:bg-[#DCEAF7] hover:text-[#233B53] transition-colors">Contact</a>
            <div class="pt-2 mt-1 border-t border-stone-100 sm:hidden">
                <a href="#contact" class="mobile-nav-link flex items-center justify-center gap-1.5 w-full py-2 rounded-xl bg-[#233B53] text-white text-xs font-bold shadow-xs">
                    <span>Get in Touch</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content (Centered, Max-width 1280px Container) -->
    <main class="flex-1 w-full">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 pt-2 sm:pt-4 pb-2 sm:pb-4">
            @yield('content')
        </div>
    </main>

    <!-- Modern Aesthetic Footer (Reference Layout: Divider, Monospace Subtle Typography) -->
    <footer class="mt-8 sm:mt-12 border-t border-[#E6ECF1] bg-white/70 backdrop-blur-sm py-5 sm:py-6">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] sm:text-xs font-mono text-stone-500">
            <!-- Left: Copyright Statement -->
            <div class="text-center sm:text-left">
                <span class="font-bold text-[#1C2430]">© 2026 Tiara Ariyanto Putri.</span>
                <span class="text-stone-400">All rights reserved.</span>
            </div>

            <!-- Right: Actual Stack Used (Uniform Color Matching 'Built with') -->
            <div class="flex flex-wrap items-center justify-center sm:justify-end gap-1.5 text-stone-400">
                <span>Built with</span>
                <span>Laravel</span>
                <span>•</span>
                <span>JavaScript</span>
                <span>•</span>
                <span>Tailwind CSS</span>
                <span>•</span>
                <span>Vite</span>
            </div>
        </div>
    </footer>

    <!-- Circular Back to Top Button -->
    <button 
        id="back-to-top" 
        type="button" 
        class="fixed bottom-6 right-6 z-40 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white/95 backdrop-blur-md border border-[#E6ECF1] shadow-md shadow-stone-900/5 hover:bg-[#DCEAF7] hover:border-[#233B53]/40 text-[#233B53] flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none translate-y-3 cursor-pointer group active:scale-95" 
        aria-label="Back to top"
    >
        <svg class="w-5 h-5 group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 max-w-sm pointer-events-none"></div>
</body>
</html>
