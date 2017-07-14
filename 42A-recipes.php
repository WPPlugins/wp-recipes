<?php
/*
Plugin Name: WP Recipes
Plugin URI: http://wordpress.org/extend/plugins/wp-recipes/
Description: Adds recipe post type, alowing you to add and manage recipes on your website. Supports archives and comments and has easy recipe ingredients and instructions management.
Author: Staxx Interactive Industries
Version: 0.1.4
Author URI: http://profiles.wordpress.org/users/staxxx/
*/


/**
 * Global PostType variables
 */
$posttypeNameSingle = "reactie"; 
$posttypeNameMultiple = "reacties"; 
$posttypeLabelSingle = "Recept";
$posttypeLabelMultiple = "Recepten";

define("posttype",                 "recipes");
define("posttypeNameSingle",       "recipe");
define("posttypeNameMultiple",     "recipes");
define("posttypeLabelSingle",      "Recipe");
define("posttypeLabelMultiple",    "Recipes");

/**
 * Create new post type 'recipe'
 */
function postTypeCreate_recipe() {
  register_post_type( posttype,
    array(
      'labels' => array(
        'name' => posttypeLabelMultiple,
        'singular_name' => posttypeLabelSingle,
        'add_new_item' => 'Add new ' . posttypeNameSingle,
        'edit_item' => 'Edit ' . posttypeLabelSingle,
        'new_item' => 'New ' . posttypeNameSingle,
        'search_items' => 'Search ' . posttypeLabelMultiple,
        'not_found' => 'No ' . posttypeLabelMultiple . ' found',
        'not_found_in_trash' => 'No ' . posttypeNameMultiple . ' found in trash',
      ),
      '_builtin' => false,
      'public' => true,
      'hierarchical' => false,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'comments',
//        'excerpt',
      ),
//      'rewrite' => array( 'slug' => 'zombie', 'with_front' => FALSE),
      //'register_meta_box_cb'=>'add_meta_boxes',
    )
  );
}
add_action( 'init', 'postTypeCreate_recipe' );





// === CUSTOM TAXONOMIES === //
function postTypeTaxonomies_recipe() {
  $labelsOrigin = array(
    'name' => _x( 'Recipe Origins', 'taxonomy general name' ),
    'singular_name' => _x( 'Origin', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Origins' ),
    'popular_items' => __( 'Popular Origins' ),
    'all_items' => __( 'All Origins' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Origin' ), 
    'update_item' => __( 'Update Origin' ),
    'add_new_item' => __( 'Add New Origin' ),
    'new_item_name' => __( 'New Origin Name' ),
    'separate_items_with_commas' => __( 'Separate origins with commas' ),
    'add_or_remove_items' => __( 'Add or remove origins' ),
    'choose_from_most_used' => __( 'Choose from the most used origins' )
  );
  register_taxonomy(
    'origin',
    posttype,
    array(
      'hierarchical' => true,
      'labels' => $labelsOrigin,
      'label' => 'Recipe origin',
      'query_var' => true,
      'rewrite' => array( 'slug' => 'origin' ),
    )
  );

  $labelsMealType = array(
    'name' => _x( 'Meal Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Meal Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Meal Types' ),
    'popular_items' => __( 'Popular Meal Types' ),
    'all_items' => __( 'All Meal Types' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Meal Type' ), 
    'update_item' => __( 'Update Meal Type' ),
    'add_new_item' => __( 'Add New Meal Type' ),
    'new_item_name' => __( 'New Meal Type Name' ),
    'separate_items_with_commas' => __( 'Separate Meal Types with commas' ),
    'add_or_remove_items' => __( 'Add or remove Meal Types' ),
    'choose_from_most_used' => __( 'Choose from the most used Meal Types' )
  );
  register_taxonomy(
    'mealtype',
    posttype,
    array(
      'hierarchical' => true,
      'labels' => $labelsMealType,
      'label' => 'Meal Type',
      'query_var' => true,
      'rewrite' => array( 'slug' => 'type' ),
    )
  );

  $labelsTags = array(
    'name' => _x( 'Recipe Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Recipe Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Recipe Tags' ),
    'popular_items' => __( 'Popular Recipe Tags' ),
    'all_items' => __( 'All Recipe Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Recipe Tag' ), 
    'update_item' => __( 'Update Recipe Tag' ),
    'add_new_item' => __( 'Add New Recipe Tag' ),
    'new_item_name' => __( 'New Recipe Tags Name' ),
    'separate_items_with_commas' => __( 'Separate Recipe Tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove Recipe Tags' ),
    'choose_from_most_used' => __( 'Choose from the most used Recipe Tags' )
  );
  register_taxonomy(
    'recipeTags',
    posttype,
    array(
      'hierarchical' => false,
      'labels' => $labelsTags,
      'label' => 'Recipe Tag',
      'query_var' => true,
      'rewrite' => array( 'slug' => 'recipe-tag' ),
    )
  );

}
add_action('init', 'postTypeTaxonomies_recipe', 0);



// New rewrite rules for a custom post type archive
function postTypeRewrite_recipe($posttype){
  global $wp_rewrite;
  $rewrite_rules = $wp_rewrite->generate_rewrite_rules($posttype.'/');
  $rewrite_rules[$posttype.'/?$'] = 'index.php?paged=1';
  
  foreach($rewrite_rules as $regex => $redirect) {
    if(strpos($redirect, 'attachment=') === false) {
      $redirect .= '&post_type='.$posttype;
    }
    if(0 < preg_match_all('@\$([0-9])@', $redirect, $matches)) {
      for($i = 0; $i < count($matches[0]); $i++) {
        $redirect = str_replace($matches[0][$i], '$matches['.$matches[1][$i].']', $redirect);
      }
    }
    $wp_rewrite->add_rule($regex, $redirect, 'top');
  }
}
function postTypeCreateRewrite_recipe(){ postTypeRewrite_recipe(posttype); }
add_action("init","postTypeCreateRewrite_recipe");




// Set custom template files for recipe posts and archives
function postTypeTemplates_recipe($posttype) {
  global $wp;
  $muley_custom_types = array($posttype);

  if (in_array($wp->query_vars["post_type"], $muley_custom_types)) {
    if ( is_robots() ) :
      do_action('do_robots');
      return;
    elseif ( is_feed() ) :
      do_feed();
      return;
    elseif ( is_trackback() ) :
      include( ABSPATH . 'wp-trackback.php' );
      return;
    elseif($wp->query_vars["name"]):
      include(TEMPLATEPATH . "/single-".$wp->query_vars["post_type"].".php");
      die();
    else:
      include(TEMPLATEPATH . "/archive-".$wp->query_vars["post_type"].".php");
      die();
    endif;

  }
}
function postTypeCreateTemplates_recipe(){ postTypeTemplates_recipe(posttype); }
add_action("template_redirect",'postTypeCreateTemplates_recipe');






/*
 * GENERAL - WP-Admin file and action inits 
*/
function recipes_my_meta_init() {
  foreach (array('auto') as $type) {
    // do niets
  }
  add_action('save_post','recipes_my_meta_save');
}
add_action('admin_init','recipes_my_meta_init');



/*
 * GENERAL - Save metadata 
*/
function recipes_my_meta_save($post_id) {
  if (!wp_verify_nonce($_POST['my_meta_noncename'],__FILE__)) return $post_id;
  if ($_POST['post_type'] == 'page') {
    if (!current_user_can('edit_page', $post_id)) return $post_id;
  }
  else {
    if (!current_user_can('edit_post', $post_id)) return $post_id;
  }

  $current_data = get_post_meta($post_id, '_my_meta', TRUE);  
  $new_data = $_POST['_my_meta'];

  recipes_my_meta_clean($new_data);
  
  if ($current_data) {
    if (is_null($new_data)) delete_post_meta($post_id,'_my_meta');
    else update_post_meta($post_id,'_my_meta',$new_data);
  }
  elseif (!is_null($new_data)) {
    add_post_meta($post_id,'_my_meta',$new_data,TRUE);
  }
  return $post_id;
}

function recipes_my_meta_clean(&$arr) {
  if (is_array($arr)) {
    foreach ($arr as $i => $v) {
      if (is_array($arr[$i])) {
        recipes_my_meta_clean($arr[$i]);
        if (!count($arr[$i])) {
          unset($arr[$i]);
        }
      }
      else {
        if (trim($arr[$i]) == '') {
          unset($arr[$i]);
        }
      }
    }
    if (!count($arr)) {
      $arr = NULL;
    }
  }
}










add_action('admin_init','recipes_setupBoxes');
function recipes_setupBoxes() {
  wp_enqueue_style('my_meta_css-klantenreactie', '/wp-content/plugins/42A-recipes/lib/css/styles.boxes.css');
  wp_enqueue_style('my_meta_css_fotos-klantenreactie', '/wp-content/plugins/42A-recipes/lib/css/styles.fotoupload.css');
  foreach (array('recipes') as $type) {
    add_meta_box('recipesBoxGeneral', 'General Recipe information', 'recipesBoxGeneral', $type, 'side', 'low');
    add_meta_box('recipesBoxIngredients', 'Recipe Ingredients', 'recipesBoxIngredients', $type, 'normal', 'low');
    add_meta_box('recipesBoxInstructions', 'Recipe Instructions', 'recipesBoxInstructions', $type, 'normal', 'low');
  }
  add_action('save_post','recipes_my_meta_save');
}

function recipesBoxGeneral() {
  global $post;
  $meta = get_post_meta($post->ID,'_my_meta',TRUE);
  include(WP_PLUGIN_DIR . '/42A-recipes/metaboxes/metaGeneral.php');
  echo '<input type="hidden" name="my_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

function recipesBoxIngredients() {
  global $post;
  $meta = get_post_meta($post->ID,'_my_meta',TRUE);
  include(WP_PLUGIN_DIR . '/42A-recipes/metaboxes/metaIngredients.php');
}

function recipesBoxInstructions() {
  global $post;
  $meta = get_post_meta($post->ID,'_my_meta',TRUE);
  include(WP_PLUGIN_DIR . '/42A-recipes/metaboxes/metaInstructions.php');
}




// Load styles and scripts
function recipes_admin_scripts() {
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  wp_register_script('my-upload-klantenreactie', '/wp-content/plugins/42A-recipes/lib/src/functions.upoader.js', array('jquery','media-upload','thickbox'));
  wp_enqueue_script('my-upload-klantenreactie');
}
function recipes_admin_styles() {
  wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'recipes_admin_scripts');
add_action('admin_print_styles', 'recipes_admin_styles');






?>