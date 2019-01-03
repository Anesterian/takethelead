<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TheLead
 */

?>
<?php
//Upper block(used Customizer api)
        if(get_theme_mod('when')): echo nl2br(esc_html(get_theme_mod('when'))); else: echo '21 march - 14 april 2019'; endif;
        if(get_theme_mod('where')): echo nl2br(esc_html(get_theme_mod('where'))); else: echo 'Vierick Campus Ghent'; endif;
        if(get_theme_mod('what')): echo nl2br(esc_html(get_theme_mod('what'))); else: echo '5 day coyrse'; endif;
//Days block
        if(get_theme_mod('title')): echo nl2br(esc_html(get_theme_mod('title'))); else: echo 'The programme'; endif;
        if(get_theme_mod('text')): echo nl2br(esc_html(get_theme_mod('text'))); else: echo 'De impact van '; endif;
        //button
        if(get_theme_mod('button_title')): echo nl2br(esc_html(get_theme_mod('button_title'))); else: echo 'VIEW FULL SHELUDE'; endif;
        if(get_theme_mod('button_url')): echo nl2br(esc_html(get_theme_mod('button_url'))); else: echo '/'; endif;
        $days_args = array(
          'post_type' => 'days',
          'order' => 'DESC',
          'orderby' => 'name'
        );
        $days_query = new WP_Query($days_args);
        if($days_query->have_posts()) : while($days_query->have_posts()) : $days_query->the_post();
        $posts = $days_query->posts;
        foreach($posts as $post){
          the_title();
          the_content();
          //This is made from custom fields(for post type - days)
          //var_dump(get_post_meta( $post->ID, $key = '_mcf_block-of-text', $single = false ));
          echo (get_post_meta( $post->ID, $key = '_mcf_block-of-text', $single = true ));
        };
      endwhile; endif;
      //This is made from custom fields(for page)
      //var_dump(get_post_meta( 7, $key = '_mcf_block-of-text', $single = false ));
      echo (get_post_meta( 7, $key = '_mcf_block-of-text', $single = true ));
?>
