<?php
function array_filter_managed($content){
	return apply_filters( 'the_content', $content);
}
add_filter('widget_text','do_shortcode');
add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

function get_image_url($item,$type){
	$check = wp_get_attachment_image_src($item,$type);
	//print("<pre>");print_r($check);exit;
	return ($check) ?$check[0] : "";
}
function post_id_get_fetured_image($id,$size){
    $list = wp_get_attachment_image_src( get_post_thumbnail_id($id),$size);
    return ($list) ? $list[0] : "";

}



/* Texonomy page Pagination  */

function getcategory_list(){
      
    global $wpdb;

    $post_per_page = (isset($_REQUEST['post_per_page'])) ? $_REQUEST['post_per_page'] : 1;
    $args = array('posts_per_page'=>$post_per_page,'order' => 'asc','paged'=>$_REQUEST['page'],'post_type'=>'product','tax_query' => array(
        array(
            'taxonomy' => 'products',
            'field' => 'term_id',
            'terms' => $_REQUEST['tours']
        )
    ) ,'orderby' => 'ID');
    $posts = get_posts( $args );

    if(!empty($posts)){
        foreach($posts as $post)
        {
		
			
            $imgs_id = post_id_get_fetured_image($post->ID,'medium');

            $title = get_post(get_post_thumbnail_id($post->ID))->post_title;


if(empty($imgs_id)){
$imgs_id = (get_template_directory_uri()."/images/no-image.png"); 
}


  printf('<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
            <div class="product_info"><a href="'.get_permalink($post).'" title="" class="overly"><span><img src="'.$imgs_id.'" alt="" title="'.$post->post_title.'"></span></a>
              <h4>'.$post->post_title.'</h4>
              <a href="'.get_permalink($post).'" title="View More" class="link">View More</a> </div>
          </div>');



        }
    }
    die();
}
add_action( 'wp_ajax_nopriv_getcategory_list', 'getcategory_list' );
add_action( 'wp_ajax_getcategory_list', 'getcategory_list' );


/* Texonomy page Pagination END */


/*Product Page Template Start*/


function getcategorys_list(){
      
    global $wpdb;

$post_per_page = (isset($_REQUEST['post_per_page'])) ? $_REQUEST['post_per_page'] : 1; 

$offset = $post_per_page * ($_REQUEST['page'] - 1);
// Setup the arguments to pass in
$args = array(
'offset'       => $offset,
'number'      => $post_per_page,
'order' => 'DESC',
'hide_empty'=>0
);
// Gather the series
$mycategory = get_terms( 'products', $args );



    if(!empty($mycategory)){
        foreach($mycategory as $post)
        {

          
                $im =  $post->taxonomy.'_'. $post->term_id; 
                 $collection_image = get_field('category_image',$im); 

                 $title = $collection_image['title'];
                 $url = get_term_link($post);
                $medium= get_image_url($collection_image['id'],'medium');

        if(empty($medium)){
        $medium = (get_template_directory_uri()."/images/no-image.png"); 
        }
       

       printf('<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
            <div class="product_info"><a href="'.$url.'" title="" class="overly"><span><img src="'.$medium.'" alt="" title=""></span></a>
              <h4>'.$post->name.'</h4>
              <a href="'.$url.'" title="View More" class="link">View More</a> </div>
          </div>');


        }
    }
    die();
}
add_action( 'wp_ajax_nopriv_getcategorys_list', 'getcategorys_list' );
add_action( 'wp_ajax_getcategorys_list', 'getcategorys_list' );


/* END */

