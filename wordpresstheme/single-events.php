<?php 


get_header();


$img_id = post_id_get_fetured_image($post->ID,'full');
$img_id = (($img_id) ? $img_id : get_template_directory_uri()."/sub-images/bg-logo.png");


wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/css/jquery.fancybox.min.css', array(), null,false );
wp_enqueue_script( 'fancybox-min', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), null ,false); 



$date = get_field('date',$post->ID);
$new = date('j<\s\up>S</\s\up> F, Y', strtotime($date));
$new=(($date)?$new:'');




?>

<div class="middle-part">
   <div class="sub-banner">
      <div class="container psr">
         <div class="profile-content testmonial-title"><h3> Events</h3></div>
         <div class="banner-logo"><img class="img-responsive" src="<?php echo $img_id; ?>" alt="Shreesava"></div>
      </div>
   </div>
   <div class="event-details-scssn gallery-scssn pad40">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="event-details events">
                  <?php echo (($new)?'<span>'.$new.'</span>':'') ?>
                  <h3><?php echo $post->post_title; ?></h3>
                  <?php echo apply_filters('the_content',$post->post_content ); ?>
                 

      <?php echo do_shortcode('[event_gallery id='.$post->ID.' acf_photo_gallery_slug="gallery_images" display_limit="32"]'); ?>


               </div>
            </div>
        </div>
      </div>
   </div>
</div>





<?php
get_footer();
?>
