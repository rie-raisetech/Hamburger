<?php
function hamburger_theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'hamburger_theme_setup');

function add_preconnect_links()
{
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">' . "\n";
}
add_action('wp_head', 'add_preconnect_links');

function my_enqueue_style()
{
  wp_enqueue_style('ress', get_theme_file_uri() . '/sass/foundation/ress.css', array(), '1.0.0');
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=M+PLUS+1p&family=M+PLUS+1m&display=swap', array(), null);
  wp_enqueue_style('style', get_theme_file_uri() . '/css/style.css', array(), '1.0.0');
  wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_enqueue_style');


function register_my_menus()
{
  register_nav_menus(array(
    'menu_category' => 'カテゴリー',
    'menu_item' => 'メニュー'
  ));
}
add_action('init', 'register_my_menus');

class Custom_Menu_Walker extends Walker_Nav_Menu
{
  function start_lvl(&$output, $depth = 0, $args = array())
  {
    if ($depth === 0) {
      $output .= '<ul class="p-menu__list">';
    }
  }

  function end_lvl(&$output, $depth = 0, $args = array())
  {
    if ($depth === 0) {
      $output .= '</ul>';
    }
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    if ($depth === 0) {
      $output .= '<h6 class="p-menu__category"><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></h6>';
    } else {
      $output .= '<li class="p-menu__item"><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></li>';
    }
  }
  function end_el(&$output, $item, $depth = 0, $args = array()) {}
}

function register_custom_post_type()
{
  register_post_type('hamburger', array(
    'label'         => 'ハンバーガー',
    'public'        => true,
    'menu_position' => 5,
    'has_archive'   => true,
    'supports'      => array('title', 'editor', 'thumbnail'),
    'rewrite'       => array('slug' => 'hamburger'),
    'show_in_rest'  => true,
    'taxonomies' => array('category'),
  ));
}
add_action('init', 'register_custom_post_type');


function hamburger_custom_search_filter($query)
{
  if (!is_admin() && $query->is_main_query() && $query->is_search()) {
    if (isset($_GET['post_type']) && $_GET['post_type'] === 'hamburger') {
      $query->set('post_type', 'hamburger');

      $search_term = $query->get('s');


      $category = get_term_by('name', $search_term, 'category');

      if ($category) {

        $query->set('s', '');
        $query->set('tax_query', array(
          array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $category->term_id,
          ),
        ));
      }
    }
  }
}
add_action('pre_get_posts', 'hamburger_custom_search_filter');
