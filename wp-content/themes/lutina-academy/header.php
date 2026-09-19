<!DOCTYPE html>
<html lang="ja" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo esc_html( $args['title'] ?? 'ICA 池袋キャリアアカデミー | 池袋の占いアカデミー' ); ?></title>
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
