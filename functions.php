<?php

function theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support('responsive-embeds');
  add_theme_support('custom-logo');
  add_theme_support('custom-header');
  add_theme_support('custom-background');
  add_theme_support('align-wide');
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'widgets',
  ));
  add_theme_support('wp-block-styles');
  add_theme_support('editor-styles');
  add_editor_style('editor-style.css');
}
add_action('after_setup_theme', 'theme_setup');

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
    'menu_category' => __('カテゴリー', 'hamburger'),
    'menu_item' => __('メニュー', 'hamburger'),
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

function hamburger_register_block_styles()
{
  register_block_style(
    'core/paragraph',
    [
      'name'         => 'fancy-paragraph',
      'label'        => __('Fancy Paragraph', 'hamburger'),
      'inline_style' => '.is-style-fancy-paragraph { color: red; font-weight: bold; }',
    ]
  );
}
add_action('init', 'hamburger_register_block_styles');

function hamburger_register_block_patterns()
{
  register_block_pattern(
    'hamburger/hero-section',
    [
      'title'       => __('Hero Section', 'hamburger'),
      'description' => __('A simple hero section with heading and paragraph.', 'hamburger'),
      'content'     => "<!-- wp:heading --><h2>Welcome!</h2><!-- /wp:heading -->\n<!-- wp:paragraph --><p>This is a custom pattern.</p><!-- /wp:paragraph -->",
    ]
  );
}
add_action('init', 'hamburger_register_block_patterns');

function hamburger_customize_main_query($query)
{
  if (!is_admin() && $query->is_main_query()) {

    if ($query->is_tag()) {
      $query->set('post_type', ['post', 'hamburger']);
      $query->set('posts_per_page', 3);
    }

    if ($query->is_category()) {
      $query->set('post_type', ['post', 'hamburger']);
      $query->set('posts_per_page', 3);
    }

    if ($query->is_search() && isset($_GET['post_type']) && $_GET['post_type'] === 'hamburger') {
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
add_action('pre_get_posts', 'hamburger_customize_main_query');

function hamburger_register_taxonomies()
{
  register_taxonomy_for_object_type('post_tag', 'hamburger');
  register_taxonomy_for_object_type('category', 'hamburger');
}
add_action('init', 'hamburger_register_taxonomies');
