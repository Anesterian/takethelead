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
//getting id of current page
global $post;
$page_id = $post-> ID;
//header block
echo (get_post_meta( $page_id, $key = '_ttlh_header_text', $single = true ));
//getting header image
$img = get_post_meta($page_id,$key = 'header-image', $single = true );
//www block
echo (get_post_meta( $page_id, $key = '_ttlh_when', $single = true ));
echo (get_post_meta( $page_id, $key = '_ttlh_where', $single = true ));
echo (get_post_meta( $page_id, $key = '_ttlh_what', $single = true ));
echo (get_post_meta( $page_id, $key = '_ttlh_button_text', $single = true ));
echo (get_post_meta( $page_id, $key = '_ttlh_button_url', $single = true ));

        //query for custom post type Days
        $days_args = array(
          'post_type' => 'days',
          'order' => 'DESC',
          'orderby' => 'name'
        );
        $days_query = new WP_Query($days_args);
        if($days_query->have_posts()) : while($days_query->have_posts()) : $days_query->the_post();
        $posts = $days_query->posts;
        foreach($posts as $post){
          //This is made from custom fields(for post type - days)
          echo (get_post_meta( $post->ID, $key = '_ttlh_title', $single = true ));
          echo (get_post_meta( $post->ID, $key = '_ttlh_subtitle', $single = true ));
          echo (get_post_meta( $post->ID, $key = '_ttlh_content', $single = true ));
          echo (get_post_meta( $post->ID, $key = '_ttlh_days_button_text', $single = true ));
          echo (get_post_meta( $post->ID, $key = '_ttlh_days_button_url', $single = true ));
        };
      endwhile; endif;

?>
<img src="<?php echo $img ?>">
