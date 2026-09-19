<?php
/**
 * 特定商取引法に基づく表記。
 */
get_header( null, array( 'title' => '特定商取引法に基づく表記 | ICA 池袋キャリアアカデミー' ) );
?>
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b border-accent-100 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center group focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-accent-600" aria-label="ICA 池袋キャリアアカデミー トップページへ">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png?v=20260916' ); ?>" alt="" width="80" height="80" class="w-20 h-20 object-contain flex-shrink-0">
                    <span class="text-[15px] md:text-lg font-mincho font-bold tracking-wider group-hover:text-accent-600 transition-colors">池袋キャリアアカデミー</span>
                </a>
            </div>
        </header>

        <main class="flex-1 w-full max-w-4xl mx-auto px-4 sm:px-6 pt-16 pb-20 md:py-24">
            <div class="text-center mb-12 md:mb-16">
                <span class="block text-accent-600 font-serif tracking-[0.3em] mb-3 text-xs md:text-sm uppercase font-bold">— Legal Information —</span>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-mincho tracking-wide leading-relaxed">特定商取引法に基づく表記</h1>
                <div class="mt-6 flex items-center justify-center gap-4" aria-hidden="true">
                    <div class="h-px w-12 bg-gradient-to-r from-transparent to-accent-400"></div>
                    <div class="w-2 h-2 rotate-45 border border-accent-400 bg-white"></div>
                    <div class="h-px w-12 bg-gradient-to-l from-transparent to-accent-400"></div>
                </div>
            </div>

            <dl class="bg-white border border-accent-100 rounded-2xl shadow-sm px-6 sm:px-10 md:px-12 divide-y divide-accent-100 text-sm sm:text-base leading-loose">
                <div class="grid grid-cols-1 sm:grid-cols-[9rem_1fr] gap-1 sm:gap-6 py-6">
                    <dt class="font-mincho font-bold">事業者名</dt>
                    <dd class="text-gray-600">ICA池袋キャリアアカデミー</dd>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-[9rem_1fr] gap-1 sm:gap-6 py-6">
                    <dt class="font-mincho font-bold">運営責任者</dt>
                    <dd class="text-gray-600">福崎なつみ</dd>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-[9rem_1fr] gap-1 sm:gap-6 py-6">
                    <dt class="font-mincho font-bold">住所</dt>
                    <dd class="text-gray-600">東京都豊島区池袋2丁目53-12 中條ビル7F</dd>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-[9rem_1fr] gap-1 sm:gap-6 py-6">
                    <dt class="font-mincho font-bold">営業時間</dt>
                    <dd class="text-gray-600">12:00～22:00</dd>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-[9rem_1fr] gap-1 sm:gap-6 py-6">
                    <dt class="font-mincho font-bold">事業内容</dt>
                    <dd class="text-gray-600">アカデミー</dd>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-[9rem_1fr] gap-1 sm:gap-6 py-6">
                    <dt class="font-mincho font-bold">料金</dt>
                    <dd class="text-gray-600"><a href="<?php echo esc_url( home_url( '/#courses' ) ); ?>" class="text-accent-600 underline underline-offset-4 hover:text-mystic-600 transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-accent-600">こちら</a>をご覧ください</dd>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-[9rem_1fr] gap-1 sm:gap-6 py-6">
                    <dt class="font-mincho font-bold">お問い合わせ</dt>
                    <dd class="min-w-0"><a href="mailto:kaimono.ofuku@gmail.com" class="break-words text-accent-600 underline underline-offset-4 hover:text-mystic-600 transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-accent-600">kaimono.ofuku@gmail.com</a></dd>
                </div>
            </dl>

            <div class="mt-12 text-center">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center justify-center gap-3 border border-accent-400 bg-accent-500/10 text-accent-600 hover:bg-accent-400 hover:text-white px-8 py-4 rounded-sm font-mincho text-sm tracking-wider transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-accent-600">
                    <i data-lucide="arrow-left" class="w-4 h-4" aria-hidden="true"></i>
                    トップページへ戻る
                </a>
            </div>
        </main>

        <footer class="bg-white border-t border-accent-100 px-4 py-8 text-center">
            <p class="text-gray-400 text-xs font-mincho tracking-widest leading-relaxed">&copy; <?php echo date( 'Y' ); ?> ICA 池袋キャリアアカデミー. All rights reserved.</p>
        </footer>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
