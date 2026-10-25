<?php
/** The front page is a normal WordPress page with editable content. */
get_header( lutina_academy_is_landing() ? 'landing' : null );
while ( have_posts() ) {
    the_post();
    the_content();
}
get_footer();
