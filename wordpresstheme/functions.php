<?php

function array_filter_managed($content){
  return apply_filters( 'the_content', $content);
}
add_filter('widget_text','do_shortcode');
//add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
if ( ! function_exists( 'marutiholiday' ) ) :
function marutiholiday() {

  @include('functions/functions.php');
 
  @include('functions/customizer.php');

  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  //add_image_size( 'thumb_medium', 200,200, true );
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'primary_menu' ),
    'navigation'=>__( 'Navigation Menu', 'navigation_menu' ),
    'contact'=>__( 'Contact Menu', 'contact_supp_menu' ),   
    'aboutus'=>__( 'About Menu', 'about_supp_menu' ),   
    'service'=>__( 'Service Menu', 'service_supp_menu' ),   
   
 
  ) );
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
  ) );

  $args = array(
        'width'         => "581px",
        'height'        => "68px",
        'default-image' => get_template_directory_uri() . '/images/logo.png',
  );




    add_theme_support( 'custom-header', $args );  
    
    add_image_size( 'p_gallery', 400, 400, true);    
    add_image_size( 't_gallery', 366, 290, true);        
    add_image_size( 'a_gallery', 320, 195, true);     
   
}
endif; // marutiholiday
add_action( 'after_setup_theme', 'marutiholiday' );



/* Category Filter For all custom post type */
function todo_restrict_manage_posts() {
    global $typenow;
    $args=array( 'public' => true, '_builtin' => false );
    $post_types = get_post_types($args);
    if ( in_array($typenow, $post_types) ) {
    $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            wp_dropdown_categories(array(
                'show_option_all' => __('Show All '.$tax_obj->label ),
                'taxonomy' => $tax_slug,
                'name' => $tax_obj->name,
                'orderby' => 'term_order',
                'selected' => $_GET[$tax_obj->query_var],
                'hierarchical' => $tax_obj->hierarchical,
                'show_count' => false,
                'hide_empty' => true
            ));
        }
    }
}
function todo_convert_restrict($query) {
    global $pagenow;
    global $typenow;
    if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
                $var = $term->slug;
            }
        }
    }
    return $query;
}
add_action( 'restrict_manage_posts', 'todo_restrict_manage_posts' );
add_filter('parse_query','todo_convert_restrict');
/* Category Filter For all custom post type */

function my_login_logo_one() {
$image = get_bloginfo('template_directory') .'/images/logo.png';
?>
<style type="text/css">
body.login div#login h1 a {
 background-image: url(<?= $image?>);  //Add your own logo image in this url
padding-bottom: 1px;
width: 100%;
background-position: center top;
background-size: contain;
}
body.login div#login h1{
}
body.login {
    background: #fff;
}
</style>
 <?php
} add_action( 'login_enqueue_scripts', 'my_login_logo_one' );
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
  //||  in_array('current-menu-ancestor', $classes)
     if( in_array('current-menu-item', $classes)) {
             $classes[] = 'active';
     }
     return $classes;
}
function load_custom_wp_admin_style() {
         ?>
<style>
        .attachment-thumbnail.size-thumbnail {
    height: 100px !important;
    width: 100px !important;
}

.attachment-thumbnail {
    max-height: 100px;
    max-width: 100px;
}
</style>
    <?
}
function arphabet_widgets_init() {

   register_sidebar( array(
        'name'          => 'OPENING HOURS',
        'id'            => 'opening_information',
        'description' => __( 'For OPENING HOURS', 'openinghours' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

     register_sidebar( array(
        'name'          => 'UPCOMING EVENTS',
        'id'            => 'upcomingevents_information',
        'description' => __( 'For UPCOMING EVENTS', 'upcomingevents' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) ); 


    register_sidebar( array(
        'name'          => 'Article',
        'id'            => 'article_information',
        'description' => __( 'For Article', 'article' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) ); 


}
add_action( 'widgets_init', 'arphabet_widgets_init' );

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

function test_ajax_load_scripts() {
  // load our jquery file that sends the $.post request
   
  // make the ajaxurl var available to the above script
  wp_localize_script( 'ajax-test', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );  
}
add_action('wp_print_scripts', 'test_ajax_load_scripts');


function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }

  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => '/page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='paginate-pagination custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}
function enable_more_buttons($buttons) {

$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'styleselect';
$buttons[] = 'backcolor';
$buttons[] = 'newdocument';
$buttons[] = 'cut';
$buttons[] = 'copy';
$buttons[] = 'charmap';
$buttons[] = 'hr';
$buttons[] = 'visualaid';
$buttons[] = 'tablecontrols';

return $buttons;
}

add_filter("mce_buttons_3", "enable_more_buttons");
function  post_nav_background(){

wp_enqueue_style( 'default', get_template_directory_uri() . '/style.css', array(), null );



/*wp_enqueue_script( 'jquery.main', get_template_directory_uri() . '/js/jquery.min.js', array(), null ,true); */

wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), null ,true);



if(is_home() || is_front_page()){

wp_enqueue_style( 'carousel-css', get_template_directory_uri() . '/css/owl.carousel.css', array(), null,false );
wp_enqueue_style( 'touch-css', get_template_directory_uri() . '/css/bootstrap-touch-slider.css', array(), null,false );
wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/css/jquery.fancybox.min.css', array(), null,false );

wp_enqueue_script( 'touch', get_template_directory_uri() . '/js/bootstrap-touch-slider.js', array(), null ,false);
wp_enqueue_script( 'newsbox', get_template_directory_uri() . '/js/jquery.bootstrap.newsbox.min.js', array(), null ,false);
wp_enqueue_script( 'carousel-min', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), null ,false); 
wp_enqueue_script( 'fancybox-min', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), null ,false); 
}



wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), null ,true);
wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array(), null ,false);

wp_add_inline_script( 'jquery-migrate', "var ajax = '".admin_url('admin-ajax.php')."';");

}
add_action( 'wp_enqueue_scripts', 'post_nav_background' );

/* Category description on set editor  */

remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );
add_filter('edit_category_form_fields', 'cat_description');
function cat_description($tag)
{
    ?>
        <table class="form-table">
            <tr class="form-field">
                <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
                <td>
                <?php
                    $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
                    wp_editor(wp_kses_post($tag->description , ENT_QUOTES, 'UTF-8'), 'cat_description', $settings);
                ?>
                <br />
                <span class="description"><?php _e('The description is not prominent by default; however, some themes may show it.'); ?></span>
                </td>
            </tr>
        </table>
    <?php
}
add_action('admin_head', 'remove_default_category_description');
function remove_default_category_description()
{
        global $current_screen;
        if ( $current_screen->id == 'edit-category' )
        {
        ?>
        <script type="text/javascript">
                jQuery(function($) {
                    $('textarea#description').closest('tr.form-field').remove();
                });
        </script>
        <?php
        }
}
/* Category description on set editor  */

function secured_code($secured){
     $nones = wp_create_nonce("my_user_vote_nonce");
      $md5 = md5($nones);
      if(isset($secured['nonce']) && $secured['nonce'] === $md5){
          $secured['nonce'] = $nones;
      }
    return  $secured;
}

function get_image_url($item,$type){
  $check = wp_get_attachment_image_src($item,$type); 
  return ($check) ?$check[0] : "";
}
function post_id_get_fetured_image($id,$size){
    $list = wp_get_attachment_image_src( get_post_thumbnail_id($id),$size);
    return ($list) ? $list[0] : "";

}
add_theme_support( 'custom-logo', array(
  'height'      => 100,
  'width'       => 400,
  'flex-height' => true,
  'flex-width'  => true,
  'header-text' => array( 'site-title', 'site-description' ),
) );

if(!function_exists('marutiholiday_uc_words')):
  function marutiholiday_uc_words($string){
    return ucwords(strtolower($string));
  }
endif;


function generate_post_list($select_id, $post_type, $selected = 0) {
        $post_type_object = get_post_type_object($post_type);
        $label = $post_type_object->label;
        $posts = get_posts(array('post_type'=> $post_type, 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1));
        echo '<ul name="'. $select_id .'" id="'.$select_id.'">';
        foreach ($posts as $post) {
            echo '<li><a href="'.get_permalink($post).'"', $selected == $post->ID ? ' class="active"' : '', '>', $post->post_title, '</a></li>';
        }
        echo '</ul>';
    }


 function get_the_category_custompost( $id = false, $tcat = 'category' ) {
    $categories = get_the_terms( $id, $tcat );
    if ( ! $categories )
        $categories = array();
    $categories = current( $categories );
    return $categories->name;
}

function category_id_by_get_post($taxonomy,$category_slug,$post_type,$select_id,$selected = 0){
    $custom_post = array(
        'post_type' => 'project',
        $taxonomy  => $category_slug,
        'orderby' => 'ID',
        'order' => 'ASC',
        'posts_per_page'=>'-1',
        'post_status' => 'publish'
    );
    $posts = get_posts($custom_post);
    echo '<ul>';
      foreach ($posts as $post) {
          echo '<li '.get_permalink($post).'"', $selected == $post->ID ? ' class="active"' : '', '><a href="'.get_permalink($post).'">'.$post->post_title.'</a></li>';
      }
   echo '</ul>';
}

function wt_get_category_count($input = '') {
    global $wpdb;
    if($input == '')
    {
        $category = get_the_category();
        return $category[0]->category_count;
    }
    elseif(is_numeric($input))
    {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
        return $wpdb->get_var($SQL);
    }
    else
    {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
        return $wpdb->get_var($SQL);
    }
}



function get_first_image_arrays($array){
$imgs_id = (get_template_directory_uri()."/images/no-image.png"); 
if(!empty($array)){
        $item= explode(',',$array);     
        if(!empty($item)){ 
            $image = array();            
            foreach($item as $post){
              if(!empty($post)){
          $images = get_field('product_images', $post);
          $image = current($images);
          $medium= get_image_url($image['id'],'medium');
          }
          else{
          $medium = $imgs_id;
          }           
          $medium = ($medium)?$medium:$imgs_id;
          }          
      }
    }
return  $medium;
}


function homepage_banners(){
  global $post;
  $images = get_field('home_page_banner');
  $str='';
  if(!empty($images)){
    $str.='<div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="false" >
    <div class="carousel-inner" role="listbox">';
      $i =1;
      foreach ($images as $key => $value) {    
      $cls = (($i==1)?'active':'');     
        $str.='<div class="item '.$cls.'"> <img src="'.$value['url'].'" alt="Bootstrap Touch Slider"  class="slide-image"/>
        <div class="bs-slider-overlay"></div>
        <div class="container">
          <div class="row">
            <div class="slide-text slide_style_right">
              <h1 data-animation="animated fadeIn"  ><span>'.$value['caption'].'</span> <br/>
                '.$value['description'].'</h1>
            </div>
          </div>
        </div>
      </div>';
      $i++;
      }
    $str.='<a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev"> <span class="fa fa-angle-left" aria-hidden="true"></span> <span class="sr-only">Previous</span></a> 
      <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next"> <span class="fa fa-angle-right" aria-hidden="true"></span> <span class="sr-only">Next</span></a></div></div>';

  }
  return $str;
}
add_shortcode('homepage_banners','homepage_banners' );



function homepage_service(){
$args = array('post_type'=>'service');
$post = get_posts($args);
$str='';
if(!empty($post)){
$str.='<div class="services">
        <div class="container">      
          <div class="services1 owl-carousel owl-theme">';
          foreach ($post as $key => $value) {
           $img = post_id_get_fetured_image($value->ID,'thumbnail');
           $str.='<div class="item">
                    <div class="slice"> <img src="'.$img.'" class="img-responsive">
                      <div class="serv_content">
                      <h2>'.$value->post_title.'</h2>'.apply_filters( 'the_content', mb_strimwidth($value->post_content, 0, 170, "...")).'
                      <a href="'.get_permalink(51).'">Read more</a>
                      </div>
                    </div>
                  </div>';
          }
$str.='</div>
    </div>
  </div>';
}
return $str;
}
add_shortcode('homepage_service','homepage_service' );

function aboutpage_service(){
$args = array('post_type'=>'service','order'=>'DESC');
$post = get_posts($args);
$str='';
if(!empty($post)){
$str.='<div class="services-list">
        <div class="profile-content testmonial-title">
          <h3> services</h3>
        </div>
        <div class="row">';
          foreach ($post as $key => $value) {
           $img = post_id_get_fetured_image($value->ID,'a_gallery');
         
            $str.='<div class="col-lg-4  col-md-6">
            <div class="slice mgt30">              
                <img src="'.$img.'" class="img-responsive">
              <h2>'.$value->post_title.'</h2>'.apply_filters( 'the_content', $value->post_content ).'
            </div>
          </div>';      

          }
$str.='</div>
  </div>';
}
return $str;
}
add_shortcode('aboutpage_service','aboutpage_service' );


function testimonials_text(){
  $args = array('post_type'=>'testimonials','order'=>'DESC','numberposts'=>'-1');
  $post1 = get_posts($args);    
  $str1='';
  if(!empty($post1)){
	     foreach ($post1 as $key => $value) {


          $link = get_fields($value->ID,'youtube_link'); 
          $y_link = $link['youtube_link'];

		  
		  if(!empty($value->post_content) && empty($y_link)){
					$str1.='<div class="col-md-12 txt-only">
					  <div class="testimonial-box video-text">
						<div class="row">';
						if(!empty($value->post_content)){
						 $str1.='<div class="col-md-8 col-sm-12 verti-middle">
								<div class="testimonial-text">'.apply_filters('the_content',$value->post_content).'
								  <h3>'.$value->post_title.'</h3>
								</div>
							</div>';
						}			
					 $str1.='</div>
					  </div>
					</div>';					
			}
		  						
			if(!empty($value->post_content) && !empty($y_link)){
					$str1.='<div class="col-md-12">
					  <div class="testimonial-box video-text">
						<div class="row">';
						if(!empty($value->post_content) && !empty($y_link)){
						 $str1.='<div class="col-md-8 col-sm-12 verti-middle">
								<div class="testimonial-text">'.apply_filters('the_content',$value->post_content).'
								  <h3>'.$value->post_title.'</h3>
								</div>
							</div>';
						
						$str1.='<div class="col-md-4 col-sm-12 verti-middle">
									<div class="youtube">
										<iframe src="'.$y_link.'" allow="autoplay; encrypted-media" allowfullscreen="" width="100%" height="250" frameborder="0"></iframe>
									</div>
								</div>';
						}			
					 $str1.='</div>
					  </div>
					</div>';					
			}
			
			
				
			
         }
   
  }
  return $str1;
}
add_shortcode('testimonials_text','testimonials_text');






function testimonials_video(){
	 $args = array('post_type'=>'testimonials','order'=>'DESC','numberposts'=>'-1');
	 $post = get_posts($args);


	 
	 $str='';
	 
	 if(!empty($post)){		 
		    foreach ($post as $key => $value) {
				$link = get_fields($value->ID,'youtube_link'); 
				$y_link = $link['youtube_link'];
								
		
		if(!empty($link) && isset($y_link) && !empty($y_link) && empty($value->post_content)){
		 $str.='<div class="col-md-4 testimonial-video">
							  <div class="testimonial-box video-text">
								<div class="row"><div class="col-md-12 col-sm-12"><div class="youtube">
									   <iframe width="100%" height="250" src="'.$y_link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
										 <h3>'.$value->post_title.'</h3>
									</div>
								  </div></div>
							  </div>
							</div>';
							
		  }
							
			}					
		 
	 }
	 return $str;


}
add_shortcode('testimonials_video','testimonials_video');













function homepage_testimonials(){
   $args = array('post_type'=>'testimonials','order'=>'DESC','numberposts'=>'-1');
  $post = get_posts($args);
  $str='';
  if(!empty($post)){
      $str.='<div class="testimonial-section">
               <div class="container">
                  <div class="profile-content testmonial-title">
                    <h3><span> CLIENTS</span><br>
                      TESTIMONIALS</h3>
                  </div>
                  <div class="testimonial">
                    <div class="testi-slide owl-carousel owl-theme">';
          foreach ($post as $key => $value) {  
		     $link = get_fields($value->ID,'youtube_link'); 
         $y_link = $link['youtube_link'];
          if(!empty($value->post_content) && empty($y_link)){
				$str.='<div class="item">
                        <div class="testimonial-p">'.apply_filters('the_content',$value->post_content).'
                          <h3>'.$value->post_title.'</h3>
                        </div>
                     </div>';					 
			}

          }
        $str.='</div>
      </div>
    </div>
</div>';
}
return $str;
}
add_shortcode('homepage_testimonials','homepage_testimonials');








function event_gallery_images($attr,$constant){     
    if(!empty($attr)){ 
            echo do_action('events_action',$attr);  
    }   
} 
add_shortcode('event_gallery','event_gallery_images');


function events_action($attr){
    global $post;
    if(!empty($attr)){
        $id = (isset($attr['id'])) ? $attr['id'] : "";
        $acf_photo_gallery_slug = (isset($attr['acf_photo_gallery_slug'])) ? $attr['acf_photo_gallery_slug'] : "";
        $images = get_field($acf_photo_gallery_slug,$id);


        $page = 1;
        $limit = (isset($attr['display_limit']) && ! empty($attr['display_limit'])) ? $attr['display_limit']: "10";    
        $total = count($images);
        $array = expression_managed_pagination($images,$page,$limit);
        $totalPages = ceil( $total/ $limit );        
          $str = '';
        if(!empty($array)){         
           
           $str.=' <div class="events-photos attr">';
                $str .= apply_filters('events_showImage',$array,$attr);
            $str .='</div>';

          
          $img_url = get_template_directory_uri()."/images/AjaxLoader.gif";


if($total>$limit){
         $str .='<div class="text-center load"><button onClick="loadmore()" id="load_more_button" class="btn-ajax"><img  src="'.$img_url.'" class="animation_image" style="display:none;">View more</button></div>';
}

            $str .='<script>
        var count = 1; 
        var limit = '.$totalPages.';  
      function loadmore(){
          count++;
         jQuery(".animation_image").css("display","inline-block"); 

         if(count > limit){ 
             jQuery(".load").html("");
             return false;
         } 
              jQuery.ajax({
                            type: \'POST\',
                            url: "'.admin_url( 'admin-ajax.php' ).'",
                            data: {
                                action: \'events_loadmore\',
                                data:'.json_encode($attr).',
                               page : count,limit:'.$limit.'               
                                },

                                success: function( data ) {
                                    if(count > 1){
                                      if(data == ""){
                                        jQuery(".load").css("display","none");

                                      }
                                    }
                                    jQuery(\'.attr\').append(data);  
                                                         
                                }
                        });
                    setTimeout(function(){ jQuery(".animation_image").css("display","none"); },1000);
              
        }   
               
    </script>'; 
    
        }
        echo $str;
    }

}
add_action('events_action','events_action',10,1);

add_filter( 'events_showImage', 'events_showImages', 10, 2 );
function events_showImages($array,$attr){
    $str = '';    
    if(!empty($array)){ 
        $str .='';
        foreach($array as $image){         
           $medium= get_image_url($image['id'],'p_gallery');
           $large= get_image_url($image['id'],'full');
            $id = $image['id']; // The attachment id of the media
            $title = $image['title']; //The title
            $caption= $image['caption']; //The caption
       
          $str.='<div class="col-lg-3 col-md-4 col-sm-6 pad2">
                       <div class="filter_item"><a href="'.$large.'" class="gallery-item" data-fancybox="gallery" >
                        <img src="'.$medium.'" class="img-responsive">
                         <i class="fa fa-search"></i> 
                         </a></div>
                     </div>';
        }        
    }
    return $str;
}


function events_loadmore(){
    $str = '';
    if(isset($_REQUEST['data'])){ 
        //$datas = json_decode($_REQUEST['data']);
        if(!empty($_REQUEST['data'])){ 
            $images = get_field($_REQUEST['data']['acf_photo_gallery_slug'],$_REQUEST['data']['id']);
            $array = expression_managed_pagination($images,$_REQUEST['page'],$_REQUEST['limit']); 
            $str .= ($array) ? apply_filters('events_showImage',$array,$_REQUEST['data']) : "";  
        }

    }
    echo $str;    
   exit;    
}
add_action('wp_ajax_events_loadmore', 'events_loadmore');
add_action('wp_ajax_nopriv_events_loadmore', 'events_loadmore');




function homepage_gallery_portion(){
$images = get_field('gallery_images',75);
if(!empty($images)){
    $str.='<div class="provide-sol owl-carousel owl-theme">';
    foreach ($images as $key => $value) {
      $img = get_image_url($value['ID'],'large');
        $str.='<div class="item">
                          <div class="filter_item"><img src="'.$img.'" class="img-responsive">
                            <div class="hover_content"><a href="'.get_permalink(75).'"> <i class="fa fa-link"></i></a></div>
                          </div>
                        </div>';     
    }
    $str.='</div>';
}
return $str;
}
add_shortcode('homepage_gallery_portion','homepage_gallery_portion' );


function homepage_video_portion(){
$videos = get_field('gallery_video',75);
if(!empty($videos)){
    $str.='<div class="provide-sol owl-carousel owl-theme">';
    foreach ($videos as $key => $value) { 
       $y_img = get_youtube_image($value['youtube_link']); 


          $str.='<div class="item">
                  <div class="filter_item "><a href="'.$value['youtube_link'].'" class="gallery-item" data-fancybox="gallery" ><img src="'.$y_img.'" class="img-responsive"> <i class="fa fa-play"></i> </a> </div>
                </div>';     
    }
    $str.='</div>';
}
return $str;
}
add_shortcode('homepage_video_portion','homepage_video_portion' );




