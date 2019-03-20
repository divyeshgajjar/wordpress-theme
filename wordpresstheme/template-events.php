<?php
/*
Template Name: Events
*/
get_header();

$img_id = post_id_get_fetured_image($post->ID,'full');
$img_id = (($img_id) ? $img_id : get_template_directory_uri()."/sub-images/bg-logo.png");
?>


<div class="middle-part">
   <div class="sub-banner">
      <div class="container psr">
         <div class="profile-content testmonial-title"><h3> <?php the_title(); ?></h3></div>
         <div class="banner-logo"><img class="img-responsive" src="<?php echo $img_id; ?>" alt="Shreesava"></div>
      </div>
   </div>
<?php echo do_shortcode('[eventlist]' );  ?>  
</div>

 <?php get_footer();  ?>