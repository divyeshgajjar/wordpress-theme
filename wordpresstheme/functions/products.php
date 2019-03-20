<?php
/*Products*/

add_action('init', 'crest_Services');
function crest_Services() {
    $labels = array(
        'name' => _x('Services', 'post type general name'),
        'singular_name' => _x('Services Item', 'post type singular name'),
        'add_new' => _x('Add New', 'Services item'),
        'add_new_item' => __('Add New Services Item'),
        'edit_item' => __('Edit Services Item'),
        'new_item' => __('New Services Item'),
        'view_item' => __('View Services Item'),
        'search_items' => __('Search Services'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-post',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','thumbnail','editor')
      );
    register_post_type( 'service' , $args );
    //register_taxonomy("services", array("service"), array("hierarchical" => true, "label" => "Services Category"));
}

add_filter("manage_edit-service_columns", "service_list_edit_columns");



function service_list_edit_columns($columns){
  $columns = array(
    'cb' => '<input type="checkbox" />',
    "title" => "Title",
    "_img" => "Image",
  "date" => "Date",
  "author" => "Author",
  );
  return $columns;
}
add_action("manage_posts_custom_column",  "_img_list_custom_columns", 10, 2);
function _img_list_custom_columns($column,$post_id){
            $width = (int) 100;
            $height = (int) 100;
             if($column == '_img'){
                $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
                // image from gallery
                $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'service', 'post_mime_type' => 'image') );
                if ($thumbnail_id)
                    $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
                elseif ($attachments) {
                    foreach ( $attachments as $attachment_id => $attachment ) {
                        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                    }
                }
                if ( isset($thumb) && $thumb ) {
                        echo $thumb;
                    } else {
                        echo __('None');
                    }
    }   
}





add_action('init', 'crest_Testimonials');
function crest_Testimonials() {
    $labels = array(
        'name' => _x('Testimonials', 'post type general name'),
        'singular_name' => _x('Testimonials Item', 'post type singular name'),
        'add_new' => _x('Add New', 'Testimonials item'),
        'add_new_item' => __('Add New Testimonials Item'),
        'edit_item' => __('Edit Testimonials Item'),
        'new_item' => __('New Testimonials Item'),
        'view_item' => __('View Testimonials Item'),
        'search_items' => __('Search Testimonials'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-post',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','editor') /*,
        'register_meta_box_cb' => 'product_meta_boxes'*/
      );
    register_post_type( 'testimonials' , $args );
   // register_taxonomy("products", array("product"), array("hierarchical" => true, "label" => "Products Category"));
}

add_filter("manage_edit-testimonials_columns", "testimonials_list_edit_columns");
function testimonials_list_edit_columns($columns){
  $columns = array(
    'cb' => '<input type="checkbox" />',
    "title" => "Title", 
  "date" => "Date",
  "author" => "Author",
  );
  return $columns;
}





add_action('init', 'crest_Events');
function crest_Events() {
    $labels = array(
        'name' => _x('Events', 'post type general name'),
        'singular_name' => _x('Events Item', 'post type singular name'),
        'add_new' => _x('Add New', 'Events item'),
        'add_new_item' => __('Add New Events Item'),
        'edit_item' => __('Edit Events Item'),
        'new_item' => __('New Events Item'),
        'view_item' => __('View Events Item'),
        'search_items' => __('Search Events'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-post',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','editor')
      );
    register_post_type( 'events' , $args );
   // register_taxonomy("products", array("product"), array("hierarchical" => true, "label" => "Products Category"));
}

