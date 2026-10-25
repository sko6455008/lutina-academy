<?php
$questions = get_posts( array(
    'post_type' => 'lutina_faq', 'post_status' => 'publish', 'posts_per_page' => -1,
    'orderby' => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ),
) );
foreach ( $questions as $question ) : ?>
<details class="lp-faq-item" open>
    <summary><span aria-hidden="true" class="lp-qa-letter">Q.</span><span><?php echo esc_html( $question->post_title ); ?></span><span class="lp-faq-toggle" aria-hidden="true"></span></summary>
    <div class="lp-faq-answer"><span class="lp-qa-letter" aria-hidden="true">A.</span><div><?php echo wpautop( wp_kses_post( $question->post_content ) ); ?></div></div>
</details>
<?php endforeach; ?>
