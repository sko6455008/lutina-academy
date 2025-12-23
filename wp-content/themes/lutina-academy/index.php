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
    <title>Lutina Academy | ルティナ占いアカデミーa</title>
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
              'hero-light': "linear-gradient(to bottom, rgba(250, 247, 252, 0.4), rgba(250, 247, 252, 1)), url('https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=2940&auto=format&fit=crop')",
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
        <nav class="fixed w-full z-50 transition-all duration-500 bg-transparent py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="logo-area flex-shrink-0 flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <div class="absolute inset-0 bg-accent-400 blur-md opacity-20 group-hover:opacity-40 transition-opacity duration-300"></div>
                            <i data-lucide="moon" class="relative w-6 h-6 text-accent-500 fill-accent-400/10"></i>
                        </div>
                        <span class="text-xl font-serif font-bold text-mystic-600 tracking-widest group-hover:text-accent-600 transition-colors">
                            Lutina Academy
                        </span>
                    </div>
                    
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-center space-x-8">
                            <a href="#features" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                特徴<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#courses" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                コース紹介<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#instructors" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                講師紹介<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#flow" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                受講の流れ<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <a href="#faq" class="text-gray-500 hover:text-accent-600 text-sm font-mincho font-medium transition-colors duration-300 tracking-wider relative group">
                                よくある質問<span class="absolute -bottom-1 left-0 w-0 h-[1.5px] bg-accent-400 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            
                            <a href="#" class="counseling-btn bg-accent-500/10 border border-accent-400 hover:bg-accent-400 hover:text-white text-accent-600 px-6 py-2 rounded-sm text-sm font-serif transition-all duration-300 tracking-wider shadow-sm">
                                COUNSELING
                            </a>
                        </div>
                    </div>

                    <div class="-mr-2 flex md:hidden">
                        <button id="mobile-menu-button" aria-expanded="false" class="inline-flex items-center justify-center p-2 text-accent-600 hover:text-accent-400 focus:outline-none">
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden transition-all duration-300 ease-in-out overflow-hidden max-h-0 opacity-0 bg-white border-b border-accent-100">
                <div class="px-4 pt-4 pb-6 space-y-2">
                    <a href="#features" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">特徴</a>
                    <a href="#courses" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">コース紹介</a>
                    <a href="#instructors" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">講師紹介</a>
                    <a href="#flow" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">受講の流れ</a>
                    <a href="#faq" class="text-gray-600 hover:text-accent-600 block px-3 py-3 rounded-md text-base font-mincho font-medium border-b border-gray-50">よくある質問</a>
                    
                    <a href="#" class="counseling-btn text-white bg-accent-400 hover:bg-accent-500 block px-3 py-3 rounded-md text-base font-serif text-center mt-6 font-bold shadow-md">
                        FREE COUNSELING
                    </a>
                </div>
            </div>
        </nav>

        <main>
            <!-- Hero -->
            <section class="relative h-screen flex items-center justify-center overflow-hidden bg-mystic-950">
                <div class="absolute inset-0 z-0">
                    <div class="absolute inset-0 bg-gradient-to-b from-white/10 via-mystic-950/80 to-mystic-950 z-10"></div>
                    <div class="w-full h-full transform scale-100 transition-transform duration-[15000ms] ease-linear">
                        <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=2940&auto=format&fit=crop" alt="Bright Mystic Background" class="w-full h-full object-cover opacity-30">
                    </div>
                </div>

                <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div class="animate-on-scroll">
                        <div class="flex justify-center mb-8">
                            <div class="h-[1px] w-16 bg-accent-400/30 self-center"></div>
                            <div class="px-4 text-accent-600 font-serif tracking-[0.3em] text-xs md:text-sm uppercase font-bold">
                                Professional Fortune Telling School
                            </div>
                            <div class="h-[1px] w-16 bg-accent-400/30 self-center"></div>
                        </div>

                        <h1 class="font-serif font-medium text-mystic-600 mb-8 leading-tight">
                            <span class="block text-xl md:text-2xl lg:text-3xl mb-4 text-gray-500 font-mincho tracking-[0.2em]">
                                星々が導く、真理への扉
                            </span>
                            <span class="block text-5xl md:text-7xl lg:text-8xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-accent-600 via-accent-400 to-accent-600 pb-2 drop-shadow-sm">
                                Lutina Academy
                            </span>
                        </h1>

                        <p class="mt-8 max-w-2xl mx-auto text-base md:text-lg text-gray-600 leading-loose font-mincho tracking-wide border-t border-b border-accent-200 py-8">
                            プロの占い師から直接学ぶ、本物の叡智。<br />
                            あなたの眠れる才能を呼び覚まし、<br class="md:hidden" />
                            光輝く未来への道標を。
                        </p>

                        <div class="mt-12 flex flex-col sm:flex-row gap-6 justify-center items-center">
                            <a href="#" class="counseling-btn group relative w-full sm:w-64 px-8 py-5 bg-accent-400 text-white shadow-lg shadow-accent-400/20 hover:shadow-accent-400/40 transition-all duration-300 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></div>
                                <span class="relative z-10 font-serif tracking-widest font-bold">無料カウンセリング</span>
                            </a>
                            
                            <a href="#courses" class="group w-full sm:w-64 px-8 py-5 text-gray-500 hover:text-accent-600 transition-colors duration-300 flex justify-center items-center gap-2 border border-accent-200 bg-white/50">
                                <span class="font-serif tracking-widest text-sm font-bold">コース一覧を見る</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features -->
            <section id="features" class="py-32 bg-white relative">
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
                                <img src="https://images.unsplash.com/photo-1515942400420-2b98fed1f515?q=80&w=800&auto=format&fit=crop" alt="未経験からプロへ" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
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
                                <img src="https://images.unsplash.com/photo-1564591746687-3c5b4b1f4a9b?q=80&w=800&auto=format&fit=crop" alt="実践的カリキュラム" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
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
                                <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=800&auto=format&fit=crop" alt="充実の開業サポート" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
                            </div>
                            <div class="p-8 relative">
                                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-1 bg-accent-400"></div>
                                <h3 class="text-xl font-serif font-bold text-mystic-600 mb-4 text-center group-hover:text-accent-600 transition-colors tracking-wide">充実の開業サポート</h3>
                                <p class="text-gray-500 leading-relaxed font-mincho text-sm text-center group-hover:text-gray-700 transition-colors">
                                    卒業後は提携サロンへの紹介や、独立開業のためのマーケティング、集客ノウハウまで徹底的にサポートします。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Courses -->
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

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        <!-- Tarot -->
                        <div class="animate-on-scroll flex flex-col h-full bg-white border border-accent-100 rounded-lg overflow-hidden transition-all duration-500 group shadow-sm hover:shadow-2xl relative">
                            <div class="h-64 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1620023428136-19343ee00508?q=80&w=800&auto=format&fit=crop" alt="タロットプロフェッショナル講座" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000">
                            </div>
                            <div class="p-8 flex-1 flex flex-col relative bg-white">
                                <h3 class="text-2xl font-serif font-bold text-mystic-600 mb-4 group-hover:text-accent-600 transition-colors">タロットプロフェッショナル講座</h3>
                                <p class="text-gray-500 text-sm font-mincho leading-loose mb-8 flex-grow">
                                    78枚のカードが織りなす神秘の物語を読み解き、深層心理にアクセスする技術を習得します。
                                </p>
                                <div class="space-y-4 mb-8 border-t border-accent-100 pt-6">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400 font-serif font-bold tracking-wider">DURATION</span>
                                        <span class="text-mystic-600 font-mincho font-bold">6ヶ月（全24回）</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400 font-serif font-bold tracking-wider">PRICE</span>
                                        <span class="text-xl text-accent-600 font-serif font-bold">¥380,000</span>
                                    </div>
                                </div>
                                <a href="#" class="view-details-btn w-full block text-center py-4 bg-mystic-900 hover:bg-accent-400 text-accent-600 hover:text-white text-xs font-serif font-bold tracking-[0.2em] transition-all duration-300 rounded border border-accent-200">
                                    VIEW DETAILS
                                </a>
                            </div>
                        </div>

                        <!-- Astrology -->
                        <div class="animate-on-scroll delay-100 flex flex-col h-full bg-white border border-accent-100 rounded-lg overflow-hidden transition-all duration-500 group shadow-sm hover:shadow-2xl relative">
                            <div class="h-64 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1532968961962-8a0cb3a2d4f5?q=80&w=800&auto=format&fit=crop" alt="西洋占星術マスターコース" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000">
                            </div>
                            <div class="p-8 flex-1 flex flex-col relative bg-white">
                                <h3 class="text-2xl font-serif font-bold text-mystic-600 mb-4 group-hover:text-accent-600 transition-colors">西洋占星術マスターコース</h3>
                                <p class="text-gray-500 text-sm font-mincho leading-loose mb-8 flex-grow">
                                    星々の配置から運命を読み解く、論理的かつ神秘的な占星術の奥義を学びます。
                                </p>
                                <div class="space-y-4 mb-8 border-t border-accent-100 pt-6">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400 font-serif font-bold tracking-wider">DURATION</span>
                                        <span class="text-mystic-600 font-mincho font-bold">12ヶ月（全48回）</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400 font-serif font-bold tracking-wider">PRICE</span>
                                        <span class="text-xl text-accent-600 font-serif font-bold">¥550,000</span>
                                    </div>
                                </div>
                                <a href="#" class="view-details-btn w-full block text-center py-4 bg-mystic-900 hover:bg-accent-400 text-accent-600 hover:text-white text-xs font-serif font-bold tracking-[0.2em] transition-all duration-300 rounded border border-accent-200">
                                    VIEW DETAILS
                                </a>
                            </div>
                        </div>

                        <!-- Palmistry -->
                        <div class="animate-on-scroll delay-200 flex flex-col h-full bg-white border border-accent-100 rounded-lg overflow-hidden transition-all duration-500 group shadow-sm hover:shadow-2xl relative">
                            <div class="h-64 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1505540328704-5858fb3862bb?q=80&w=800&auto=format&fit=crop" alt="手相・人相・観相学統合コース" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000">
                            </div>
                            <div class="p-8 flex-1 flex flex-col relative bg-white">
                                <h3 class="text-2xl font-serif font-bold text-mystic-600 mb-4 group-hover:text-accent-600 transition-colors">手相・人相・観相学統合コース</h3>
                                <p class="text-gray-500 text-sm font-mincho leading-loose mb-8 flex-grow">
                                    掌や顔に刻まれた人生の地図を読み解き、開運へと導く実践的な技術を伝授します。
                                </p>
                                <div class="space-y-4 mb-8 border-t border-accent-100 pt-6">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400 font-serif font-bold tracking-wider">DURATION</span>
                                        <span class="text-mystic-600 font-mincho font-bold">4ヶ月（全16回）</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400 font-serif font-bold tracking-wider">PRICE</span>
                                        <span class="text-xl text-accent-600 font-serif font-bold">¥280,000</span>
                                    </div>
                                </div>
                                <a href="#" class="view-details-btn w-full block text-center py-4 bg-mystic-900 hover:bg-accent-400 text-accent-600 hover:text-white text-xs font-serif font-bold tracking-[0.2em] transition-all duration-300 rounded border border-accent-200">
                                    VIEW DETAILS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Instructors -->
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
                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=1200&auto=format&fit=crop" alt="月読 セレナ" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-accent-600/20 to-transparent"></div>
                            </div>
                        </div>

                        <div class="w-full md:w-7/12 flex flex-col justify-center">
                            <div class="mb-8 border-b border-accent-100 pb-6">
                                <h3 class="text-4xl lg:text-5xl font-serif font-bold text-mystic-600 mb-3 tracking-wide">月読 セレナ</h3>
                                <p class="text-accent-600 text-sm lg:text-base tracking-[0.2em] uppercase font-serif font-bold">Lutina Academy 代表 / 占星術師</p>
                            </div>

                            <div class="space-y-8">
                                <div>
                                    <h4 class="text-lg font-serif font-bold text-mystic-600 mb-4 flex items-center gap-3">
                                        <span class="w-8 h-[1px] bg-accent-400"></span>
                                        Biography
                                    </h4>
                                    <p class="text-gray-600 font-mincho leading-loose whitespace-pre-wrap text-justify">鑑定歴25年。幼少期より星を読む力を持ち、渡英して英国占星術協会にて正式な資格を取得。帰国後、政財界の重鎮や著名人を顧客に持ち、その的中率は「神の目」と称される。

現在は後進の育成に注力し、心理学と伝統的な占術を融合させた独自のメソッド「ルティナ式占術」を確立。論理的かつ直感的な指導には定評があり、これまでに育てたプロ占い師は500名を超える。</p>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                    <div>
                                        <h4 class="text-lg font-serif font-bold text-mystic-600 mb-4 flex items-center gap-3">
                                            <span class="w-8 h-[1px] bg-accent-400"></span>
                                            Specialization
                                        </h4>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">西洋占星術</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">タロットリーディング</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">心理カウンセリング</span>
                                            <span class="px-3 py-1 bg-mystic-900 border border-accent-100 text-accent-600 text-xs tracking-wider font-bold">恒星占星術</span>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="text-lg font-serif font-bold text-mystic-600 mb-4 flex items-center gap-3">
                                            <span class="w-8 h-[1px] bg-accent-400"></span>
                                            Achievements
                                        </h4>
                                        <ul class="space-y-3">
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>英国占星術協会 正会員</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>著書「星が告げる未来」累計50万部突破</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>大手電話占いサイト 年間指名ランキング1位獲得（2018-2022）</span>
                                            </li>
                                            <li class="flex items-start gap-3 text-sm text-gray-500 font-mincho">
                                                <i data-lucide="award" class="w-4 h-4 text-accent-500 mt-1 flex-shrink-0"></i>
                                                <span>鑑定実績 3万人以上</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonials -->
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
                                趣味から始めましたが、今では副業として週末だけ鑑定を行っています。先生方のサポートが手厚く、自信を持ってデビューできました。
                            </p>
                            <div class="flex items-center pt-6 border-t border-gray-50">
                                <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?q=80&w=200&auto=format&fit=crop" alt="佐藤 ありさ" class="w-14 h-14 rounded-full object-cover border-2 border-accent-100 mr-4 shadow-sm">
                                <div>
                                    <h4 class="text-mystic-600 font-bold font-serif">佐藤 ありさ</h4>
                                    <p class="text-accent-600 text-xs font-bold">28歳 / OL</p>
                                </div>
                            </div>
                        </div>

                        <div class="animate-on-scroll delay-100 bg-white p-10 rounded-3xl border border-accent-100 relative shadow-sm hover:shadow-xl transition-all duration-500">
                            <div class="absolute top-6 left-6 text-accent-400 opacity-20">
                                <i data-lucide="quote" class="w-10 h-10 fill-current"></i>
                            </div>
                            <p class="text-gray-600 italic leading-relaxed mb-8 relative z-10 min-h-[100px] font-mincho">
                                営業の仕事に疲れ果てていた時に占いに出会い、人生が変わりました。論理的なカリキュラムのおかげで、男性の私でも理解しやすかったです。
                            </p>
                            <div class="flex items-center pt-6 border-t border-gray-50">
                                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=200&auto=format&fit=crop" alt="田中 健一" class="w-14 h-14 rounded-full object-cover border-2 border-accent-100 mr-4 shadow-sm">
                                <div>
                                    <h4 class="text-mystic-600 font-bold font-serif">田中 健一</h4>
                                    <p class="text-accent-600 text-xs font-bold">42歳 / 元営業職</p>
                                </div>
                            </div>
                        </div>

                        <div class="animate-on-scroll delay-200 bg-white p-10 rounded-3xl border border-accent-100 relative shadow-sm hover:shadow-xl transition-all duration-500">
                            <div class="absolute top-6 left-6 text-accent-400 opacity-20">
                                <i data-lucide="quote" class="w-10 h-10 fill-current"></i>
                            </div>
                            <p class="text-gray-600 italic leading-relaxed mb-8 relative z-10 min-h-[100px] font-mincho">
                                子育ての合間にオンラインで受講。自分のペースで学べるのが魅力でした。卒業後の集客サポートのおかげで、自宅サロンを開業できました。
                            </p>
                            <div class="flex items-center pt-6 border-t border-gray-50">
                                <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?q=80&w=200&auto=format&fit=crop" alt="高橋 美穂" class="w-14 h-14 rounded-full object-cover border-2 border-accent-100 mr-4 shadow-sm">
                                <div>
                                    <h4 class="text-mystic-600 font-bold font-serif">高橋 美穂</h4>
                                    <p class="text-accent-600 text-xs font-bold">35歳 / 主婦</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Flow -->
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
                                            無料カウンセリング
                                        </h3>
                                        <p class="text-gray-500 text-sm leading-relaxed font-mincho">
                                            まずは専門スタッフがあなたの適性や目標をヒアリングし、最適なコースをご提案します。
                                        </p>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-shrink-0 w-12 h-12 rounded-full bg-white border-2 border-accent-400 flex items-center justify-center shadow-lg">
                                    <span class="text-sm font-serif font-bold text-accent-600">01</span>
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
                                    <span class="text-sm font-serif font-bold text-accent-600">02</span>
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
                                    <span class="text-sm font-serif font-bold text-accent-600">03</span>
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
                                    <span class="text-sm font-serif font-bold text-accent-600">04</span>
                                </div>
                                <div class="hidden md:block w-5/12"></div>
                            </div>

                             <!-- Step 5 -->
                             <div class="animate-on-scroll flex flex-col md:flex-row items-center justify-between gap-8 md:flex-row-reverse">
                                <div class="w-full md:w-5/12 text-center md:text-left">
                                    <div class="flex flex-col md:items-end md:text-right">
                                        <h3 class="text-xl font-serif font-bold text-mystic-600 mb-3 flex items-center gap-3">
                                            <span class="md:hidden inline-block px-3 py-1 bg-accent-400 text-white text-xs font-bold rounded-full">05</span>
                                            プロデビュー認定
                                        </h3>
                                        <p class="text-gray-500 text-sm leading-relaxed font-mincho">
                                            卒業試験に合格後、認定証を発行。プロとしての第一歩をキャリアサポートと共に踏み出します。
                                        </p>
                                    </div>
                                </div>
                                <div class="relative z-10 flex-shrink-0 w-12 h-12 rounded-full bg-white border-2 border-accent-400 flex items-center justify-center shadow-lg">
                                    <span class="text-sm font-serif font-bold text-accent-600">05</span>
                                </div>
                                <div class="hidden md:block w-5/12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FAQ -->
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
                        $faqs = [
                            ['q' => '占いの経験が全くない初心者でも大丈夫ですか？', 'a' => 'はい、当アカデミーの受講生の約8割が完全未経験からのスタートです。基礎から丁寧に指導しますのでご安心ください。'],
                            ['q' => '働きながら受講することは可能ですか？', 'a' => 'もちろんです。オンライン講座は24時間視聴可能で、対面講座も土日や夜間に開催しています。ライフスタイルに合わせて学べます。'],
                            ['q' => '卒業後に仕事の紹介はありますか？', 'a' => 'はい、提携している電話占い会社や対面占い館への推薦制度があります。また、独立開業のためのマーケティング講座も実施しています。'],
                            ['q' => '受講料の分割払いは可能ですか？', 'a' => 'はい、最大24回までの分割払いに対応しております。クレジットカードや教育ローンのご利用も可能です。'],
                            ['q' => 'オンライン授業と対面授業の違いは何ですか？', 'a' => 'カリキュラム内容は同一です。対面は講師から直接手技を学べるメリットがあり、オンラインは場所を選ばず繰り返し復習できるメリットがあります。'],
                            ['q' => '年齢制限はありますか？', 'a' => 'いいえ、年齢制限はございません。20代から70代まで幅広い年齢層の方が学ばれています。'],
                            ['q' => '途中でコースを変更することはできますか？', 'a' => '受講開始から1ヶ月以内であれば、コースの変更や追加が可能です。事務局までご相談ください。'],
                            ['q' => '霊感がないと占い師にはなれませんか？', 'a' => 'いいえ。タロットや占星術は「命・卜・相」という学問に基づいた技術ですので、霊感は必要ありません。正しい知識と技術で誰でも習得可能です。']
                        ];
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
                        <h3 class="text-2xl font-serif font-bold text-mystic-600 mb-6 flex items-center gap-2">
                            <span class="text-accent-400">✦</span> Lutina Academy
                        </h3>
                        <p class="text-gray-500 mb-8 leading-relaxed max-w-md font-mincho text-sm">
                            あなたの持つ潜在的な能力を開花させ、新しい未来を切り拓くお手伝いをさせていただきます。
                            星々が示す道筋を、共に歩みましょう。
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="p-3 bg-mystic-900 rounded-full hover:bg-accent-400 hover:text-white text-accent-600 transition-all duration-300 shadow-sm"><i data-lucide="instagram" class="w-[18px] h-[18px]"></i></a>
                            <a href="#" class="p-3 bg-mystic-900 rounded-full hover:bg-accent-400 hover:text-white text-accent-600 transition-all duration-300 shadow-sm"><i data-lucide="twitter" class="w-[18px] h-[18px]"></i></a>
                            <a href="#" class="p-3 bg-mystic-900 rounded-full hover:bg-accent-400 hover:text-white text-accent-600 transition-all duration-300 shadow-sm"><i data-lucide="facebook" class="w-[18px] h-[18px]"></i></a>
                            <a href="#" class="p-3 bg-mystic-900 rounded-full hover:bg-accent-400 hover:text-white text-accent-600 transition-all duration-300 shadow-sm"><i data-lucide="youtube" class="w-[18px] h-[18px]"></i></a>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        <h4 class="text-sm font-bold text-mystic-600 uppercase tracking-wider mb-6 border-b-2 border-accent-400 inline-block pb-1">Information</h4>
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
                            <div class="flex items-center group">
                                <i data-lucide="mail" class="w-5 h-5 text-accent-500 mr-4 flex-shrink-0"></i>
                                <span class="text-gray-500 font-serif tracking-wider text-sm font-bold">info@lutina-academy.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-gray-400 text-xs font-serif tracking-widest">
                        &copy; <?php echo date('Y'); ?> Lutina Academy. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Mobile Sticky CTA Button -->
        <div class="fixed bottom-0 left-0 w-full z-50 md:hidden p-4 bg-gradient-to-t from-mystic-950 via-mystic-950/90 to-transparent">
            <a href="#" class="counseling-btn block w-full py-4 bg-gradient-to-r from-accent-600 via-accent-400 to-accent-600 text-mystic-950 text-center font-serif font-bold tracking-widest rounded shadow-[0_0_20px_rgba(199,176,205,0.4)] hover:shadow-[0_0_30px_rgba(199,176,205,0.6)] transition-all duration-300">
                無料相談する
            </a>
        </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>

