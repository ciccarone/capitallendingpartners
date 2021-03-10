<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'ciccarone-style', get_stylesheet_directory_uri() . '/style.css' );
}

function filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

function company_name() {
  return 'Capital Lending Partners';
}
add_shortcode('company_name', 'company_name');


function pull_cards( $atts = [], $tag = '' ) {
  $atts = array_change_key_case( (array) $atts, CASE_LOWER );

  $wporg_atts = shortcode_atts(
      array(
          'category_id' => '102',
      ), $atts, $tag
  );


  // 102
  $args = array(
      'post_type'         =>  'page',
      'cat'          =>  $atts['category_id'],
      'posts_per_page'    =>  -1
  );

  $cards = new WP_Query($args);
  $ret = '';
  if ( $cards->have_posts() ) {
    $ret .= '<div class="fmtg-cards">';
    while ( $cards->have_posts() ) {
      $cards->the_post();
      $ret .= '<a class="fmtg-cards__item" href="'.get_the_permalink().'">';
        $ret .= '<div class="fmtg-cards__frame" style="background-image: url('.get_the_post_thumbnail_url().')">';
          $ret .= '<h2>'.get_the_title().'</h2>';
        $ret .= '</div>';
      $ret .= '</a>';
    }
    $ret .= '</div>';
  }
  return $ret;
}
add_shortcode('pull_cards', 'pull_cards');
