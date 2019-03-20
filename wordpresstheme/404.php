<?php 
/* 

Templete Name: 404
 */
get_header();

$img_id = post_id_get_fetured_image($post->ID,'full');
    $img_id = (($img_id) ? $img_id : get_template_directory_uri()."/sub-images/contactus-banner.jpg");

?>

<section>
    <div class="middle about_details">
      <div class="banner innerpage_banner">
        <div class="container-fluid">
          <div class="overly_text">
            <div class="slider_overly"><img src="<?php echo get_template_directory_uri(); ?>/images/logo_bit.png" alt="Baheti Metal" title="Baheti Metal"></div>
          </div>
          <div class="subpagr_banner"> <span><img src="<?php echo $img_id; ?>" alt="" title=""></span>
            <h2><?php the_title();?></h2>
          </div>
        </div>
       
      </div>
      

<div class="contact_details" id="conrdetail">
       <div class="container">
        <div class="error">
            <h1>404!</h1>
            <div class="text-sm">
            </div>
        </div>
    </div>

     <div class="text-bg">
    <div class="container">
        <h6>Error</h6>
        <p>Sorry, the page you requested could not be found</p>
        <p class="m-top30">Go back <a href="<?php echo Site_url();?>">Home</a></p>
    </div>
    </div>

        
      </div>



 
    </div>
  </section>


   




<?php get_footer(); ?>
