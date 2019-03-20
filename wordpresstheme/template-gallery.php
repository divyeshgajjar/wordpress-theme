<?php
/*
Template Name: Gallery
*/
get_header();

wp_enqueue_style( 'touch-css', get_template_directory_uri() . '/css/bootstrap-touch-slider.css', array(), null,false );
wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/css/jquery.fancybox.min.css', array(), null,false );

wp_enqueue_script( 'touch', get_template_directory_uri() . '/js/bootstrap-touch-slider.js', array(), null ,false);
wp_enqueue_script( 'newsbox', get_template_directory_uri() . '/js/jquery.bootstrap.newsbox.min.js', array(), null ,false);

wp_enqueue_script( 'fancybox-min', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), null ,false); 


$img_id = post_id_get_fetured_image($post->ID,'full');
$img_id = (($img_id) ? $img_id : get_template_directory_uri()."/sub-images/bg-logo.png");
?>

<div class="middle-part">
  <div class="sub-banner">
    <div class="container psr">
      <div class="profile-content testmonial-title">
        <h3><?php the_title(); ?></h3>
      </div>
      <div class="banner-logo"><img class="img-responsive" src="<?php echo $img_id; ?>" alt="Shreesava"></div>
    </div>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <iframe id="iframeYoutube" width="560" height="315"  src="https://www.youtube.com/embed/-nksMb8_ngA" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>






<div class="gallery ">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="toggleOwl gallery-scssn">
            <ul  class="menu-10">
              <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">VIDEO GALLERY</a></li>
              <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">PHOTO GALLERY</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="tab1">
                <div class="video-tab">

<?php echo do_shortcode('[gallery_video]');  ?>

                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab2">
                <div class="photo-tab">

<?php 
do_shortcode('[gallery_images id='.$post->ID.' acf_photo_gallery_slug="gallery_images" display_limit="30"]');
?> 

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 

 </div>



<script type="text/javascript">
$(document).ready(function(){
	$('#bootstrap-touch-slider').bsTouchSlider();	
})
</script>



<?php get_footer(); ?>