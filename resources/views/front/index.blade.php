<!doctype html>
<html lang="ru" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- seo --}}
    <title>{{ $product->seo_title ?? 'NOOTROZ - Пик Умственной Продуктивности' }}</title>
    <meta name="description"
        content="{{ $product->seo_description ?? 'Инновационная формула для улучшения памяти, концентрации и защиты мозга. Разработано ведущими нейробиологами.' }}">

    <meta property="og:title" content="{{ $product->seo_title ?? $product->title }}">
    <meta property="og:description" content="{{ $product->seo_description ?? $product->description }}">
    <meta property="og:image" content="{{ asset('storage/' . $product->image_path) }}">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS v4 Browser CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Tailwind Theme Configuration -->
    <style type="text/tailwindcss">
        @theme {
            --font-sans: "Inter", ui-sans-serif, system-ui, sans-serif;
            --font-display: "Outfit", sans-serif;

            --color-primary: #c28e5e;
            --color-primary-dark: #a6764a;
            --color-accent: #1a1a1a;
        }

        @layer base {
            body {
                @apply font-sans text-gray-900 bg-white;
            }

            h1,
            h2,
            h3,
            h4 {
                @apply font-display tracking-tight;
            }
        }
    </style>

    /* <!-- Custom CSS --> */
    <style>
        /* Reveal Animations */
        .reveal-up,
        .reveal-left,
        .reveal-scale {
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-up {
            transform: translateY(30px);
        }

        .reveal-left {
            transform: translateX(-30px);
        }

        .reveal-scale {
            transform: scale(0.95);
        }

        .reveal-up.active,
        .reveal-left.active,
        .reveal-scale.active {
            opacity: 1;
            transform: translate(0) scale(1);
        }

        /* Gradient text for highlighted words */
        .gradient-text {
            background: linear-gradient(90deg, #f1a953 0%, #80480c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Mobile Menu - slides from LEFT */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        .mobile-overlay {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s ease;
        }

        .mobile-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        /* Hamburger Animation */
        .hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: currentColor;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        /* Product box float animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .product-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="font-sans text-gray-900 bg-white selection:bg-primary/30 selection:text-primary">
    <!-- Navbar -->
    <header id="navbar"
        class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('img/logo.svg') }}" alt="">

                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#преимущества"
                        class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Преимущества</a>
                    <a href="#состав"
                        class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Состав</a>
                    <a href="#применение"
                        class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Применение</a>
                    <a href="#вопросы"
                        class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Вопросы</a>
                    <a href="#консультация"
                        class="text-sm font-medium text-gray-600 hover:text-primary transition-colors">Консультация</a>
                </nav>

                <div class="flex items-center gap-4">
                    <!-- Order Button (Desktop) -->
                    <button
                        class="hidden md:block bg-[#171717] text-white px-6 py-2.5 rounded-[8px] text-sm font-semibold hover:bg-primary-dark transition-all shadow-sm">
                        Заказать
                    </button>

                    <!-- Hamburger (Mobile) -->
                    <button id="hamburger-btn" class="md:hidden hamburger flex flex-col gap-1.5 p-2 text-accent"
                        aria-label="Меню">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="mobile-overlay fixed inset-0 bg-black/50 z-[60]"></div>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 h-full w-[280px] bg-white z-[70] shadow-2xl">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div class="font-display font-bold text-xl tracking-tighter">
                <span class="text-accent">ANFA</span>
            </div>
            <button id="mobile-close"
                class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors"
                aria-label="Закрыть">
                <i data-lucide="x" class="w-5 h-5 text-gray-600"></i>
            </button>
        </div>
        <nav class="flex flex-col p-6 gap-1">
            <a href="#преимущества"
                class="mobile-link py-3 px-4 text-base font-medium text-gray-700 hover:text-primary hover:bg-primary/5 rounded-xl transition-all">Преимущества</a>
            <a href="#состав"
                class="mobile-link py-3 px-4 text-base font-medium text-gray-700 hover:text-primary hover:bg-primary/5 rounded-xl transition-all">Состав</a>
            <a href="#применение"
                class="mobile-link py-3 px-4 text-base font-medium text-gray-700 hover:text-primary hover:bg-primary/5 rounded-xl transition-all">Применение</a>
            <a href="#вопросы"
                class="mobile-link py-3 px-4 text-base font-medium text-gray-700 hover:text-primary hover:bg-primary/5 rounded-xl transition-all">Вопросы</a>
            <a href="#консультация"
                class="mobile-link py-3 px-4 text-base font-medium text-gray-700 hover:text-primary hover:bg-primary/5 rounded-xl transition-all">Консультация</a>
        </nav>
        <div class="p-6 mt-auto">
            <button
                class="mobile-link w-full bg-[#171717] text-white py-4 rounded-[8px] font-bold hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                Заказать
            </button>
        </div>
    </div>

    <main>
        <!-- Hero -->
        <section class="pt-28 sm:pt-32 pb-16 sm:pb-20 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="reveal-left">
                        <span
                            class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 block">{{ $product->subtitle }}</span>
                        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-accent leading-[1.1] mb-6">

                            {!! $product->title !!}
                        </h1>
                        <p class="text-base sm:text-lg text-gray-600 mb-8 sm:mb-10 max-w-lg leading-relaxed">
                            {{ $product->description }}
                        </p>

                        <div class="flex flex-wrap gap-8 sm:gap-12 mb-10 sm:mb-12">
                            <div>
                                <div class="text-3xl sm:text-4xl font-bold text-primary mb-1">
                                    {{ $product->absorption_rate }}
                                </div>
                                <div class="text-[10px] sm:text-xs uppercase tracking-widest text-gray-400 font-bold">
                                    Усвояемость
                                </div>
                            </div>
                            <div>
                                <div class="text-3xl sm:text-4xl font-bold text-primary mb-1">
                                    {{ $product->course_duration }} <span class="text-xl sm:text-2xl">Мес</span>
                                </div>
                                <div class="text-[10px] sm:text-xs uppercase tracking-widest text-gray-400 font-bold">
                                    Полный курс
                                </div>
                            </div>
                            <div>
                                <div class="text-3xl sm:text-4xl font-bold text-primary mb-1">
                                    {{ $product->capsule_count }}
                                </div>
                                <div class="text-[10px] sm:text-xs uppercase tracking-widest text-gray-400 font-bold">
                                    Мягких капсул
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3 sm:gap-4">
                            <a href="{{ $product->primary_link }}"
                                class="bg-accent text-white px-6 sm:px-8 py-3.5 sm:py-4 rounded-[8px] font-bold hover:bg-gray-800 transition-all shadow-lg shadow-black/10 text-sm sm:text-base">
                                Начать курс
                            </a>
                            <a href="{{ $product->secondary_link }}"
                                class="border border-gray-200 text-gray-600 px-6 sm:px-8 py-3.5 sm:py-4 rounded-[8px] font-bold hover:bg-gray-50 transition-all text-sm sm:text-base">
                                Изучить состав
                            </a>
                        </div>
                    </div>

                    <div class="relative reveal-scale flex justify-center lg:justify-end">
                        <div class="absolute inset-0 bg-primary/10 blur-3xl rounded-full -z-10 transform scale-75">
                        </div>
                        <img src="{{ asset('storage/' . $product['image_path']) }}" alt="NOOTROZ Product Box"
                            class="w-full max-w-[320px] sm:max-w-[400px] lg:max-w-md mx-auto drop-shadow-2xl product-float" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Problems -->
        <section id="преимущества" class="py-16 sm:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 sm:mb-20">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-accent mb-6">
                        {!! $problem->title !!}
                    </h2>
                    <p class="text-gray-500 max-w-3xl mx-auto text-sm sm:text-base leading-relaxed">
                        {{ $problem->description }}
                    </p>
                </div>

                <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">
                    <div
                        class="lg:col-span-6 relative w-full h-[400px] sm:h-[450px] lg:h-[500px] rounded-[32px] overflow-hidden reveal-left">
                        <div class="absolute inset-0 w-full h-full"
                            style="
                  -webkit-mask-image: linear-gradient(
                    to right,
                    black,
                    transparent 100%
                  );
                  mask-image: linear-gradient(
                    to right,
                    black,
                    transparent 100%
                  );
                ">
                            <img src="{{ asset('storage/' . $problem->image_path) }}" alt="Stressed person"
                                class="w-full h-full object-cover" referrerpolicy="no-referrer" />
                        </div>
                    </div>

                    <div class="lg:col-span-6 space-y-0 divide-y divide-gray-100">
                        @foreach ($problem->problems as $item)
                            <div class="py-6 sm:py-8 reveal-up">
                                <div class="flex items-center gap-4 mb-4">
                                    <img src="{{ asset('storage/' . $item['icon']) }}" alt=""
                                        class="w-6 h-6 sm:w-7 sm:h-7 text-accent">
                                    <h3 class="text-lg sm:text-xl font-bold text-accent">
                                        {{ $item['title'] }}
                                    </h3>
                                </div>
                                <p class="text-gray-500 text-sm leading-relaxed max-w-lg">
                                    {{ $item['text'] }}
                                </p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>

        <!-- Why NOOTROZ -->
        <section id="состав" class="py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-accent">
                        {!! $cause->title !!}
                    </h2>
                </div>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Action Card -->
                    <div
                        class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50 reveal-up">
                        <h3
                            class="text-xl sm:text-2xl font-bold text-primary mb-6 sm:mb-8 pb-4 border-b border-gray-100">
                            {!! $cause->main_action_title !!}
                        </h3>
                        <ul class="space-y-3 sm:space-y-4">

                            @foreach ($cause->main_actions as $item)
                                <li class="flex gap-3 text-xs sm:text-sm text-gray-600 leading-relaxed">
                                    <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></div>
                                    {{ $item }}
                                </li>
                            @endforeach


                        </ul>
                    </div>

                    <!-- Composition Card -->
                    <div
                        class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50 flex flex-col items-center reveal-up">
                        <div class="relative w-36 h-36 sm:w-48 sm:h-48 mb-6 sm:mb-8">
                            <div class="absolute inset-0 bg-primary/5 rounded-full animate-pulse"></div>
                            <img src="{{ asset('storage/' . $cause->center_image) }}" alt="Brain composition"
                                class="w-full h-full object-contain relative z-10 rounded-full"
                                referrerpolicy="no-referrer" />
                        </div>
                        <div class="grid grid-cols-2 gap-x-6 sm:gap-x-8 gap-y-4 sm:gap-y-6 w-full">
                            @foreach ($cause->center_stats as $item)
                                <div>
                                    <div class="text-xs font-bold text-primary mb-1">
                                        {{ $item['label'] }}
                                    </div>
                                    <div class="text-[10px] text-gray-400 uppercase tracking-wider">
                                        {{ $item['sub_label'] }}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Minerals Card -->
                    <div
                        class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50 reveal-up sm:col-span-2 md:col-span-1">
                        <h3
                            class="text-xl sm:text-2xl font-bold text-primary mb-6 sm:mb-8 pb-4 border-b border-gray-100">
                            {!! $cause->composition_title !!}
                        </h3>
                        <ul class="space-y-4 sm:space-y-6">
                            @foreach ($cause->composition_items as $item)
                                <li>
                                    <div class="flex items-center gap-2 mb-1">
                                        <div class="w-2 h-2 rounded-full bg-primary"></div>
                                        <span class="font-bold text-accent text-sm sm:text-base">{{ $item['name'] }}</span>
                                    </div>
                                    <p class="text-xs text-gray-400 ml-4">{{ $item['desc'] }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Usage -->
        <section id="применение" class="py-16 sm:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-accent mb-4">
                        Применение <span class="gradient-text">NOOTROZ</span>
                    </h2>
                    <p class="text-gray-500 text-xs sm:text-sm uppercase tracking-widest font-bold">
                        Следуйте рекомендованному курсу для максимального результата
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                    <div
                        class="group relative h-[350px] sm:h-[450px] rounded-3xl overflow-hidden shadow-xl reveal-scale">
                        <img src="https://picsum.photos/seed/morning-usage/600/800" alt="Morning"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            referrerpolicy="no-referrer" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 sm:top-6 left-4 sm:left-6">
                            <span
                                class="bg-primary/90 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Утро</span>
                        </div>
                        <div class="absolute bottom-6 sm:bottom-8 left-6 sm:left-8 right-6 sm:right-8 text-white">
                            <h3 class="text-xl sm:text-2xl font-bold mb-2">
                                Дважды в день
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-300 leading-relaxed">
                                Принимайте 2 капсулы утром во время еды
                            </p>
                        </div>
                    </div>
                    <div
                        class="group relative h-[350px] sm:h-[450px] rounded-3xl overflow-hidden shadow-xl reveal-scale">
                        <img src="https://picsum.photos/seed/evening-usage/600/800" alt="Evening"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            referrerpolicy="no-referrer" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 sm:top-6 left-4 sm:left-6">
                            <span
                                class="bg-primary/90 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Вечер</span>
                        </div>
                        <div class="absolute bottom-6 sm:bottom-8 left-6 sm:left-8 right-6 sm:right-8 text-white">
                            <h3 class="text-xl sm:text-2xl font-bold mb-2">
                                Один раз в день
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-300 leading-relaxed">
                                Для поддержания эффекта и расслабления
                            </p>
                        </div>
                    </div>
                    <div
                        class="group relative h-[350px] sm:h-[450px] rounded-3xl overflow-hidden shadow-xl reveal-scale sm:col-span-2 md:col-span-1">
                        <img src="https://picsum.photos/seed/course-usage/600/800" alt="Course"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            referrerpolicy="no-referrer" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 sm:top-6 left-4 sm:left-6">
                            <span
                                class="bg-primary/90 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">Полный
                                курс</span>
                        </div>
                        <div class="absolute bottom-6 sm:bottom-8 left-6 sm:left-8 right-6 sm:right-8 text-white">
                            <h3 class="text-xl sm:text-2xl font-bold mb-2">3–6 месяцев</h3>
                            <p class="text-xs sm:text-sm text-gray-300 leading-relaxed">
                                Рекомендуемая длительность для стойкого результата
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="вопросы" class="py-16 sm:py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-10 sm:gap-16">
                    <div>
                        <span
                            class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 block">Поддержка</span>
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-accent mb-6 sm:mb-8">
                            Часто задаваемые <br />
                            <span class="gradient-text">Вопросы</span>
                        </h2>
                        <p class="text-gray-500 max-w-md text-sm sm:text-base">
                            Найдите ответы на самые популярные вопросы о нашем когнитивном
                            комплексе.
                        </p>
                    </div>

                    <div class="space-y-4" id="faq-container">
                        <!-- FAQ Item 1 -->
                        <div class="border-b border-gray-200 faq-item active">
                            <button
                                class="w-full py-5 sm:py-6 flex justify-between items-center text-left group faq-trigger">
                                <span class="font-bold transition-colors text-primary text-sm sm:text-base">Как быстро
                                    появится эффект?</span>
                                <i data-lucide="chevron-down"
                                    class="w-5 h-5 transition-transform duration-300 rotate-180 text-primary"></i>
                            </button>
                            <div class="faq-content overflow-hidden transition-all duration-300"
                                style="max-height: 200px">
                                <p class="pb-5 sm:pb-6 text-xs sm:text-sm text-gray-500 leading-relaxed">
                                    Первые результаты в виде улучшения концентрации и ясности
                                    мысли обычно заметны уже через 7-10 дней регулярного приема.
                                </p>
                            </div>
                        </div>
                        <!-- FAQ Item 2 -->
                        <div class="border-b border-gray-200 faq-item">
                            <button
                                class="w-full py-5 sm:py-6 flex justify-between items-center text-left group faq-trigger">
                                <span
                                    class="font-bold transition-colors text-accent group-hover:text-primary text-sm sm:text-base">Как
                                    принимать NOOTROZ?</span>
                                <i data-lucide="chevron-down"
                                    class="w-5 h-5 transition-transform duration-300 text-gray-400"></i>
                            </button>
                            <div class="faq-content overflow-hidden transition-all duration-300"
                                style="max-height: 0">
                                <p class="pb-5 sm:pb-6 text-xs sm:text-sm text-gray-500 leading-relaxed">
                                    Рекомендуется принимать по 2 капсулы в день, желательно во
                                    время завтрака, запивая достаточным количеством воды.
                                </p>
                            </div>
                        </div>
                        <!-- FAQ Item 3 -->
                        <div class="border-b border-gray-200 faq-item">
                            <button
                                class="w-full py-5 sm:py-6 flex justify-between items-center text-left group faq-trigger">
                                <span
                                    class="font-bold transition-colors text-accent group-hover:text-primary text-sm sm:text-base">Есть
                                    ли побочные эффекты?</span>
                                <i data-lucide="chevron-down"
                                    class="w-5 h-5 transition-transform duration-300 text-gray-400"></i>
                            </button>
                            <div class="faq-content overflow-hidden transition-all duration-300"
                                style="max-height: 0">
                                <p class="pb-5 sm:pb-6 text-xs sm:text-sm text-gray-500 leading-relaxed">
                                    NOOTROZ состоит из натуральных компонентов и обычно хорошо
                                    переносится. Однако перед применением рекомендуется
                                    проконсультироваться с врачом.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Consultation -->
        <section id="консультация" class="py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="reveal-left">
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 block">Действуйте
                            сейчас</span>
                        <h2 class="text-4xl sm:text-5xl font-bold text-accent mb-6 leading-tight">
                            Готовы мыслить <br />
                            <span class="gradient-text italic">Яснее?</span>
                        </h2>
                        <p class="text-gray-600 mb-8 sm:mb-10 max-w-sm text-sm sm:text-base">
                            Закажите NOOTROZ сегодня и начните путь к максимальной
                            продуктивности вашего мозга.
                        </p>
                        <img src="./assets/nootroz-box.png" alt="NOOTROZ box" class="w-48 sm:w-64 drop-shadow-xl" />
                    </div>

                    <div
                        class="bg-gray-50 p-8 sm:p-10 rounded-[32px] sm:rounded-[40px] border border-gray-100 reveal-up">
                        <h3 class="text-xl sm:text-2xl font-bold text-accent mb-2">
                            Получить консультацию
                        </h3>
                        <p class="text-xs sm:text-sm text-gray-500 mb-6 sm:mb-8">
                            Оставьте заявку, и наш специалист свяжется с вами для
                            индивидуального подбора курса.
                        </p>

                        <form class="space-y-3 sm:space-y-4" id="consultation-form">
                            <input type="text" placeholder="Имя" required
                                class="w-full px-5 sm:px-6 py-3.5 sm:py-4 rounded-2xl bg-white border border-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm sm:text-base" />
                            <input type="email" placeholder="Email" required
                                class="w-full px-5 sm:px-6 py-3.5 sm:py-4 rounded-2xl bg-white border border-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm sm:text-base" />
                            <input type="tel" placeholder="Телефон" required
                                class="w-full px-5 sm:px-6 py-3.5 sm:py-4 rounded-2xl bg-white border border-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm sm:text-base" />
                            <button type="submit"
                                class="w-full bg-accent text-white py-4 sm:py-5 rounded-2xl font-bold hover:bg-gray-800 transition-all shadow-lg shadow-black/10 mt-2 sm:mt-4 text-sm sm:text-base">
                                Записаться на консультацию
                            </button>
                            <p class="text-[10px] text-center text-gray-400 mt-3 sm:mt-4">
                                Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-accent text-white pt-16 sm:pt-20 pb-8 sm:pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-12 mb-12 sm:mb-16">
                <div class="col-span-2 lg:col-span-1">
                    <div class="font-display font-bold text-2xl tracking-tighter mb-4 sm:mb-6">
                        <span>ANFA</span>
                        <span class="text-[10px] ml-1 font-normal text-gray-500 uppercase tracking-widest block">Group
                            of Companies</span>
                    </div>
                    <p class="text-gray-500 text-xs sm:text-sm mb-6 sm:mb-8 leading-relaxed">
                        Advanced cognitive optimization formulated by ANFA
                        Pharmaceuticals.
                    </p>
                    <div class="flex gap-3 sm:gap-4">
                        <a href="#"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-800 flex items-center justify-center hover:bg-primary hover:border-primary transition-all">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-800 flex items-center justify-center hover:bg-primary hover:border-primary transition-all">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-800 flex items-center justify-center hover:bg-primary hover:border-primary transition-all">
                            <i data-lucide="linkedin" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold mb-4 sm:mb-6 text-xs sm:text-sm uppercase tracking-widest">
                        Продукт
                    </h4>
                    <ul class="space-y-3 sm:space-y-4 text-xs sm:text-sm text-gray-500">
                        <li>
                            <a href="#преимущества" class="hover:text-primary transition-colors">Преимущества</a>
                        </li>
                        <li>
                            <a href="#состав" class="hover:text-primary transition-colors">Состав</a>
                        </li>
                        <li>
                            <a href="#применение" class="hover:text-primary transition-colors">Применение</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-primary transition-colors">Отзывы</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 sm:mb-6 text-xs sm:text-sm uppercase tracking-widest">
                        Компания
                    </h4>
                    <ul class="space-y-3 sm:space-y-4 text-xs sm:text-sm text-gray-500">
                        <li>
                            <a href="#" class="hover:text-primary transition-colors">О нас</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-primary transition-colors">Исследования</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-primary transition-colors">Контакты</a>
                        </li>
                    </ul>
                </div>

                <div class="col-span-2 lg:col-span-1">
                    <h4 class="font-bold mb-4 sm:mb-6 text-xs sm:text-sm uppercase tracking-widest">
                        Контакты
                    </h4>
                    <ul class="space-y-3 sm:space-y-4 text-xs sm:text-sm text-gray-500">
                        <li class="flex gap-3">
                            <i data-lucide="phone" class="w-4 h-4 text-primary flex-shrink-0"></i>
                            <span>+ 998 90 123 45 67</span>
                        </li>
                        <li class="flex gap-3">
                            <i data-lucide="map-pin" class="w-4 h-4 text-primary flex-shrink-0"></i>
                            <span>г. Ташкент, Сергелийский район, ТКАД</span>
                        </li>
                        <li class="flex gap-3">
                            <i data-lucide="mail" class="w-4 h-4 text-primary flex-shrink-0"></i>
                            <span>info@jacsino.uz</span>
                        </li>
                        <li class="flex gap-3">
                            <i data-lucide="clock" class="w-4 h-4 text-primary flex-shrink-0"></i>
                            <span>Пн-Вс: 09:00 – 20:00</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="pt-6 sm:pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-4">
                <p class="text-[10px] text-gray-600">
                    © 2026 ANFA Pharmaceuticals. All rights reserved.
                </p>
                <p class="text-[10px] text-gray-600 text-center sm:text-right max-w-md">
                    Данный продукт не предназначен для диагностики, лечения или
                    предотвращения каких-либо заболеваний.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Lucide icons
            if (window.lucide) {
                window.lucide.createIcons();
            }

            // ===== Mobile Menu =====
            var hamburgerBtn = document.getElementById("hamburger-btn");
            var mobileMenu = document.getElementById("mobile-menu");
            var mobileOverlay = document.getElementById("mobile-overlay");
            var mobileClose = document.getElementById("mobile-close");
            var mobileLinks = document.querySelectorAll(".mobile-link");

            function openMenu() {
                mobileMenu.classList.add("open");
                mobileOverlay.classList.add("open");
                hamburgerBtn.classList.add("active");
                document.body.style.overflow = "hidden";
            }

            function closeMenu() {
                mobileMenu.classList.remove("open");
                mobileOverlay.classList.remove("open");
                hamburgerBtn.classList.remove("active");
                document.body.style.overflow = "";
            }

            if (hamburgerBtn) hamburgerBtn.addEventListener("click", openMenu);
            if (mobileClose) mobileClose.addEventListener("click", closeMenu);
            if (mobileOverlay) mobileOverlay.addEventListener("click", closeMenu);

            // Close menu when clicking a nav link
            mobileLinks.forEach(function(link) {
                link.addEventListener("click", closeMenu);
            });

            // Close menu on Escape key
            document.addEventListener("keydown", function(e) {
                if (e.key === "Escape") closeMenu();
            });

            // ===== FAQ Interactivity =====
            var faqItems = document.querySelectorAll(".faq-item");

            faqItems.forEach(function(item) {
                var trigger = item.querySelector(".faq-trigger");
                var content = item.querySelector(".faq-content");
                var icon = item.querySelector('[data-lucide="chevron-down"]');
                var title = item.querySelector("span");

                if (trigger) {
                    trigger.addEventListener("click", function() {
                        var isActive = item.classList.contains("active");

                        // Close all other items
                        faqItems.forEach(function(otherItem) {
                            if (otherItem !== item) {
                                otherItem.classList.remove("active");
                                var otherContent = otherItem.querySelector(".faq-content");
                                var otherIcon = otherItem.querySelector(
                                    '[data-lucide="chevron-down"]',
                                );
                                var otherTitle = otherItem.querySelector("span");

                                if (otherContent) otherContent.style.maxHeight = "0";
                                if (otherIcon) otherIcon.style.transform = "rotate(0deg)";
                                if (otherIcon) {
                                    otherIcon.classList.remove("text-primary");
                                    otherIcon.classList.add("text-gray-400");
                                }
                                if (otherTitle) {
                                    otherTitle.classList.remove("text-primary");
                                    otherTitle.classList.add("text-accent");
                                }
                            }
                        });

                        // Toggle current item
                        if (isActive) {
                            item.classList.remove("active");
                            if (content) content.style.maxHeight = "0";
                            if (icon) icon.style.transform = "rotate(0deg)";
                            if (icon) {
                                icon.classList.remove("text-primary");
                                icon.classList.add("text-gray-400");
                            }
                            if (title) {
                                title.classList.remove("text-primary");
                                title.classList.add("text-accent");
                            }
                        } else {
                            item.classList.add("active");
                            if (content)
                                content.style.maxHeight = content.scrollHeight + "px";
                            if (icon) icon.style.transform = "rotate(180deg)";
                            if (icon) {
                                icon.classList.remove("text-gray-400");
                                icon.classList.add("text-primary");
                            }
                            if (title) {
                                title.classList.remove("text-accent");
                                title.classList.add("text-primary");
                            }
                        }
                    });
                }
            });

            // ===== Form Submission =====
            var form = document.getElementById("consultation-form");
            if (form) {
                form.addEventListener("submit", function(e) {
                    e.preventDefault();
                    var formData = new FormData(form);
                    var data = Object.fromEntries(formData.entries());
                    console.log("Form submitted:", data);
                    alert(
                        "Спасибо! Ваша заявка принята. Мы свяжемся с вами в ближайшее время.",
                    );
                    form.reset();
                });
            }

            // ===== Reveal Animation on Scroll =====
            var revealElements = document.querySelectorAll(
                ".reveal-up, .reveal-left, .reveal-scale",
            );

            function revealOnScroll() {
                revealElements.forEach(function(el) {
                    var rect = el.getBoundingClientRect();
                    var isVisible = rect.top < window.innerHeight - 100;
                    if (isVisible) {
                        el.classList.add("active");
                    }
                });
            }

            window.addEventListener("scroll", revealOnScroll);
            revealOnScroll(); // Initial check
        });
    </script>
</body>

</html>
