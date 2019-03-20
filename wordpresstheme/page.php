<?php get_header();
 

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
  <div class="about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="about-details">
           <?php echo  apply_filters( 'the_content',$post->post_content);  ?>          
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>



<?php get_footer(); ?>
