<?php
/** Display ordinary pages as well as the academy's editable page blocks. */
get_header( null, array( 'title' => get_the_title() . ' | ICA 池袋キャリアアカデミー' ) );
while ( have_posts() ) {
    the_post();
    if ( has_block( 'lutina/home' ) || has_block( 'lutina/legal' ) ) {
        the_content();
    } else {
        ?>
        <main class="max-w-4xl mx-auto px-6 py-20 text-mystic-600 leading-loose">
            <h1 class="text-3xl font-mincho mb-10"><?php the_title(); ?></h1>
            <?php the_content(); ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block mt-12 text-accent-600 underline underline-offset-4">トップページへ戻る</a>
        </main>
        <?php
    }
}
get_footer();
