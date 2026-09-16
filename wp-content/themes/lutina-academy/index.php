<?php
/**
 * Main template file
 */
?>
<!DOCTYPE html>
<html lang="ja" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ICA 池袋キャリアアカデミー | 池袋の占いアカデミー</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Shippori+Mincho:wght@400;500;600;700&family=Zen+Kaku+Gothic+New:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              serif: ['"Cinzel"', '"Shippori Mincho"', 'serif'],
              sans: ['"Zen Kaku Gothic New"', 'sans-serif'],
              mincho: ['"Shippori Mincho"', 'serif'],
            },
            colors: {
              mystic: {
                950: '#FAF7FC', // Brightest Off-white lavender
                900: '#F3EDF7', // Light lavender background
                800: '#E9DFEF', // Soft lavender
                700: '#D9C6E2', // Medium lavender
                600: '#2D2437', // Deep text color
              },
              accent: {
                100: '#F5F0F7',
                200: '#E7DCEB',
                300: '#D8C6DE',
                400: '#C7B0CD', // Main Mystic Lavender
                500: '#A68EAD',
                600: '#866D8D',
              }
            },
            backgroundImage: {
              'hero-light': "url('<?php echo get_template_directory_uri(); ?>/assets/images/top.png')",
            },
            animation: {
              'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
              'spin-slow': 'spin 25s linear infinite',
            }
          }
        }
      }
    </script>
    <style>
      /* Custom Scrollbar */
      ::-webkit-scrollbar {
        width: 8px;
      }
      ::-webkit-scrollbar-track {
        background: #FAF7FC;
      }
      ::-webkit-scrollbar-thumb {
        background: #D9C6E2;
        border-radius: 4px;
        border: 2px solid #FAF7FC;
      }
      ::-webkit-scrollbar-thumb:hover {
        background: #C7B0CD;
      }
      
      body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.02'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 9999;
      }

      /* Animation Utilities */
      .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
      }
      .animate-in {
        opacity: 1;
        transform: translateY(0);
      }
      /* Delayed animations */
      .delay-100 { transition-delay: 100ms; }
      .delay-200 { transition-delay: 200ms; }
      .delay-300 { transition-delay: 300ms; }
      .delay-400 { transition-delay: 400ms; }
      .delay-500 { transition-delay: 500ms; }

      /* カリキュラムの強調ポイント */
      .curriculum-highlight { color: #B4487A; font-weight: 700; }

      /* Accordion transition */
      .accordion-content {
          transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
          max-height: 0;
          opacity: 0;
          overflow: hidden;
      }
    </style>
    <?php wp_head(); ?>
  </head>
  <body class="bg-mystic-950 text-mystic-600 font-sans antialiased overflow-x-hidden selection:bg-accent-200 selection:text-mystic-600">
    <div class="min-h-screen bg-mystic-900 text-white font-sans selection:bg-accent-400 selection:text-mystic-950 pb-20 md:pb-0">
        
        <!-- Navbar -->
        <nav class="fixed w-full z-50 bg-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="logo-area flex-shrink-0 flex items-center cursor-pointer group" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
                        <div class="relative">
                            <img 
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png?v=20260916" 
                                alt="ICA 池袋キャリアアカデミー ロゴ" 
                                class="w-[80px] h-[80px] md:w-[80px] md:h-[80px] object-contain"
                            >
                        </div>
                        <span class="text-[15px] md:text-lg font-mincho font-bold text-mystic-600 tracking-wider group-hover:text-accent-600 transition-colors">
                            池袋キャリアアカデミー
                        </span>
                    </div>
                    
                    <div class="hidden lg:block">
                        <div class="ml-8 flex items-center space-x-6">
                            <a href="#reasons" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                選ばれる理由<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#earnings" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                将来像<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#features" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                特徴<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#courses" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                コース紹介<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#instructors" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                講師<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#testimonials" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                受講生の声<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#flow" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                受講の流れ<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#faq" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                Q&A<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            
                            <a href="https://lin.ee/NmIGh0t" target="_blank" rel="noopener noreferrer" class="counseling-btn bg-accent-500/10 border border-accent-400 hover:bg-accent-400 hover:text-white text-accent-600 px-6 py-2 rounded-sm text-sm font-serif transition-all duration-300 tracking-wider shadow-sm">
                                無料相談する
                            </a>
                        </div>
                    </div>

                    <div class="-mr-2 flex lg:hidden">
                        <button id="mobile-menu-button" aria-expanded="false" class="inline-flex items-center justify-center p-2 text-accent-600 hover:text-accent-400 focus:outline-none">
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="lg:hidden transition-all duration-300 ease-in-out overflow-y-auto max-h-0 opacity-0 bg-white border-b border-accent-100">
                <div class="px-4 pt-4 pb-6 space-y-2">
                    <a href="#reasons" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">選ばれる理由</a>
                    <a href="#earnings" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">将来像</a>
                    <a href="#features" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">特徴</a>
                    <a href="#courses" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">コース紹介</a>
                    <a href="#instructors" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">講師</a>
                    <a href="#testimonials" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">受講生の声</a>
                    <a href="#flow" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">受講の流れ</a>
                    <a href="#faq" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">Q&A</a>
                </div>
            </div>
        </nav>

        <main>
            <!-- 1. Hero -->
            <section class="relative flex items-center justify-center bg-mystic-950 pt-20">
                <div class="w-full mx-auto">
                    <div class="w-full">
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/assets/images/top.png?v=20260916"
                            alt="ICA 池袋キャリアアカデミー メインビジュアル"
                            class="w-full h-auto mx-auto"
                        >
                    </div>
                </div>
            </section>

            <!-- 2. Reasons (選ばれる理由) -->
            <section id="reasons" class="py-32 bg-white relative">
                <div class="absolute inset-0 bg-gradient-to-b from-mystic-950 via-white to-white pointer-events-none"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-20 relative z-10 animate-on-scroll">
                        <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Why Choose Us —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">選ばれる理由</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Feature 1 -->
                        <div class="animate-on-scroll group bg-white border border-accent-100 rounded-2xl overflow-hidden transition-all duration-500 shadow-sm hover:shadow-xl hover:-translate-y-2 flex flex-col">
                            <div class="h-56 relative overflow-hidden">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reason1.webp" alt="未経験からプロへ" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
                            </div>
                            <div class="p-8 relative">
                                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-1 bg-accent-400"></div>
                                <h3 class="text-xl font-serif font-bold text-mystic-600 mb-4 text-center group-hover:text-accent-600 transition-colors tracking-wide">未経験からプロへ</h3>
                                <p class="text-gray-500 leading-relaxed font-mincho text-sm text-center group-hover:text-gray-700 transition-colors">
                                    基礎から応用まで体系化されたカリキュラム。予備知識ゼロからでも、最短ルートでプロの技術を習得できます。
                                </p>
                            </div>
                        </div>
                        <!-- Feature 2 -->
                        <div class="animate-on-scroll delay-200 group bg-white border border-accent-100 rounded-2xl overflow-hidden transition-all duration-500 shadow-sm hover:shadow-xl hover:-translate-y-2 flex flex-col">
                            <div class="h-56 relative overflow-hidden">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reason2.webp" alt="実践的カリキュラム" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
                            </div>
                            <div class="p-8 relative">
                                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-1 bg-accent-400"></div>
                                <h3 class="text-xl font-serif font-bold text-mystic-600 mb-4 text-center group-hover:text-accent-600 transition-colors tracking-wide">実践的カリキュラム</h3>
                                <p class="text-gray-500 leading-relaxed font-mincho text-sm text-center group-hover:text-gray-700 transition-colors">
                                    座学だけでなく、実際の鑑定現場を想定したロールプレイングを重視。即戦力として活躍できる「対話力」を磨きます。
                                </p>
                            </div>
                        </div>
                        <!-- Feature 3 -->
                        <div class="animate-on-scroll delay-400 group bg-white border border-accent-100 rounded-2xl overflow-hidden transition-all duration-500 shadow-sm hover:shadow-xl hover:-translate-y-2 flex flex-col">
                            <div class="h-56 relative overflow-hidden">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/course2.webp" alt="充実の開業サポート" class="w-full h-full object-cover object-ceneter transform group-hover:scale-110 transition-transform duration-1000">
                            </div>
                            <div class="p-8 relative">
                                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-1 bg-accent-400"></div>
                                <h3 class="text-xl font-serif font-bold text-mystic-600 mb-4 text-center group-hover:text-accent-600 transition-colors tracking-wide">充実の開業サポート</h3>
                                <p class="text-gray-500 leading-relaxed font-mincho text-sm text-center group-hover:text-gray-700 transition-colors">
                                    独立開業のためのマーケティング、集客ノウハウ、お仕事の取り方まで習得できます。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. TargetAudience (こんな方にオススメ) -->
            <section id="target" class="py-32 bg-mystic-950 relative overflow-hidden">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- Main Frame Container -->
                    <div class="animate-on-scroll relative bg-white border-[3px] border-accent-200 p-8 md:p-16 shadow-lg">
                        <!-- Ornamental Corners (SVG) -->
                        <div class="absolute top-2 left-2 w-16 h-16 md:w-24 md:h-24 text-accent-400 opacity-60">
                            <svg viewBox="0 0 100 100" fill="currentColor">
                                <path d="M0,0 L40,0 Q20,0 20,20 L20,40 Q20,20 0,20 Z" />
                                <circle cx="15" cy="15" r="2" />
                                <path d="M10,30 Q10,10 30,10" fill="none" stroke="currentColor" strokeWidth="1" />
                            </svg>
                        </div>
                        <div class="absolute top-2 right-2 w-16 h-16 md:w-24 md:h-24 text-accent-400 opacity-60 rotate-90">
                            <svg viewBox="0 0 100 100" fill="currentColor">
                                <path d="M0,0 L40,0 Q20,0 20,20 L20,40 Q20,20 0,20 Z" />
                                <circle cx="15" cy="15" r="2" />
                                <path d="M10,30 Q10,10 30,10" fill="none" stroke="currentColor" strokeWidth="1" />
                            </svg>
                        </div>
                        <div class="absolute bottom-2 left-2 w-16 h-16 md:w-24 md:h-24 text-accent-400 opacity-60 -rotate-90">
                            <svg viewBox="0 0 100 100" fill="currentColor">
                                <path d="M0,0 L40,0 Q20,0 20,20 L20,40 Q20,20 0,20 Z" />
                                <circle cx="15" cy="15" r="2" />
                                <path d="M10,30 Q10,10 30,10" fill="none" stroke="currentColor" strokeWidth="1" />
                            </svg>
                        </div>
                        <div class="absolute bottom-2 right-2 w-16 h-16 md:w-24 md:h-24 text-accent-400 opacity-60 rotate-180">
                            <svg viewBox="0 0 100 100" fill="currentColor">
                                <path d="M0,0 L40,0 Q20,0 20,20 L20,40 Q20,20 0,20 Z" />
                                <circle cx="15" cy="15" r="2" />
                                <path d="M10,30 Q10,10 30,10" fill="none" stroke="currentColor" strokeWidth="1" />
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="relative z-10 text-center">
                            <h2 class="text-3xl md:text-5xl font-mincho font-bold text-accent-600 mb-6 tracking-tight">
                                こんな方にオススメ！
                            </h2>

                            <!-- Decorative Divider -->
                            <div class="flex items-center justify-center gap-4 mb-12">
                                <div class="h-[1px] w-12 md:w-24 bg-accent-400"></div>
                                <div class="text-accent-500">
                                    <svg width="60" height="20" viewBox="0 0 60 20" fill="currentColor">
                                        <path d="M30,0 Q35,10 45,10 T60,10 M30,0 Q25,10 15,10 T0,10" fill="none" stroke="currentColor" strokeWidth="1" />
                                        <path d="M30,5 L33,10 L30,15 L27,10 Z" />
                                    </svg>
                                </div>
                                <div class="h-[1px] w-12 md:w-24 bg-accent-400"></div>
                            </div>

                            <!-- Checklist -->
                            <div class="max-w-lg mx-auto text-left space-y-8">
                                <?php
                                $targets = [
                                    ['text' => '副業で占いを始めてみたい', 'underline' => '占いを始めてみたい'],
                                    ['text' => '独学で占いを学んだけれどスキルが不安', 'underline' => 'スキルが不安'],
                                    ['text' => '本格的にプロの占い師になりたい', 'underline' => 'プロの占い師になりたい'],
                                    ['text' => '人気の稼げる占い師になりたい', 'underline' => '人気の稼げる占い師になりたい'],
                                ];
                                foreach ($targets as $i => $item) : 
                                    $parts = explode($item['underline'], $item['text']);
                                ?>
                                    <div class="animate-on-scroll delay-<?php echo ($i * 100); ?> flex items-start gap-4 group">
                                        <div class="mt-1 flex-shrink-0 border border-accent-400 p-0.5 rounded-sm">
                                            <i data-lucide="check" class="w-[18px] h-[18px] text-accent-600" stroke-width="3"></i>
                                        </div>
                                        <p class="text-lg md:text-2xl font-mincho font-medium text-mystic-600 leading-snug">
                                            <?php echo $parts[0]; ?>
                                            <span class="relative inline-block">
                                                <?php echo $item['underline']; ?>
                                                <span class="absolute bottom-0 left-0 w-full h-[2px] bg-accent-400/60"></span>
                                            </span>
                                            <?php if(isset($parts[1])) echo $parts[1]; ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Caption -->
                    <p class="animate-on-scroll delay-500 mt-12 text-center text-gray-400 font-mincho text-sm tracking-widest italic">
                        ICA 池袋キャリアアカデミーは、あなたの「なりたい」を全力でサポートします。
                    </p>
                </div>
            </section>

            <!-- 4. Earnings (占い師になってどのくらい稼げるの？) -->
            <section id="earnings" class="py-32 bg-mystic-900 relative">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-20 relative z-10 animate-on-scroll">
                        <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Real Earnings —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">占い師になってどのくらい稼げるの？</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Grid -->
                    <div class="grid grid-cols-2 gap-4 md:gap-8 mb-16">
                        <?php
                        $earningData = [
                            ['name' => 'M.Sさん', 'income' => '70', 'days' => '5', 'gender' => 'female'],
                            ['name' => 'K.Fさん', 'income' => '55', 'days' => '4', 'gender' => 'male'],
                            ['name' => 'Y.Yさん', 'income' => '25', 'days' => '2', 'gender' => 'female'],
                            ['name' => 'H.Tさん', 'income' => '10', 'days' => '1', 'gender' => 'female'],
                        ];
                        foreach ($earningData as $i => $data) : ?>
                            <div class="animate-on-scroll delay-<?php echo ($i * 100); ?> bg-white border border-accent-200 overflow-hidden shadow-sm">
                                <!-- Top Section: Icon & Name -->
                                <div class="p-6 md:p-10 flex flex-col items-center justify-center relative min-h-[160px] md:min-h-[200px]">
                                    <div class="mb-4 text-accent-300">
                                        <?php if ($data['gender'] === 'female') : ?>
                                            <div class="relative">
                                                <i data-lucide="user" class="w-[64px] h-[64px] md:w-24 md:h-24 stroke-[1]"></i>
                                                <div class="absolute inset-0 bg-accent-100/20 rounded-full blur-xl"></div>
                                            </div>
                                        <?php else : ?>
                                            <div class="relative">
                                                <i data-lucide="user-round" class="w-[64px] h-[64px] md:w-24 md:h-24 stroke-[1]"></i>
                                                <div class="absolute inset-0 bg-accent-100/20 rounded-full blur-xl"></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-gray-500 font-serif text-xs md:text-sm tracking-widest absolute bottom-4 right-4">
                                        <?php echo $data['name']; ?>
                                    </div>
                                </div>

                                <!-- Bottom Section: Income Bar -->
                                <div class="bg-accent-600 py-3 md:py-5 px-2 text-center text-white">
                                    <div class="flex items-baseline justify-center gap-1">
                                        <span class="text-xs md:text-sm font-mincho opacity-90">月収</span>
                                        <span class="text-2xl md:text-4xl font-serif font-bold tracking-tighter leading-none"><?php echo $data['income']; ?></span>
                                        <span class="text-xs md:text-sm font-mincho">万円 / 週<?php echo $data['days']; ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Footer Text -->
                    <div class="animate-on-scroll delay-500 text-center space-y-2">
                        <p class="text-gray-500 font-mincho text-sm md:text-lg leading-relaxed">
                            アカデミーを卒業し、占い師になった方の<br class="md:hidden" />
                            <span class="text-accent-600 font-bold">実際に稼いだ金額</span>です。
                        </p>
                        <p class="text-gray-500 font-mincho text-sm md:text-lg leading-relaxed">
                            自分に合った働き方で、<br class="md:hidden" />
                            <span class="text-accent-600 font-bold">目標の収入</span>を得ることができています。
                        </p>
                    </div>
                </div>
            </section>

            <!-- 5. ICA 池袋キャリアアカデミーの特徴 (CourseStrengths) -->
            <section id="features" class="py-32 bg-white relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-20 relative z-10 animate-on-scroll">
                        <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Strengths —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-mincho text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">ICA 池袋キャリアアカデミーの特徴</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 border-t border-l border-accent-100">
                        <?php
                        $strengths = [
                            [
                                'title' => '門外不出のノウハウ',
                                'desc' => 'るみか先生が15年の鑑定経験から編み出した、的中率を極限まで高める独自ノウハウを提供します。',
                                'image' => get_template_directory_uri() . '/assets/images/feature1.webp',
                                'tag' => 'Original'
                            ],
                            [
                                'title' => '個別添削',
                                'desc' => '講師が丁寧に課題に対して個別で添削。あなたのリーディングの癖を見抜き、的確なアドバイスを行います。',
                                'image' => get_template_directory_uri() . '/assets/images/feature2.webp',
                                'tag' => 'Feedback'
                            ],
                            [
                                'title' => '実践実習',
                                'desc' => '実際の相談者を想定した模擬鑑定で即戦力を養います。リアルタイムでの対話力が身につきます。',
                                'image' => get_template_directory_uri() . '/assets/images/feature3.webp',
                                'tag' => 'Practice'
                            ],
                            [
                                'title' => '動画アーカイブ',
                                'desc' => '全講義は動画で録画。受講期間中はいつでも、どこでも、何度でも復習することが可能です。',
                                'image' => get_template_directory_uri() . '/assets/images/feature4.webp',
                                'tag' => 'Archive'
                            ],
                            [
                                'title' => 'コミュニティ',
                                'desc' => '受講生・卒業生限定のSNSへ招待。一生涯の仲間と悩み相談や情報交換が可能です。',
                                'image' => get_template_directory_uri() . '/assets/images/feature5.webp',
                                'tag' => 'Network'
                            ],
                            [
                                'title' => '開業サポート',
                                'desc' => 'お仕事の取り方、SNS運用、集客の仕方のような開業に必要なノウハウを習得可能です。',
                                'image' => get_template_directory_uri() . '/assets/images/feature6.webp?v=20260916',
                                'tag' => 'License'
                            ]
                        ];
                        foreach ($strengths as $i => $s) : ?>
                            <div class="animate-on-scroll delay-<?php echo ($i * 100); ?> group transition-all duration-500 bg-white border-r border-b border-accent-100 flex flex-col items-start relative overflow-hidden">
                                <!-- Image Header -->
                                <div class="w-full aspect-[16/10] overflow-hidden bg-mystic-900">
                                    <img 
                                        src="<?php echo $s['image']; ?>" 
                                        alt="<?php echo $s['title']; ?>"
                                        class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 scale-100 group-hover:scale-110 transition-all duration-1000 ease-out"
                                    />
                                </div>

                                <!-- Content Area -->
                                <div class="p-8 md:p-10 flex flex-col flex-1">
                                    <!-- Tag -->
                                    <div class="mb-4">
                                        <span class="text-[10px] font-serif tracking-[0.2em] text-accent-500 font-bold uppercase border-b border-accent-200 pb-1">
                                            <?php echo $s['tag']; ?>
                                        </span>
                                    </div>

                                    <h3 class="text-xl font-serif font-bold text-mystic-600 mb-4 tracking-wide group-hover:text-accent-600 transition-colors">
                                        <?php echo $s['title']; ?>
                                    </h3>
                                    
                                    <p class="text-gray-500 font-mincho text-sm leading-loose group-hover:text-gray-700 transition-colors">
                                        <?php echo $s['desc']; ?>
                                    </p>

                                    <div class="mt-8 overflow-hidden h-px w-0 group-hover:w-16 bg-accent-400 transition-all duration-500"></div>
                                </div>
                                
                                <!-- Subtle hover overlay for the whole card -->
                                <div class="absolute inset-0 bg-accent-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- 6. Courses（講座カリキュラム：コースは1つ） -->
            <section id="courses" class="py-32 bg-mystic-900 relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-20 relative z-10 animate-on-scroll">
                        <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Courses —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">コース紹介</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-6xl mx-auto animate-on-scroll bg-white border border-accent-100 rounded-lg overflow-hidden shadow-sm">
                        <!-- コース画像 -->
                        <div class="h-48 md:h-64 overflow-hidden relative">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/course1.webp" alt="講座カリキュラム" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-mystic-600/30 to-transparent"></div>
                        </div>

                        <!-- 講座名・回数・料金 -->
                        <div class="px-6 md:px-12 pt-10 pb-8 text-center border-b border-accent-100">
                            <h3 class="text-2xl md:text-3xl font-serif font-bold text-mystic-600 tracking-wide mb-4">講座カリキュラム</h3>
                            <p class="text-lg md:text-2xl font-serif font-bold text-mystic-600 tracking-wider">
                                全8回24時間<span class="mx-2 text-accent-400 font-normal">／</span><span class="text-accent-600">478,000円-</span>
                            </p>
                        </div>

                        <!-- カリキュラム（3ブロック） -->
                        <div class="p-6 md:p-12 grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                            <div class="animate-on-scroll  flex flex-col bg-mystic-950 border border-accent-100 rounded-lg overflow-hidden">
                                <div class="flex items-center gap-3 bg-mystic-800 px-5 py-4">
                                    <span class="inline-block px-3 py-1 rounded bg-accent-400 text-white text-sm font-serif font-bold tracking-wider whitespace-nowrap">1〜3回</span>
                                    <h4 class="text-base md:text-lg font-mincho font-bold text-mystic-600">基礎リーディングを学ぶ</h4>
                                </div>
                                <ul class="p-5 md:p-6 space-y-3 text-sm md:text-[15px] text-gray-600 font-mincho leading-relaxed">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-400 flex-shrink-0"></span>
                                        <span>大アルカナ／小アルカナの基本</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-400 flex-shrink-0"></span>
                                        <span>絵柄を読み取る練習</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-400 flex-shrink-0"></span>
                                        <span>逆位置カードへの声のかけ方</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-400 flex-shrink-0"></span>
                                        <span><span class="curriculum-highlight">初心者がつまずきやすいポイント</span>の解説</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-400 flex-shrink-0"></span>
                                        <span>カードに対する直感力を育てるワーク</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="animate-on-scroll delay-100 flex flex-col bg-mystic-950 border border-accent-100 rounded-lg overflow-hidden">
                                <div class="flex items-center gap-3 bg-mystic-800 px-5 py-4">
                                    <span class="inline-block px-3 py-1 rounded bg-accent-500 text-white text-sm font-serif font-bold tracking-wider whitespace-nowrap">4〜5回</span>
                                    <h4 class="text-base md:text-lg font-mincho font-bold text-mystic-600">応用リーディングを学ぶ</h4>
                                </div>
                                <ul class="p-5 md:p-6 space-y-3 text-sm md:text-[15px] text-gray-600 font-mincho leading-relaxed">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-500 flex-shrink-0"></span>
                                        <span>3枚引き／ケルト十字／ヘキサグラムなど</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-500 flex-shrink-0"></span>
                                        <span><span class="curriculum-highlight">スクール独自のオリジナル技法</span></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-500 flex-shrink-0"></span>
                                        <span>ネガティブな結果の言い換え技術</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-500 flex-shrink-0"></span>
                                        <span>相談者との<span class="curriculum-highlight">距離感・メンタルケア</span></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-500 flex-shrink-0"></span>
                                        <span>実践を想定したロールプレイ鑑定</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="animate-on-scroll delay-200 flex flex-col bg-mystic-950 border border-accent-100 rounded-lg overflow-hidden">
                                <div class="flex items-center gap-3 bg-mystic-800 px-5 py-4">
                                    <span class="inline-block px-3 py-1 rounded bg-accent-600 text-white text-sm font-serif font-bold tracking-wider whitespace-nowrap">6〜8回</span>
                                    <h4 class="text-base md:text-lg font-mincho font-bold text-mystic-600">応用リーディングを学ぶ</h4>
                                </div>
                                <ul class="p-5 md:p-6 space-y-3 text-sm md:text-[15px] text-gray-600 font-mincho leading-relaxed">
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-600 flex-shrink-0"></span>
                                        <span>モデルを使った実践リーディング</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-600 flex-shrink-0"></span>
                                        <span><span class="curriculum-highlight">個別フィードバック</span></span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-600 flex-shrink-0"></span>
                                        <span>声のトーン／あいづち／間の取り方</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-600 flex-shrink-0"></span>
                                        <span>安心する空気・信頼関係の作り方</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-600 flex-shrink-0"></span>
                                        <span>深掘り質問の組み立て方</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-600 flex-shrink-0"></span>
                                        <span>鑑定結果を<span class="curriculum-highlight">言語化する</span>トレーニング</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-600 flex-shrink-0"></span>
                                        <span><span class="curriculum-highlight">価格設定・リピート獲得</span>の考え方</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="mt-[0.55em] w-2 h-2 rotate-45 bg-accent-600 flex-shrink-0"></span>
                                        <span><span class="curriculum-highlight">個人で稼ぐ占い師のマインドセット</span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="px-6 md:px-12 pb-10">
                            <a href="https://lin.ee/NmIGh0t" target="_blank" rel="noopener noreferrer" class="view-details-btn max-w-md mx-auto block text-center py-4 bg-mystic-900 hover:bg-accent-400 text-accent-600 hover:text-white text-xs font-serif font-bold tracking-[0.2em] transition-all duration-300 rounded border border-accent-200">
                                無料相談する
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 7. Instructors -->
            <section id="instructors" class="py-32 bg-white relative overflow-hidden">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-20 relative z-10 animate-on-scroll">
                         <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Instructor —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">講師</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>

                    <div class="animate-on-scroll flex flex-col md:flex-row gap-12 lg:gap-20 items-center md:items-start">
                        <div class="w-full md:w-5/12 relative">
                            <div class="relative aspect-[3/4] rounded-2xl overflow-hidden shadow-2xl">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rumika.webp" alt="るみか" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-accent-600/20 to-transparent"></div>
                            </div>
                        </div>

                        <div class="w-full md:w-7/12 flex flex-col justify-center">
                            <div class="mb-8 border-b border-accent-100 pb-6">
                                <h3 class="text-4xl lg:text-5xl font-serif font-bold text-mystic-600 mb-3 tracking-wide">るみか先生</h3>
                                <p class="text-accent-600 text-sm lg:text-base tracking-[0.2em] uppercase font-mincho font-bold">ICA 池袋キャリアアカデミー 講師 / 占い師</p>
                            </div>

                            <div class="space-y-8">
                                <div>
                                    <h4 class="text-lg font-serif font-bold text-mystic-600 mb-4 flex items-center gap-3">
                                        <span class="w-8 h-[1px] bg-accent-400"></span>
                                        メッセージ
                                    </h4>
                                    <div class="text-gray-600 font-mincho leading-loose text-justify space-y-4">
                                        <p>ご覧頂きありがとうございます。タロット講座の講師を努めさせて頂きまするみかです。</p>
                                        <p>タロットカードはただ意味を暗記するものではなく、引いたカードから「今、その人に必要なメッセージ」を読み取るためのとても奥深いツールです。私自身、霊感霊視を中心とした鑑定を行なっていますが、その中でタロットカードは霊視で受け取った感覚やメッセージを「目にみえる形」「言葉にしやすい形」にしてくれる大切な存在です。</p>
                                        <p>この講座では、カード1枚1枚の基本的な意味、スプレッドの使い方、占いとしての読み方だけでなく、カードをどう感じ、どう受け取るか、相談者にどう伝えるか、といった実践的で感覚的な部分も大切にお伝えします。</p>
                                        <p>霊感がないとできない、特別な人だけの講座ではありません。霊感は誰の中にも眠っている感覚であり、タロットカードはその感覚を安全に確実に目覚めさせてくれます。</p>
                                        <p>タロットカードと向き合い、経験を重ねていくことで誰でも少しずつ「自分なりの読み方」「直感でカードを受け取る感覚」を育てていくことができます。</p>
                                        <p>タロットに興味がある、自分や身近な人を占えるようになりたい、将来占いを仕事にしたい、感覚的にカードを読む力を身につけたい、そんな方に向けた丁寧に学べるタロットカード講座です。</p>
                                        <p>タロットカードを通して、新しい扉を開くお手伝いができれば幸いです。</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                    <div>
                                        <h4 class="text-lg font-serif font-bold text-mystic-600 mb-4 flex items-center gap-3">
                                            <span class="w-8 h-[1px] bg-accent-400"></span>
                                            使用占術
                                        </h4>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">タロット</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">ルノルマンカード</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">九星気学</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">西洋占星術</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">写真鑑定</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">守護霊チャネリング</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">スピリチュアルリーディングを組み合わせた綜合鑑定</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">恋愛</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">人間関係</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">仕事</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">人生相談</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">経営相談</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">霊的相談</span>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="text-lg font-serif font-bold text-mystic-600 mb-4 flex items-center gap-3">
                                            <span class="w-8 h-[1px] bg-accent-400"></span>
                                            実績
                                        </h4>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>鑑定歴15年。</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>累計鑑定人数3万人以上</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>臼井式レイキヒーリング(サードディグリー修了)</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>クンダリーニ覚醒修了</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>ライトランゲージ伝授資格保有</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>心理学を継続的に学び鑑定に活用</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>アロマハンドFAB講師資格保有(手に施す封印解除)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 8. Testimonials -->
            <section id="testimonials" class="py-24 bg-mystic-900 relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-20 relative z-10 animate-on-scroll">
                        <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Testimonials —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">受講生の声</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="animate-on-scroll bg-white p-10 rounded-3xl border border-accent-100 relative shadow-sm hover:shadow-xl transition-all duration-500">
                            <div class="absolute top-6 left-6 text-accent-400 opacity-20">
                                <i data-lucide="quote" class="w-10 h-10 fill-current"></i>
                            </div>
                            <p class="text-gray-600 italic leading-relaxed mb-8 relative z-10 min-h-[100px] font-mincho">
                                会社員を続けながら、本当にプロになれるか不安でした。でも、ここでは単なる知識だけでなく『相談者の心にどう届けるか』を徹底的に学べます。今では週末の副業だけで心に余裕が持てる収入を得られ、毎日が本当に楽しいです！
                            </p>
                            <div class="flex items-center pt-6 border-t border-gray-50">
                                <div class="w-14 h-14 rounded-full bg-accent-200 border-2 border-accent-100 mr-4 shadow-sm flex items-center justify-center flex-shrink-0">
                                    <svg class="w-8 h-8 text-accent-600" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M6 21c0-3.314 2.686-6 6-6s6 2.686 6 6" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-mystic-600 font-bold font-serif">佐藤</h4>
                                    <p class="text-accent-600 text-xs font-bold">28歳 / OL</p>
                                </div>
                            </div>
                        </div>

                        <div class="animate-on-scroll delay-100 bg-white p-10 rounded-3xl border border-accent-100 relative shadow-sm hover:shadow-xl transition-all duration-500">
                            <div class="absolute top-6 left-6 text-accent-400 opacity-20">
                                <i data-lucide="quote" class="w-10 h-10 fill-current"></i>
                            </div>
                            <p class="text-gray-600 italic leading-relaxed mb-8 relative z-10 min-h-[100px] font-mincho">
                                占いは『特別な才能』が必要だと思っていましたが、ICA 池袋キャリアアカデミーの講義は驚くほど体系的で納得感がありました。営業職で培った対話力と占術が結びつき、デビュー後すぐにリピーター様に恵まれたのは大きな自信になりました。
                            </p>
                            <div class="flex items-center pt-6 border-t border-gray-50">
                                <div class="w-14 h-14 rounded-full bg-accent-200 border-2 border-accent-100 mr-4 shadow-sm flex items-center justify-center flex-shrink-0">
                                    <svg class="w-8 h-8 text-accent-600" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M6 21c0-3.314 2.686-6 6-6s6 2.686 6 6" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-mystic-600 font-bold font-serif">田中</h4>
                                    <p class="text-accent-600 text-xs font-bold">42歳 / 元営業職</p>
                                </div>
                            </div>
                        </div>

                        <div class="animate-on-scroll delay-200 bg-white p-10 rounded-3xl border border-accent-100 relative shadow-sm hover:shadow-xl transition-all duration-500">
                            <div class="absolute top-6 left-6 text-accent-400 opacity-20">
                                <i data-lucide="quote" class="w-10 h-10 fill-current"></i>
                            </div>
                            <p class="text-gray-600 italic leading-relaxed mb-8 relative z-10 min-h-[100px] font-mincho">
                                育児の合間に受講しました。技術はもちろん、SNSでの集客や自分自身の整え方まで教えていただけたおかげで、占い師デビューすることができました。相談者様から『救われました』と言っていただける、今の仕事が誇りです。
                            </p>
                            <div class="flex items-center pt-6 border-t border-gray-50">
                                <div class="w-14 h-14 rounded-full bg-accent-200 border-2 border-accent-100 mr-4 shadow-sm flex items-center justify-center flex-shrink-0">
                                    <svg class="w-8 h-8 text-accent-600" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M6 21c0-3.314 2.686-6 6-6s6 2.686 6 6" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-mystic-600 font-bold font-serif">伊藤</h4>
                                    <p class="text-accent-600 text-xs font-bold">35歳 / 主婦</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 9. Flow -->
            <section id="flow" class="py-24 bg-white">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                     <div class="text-center mb-20 relative z-10 animate-on-scroll">
                        <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Flow —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">受講の流れ</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-px bg-accent-200 transform -translate-x-1/2"></div>
                        
                        <div class="space-y-16">
                            <!-- Step 1 -->
                            <div class="animate-on-scroll flex flex-col md:flex-row items-center justify-between gap-8 md:flex-row-reverse">
                                <div class="w-full md:w-5/12 text-center md:text-left">
                                    <div class="flex flex-col md:items-end md:text-right">
                                        <h3 class="text-xl font-serif font-bold text-mystic-600 mb-3 flex items-center gap-3">
                                            <span class="md:hidden inline-block px-3 py-1 bg-accent-400 text-white text-xs font-bold rounded-full">01</span>
                                            公式LINEにて無料カウンセリング
                                        </h3>
                                        <p class="text-gray-500 text-sm leading-relaxed font-mincho">
                                            専門スタッフがあなたの適性や目標をヒアリングし、最適なコースをご提案します。
                                        </p>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-shrink-0 w-12 h-12 rounded-full bg-white border-2 border-accent-400 flex items-center justify-center shadow-lg">
                                    <span class="hidden md:block text-sm font-serif font-bold text-accent-600">01</span>
                                    <i data-lucide="chevron-down" class="md:hidden w-6 h-6 text-accent-600"></i>
                                </div>
                                <div class="hidden md:block w-5/12"></div>
                            </div>

                            <!-- Step 2 -->
                            <div class="animate-on-scroll flex flex-col md:flex-row items-center justify-between gap-8">
                                <div class="w-full md:w-5/12 text-center md:text-left">
                                    <div class="flex flex-col md:items-start">
                                        <h3 class="text-xl font-serif font-bold text-mystic-600 mb-3 flex items-center gap-3">
                                            <span class="md:hidden inline-block px-3 py-1 bg-accent-400 text-white text-xs font-bold rounded-full">02</span>
                                            コースお申し込み
                                        </h3>
                                        <p class="text-gray-500 text-sm leading-relaxed font-mincho">
                                            内容にご納得いただけましたら、お手続きへ。受講料のお支払い方法も柔軟に対応します。
                                        </p>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-shrink-0 w-12 h-12 rounded-full bg-white border-2 border-accent-400 flex items-center justify-center shadow-lg">
                                    <span class="hidden md:block text-sm font-serif font-bold text-accent-600">02</span>
                                    <i data-lucide="chevron-down" class="md:hidden w-6 h-6 text-accent-600"></i>
                                </div>
                                <div class="hidden md:block w-5/12"></div>
                            </div>

                             <!-- Step 3 -->
                             <div class="animate-on-scroll flex flex-col md:flex-row items-center justify-between gap-8 md:flex-row-reverse">
                                <div class="w-full md:w-5/12 text-center md:text-left">
                                    <div class="flex flex-col md:items-end md:text-right">
                                        <h3 class="text-xl font-serif font-bold text-mystic-600 mb-3 flex items-center gap-3">
                                            <span class="md:hidden inline-block px-3 py-1 bg-accent-400 text-white text-xs font-bold rounded-full">03</span>
                                            受講開始
                                        </h3>
                                        <p class="text-gray-500 text-sm leading-relaxed font-mincho">
                                            テキストと動画教材で基礎学習をスタート。オンラインシステムへのアクセス権を発行します。
                                        </p>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-shrink-0 w-12 h-12 rounded-full bg-white border-2 border-accent-400 flex items-center justify-center shadow-lg">
                                    <span class="hidden md:block text-sm font-serif font-bold text-accent-600">03</span>
                                    <i data-lucide="chevron-down" class="md:hidden w-6 h-6 text-accent-600"></i>
                                </div>
                                <div class="hidden md:block w-5/12"></div>
                            </div>

                            <!-- Step 4 -->
                            <div class="animate-on-scroll flex flex-col md:flex-row items-center justify-between gap-8">
                                <div class="w-full md:w-5/12 text-center md:text-left">
                                    <div class="flex flex-col md:items-start">
                                        <h3 class="text-xl font-serif font-bold text-mystic-600 mb-3 flex items-center gap-3">
                                            <span class="md:hidden inline-block px-3 py-1 bg-accent-400 text-white text-xs font-bold rounded-full">04</span>
                                            実践トレーニング
                                        </h3>
                                        <p class="text-gray-500 text-sm leading-relaxed font-mincho">
                                            講師とのマンツーマン指導やグループワークで、知識を「使える技術」へと昇華させます。
                                        </p>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-shrink-0 w-12 h-12 rounded-full bg-white border-2 border-accent-400 flex items-center justify-center shadow-lg">
                                    <span class="hidden md:block text-sm font-serif font-bold text-accent-600">04</span>
                                    <i data-lucide="chevron-down" class="md:hidden w-6 h-6 text-accent-600"></i>
                                </div>
                                <div class="hidden md:block w-5/12"></div>
                            </div>

                             <!-- Step 5 -->
                             <div class="animate-on-scroll flex flex-col md:flex-row items-center justify-between gap-8 md:flex-row-reverse">
                                <div class="w-full md:w-5/12 text-center md:text-left">
                                    <div class="flex flex-col md:items-end md:text-right">
                                        <h3 class="text-xl font-serif font-bold text-mystic-600 mb-3 flex items-center gap-3">
                                            <span class="md:hidden inline-block px-3 py-1 bg-accent-400 text-white text-xs font-bold rounded-full">05</span>
                                            占い師デビュー
                                        </h3>
                                        <p class="text-gray-500 text-sm leading-relaxed font-mincho">
                                            占い師としての第一歩をキャリアサポートと共に踏み出します。
                                        </p>
                                    </div>
                                </div>
                                <div class="hidden md:flex relative z-10 flex-shrink-0 w-12 h-12 rounded-full bg-white border-2 border-accent-400 items-center justify-center shadow-lg">
                                    <span class="text-sm font-serif font-bold text-accent-600">05</span>
                                </div>
                                <div class="hidden md:block w-5/12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 10. Sister Academy (姉妹アカデミーはこちら) -->
            <section id="sister" class="py-24 bg-mystic-950 relative overflow-hidden">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-16 relative z-10 animate-on-scroll">
                        <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Sister Academy —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">姉妹アカデミーはこちら</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>

                    <!-- 姉妹校カード（カード全体がリンク） -->
                    <a href="https://nail-school-tokyo.com/" target="_blank" rel="noopener noreferrer" class="animate-on-scroll delay-200 group block bg-white border border-accent-100 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                        <div class="flex flex-col md:flex-row items-center gap-8 p-8 md:p-12">
                            
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-xl md:text-2xl font-mincho font-bold text-mystic-600 mb-3 group-hover:text-accent-600 transition-colors">ICA 池袋キャリアアカデミー</h3>
                                <p class="text-gray-500 text-sm md:text-base leading-relaxed font-mincho">
                                    プロのネイリストを目指す方のための、東京・池袋の姉妹アカデミーです。<br class="hidden md:block" />
                                    ネイルにご興味のある方は、姉妹校の公式サイトもぜひご覧ください。
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center gap-2 bg-accent-500/10 border border-accent-400 group-hover:bg-accent-400 group-hover:text-white text-accent-600 px-6 py-3 rounded-sm text-sm font-serif tracking-wider transition-all duration-300 whitespace-nowrap">
                                    サイトを見る
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <!-- 11. FAQ -->
            <section id="faq" class="py-24 bg-mystic-900">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                     <div class="text-center mb-20 relative z-10 animate-on-scroll">
                        <div class="flex flex-col items-center">
                            <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Q & A —</span>
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-mystic-600 tracking-wide leading-relaxed drop-shadow-sm">よくある質問</h2>
                            <div class="mt-6 flex items-center justify-center gap-4">
                                <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                                <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                                <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <?php
                        // Q&A投稿（管理画面のQ&Aメニューで登録・更新・削除。並び順は「順序」昇順）
                        $faq_posts = get_posts(array(
                            'post_type'      => 'qa',
                            'posts_per_page' => -1,
                            'orderby'        => array('menu_order' => 'ASC', 'date' => 'ASC'),
                        ));
                        $faqs = [];
                        foreach ($faq_posts as $faq_post) {
                            $faqs[] = [
                                'q' => esc_html($faq_post->post_title),
                                'a' => wpautop($faq_post->post_content),
                            ];
                        }
                        foreach ($faqs as $i => $faq) : ?>
                            <div class="animate-on-scroll border border-accent-100 rounded-2xl overflow-hidden bg-white shadow-sm">
                                <button class="faq-button w-full px-8 py-6 flex items-center justify-between text-left focus:outline-none hover:bg-mystic-950 transition-colors">
                                    <span class="text-base font-bold text-mystic-600">
                                        <?php echo $faq['q']; ?>
                                    </span>
                                    <span class="ml-4 flex-shrink-0 text-accent-400">
                                        <i data-lucide="plus" class="faq-icon w-5 h-5"></i>
                                    </span>
                                </button>
                                <div class="accordion-content">
                                    <div class="px-8 pb-8 text-gray-500 text-sm leading-relaxed font-mincho border-t border-gray-50 pt-6">
                                        <?php echo $faq['a']; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </main>

        <!-- ContactFooter -->
        <footer id="contact" class="bg-white border-t border-accent-100 pt-20 pb-10 relative overflow-hidden">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16 border-b border-accent-100 pb-12">
                    <div class="lg:col-span-2">
                        <h3 class="text-2xl font-mincho font-bold text-mystic-600 mb-6 flex items-center gap-2">
                            <span class="text-accent-400"></span> ICA 池袋キャリアアカデミー
                        </h3>
                        <p class="text-gray-500 mb-8 leading-relaxed max-w-md font-mincho text-sm">
                            あなたの持つ潜在的な能力を開花させ、新しい未来を切り拓くお手伝いをさせていただきます。
                            星々が示す道筋を、共に歩みましょう。
                        </p>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="space-y-5">
                            <div class="flex items-start group">
                                <i data-lucide="map-pin" class="w-5 h-5 text-accent-500 mt-1 mr-4 flex-shrink-0"></i>
                                <span class="text-gray-500 font-mincho text-sm leading-relaxed">〒150-0001<br />東京都渋谷区神宮前1-2-3 スターライトビル 5F</span>
                            </div>
                            <div class="flex items-center group">
                                <i data-lucide="phone" class="w-5 h-5 text-accent-500 mr-4 flex-shrink-0"></i>
                                <span class="text-gray-500 font-serif tracking-wider text-sm font-bold">03-1234-5678</span>
                                <span class="ml-2 text-xs text-gray-400">(平日 10:00 - 18:00)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-gray-400 text-xs font-mincho tracking-widest">
                        &copy; <?php echo date('Y'); ?> ICA 池袋キャリアアカデミー. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Mobile Sticky CTA Button -->
        <div class="fixed bottom-0 left-0 w-full z-50 md:hidden p-4 bg-gradient-to-t from-mystic-950 via-mystic-950/90 to-transparent">
            <a href="https://lin.ee/NmIGh0t" target="_blank" rel="noopener noreferrer" class="counseling-btn block w-full py-4 bg-gradient-to-r from-accent-600 via-accent-400 to-accent-600 text-mystic-950 text-center font-serif font-bold tracking-widest rounded shadow-[0_0_20px_rgba(199,176,205,0.4)] hover:shadow-[0_0_30px_rgba(199,176,205,0.6)] transition-all duration-300">
                公式LINEで無料相談する
            </a>
        </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
