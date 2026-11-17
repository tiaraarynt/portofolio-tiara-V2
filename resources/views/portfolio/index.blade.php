@extends('layouts.app')

@section('content')
<div class="space-y-16 sm:space-y-20 lg:space-y-24 w-full">

    <!-- ========================================== -->
    <!-- HERO SECTION (Elegant Two-Column, Burgundy Accents, Serif + Sans-Serif Typography) -->
    <!-- ========================================== -->
    <section id="hero" class="relative pt-2 sm:pt-4 lg:pt-6 pb-6 sm:pb-10 w-full">
        <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-12 w-full">
            
            <!-- Left Column: Introduction & Typography (Balanced alignment with profile photo) -->
            <div class="space-y-5 max-w-xl lg:max-w-2xl flex-1 w-full flex flex-col items-start text-left">
                
                <!-- Status / Role Specialization Pill (Solid White Ref Style) -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white text-[#233B53] border border-[#E6ECF1] shadow-xs">
                    <span class="relative flex h-2 w-2 shrink-0">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#233B53] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#233B53]"></span>
                    </span>
                    <span class="font-medium tracking-tight">Fresh Graduate · Full-Stack Developer · UI/UX Designer · Manual Testing</span>
                </div>

                <!-- Main Headline: Serif & Sans-Serif Combination on the same line on desktop -->
                <div class="space-y-2 sm:space-y-3 w-full">
                    <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-[68px] xl:text-[76px] font-extrabold text-[#1C2430] tracking-tight leading-[1.1] flex flex-wrap items-baseline gap-x-2.5 sm:gap-x-3.5">
                        <span>Hello, I'm</span>
                        <span class="font-serif italic font-normal text-[#233B53] tracking-normal">Tiara.</span>
                    </h1>
                    <div class="text-lg sm:text-xl lg:text-2xl font-bold text-stone-700 tracking-tight pt-0.5">
                        Software Engineer
                    </div>
                </div>

                <!-- Professional Bio Statement -->
                <p class="text-xs sm:text-sm text-stone-600 leading-relaxed font-normal max-w-xl">
                    Software Engineering graduate from IPB University specializing in web development, UI/UX design, and software testing. Experienced in building responsive web applications with Laravel, designing intuitive user experiences with Figma, and ensuring quality through rigorous manual &amp; black box testing.
                </p>

                <!-- Actions: CTA Button Only -->
                <div class="pt-2 flex items-center w-full">
                    <!-- Get in Touch Button (Prevent Wrapping) -->
                    <a href="#contact" class="px-6 py-2.5 rounded-full bg-[#233B53] hover:bg-[#162637] text-white font-bold text-xs sm:text-sm transition-all shadow-sm shadow-[#233B53]/20 flex items-center gap-2 cursor-pointer active:scale-95 group whitespace-nowrap shrink-0">
                        <span class="whitespace-nowrap">Get in Touch</span>
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

            </div>

            <!-- Right Column: Profile Photo Frame based on Reference Image -->
            <div class="flex justify-center flex-shrink-0 w-full lg:w-auto my-2 lg:my-0">
                <div class="relative">
                    
                    <!-- Top-Left Location Badge (Burgundy Theme) Aligned Exactly with the Outer White Frame Left Edge -->
                    <div class="absolute -top-3.5 left-0 z-20 px-3 py-1 rounded-full bg-[#233B53] text-white text-[10px] sm:text-[10.5px] font-semibold tracking-tight shadow-md flex items-center gap-1.5 whitespace-nowrap">
                        <span class="text-[10.5px]">📍</span>
                        <span>Bogor / Depok / Jakarta</span>
                    </div>

                    <!-- Outer Rounded White Frame with Subtle Border & Shadow -->
                    <div class="relative w-64 sm:w-72 lg:w-80 rounded-3xl bg-white p-3 border border-[#E6ECF1] shadow-xl shadow-stone-900/5 transition-transform duration-300 hover:-translate-y-1">
                        
                        <!-- Inner Photo Canvas with Original Full Color Photo -->
                        <div class="relative aspect-4/5 rounded-2xl overflow-hidden bg-stone-100 border border-[#E6ECF1] flex items-center justify-center">
                            <img 
                                src="{{ asset('images/tiara.jpg') }}" 
                                alt="{{ $portfolio['personal']['full_name'] }}" 
                                class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500"
                                loading="eager"
                            >

                            <!-- Name Badge Inside the Photo Canvas at Top-Left (Directly below location badge with neat, minimal gap) -->
                            <div class="absolute top-1.5 left-1.5 z-10 px-3 py-0.5 sm:py-1 rounded-full bg-white/95 backdrop-blur-md text-[#1C2430] border border-[#E6ECF1] text-[9.5px] sm:text-[10px] font-bold tracking-tight shadow-sm flex items-center gap-1.5 whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#233B53] shrink-0"></span>
                                <span>Tiara Ariyanto Putri</span>
                            </div>
                        </div>

                    </div>

                    <!-- Overlapping 'Open to Work' Badge at Bottom-Right -->
                    <div class="absolute -bottom-3 right-4 z-20 px-3.5 py-1 rounded-full bg-white text-[#1C2430] border border-[#E6ECF1] text-[11px] font-bold tracking-tight shadow-md flex items-center gap-2 whitespace-nowrap">
                        <span class="relative flex h-2 w-2 shrink-0">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span>Open to Work</span>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- ========================================== -->
    <!-- 1. EDUCATION SECTION -->
    <!-- ========================================== -->
    <section id="education" class="relative scroll-mt-24 space-y-6 w-full">
        <!-- Section Variation Gradient: Soft Powder Blue Wash -->
        <div class="section-gradient-accent top-4 -right-12 w-80 h-80 bg-[#DCEAF7]/80" data-speed="0.04"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-end justify-between gap-1 border-b border-[#E6ECF1] pb-3">
            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1C2430] tracking-tight">
                    Academic <span class="font-serif italic font-normal text-[#233B53]">Education</span>
                </h2>
            </div>
            <p class="text-xs font-semibold text-[#233B53]">
                Academic Background
            </p>
        </div>

        <div class="relative z-10 w-full">
            @foreach($portfolio['education'] as $edu)
                <!-- Wide Horizontal Card Layout with Two Columns on Desktop -->
                <div class="clean-card p-6 sm:p-8 rounded-3xl bg-white border border-[#E6ECF1] shadow-xs hover:border-[#233B53]/40 transition-all duration-300">
                    <div class="flex flex-col lg:flex-row gap-8 lg:gap-10 items-stretch">
                        
                        <!-- Left Column: Institution Identity, Degree, GPA & Badges -->
                        <div class="flex-1 space-y-5 flex flex-col justify-between">
                            
                            <!-- Top: Logo + Institution Header + Badges -->
                            <div class="space-y-4">
                                <!-- Period Badge (Only Aug 2022 – Aug 2026) -->
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-[11px] font-mono font-bold px-3 py-1 rounded-full bg-[#DCEAF7] text-[#233B53] border border-[#E6ECF1]">
                                        Aug 2022 – Aug 2026
                                    </span>
                                </div>

                                <!-- University Logo Lockup + Title -->
                                <div class="flex items-start gap-4 pt-1">
                                    <!-- Official IPB University Logo Seal -->
                                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-[#FAFAF7] border border-[#E6ECF1] p-2 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-transform">
                                        <img 
                                            src="{{ asset('images/ipb-logo.png') }}" 
                                            alt="IPB University Logo" 
                                            class="w-full h-full object-contain"
                                            loading="lazy"
                                        >
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-xs sm:text-sm font-bold text-[#233B53] tracking-tight">
                                            {{ $edu['institution'] }}
                                        </div>
                                        <h3 class="text-base sm:text-xl font-extrabold text-[#1C2430] leading-snug mt-0.5">
                                            {{ $edu['degree'] }}
                                        </h3>
                                        <div class="text-xs text-stone-500 font-medium mt-1 flex items-center gap-1.5">
                                            <span>📍</span>
                                            <span>{{ $edu['location'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Box: Academic Achievement Area (Highlighting GPA) -->
                            <div class="p-4 rounded-2xl bg-[#FAFAF7] border border-[#E6ECF1] flex items-center justify-between gap-4">
                                <div>
                                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-stone-400 block">Academic Achievement</span>
                                    <div class="text-xs sm:text-sm font-bold text-[#1C2430] mt-0.5">
                                        Cumulative GPA
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-2xl sm:text-3xl font-extrabold font-mono text-[#233B53] tracking-tight">
                                        3.50
                                    </span>
                                    <span class="text-xs font-mono font-bold text-stone-400">/ 4.00</span>
                                </div>
                            </div>

                        </div>

                        <!-- Vertical Divider for Desktop -->
                        <div class="hidden lg:block w-px bg-[#E6ECF1] self-stretch"></div>

                        <!-- Right Column: Key Academic & Engineering Scope & Certification -->
                        <div class="flex-1 space-y-4 flex flex-col justify-between">
                            
                            <!-- Key Academic & Engineering Scope -->
                            <div class="space-y-3">
                                <div class="flex items-center justify-between border-b border-[#E6ECF1] pb-2">
                                    <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-[#233B53]">
                                        Key Academic &amp; Engineering Scope
                                    </span>
                                    <span class="text-[10px] font-mono text-stone-400">Focus Areas</span>
                                </div>

                                <!-- Scope Points -->
                                <div class="space-y-2 text-xs sm:text-[13px] text-stone-600 leading-relaxed">
                                    <div class="flex items-start gap-2">
                                        <span class="text-[#233B53] font-bold mt-0.5 shrink-0">✦</span>
                                        <span><strong class="text-[#1C2430]">Web Development &amp; Architecture:</strong> Full-stack web application development with Laravel, PHP, relational MySQL schemas, and responsive UI.</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-[#233B53] font-bold mt-0.5 shrink-0">✦</span>
                                        <span><strong class="text-[#1C2430]">UI/UX Design &amp; Prototyping:</strong> User research, workflow diagramming with Draw.io, design systems, and interactive prototypes in Figma.</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-[#233B53] font-bold mt-0.5 shrink-0">✦</span>
                                        <span><strong class="text-[#1C2430]">SDLC &amp; Software Testing:</strong> End-to-end SDLC using Prototyping methodology, structured system analysis, and comprehensive Black Box &amp; usability testing.</span>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-[#233B53] font-bold mt-0.5 shrink-0">✦</span>
                                        <span><strong class="text-[#1C2430]">Capstone Project:</strong> Developed the <em>Education &amp; Training Module (Modul Diklat)</em> for government civil servant (ASN) management.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Relevant Credentials & Technology Tags -->
                            <div class="pt-3 border-t border-[#E6ECF1] space-y-2">
                                <div class="flex items-center justify-between text-[11px]">
                                    <span class="font-bold text-[#1C2430] flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#233B53]"></span>
                                        <span>BNSP Certified Software Engineer</span>
                                    </span>
                                    <span class="text-[10px] font-mono text-stone-400">LSP Vokasi IPB (2026–2029)</span>
                                </div>

                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold font-mono bg-[#DCEAF7] text-[#233B53] border border-[#E6ECF1]">Laravel</span>
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold font-mono bg-[#FAFAF7] text-stone-700 border border-[#E6ECF1]">MySQL</span>
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold font-mono bg-[#FAFAF7] text-stone-700 border border-[#E6ECF1]">Figma</span>
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold font-mono bg-[#FAFAF7] text-stone-700 border border-[#E6ECF1]">Draw.io</span>
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold font-mono bg-[#FAFAF7] text-stone-700 border border-[#E6ECF1]">Black Box QA</span>
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold font-mono bg-[#DCEAF7] text-[#233B53] border border-[#E6ECF1]">Prototyping SDLC</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 2. ORGANIZATIONAL EXPERIENCE SECTION -->
    <!-- ========================================== -->
    <section id="organizations" class="relative scroll-mt-24 space-y-6 w-full">
        <!-- Section Variation Gradient: Butter Cream Left Glow -->
        <div class="section-gradient-accent top-8 -left-14 w-84 h-84 bg-[#FFF3D6]/70" data-speed="-0.04"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-end justify-between gap-1 border-b border-[#E6ECF1] pb-3">
            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1C2430] tracking-tight">
                    Organizational <span class="font-serif italic font-normal text-[#233B53]">Experience</span>
                </h2>
            </div>
            <p class="text-xs font-semibold text-[#233B53]">
                Active committee &amp; team contribution
            </p>
        </div>

        <div class="relative z-10 space-y-4 w-full">
            @foreach($portfolio['organisations'] as $org)
                <div class="clean-card p-5 sm:p-6 rounded-2xl bg-white border border-[#E6ECF1] hover:border-[#233B53]/40 transition-all">
                    <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-center">
                        <!-- Left Featured Photo -->
                        <div class="w-full sm:w-52 md:w-56 lg:w-64 flex-shrink-0">
                            <div class="group relative aspect-4/3 rounded-xl overflow-hidden bg-stone-100 border border-[#E6ECF1] shadow-2xs">
                                <img 
                                    src="{{ asset('images/omvi-team.jpg') }}" 
                                    alt="OMVI 2023 VCD Committee Team" 
                                    class="w-full h-full object-cover object-center"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-80"></div>
                                <div class="absolute bottom-2 left-2.5 right-2.5 flex items-center justify-between text-white">
                                    <span class="text-[11px] font-bold drop-shadow-sm">
                                        OMVI 2023 Committee
                                    </span>
                                    <span class="text-[9px] font-mono px-2 py-0.5 rounded-full bg-white/20 backdrop-blur-md border border-white/25 text-white font-semibold">VCD Team</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Content Info -->
                        <div class="space-y-2.5 flex-1 min-w-0 w-full">
                            <!-- Period, Badge & Scope Pills -->
                            <div class="flex flex-wrap items-center gap-1.5">
                                <span class="text-[10px] font-mono font-bold px-2.5 py-0.5 rounded-full bg-[#DCEAF7] text-[#233B53] border border-[#E6ECF1] shadow-2xs">
                                    {{ $org['period'] }}
                                </span>
                                <span class="text-[10px] font-bold text-[#233B53] bg-white px-2.5 py-0.5 rounded-full border border-[#E6ECF1]">
                                    Committee &amp; Events
                                </span>
                                <span class="text-[10px] font-medium text-stone-500 px-2 py-0.5 rounded-md bg-[#FAFAF7] border border-[#E6ECF1]">
                                    Campus Annual Event
                                </span>
                            </div>

                            <!-- Role Title & Organization Name -->
                            <div>
                                <h3 class="text-sm sm:text-base font-extrabold text-[#1C2430] leading-snug">
                                    {{ $org['role'] }}
                                </h3>
                                <div class="text-[11px] sm:text-xs font-bold text-[#233B53] mt-0.5">
                                    {{ $org['organisation'] }}
                                </div>
                            </div>

                            <!-- Bullet Points Responsibilities -->
                            <div class="space-y-1 pt-0.5 border-t border-[#E6ECF1]">
                                <div class="flex items-start gap-1.5 text-xs text-stone-600 leading-normal">
                                    <span class="text-[#233B53] font-bold mt-0.5 shrink-0 text-[10px]">✦</span>
                                    <span>Designed promotional Instagram posts and story updates.</span>
                                </div>
                                <div class="flex items-start gap-1.5 text-xs text-stone-600 leading-normal">
                                    <span class="text-[#233B53] font-bold mt-0.5 shrink-0 text-[10px]">✦</span>
                                    <span>Designed official event merchandise including T-shirts, lanyards, and staff ID cards.</span>
                                </div>
                                <div class="flex items-start gap-1.5 text-xs text-stone-600 leading-normal">
                                    <span class="text-[#233B53] font-bold mt-0.5 shrink-0 text-[10px]">✦</span>
                                    <span>Created visual stage concepts, backdrops, and event hall decorations.</span>
                                </div>
                            </div>

                            <!-- Applied Tools & Deliverables Tags -->
                            <div class="pt-1 flex flex-wrap items-center gap-1">
                                <span class="text-[10px] font-mono font-bold text-stone-400 mr-1">Deliverables:</span>
                                <span class="px-2 py-0.5 rounded-md text-[9px] font-bold font-mono bg-[#DCEAF7] text-[#233B53] border border-[#E6ECF1]">Canva</span>
                                <span class="px-2 py-0.5 rounded-md text-[9px] font-bold font-mono bg-white text-[#1C2430] border border-[#E6ECF1]">Merchandise Design</span>
                                <span class="px-2 py-0.5 rounded-md text-[9px] font-bold font-mono bg-[#DCEAF7] text-[#233B53] border border-[#E6ECF1]">Stage Setup</span>
                                <span class="px-2 py-0.5 rounded-md text-[9px] font-bold font-mono bg-white text-[#1C2430] border border-[#E6ECF1]">Team Collaboration</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 3. WORK EXPERIENCE SECTION -->
    <!-- ========================================== -->
    <section id="experience" class="relative scroll-mt-24 space-y-6 w-full">
        <!-- Section Variation Gradient: Dual Horizontal Blend -->
        <div class="section-gradient-accent -top-10 left-1/4 w-[32rem] h-64 bg-gradient-to-r from-[#DCEAF7]/40 via-transparent to-[#DCEAF7]/40" data-speed="0.05"></div>

        <div class="relative z-10 flex items-center justify-between gap-3 border-b border-[#E6ECF1] pb-3">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1C2430] tracking-tight leading-tight">
                    Work <span class="font-serif italic font-normal text-[#233B53]">Experience</span>
                </h2>
            </div>
            <!-- Navigation Prev/Next Buttons -->
            <div class="flex items-center gap-1.5 flex-shrink-0">
                <button type="button" onclick="scrollCarousel('exp-scroll-container', -340)" class="w-8 h-8 rounded-full border border-[#E6ECF1] bg-white hover:bg-[#DCEAF7] hover:border-[#233B53]/40 text-[#233B53] flex items-center justify-center transition-all shadow-2xs cursor-pointer active:scale-95" aria-label="Scroll Left">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" onclick="scrollCarousel('exp-scroll-container', 340)" class="w-8 h-8 rounded-full border border-[#E6ECF1] bg-white hover:bg-[#DCEAF7] hover:border-[#233B53]/40 text-[#233B53] flex items-center justify-center transition-all shadow-2xs cursor-pointer active:scale-95" aria-label="Scroll Right">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <!-- Horizontal scroll row with drag/touch/button slide -->
        <div class="relative z-10 w-full">
            <div id="exp-scroll-container" class="netflix-scroll flex items-stretch gap-4 sm:gap-5 overflow-x-auto pb-4 pt-1 snap-x snap-mandatory cursor-grab active:cursor-grabbing select-none">
                @foreach($portfolio['experiences'] as $index => $exp)
                    <div class="snap-start flex-shrink-0 w-[min(340px,88vw)] sm:w-[365px] clean-card p-5 sm:p-6 rounded-3xl bg-white border border-[#E6ECF1] hover:border-[#233B53]/40 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                        
                        <div class="space-y-3.5 flex-1 flex flex-col">
                            <!-- Card Top Header: Logo + Date Badge Row -->
                            <div class="flex items-center justify-between gap-2.5">
                                <!-- Organization Official Logo -->
                                <div class="w-11 h-11 rounded-2xl bg-[#FAFAF7] border border-[#E6ECF1] flex items-center justify-center shrink-0 shadow-2xs overflow-hidden p-1.5">
                                    @if(str_contains($exp['company'], 'IPB'))
                                        <img src="{{ asset('images/ipb-logo.png') }}" alt="{{ $exp['company'] }}" class="w-full h-full object-contain" loading="lazy">
                                    @elseif(str_contains($exp['company'], 'Depok'))
                                        <img src="{{ asset('images/depok-logo.png') }}" alt="{{ $exp['company'] }}" class="w-full h-full object-contain" loading="lazy">
                                    @elseif(str_contains($exp['company'], 'Sansyu'))
                                        <img src="{{ asset('images/sansyu-logo.jpg') }}" alt="{{ $exp['company'] }}" class="w-full h-full object-contain" loading="lazy">
                                    @else
                                        <div class="w-full h-full rounded-xl bg-[#DCEAF7] flex items-center justify-center text-[#233B53] font-bold text-xs">
                                            🏢
                                        </div>
                                    @endif
                                </div>

                                <!-- Burgundy Date Badge (Top-Right, No Overlap) -->
                                <div class="shrink-0">
                                    <span class="font-mono font-bold px-3 py-1 rounded-full bg-[#DCEAF7] text-[#233B53] border border-[#E6ECF1] whitespace-nowrap text-[10.5px] sm:text-[11px] shadow-2xs inline-block">
                                        {{ $exp['period'] }}
                                    </span>
                                </div>
                            </div>

                            <!-- Role Title & Organization (No Truncation / Ellipsis, Full Natural Wrapping) -->
                            <div class="space-y-1">
                                <h3 class="text-sm sm:text-base font-extrabold text-[#1C2430] leading-snug">
                                    {{ $exp['role'] }}
                                </h3>
                                <div class="text-xs sm:text-[13px] font-bold text-[#233B53] leading-snug">
                                    {{ $exp['company'] }}
                                </div>
                                <div class="text-[11px] text-stone-500 font-medium flex items-center gap-1 pt-0.5">
                                    <span>📍</span>
                                    <span>{{ $exp['location'] }}</span>
                                </div>
                            </div>

                            <!-- Thin Divider below Header -->
                            <div class="border-t border-[#E6ECF1] pt-1"></div>

                            <!-- Job Descriptions with Burgundy Outlined Check Icons -->
                            <div class="space-y-2 flex-1">
                                @foreach($exp['points'] as $point)
                                    <div class="flex items-start gap-2 text-xs text-stone-600 leading-relaxed font-normal">
                                        <span class="shrink-0 mt-0.5 w-4 h-4 rounded-full border border-[#233B53] bg-[#FAFAF7] text-[#233B53] flex items-center justify-center shadow-2xs">
                                            <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </span>
                                        <span>{{ $point }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Relevant Technology/Skill Tags Separated by a Divider -->
                        @if(!empty($exp['skills']))
                            <div class="pt-3.5 mt-4 border-t border-[#E6ECF1]">
                                <div class="flex flex-wrap items-center gap-1.5">
                                    @foreach($exp['skills'] as $skillTag)
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-[#FAFAF7] text-[#1C2430] border border-[#E6ECF1] hover:bg-[#DCEAF7] hover:text-[#233B53] transition-colors">
                                            {{ $skillTag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ========================================== -->
    <!-- 4. PROJECT EXPERIENCE — Focused Carousel -->
    <!-- ========================================== -->
    <section id="projects" class="relative scroll-mt-24 space-y-3 sm:space-y-4 w-full">
        <!-- Section Variation Gradient: Powder Blue & Butter Cream Focal Halo -->
        <div class="section-gradient-accent top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[44rem] h-84 bg-[radial-gradient(ellipse,_var(--tw-gradient-stops))] from-[#FFF3D6]/70 via-[#DCEAF7]/50 to-transparent" data-speed="0.03"></div>

        <div class="relative z-10 flex items-center justify-between gap-3 border-b border-[#E6ECF1] pb-2.5">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1C2430] tracking-tight truncate">
                    Featured <span class="font-serif italic font-normal text-[#233B53]">Projects</span>
                </h2>
            </div>

            <!-- Action Controls: Prev/Next Carousel Arrows -->
            <div class="flex items-center gap-2 flex-shrink-0">
                <button type="button" onclick="scrollProjectsByStep(-1)" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-[#E6ECF1] bg-white hover:bg-[#DCEAF7] hover:border-[#233B53]/40 text-[#233B53] flex items-center justify-center transition-all shadow-xs cursor-pointer active:scale-95" aria-label="Previous Project">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" onclick="scrollProjectsByStep(1)" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-[#E6ECF1] bg-white hover:bg-[#DCEAF7] hover:border-[#233B53]/40 text-[#233B53] flex items-center justify-center transition-all shadow-xs cursor-pointer active:scale-95" aria-label="Next Project">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <!-- Horizontal Carousel Stage with Coverflow Perspective & Depth Padding -->
        <div class="relative z-10 w-full overflow-hidden py-2">
            <div class="netflix-scroll flex items-center gap-4 sm:gap-6 md:gap-7 overflow-x-auto py-8 sm:py-10 md:py-12 px-[6vw] min-[400px]:px-[10vw] sm:px-[20vw] md:px-[26vw] lg:px-[30vw] cursor-grab active:cursor-grabbing select-none" id="projects-grid">
                @foreach($portfolio['projects'] as $index => $project)
                    @php
                        $tags = $project['technology'] ?? $project['tags'] ?? [];
                        $hasUrl = !empty($project['url']) && !in_array(strtolower(trim($project['url'])), ['#', 'internal', 'internal / not publicly available', 'none']);
                    @endphp
                    <div class="project-card-item flex-shrink-0 w-[260px] min-[380px]:w-[285px] sm:w-[330px] md:w-[350px] max-w-[85vw] rounded-2xl overflow-hidden bg-white text-[#1C2430] border border-[#E6ECF1] flex flex-col justify-between shadow-xs cursor-pointer select-none {{ $index === 0 ? 'is-active' : '' }}" data-project-index="{{ $index }}">
                        
                        <!-- Top Image Layer: 16:9 Aspect Ratio with Floating Category Pill on Top-Right -->
                        <div class="relative p-2.5 sm:p-3 bg-gradient-to-b from-[#FAFAF7] to-white border-b border-[#E6ECF1]">
                            <!-- 16:9 Image Placeholder / Screenshot Canvas -->
                            <div class="relative w-full aspect-16/9 rounded-xl overflow-hidden border border-[#E6ECF1] bg-gradient-to-br from-[#DCEAF7]/40 via-white to-[#FAFAF7] flex items-center justify-center shadow-inner">
                                @if(!empty($project['image']))
                                    <img 
                                        src="{{ asset('images/projects/' . $project['image']) }}" 
                                        alt="{{ $project['title'] }}" 
                                        class="w-full h-full object-cover {{ !empty($project['image_position']) ? '' : 'object-top' }}"
                                        @if(!empty($project['image_position'])) style="object-position: {{ $project['image_position'] }};" @endif
                                        loading="lazy"
                                    >
                                @else
                                    <!-- Clean Architectural Preview Graphic -->
                                    <div class="flex flex-col items-center justify-center gap-1 p-2 text-center w-full h-full select-none">
                                        <div class="w-7 h-7 rounded-lg bg-white/95 border border-[#E6ECF1] flex items-center justify-center text-[#233B53] shadow-2xs">
                                            <svg class="w-3.5 h-3.5 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-[8.5px] font-mono font-bold text-[#233B53]/75 tracking-wider uppercase">
                                            Project Preview
                                        </span>
                                    </div>
                                    <div class="absolute inset-1.5 rounded-lg border border-dashed border-[#233B53]/30 pointer-events-none"></div>
                                @endif

                                <!-- Category Badge Floating Overlay -->
                                <div class="absolute top-2 right-2 px-2.5 py-0.5 rounded-full font-mono text-[8.5px] font-extrabold uppercase bg-white/95 text-[#233B53] border border-[#E6ECF1] shadow-2xs backdrop-blur-xs">
                                    {{ $project['category'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Content Section -->
                        <div class="p-3 sm:p-3.5 flex-1 flex flex-col justify-between bg-white">
                            <div class="flex flex-col">
                                <!-- Project Title: Bold uppercase, wrapped naturally -->
                                <div>
                                    <h3 class="text-xs sm:text-[13px] font-black text-[#1C2430] tracking-tight leading-snug uppercase">
                                        {{ $project['title'] }}
                                    </h3>
                                </div>

                                <!-- Technology Tags: Exactly 8-10px gap from title (mt-2.5 = 10px) -->
                                <div class="mt-2.5 flex flex-wrap gap-1">
                                    @foreach(array_slice($tags, 0, 4) as $tag)
                                        <span class="px-2 py-0.5 rounded-md text-[8.5px] font-bold font-mono border bg-[#DCEAF7] text-[#233B53] border-[#E6ECF1] shadow-2xs">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>

                                <!-- Project Description (Compact container with natural line height) -->
                                <div class="mt-2.5">
                                    <p class="text-[10.5px] text-stone-600 leading-relaxed font-normal">
                                        {{ $project['description'] }}
                                    </p>
                                </div>
                            </div>

                            <!-- Footer: Aligned neatly at the bottom -->
                            <div class="pt-2 mt-3 border-t border-[#E6ECF1] flex items-center justify-between text-xs min-h-[1.75rem]">
                                @if($hasUrl)
                                    <a 
                                        href="{{ $project['url'] }}" 
                                        target="_blank" 
                                        rel="noopener noreferrer" 
                                        class="inline-flex items-center gap-1 font-bold text-[#233B53] hover:text-[#162637] transition-colors text-[10.5px] group/link py-0.5"
                                    >
                                        <span>View Project</span>
                                        <svg class="w-3 h-3 group-hover/link:translate-x-0.5 group-hover/link:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                    <!-- Subtle External Link Icon on Right -->
                                    <span class="text-stone-300 text-xs pointer-events-none">↗</span>
                                @else
                                    <span class="text-[9.5px] font-mono text-stone-400 font-semibold italic">
                                        Internal Project
                                    </span>
                                    <span class="text-[9.5px] font-mono text-stone-300 pointer-events-none">🔒</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination Indicators Below Carousel -->
        <div class="relative z-10 flex items-center justify-center gap-1.5 pt-1">
            @foreach($portfolio['projects'] as $index => $project)
                <button 
                    type="button" 
                    data-proj-dot="{{ $index }}" 
                    class="h-2 rounded-full transition-all duration-300 cursor-pointer {{ $index === 0 ? 'bg-[#233B53] ring-1 ring-[#233B53]/20 w-7' : 'bg-[#C4D7E8] w-2 hover:bg-[#233B53]/60' }}"
                    aria-label="Go to slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 5. CERTIFICATIONS & ACHIEVEMENTS SECTION -->
    <!-- ========================================== -->
    <section id="certifications" class="relative scroll-mt-24 space-y-6 w-full">
        <!-- Section Variation Gradient: Soft Powder Blue & Butter Cream Highlights -->
        <div class="section-gradient-accent -top-10 -right-16 w-84 h-84 bg-[#DCEAF7]/70" data-speed="-0.04"></div>
        <div class="section-gradient-accent -bottom-10 -left-16 w-76 h-76 bg-[#FFF3D6]/60" data-speed="0.04"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-end justify-between gap-1 border-b border-[#E6ECF1] pb-3">
            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1C2430] tracking-tight">
                    Licenses &amp; <span class="font-serif italic font-normal text-[#233B53]">Achievements</span>
                </h2>
            </div>
            <p class="text-xs font-semibold text-[#233B53]">
                National and academic credentials
            </p>
        </div>

        <div class="relative z-10 grid grid-cols-1 min-[540px]:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 w-full items-stretch">
            @foreach($portfolio['certifications'] as $index => $cert)
                @php
                    $icons = ['National' => '🏛️', 'Achievement' => '🥈', 'Professional' => '🎨', 'Leadership' => '⭐'];
                    $icon = $icons[$cert['badge'] ?? ''] ?? '📜';
                    $certFile = !empty($cert['file']) ? asset('images/certificates/' . $cert['file']) : (!empty($cert['image']) ? asset('images/certificates/' . $cert['image']) : '');
                    $certImage = !empty($cert['image']) ? asset('images/certificates/' . $cert['image']) : $certFile;
                    $isPdf = !empty($cert['file']) && str_ends_with(strtolower($cert['file']), '.pdf');
                @endphp

                <div 
                    class="group clean-card bg-white rounded-2xl border border-[#E6ECF1] overflow-hidden flex flex-col hover:border-[#233B53]/40 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 cursor-pointer"
                    onclick="openCertificateModal('{{ $certImage }}', '{{ $certFile }}', {{ $isPdf ? 'true' : 'false' }}, '{{ addslashes($cert['title']) }}', '{{ addslashes($cert['issuer']) }}', '{{ $cert['badge'] ?? '' }}')"
                    role="button"
                    tabindex="0"
                    onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); this.click(); }"
                >

                    {{-- Top Certificate Image Box with Compact Container Height & Original Proportions --}}
                    <div class="relative w-full aspect-16/9 bg-gradient-to-br from-[#FAFAF7] to-white p-2 sm:p-2.5 flex items-center justify-center border-b border-[#E6ECF1] overflow-hidden">
                        @if(!empty($cert['image']))
                            <img
                                src="{{ asset('images/certificates/' . $cert['image']) }}"
                                alt="Certificate – {{ $cert['title'] }}"
                                class="w-full h-full object-contain drop-shadow-2xs group-hover:scale-[1.03] transition-transform duration-300"
                                loading="lazy"
                            >
                        @else
                            <div class="flex flex-col items-center justify-center gap-1 text-center w-full">
                                <div class="w-8 h-8 rounded-xl bg-white border border-[#E6ECF1] flex items-center justify-center text-sm shadow-2xs">
                                    {{ $icon }}
                                </div>
                                <span class="text-[9px] font-mono font-bold text-[#233B53] uppercase tracking-wider">{{ $cert['badge'] }}</span>
                            </div>
                        @endif

                        {{-- Category Badge with Balanced & Consistent Padding --}}
                        <div class="absolute top-2 right-2 px-2.5 py-1 rounded-full bg-white/95 backdrop-blur-xs border border-[#E6ECF1] text-[9px] font-mono font-bold text-[#233B53] shadow-2xs pointer-events-none tracking-wide">
                            {{ $cert['badge'] }}
                        </div>
                    </div>

                    {{-- Title and Issuer Below the Image --}}
                    <div class="p-3.5 sm:p-4 flex-1 flex flex-col justify-between space-y-2.5 bg-white">
                        <div class="space-y-1">
                            <h3 class="text-xs sm:text-sm font-extrabold text-[#1C2430] leading-snug line-clamp-2" title="{{ $cert['title'] }}">
                                {{ $cert['title'] }}
                            </h3>
                            <p class="text-[10px] sm:text-[10.5px] text-[#233B53] font-semibold leading-tight line-clamp-2" title="{{ $cert['issuer'] }}">
                                {{ $cert['issuer'] }}
                            </p>
                        </div>

                        <div class="pt-2.5 mt-auto border-t border-stone-100 flex items-center justify-between gap-2 text-[10px] font-mono">
                            <span class="text-stone-400 font-semibold truncate">{{ $cert['year'] ?? 'Verified' }}</span>
                            <span class="text-[#233B53] font-bold shrink-0 inline-flex items-center group-hover:text-[#162637] transition-colors">
                                View ↗
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 6. SKILLS & TECHNICAL TOOLKIT -->
    <!-- ========================================== -->
    <section id="skills" class="relative scroll-mt-24 space-y-6 w-full">
        <!-- Section Variation Gradient: Butter Cream & Powder Blue Accents -->
        <div class="section-gradient-accent top-14 left-1/4 w-84 h-84 bg-[#FFF3D6]/70" data-speed="0.05"></div>
        <div class="section-gradient-accent bottom-10 right-1/4 w-[28rem] h-[28rem] bg-[#DCEAF7]/60" data-speed="-0.05"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-end justify-between gap-1 border-b border-[#E6ECF1] pb-3">
            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1C2430] tracking-tight">
                    Tools &amp; <span class="font-serif italic font-normal text-[#233B53]">Technologies</span>
                </h2>
            </div>
            <p class="text-xs font-semibold text-[#233B53]">
                Technologies and tools I use
            </p>
        </div>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-5 w-full">
            @foreach($portfolio['skills'] as $index => $category)
                <div class="clean-card rounded-3xl p-5 sm:p-6 flex flex-col justify-start bg-white border border-[#E6ECF1] h-full">
                    {{-- Card header --}}
                    <div class="flex items-center gap-2.5 mb-2">
                        <div class="w-8 h-8 rounded-xl bg-[#DCEAF7] text-[#233B53] border border-[#E6ECF1] flex items-center justify-center font-bold text-sm shadow-2xs shrink-0">
                            ✦
                        </div>
                        <h3 class="font-extrabold text-sm sm:text-base text-[#1C2430] leading-snug">
                            {{ $category['category'] }}
                        </h3>
                    </div>
                    <p class="text-xs text-stone-500 font-medium leading-relaxed mb-4 min-h-[36px]">
                        {{ $category['description'] }}
                    </p>

                    {{-- Tool items: 2-column grid directly positioned below description --}}
                    <div class="grid grid-cols-2 gap-2.5">
                        @foreach($category['items'] as $item)
                            <div class="flex flex-col items-center justify-center p-3 rounded-2xl bg-[#FAFAF7] border border-[#E6ECF1] hover:border-[#233B53]/40 hover:bg-[#DCEAF7] hover:shadow-2xs transition-all text-center min-h-[92px]">
                                <div class="w-8 h-8 rounded-lg bg-white border border-[#E6ECF1] flex items-center justify-center shadow-2xs p-1 mb-1.5 shrink-0">
                                    <img
                                        src="{{ asset('images/tools/' . $item['logo']) }}"
                                        alt="{{ $item['name'] }} logo"
                                        width="24"
                                        height="24"
                                        class="w-6 h-6 object-contain"
                                        loading="lazy"
                                    />
                                </div>
                                <span class="text-xs font-bold text-[#1C2430] leading-tight line-clamp-2">
                                    {{ $item['name'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Soft Skills: Neat Individual Chips with Burgundy & Soft Blush Accents -->
        <div class="relative z-10 clean-card p-5 sm:p-6 rounded-2xl bg-white border border-[#E6ECF1] space-y-3">
            <p class="text-[11px] font-mono font-extrabold text-[#233B53] uppercase tracking-wider">Soft Skills</p>
            <div class="flex flex-wrap gap-2.5 sm:gap-3">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FAFAF7] text-[#1C2430] text-xs sm:text-sm font-bold border border-[#E6ECF1] shadow-2xs hover:border-[#233B53]/40 hover:bg-[#DCEAF7] transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#233B53]"></span>
                    Team Collaboration
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FAFAF7] text-[#1C2430] text-xs sm:text-sm font-bold border border-[#E6ECF1] shadow-2xs hover:border-[#233B53]/40 hover:bg-[#DCEAF7] transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#233B53]"></span>
                    Communication
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FAFAF7] text-[#1C2430] text-xs sm:text-sm font-bold border border-[#E6ECF1] shadow-2xs hover:border-[#233B53]/40 hover:bg-[#DCEAF7] transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#233B53]"></span>
                    Adaptability
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FAFAF7] text-[#1C2430] text-xs sm:text-sm font-bold border border-[#E6ECF1] shadow-2xs hover:border-[#233B53]/40 hover:bg-[#DCEAF7] transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#233B53]"></span>
                    Problem Solving
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FAFAF7] text-[#1C2430] text-xs sm:text-sm font-bold border border-[#E6ECF1] shadow-2xs hover:border-[#233B53]/40 hover:bg-[#DCEAF7] transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#233B53]"></span>
                    Project &amp; Time Management
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FAFAF7] text-[#1C2430] text-xs sm:text-sm font-bold border border-[#E6ECF1] shadow-2xs hover:border-[#233B53]/40 hover:bg-[#DCEAF7] transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#233B53]"></span>
                    Critical Thinking
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FAFAF7] text-[#1C2430] text-xs sm:text-sm font-bold border border-[#E6ECF1] shadow-2xs hover:border-[#233B53]/40 hover:bg-[#DCEAF7] transition-all">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#233B53]"></span>
                    Attention to Detail
                </span>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 7. CONTACT SECTION -->
    <!-- ========================================== -->
    <section id="contact" class="relative scroll-mt-24 space-y-6 w-full">
        <!-- Section Variation Gradient: Central Warm Glow -->
        <div class="section-gradient-accent top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[40rem] h-80 bg-gradient-to-r from-[#DCEAF7]/60 via-[#FAFAF7]/80 to-[#DCEAF7]/60" data-speed="0.03"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-end justify-between gap-1 border-b border-[#E6ECF1] pb-3">
            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1C2430] tracking-tight">
                    Let's Connect &amp; <span class="font-serif italic font-normal text-[#233B53]">build together.</span>
                </h2>
            </div>
            <p class="text-xs font-semibold text-[#233B53]">
                Fast response via Email &amp; WhatsApp
            </p>
        </div>

        <div class="relative z-10 grid grid-cols-1 min-[540px]:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 w-full">
            <!-- 1. LinkedIn -->
            <a href="https://www.linkedin.com/in/tiaraaptr" target="_blank" rel="noopener" class="group clean-card p-6 rounded-3xl bg-white border border-[#E6ECF1] flex flex-col justify-between space-y-5 hover:border-[#233B53]/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-2xl bg-[#FAFAF7] border border-[#E6ECF1] flex items-center justify-center transition-colors group-hover:scale-105 duration-300 shadow-2xs">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="#0A66C2">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76a1.63 1.63 0 1 0 0-3.26 1.63 1.63 0 0 0 0 3.26m1.4 9.74V9.97H5.06v8.53h2.8z"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#FAFAF7] border border-[#E6ECF1] group-hover:bg-[#233B53] group-hover:text-white group-hover:border-[#233B53] text-stone-400 flex items-center justify-center transition-all duration-300 shadow-2xs">
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"/>
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-[#233B53]">Professional Network</span>
                    <h3 class="text-base font-extrabold text-[#1C2430] leading-snug">LinkedIn</h3>
                    <p class="text-xs text-stone-500 font-medium truncate pt-0.5">www.linkedin.com/in/tiaraaptr</p>
                </div>

                <div class="pt-3 border-t border-[#E6ECF1] flex items-center justify-between text-xs font-bold text-[#233B53]">
                    <span>Connect on LinkedIn</span>
                    <span class="text-xs group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </a>

            <!-- 2. Instagram -->
            <a href="https://www.instagram.com/tir.aptr_" target="_blank" rel="noopener" class="group clean-card p-6 rounded-3xl bg-white border border-[#E6ECF1] flex flex-col justify-between space-y-5 hover:border-[#233B53]/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-2xl bg-[#FAFAF7] border border-[#E6ECF1] flex items-center justify-center transition-colors group-hover:scale-105 duration-300 shadow-2xs">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="#E1306C">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#FAFAF7] border border-[#E6ECF1] group-hover:bg-[#233B53] group-hover:text-white group-hover:border-[#233B53] text-stone-400 flex items-center justify-center transition-all duration-300 shadow-2xs">
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"/>
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-[#233B53]">Social &amp; Visuals</span>
                    <h3 class="text-base font-extrabold text-[#1C2430] leading-snug">Instagram</h3>
                    <p class="text-xs text-stone-500 font-medium truncate pt-0.5">@tir.aptr_</p>
                </div>

                <div class="pt-3 border-t border-[#E6ECF1] flex items-center justify-between text-xs font-bold text-[#233B53]">
                    <span>Follow on Instagram</span>
                    <span class="text-xs group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </a>

            <!-- 3. WhatsApp -->
            <a href="https://wa.me/6285691265744" target="_blank" rel="noopener" class="group clean-card p-6 rounded-3xl bg-white border border-[#E6ECF1] flex flex-col justify-between space-y-5 hover:border-[#233B53]/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-2xl bg-[#FAFAF7] border border-[#E6ECF1] flex items-center justify-center transition-colors group-hover:scale-105 duration-300 shadow-2xs">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="#25D366">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.03-1.25-.75-.67-1.26-1.5-1.41-1.75-.14-.25-.02-.39.11-.51.11-.11.25-.29.37-.44.13-.14.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.34-.76-1.84-.2-.48-.4-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.22.25-.87.85-.87 2.07 0 1.22.89 2.4 1.01 2.56.13.17 1.75 2.67 4.23 3.74.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.14-1.18-.06-.1-.22-.17-.47-.29z"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#FAFAF7] border border-[#E6ECF1] group-hover:bg-[#233B53] group-hover:text-white group-hover:border-[#233B53] text-stone-400 flex items-center justify-center transition-all duration-300 shadow-2xs">
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"/>
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-[#233B53]">Direct Messaging</span>
                    <h3 class="text-base font-extrabold text-[#1C2430] leading-snug">WhatsApp</h3>
                    <p class="text-xs text-stone-500 font-medium truncate pt-0.5">+62 856-9126-5744</p>
                </div>

                <div class="pt-3 border-t border-[#E6ECF1] flex items-center justify-between text-xs font-bold text-[#233B53]">
                    <span>Chat on WhatsApp</span>
                    <span class="text-xs group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </a>

            <!-- 4. Email -->
            <a href="mailto:tiaraariyantoputrii@gmail.com" class="group clean-card p-6 rounded-3xl bg-white border border-[#E6ECF1] flex flex-col justify-between space-y-5 hover:border-[#233B53]/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-2xl bg-[#FAFAF7] border border-[#E6ECF1] flex items-center justify-center transition-colors group-hover:scale-105 duration-300 shadow-2xs">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="#233B53" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#FAFAF7] border border-[#E6ECF1] group-hover:bg-[#233B53] group-hover:text-white group-hover:border-[#233B53] text-stone-400 flex items-center justify-center transition-all duration-300 shadow-2xs">
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"/>
                        </svg>
                    </div>
                </div>

                <div class="space-y-1">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-[#233B53]">Official Inquiry</span>
                    <h3 class="text-base font-extrabold text-[#1C2430] leading-snug">Email</h3>
                    <p class="text-xs text-stone-500 font-medium truncate pt-0.5">tiaraariyantoputrii@gmail.com</p>
                </div>

                <div class="pt-3 border-t border-[#E6ECF1] flex items-center justify-between text-xs font-bold text-[#233B53]">
                    <span>Send an Email</span>
                    <span class="text-xs group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </a>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- CERTIFICATE PREVIEW MODAL -->
    <!-- ========================================== -->
    <div id="cert-modal" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5 opacity-0 pointer-events-none transition-opacity duration-300" role="dialog" aria-modal="true" aria-labelledby="cert-modal-title">
        <!-- Backdrop -->
        <div id="cert-modal-backdrop" class="absolute inset-0 bg-stone-900/60 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Dialog Box -->
        <div class="relative w-full max-w-3xl max-h-[92vh] bg-white rounded-3xl border border-[#E6ECF1] shadow-2xl overflow-hidden flex flex-col z-10 scale-95 transition-transform duration-300" id="cert-modal-card">
            
            <!-- Modal Header -->
            <div class="px-5 py-3.5 sm:py-4 border-b border-[#E6ECF1] bg-gradient-to-r from-[#DCEAF7] via-white to-[#FAFAF7] flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <div class="mb-1">
                        <span id="cert-modal-badge" class="px-2.5 py-0.5 rounded-full bg-white border border-[#E6ECF1] text-[9.5px] font-mono font-bold text-[#233B53] shadow-2xs"></span>
                    </div>
                    <h3 id="cert-modal-title" class="text-sm sm:text-base font-extrabold text-[#1C2430] truncate"></h3>
                    <p id="cert-modal-issuer" class="text-xs text-[#233B53] font-semibold truncate mt-0.5"></p>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a id="cert-modal-download" href="#" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-full bg-white border border-[#E6ECF1] hover:bg-[#DCEAF7] hover:border-[#233B53]/40 text-[#233B53] text-xs font-bold transition-all flex items-center gap-1.5 shadow-2xs">
                        <span>Open Original</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                    <button type="button" onclick="closeCertificateModal()" class="w-9 h-9 rounded-full bg-white hover:bg-[#DCEAF7] border border-[#E6ECF1] text-[#1C2430] hover:text-[#233B53] flex items-center justify-center transition-colors shadow-2xs cursor-pointer" aria-label="Close modal">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content Preview Area -->
            <div class="p-3 sm:p-5 flex-1 overflow-auto bg-[#FAFAF7] flex items-center justify-center min-h-[300px]">
                <img id="cert-modal-img" src="" alt="Certificate Preview" class="max-w-full max-h-[70vh] object-contain rounded-xl shadow-sm border border-[#E6ECF1] bg-white">
            </div>
        </div>
    </div>

</div>
@endsection
