<?php
include('navigation_class.php');
include('breadcrumb.php');
include('products.php');


include('actions.php');
include('template-functions.php');






// custom menu example @ https://digwp.com/2011/11/html-formatting-custom-menus/
function clean_custom_menus($menu_name) {
    global $wp; 

	$menu_name = $menu_name; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = "\t\t\t\t". '<ul class="nav justify-content-center">' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
      $current_url = home_url(add_query_arg(array(),$wp->request));
      $op = $current_url.'/';

			$menu_list .= "\t\t\t\t\t". '<li class="nav-item"><a class="nav-link '.(($op==$url)?'active':'').'" href="'. $url .'">'. $title .'</a></li>' ."\n";
		}
		$menu_list .= "\t\t\t\t". '</ul>' ."\n";
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}



/*add_action( 'wp_footer', 'mycustom_wp_footer' ); 
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
   path = '<?php echo esc_url( get_permalink(508));?>';
   window.location.href=path;
 }, false );
</script>
<?php
}*/ 

?>
<?



// For gallery Page in Images ************************


function expresion($attr,$constant){     
    if(!empty($attr)){ 
            echo do_action('expression_action',$attr);  
    }   
} 
add_shortcode('gallery_images','expresion');
function expression_action($attr){
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
          
           $str.=' <div class="row attr" id="results">';
                $str .= apply_filters('expression_showImage',$array,$attr);
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
                                action: \'expression_loadmore\',
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
                                     loadjs();                             
                                }
                        });
                    setTimeout(function(){ jQuery(".animation_image").css("display","none"); },1000);
              
        }   
        function loadjs(){
            jQuery(document).ready(function(){
                     $("[data-fancybox]").fancybox({
                      transitionEffect: "zoom-in-out",
                      transitionDuration: 400,
                      buttons: ["zoom", "thumbs", "close"],
                      hash: false,
                      });
                    });
            }       
    </script>'; 
    
        }else{

        $str .='<div class="no-records"><ul><li><i class="fa fa-exclamation"></i></li><li><h6>No <br>Records</h6><br><small class="text-left">Found!</small></li></ul></div>';
        }

        echo $str;
    }

}
add_action('expression_action','expression_action',10,1);


function expression_managed_pagination($images,$page,$limit){
    if(!empty($images)){
        $page = ! empty( $page ) ? (int) $page : 1;
        $total = count( $images ); //total items in array    
        $totalPages = ceil( $total/ $limit ); //calculate total pages
        $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
        $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
        $offset = ($page - 1) * $limit;
        if( $offset < 0 ) $offset = 0;
        $images = array_slice( $images, $offset, $limit );       
        return ($images) ? $images : "";
    }
}




add_filter( 'expression_showImage', 'expression_showImages', 10, 2 );
function expression_showImages($array,$attr){
    $str = '';    
    if(!empty($array)){ 
        $str .='';
        foreach($array as $image){    
	
           $medium= get_image_url($image['id'],'medium_large');
           $large= get_image_url($image['id'],'full');
            $id = $image['id']; // The attachment id of the media
            $title = $image['title']; //The title
            $caption= $image['caption']; //The caption

         $str.='<div class="col-md-4 col-sm-6 pad2">
                      <div class="filter_item"><a href="'.$large.'" class="gallery-item" data-fancybox="gallery" ><img src="'.$medium.'" class="img-responsive">
                        <i class="fa fa-search"></i></a> </div>
                    </div>';
        }        
    }
    return $str;
}

function expression_loadmore(){
    $str = '';
    if(isset($_REQUEST['data'])){ 
        //$datas = json_decode($_REQUEST['data']);
        if(!empty($_REQUEST['data'])){ 
            $images = get_field($_REQUEST['data']['acf_photo_gallery_slug'],$_REQUEST['data']['id']);
            $array = expression_managed_pagination($images,$_REQUEST['page'],$_REQUEST['limit']); 
            $str .= ($array) ? apply_filters('expression_showImage',$array,$_REQUEST['data']) : "";  
        }

    }
    echo $str;    
   exit;    
}
add_action('wp_ajax_expression_loadmore', 'expression_loadmore');
add_action('wp_ajax_nopriv_expression_loadmore', 'expression_loadmore');

// For gallery Page in Images ************************



// For gallery Page in Videos ************************
function gallery_video(){
$videos = get_field('gallery_video');
$str='';
if(!empty($videos)){
	$str.='<div class="row">';
foreach ($videos as $key => $value) {
		if(isset($value['youtube_link'])){

      $y_img = get_youtube_image($value['youtube_link']); 

        $str.='<div class="col-md-4  col-sm-6  pad2">
                        <div class="filter_item ">
                          <a href="'.$value['youtube_link'].'" class="gallery-item" data-fancybox="gallery" >
                           <img src="'.$y_img.'" class="img-responsive">
                           <i class="fa fa-play"></i> 
                          </a>
                        </div>
                     </div>';
		}
	}
    $str.='</div>';
}else{
	$str .='<div class="no-records"><ul><li><i class="fa fa-exclamation"></i></li><li><h6>No <br>Records</h6><br><small class="text-left">Found!</small></li></ul></div>';
}
return $str;
}
add_shortcode('gallery_video','gallery_video');





function get_youtube_image($link){
$id =  substr($link, strrpos($link, '/') + 1);
$url = 'https://img.youtube.com/vi/'.$id.'/hqdefault.jpg';
return (($url)?$url:'');
}


/*  */





function event(){
 
 do_action('eventlist_fun');
}
add_shortcode('eventlist','event');


add_action('eventlist_fun','eventlist_fun');

function eventlist_fun(){
     global  $post; 
     $paged = isset( $_GET['paged'] ) ? (int) $_GET['paged'] : 1;
     $args = array( 'post_type' => 'events','paged'=>$paged,'posts_per_page' => 12,'order'=>'DESC','orderby'=>'id');
     $loop =get_posts( $args );  

    $count_posts = wp_count_posts('events');
    $total_posts = $count_posts->publish;

      if(!empty($loop)){             
          $str .='<div class="events-scssn pad40">
                    <div class="container">
                      <div class="row main_gallery">';
            $str .= load_more_events($paged,$loop); 
        $str .='</div>  
                 </div>  
                  </div>';            
    

      $img_url = get_template_directory_uri()."/images/AjaxLoader.gif";
      if($total_posts > 12){   
    $str .='<div class="text-center load"><button onClick="loadmore()" id="load_more_button" class="btn-ajax"><img  src="'.$img_url.'" class="animation_image" style="display:none;">View more</button></div>';
    }
                 
     }
    $str .='<script>
        var count = 1; 
        function loadmore(){
          count++;
         jQuery(".animation_image").css("display","inline-block");  
            jQuery.ajax({
                            type: \'POST\',
                            url: "'.admin_url( 'admin-ajax.php' ).'",
                            data: {
                                action: \'load_event_images\',
                            page : count                
                            },
                            success: function( data ) {
                if(count > 1){
                  if(data == ""){
                    jQuery(".load").css("display","none");
                  }
                }
                      jQuery(\'.main_gallery\').append(data);                               
                     }
                        });
            setTimeout(function(){ jQuery(".animation_image").css("display","none"); },1000);
              
        }
    </script>'; 

 echo($str); 
} 


function load_more_events($page,$loop){

global $post;
 
  if(!empty($loop)){
  $str = "";
     $i=1;$j=1;     
           foreach($loop as $value){

            $date = get_field('date',$value->ID);
            $new = date('j<\s\up>S</\s\up> F, Y', strtotime($date));
            $new=(($date)?$new:''); 
            $url = get_permalink($value);

            $images = get_field('gallery_images',$value->ID);   
           $first_image = get_first_image_array($images);

$str.='<div class="col-md-12">
              <div class="events">
                <div class="col-lg-3 col-md-4 padl0 padr0">
                  <span class="xs">'.$new.'</span>
                  <div class="event_img"><img src="'.$first_image.'" class="img-responsive"></div></div>
                  <div class="col-lg-9 col-md-8 padl0 padr0">
                    <div class="events-content">
                        <span class="xs-none">'.$new.'</span>
                        <h3>'.$value->post_title.'</h3>'.apply_filters('the_content',wp_trim_words($value->post_content,25)).'
                        <a href="'.$url.'">View Details</a>
                    </div>
                  </div>
                 </div>
            </div>';
       
            $i++;
           }
  
        return $str;  
  }
}



function load_event_images(){
    $paged = isset( $_REQUEST['page'] ) ? (int) $_REQUEST['page'] : 1;
     $args = array( 'post_type' => 'events','paged'=>$paged,'posts_per_page' => 12,'order'=>'DESC','orderby'=>'id');
     $loop =get_posts( $args ); 
     $str = '';    
     if(!empty($loop)){ 
      $str .= load_more_events($paged,$loop);
     }
     print($str);
   exit;
}
add_action('wp_ajax_load_event_images', 'load_event_images');
add_action('wp_ajax_nopriv_load_event_images', 'load_event_images');


function get_first_image_array($images){
  $img = current($images);
  $medium = get_image_url($img['id'],'medium_large');
  return $medium;
}



add_action( 'admin_enqueue_scripts', function() {
	 global $post;	
	 if($post->post_type=='post'){
		 wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), null ,true);
	 }	
} );








function wordpress_numeric_post_nav() {
    if( is_singular() )
        return;
    global $wp_query;
    /* Stop the code if there is only a single page page */
    if( $wp_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
    /*Add current page into the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    /*Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '<div class="navigation"><ul>' . "\n";
    /*Display Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
    /*Display Link to first page*/
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
    /* Link to current page */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
    /* Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
    echo '</ul></div>' . "\n";
}