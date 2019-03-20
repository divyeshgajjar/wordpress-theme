<?php 
/* 
	Template Name: Homepage
 */
get_header(); 

$img_id = post_id_get_fetured_image($post->ID,'full');
$img_id = (($img_id) ? $img_id : get_template_directory_uri()."/images/profile-img.jpg");

?>


<div class="middle-part">

<?php  echo do_shortcode('[homepage_banners]' ); ?>
	
<div class="event">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-sm-12 col-xs-12">
          <div class="mantra">
            <div class="weekly">
              <div class="speech-bubble hvr-icon">
                <div class="arrow bottom right"></div>
                Shreesava motto </div>
            </div>
            <p><?php _e($post->post_excerpt); ?></p>
          </div>
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
          <div class="upcoming-events">
            <div class="panel panel-default">
              <div class="panel-heading"><span>UPCOMING</span> EVENTS
                <div class="panel-footer"> </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-xs-12">
                    <ul id="demo3">
                    <?php dynamic_sidebar( 'upcomingevents_information' ); ?>
                    </ul>
                    <a href="<?php echo get_permalink(110); ?>" class="event-button">Archive Events</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php echo do_shortcode('[homepage_service]' ); ?>


   <div class="profile" style="background: url(<?php echo $img_id; ?>) no-repeat;background-size: cover;
    background-position: 31%;">
    <div class="container">
      <div class="profile-box">
        <div class="row">
          <div class="col-lg-6 col-lg-offset-6 col-md-8 col-md-offset-3">
            <div class="profile-content">
            <?php echo apply_filters('the_content', $post->post_content );  ?>
              <a href="<?php echo get_permalink(51); ?>">READ MORE</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="gallery">
    <div class="row">
      <div class="col-xs-12">
        <div class="toggleOwl home-tab">
          <ul  class="menu-10">
            <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">VIDEO GALLERY</a></li>
            <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">PHOTO GALLERY</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
           <div role="tabpanel" class="tab-pane active" id="tab1">
           <?php  echo do_shortcode('[homepage_video_portion]' ); ?>
           </div>
            <div role="tabpanel" class="tab-pane" id="tab2">
                  <?php  echo do_shortcode('[homepage_gallery_portion]' ); ?>
             </div>
          </div>

        </div>
      </div>
    </div>
  </div>



<?php  echo do_shortcode('[homepage_testimonials]' ); ?>


</div>





<script type="text/javascript">
jQuery(document).ready(function(){

   jQuery("#demo3").bootstrapNews({
            newsPerPage: 2,
            autoplay: false,
             navText: ['<i class="fa fa-angle-left"></i> ' , '<i class="fa fa-angle-right"></i>'],
            onToDo: function () {
                //console.log(this);
            }
        });
 
	jQuery('.services1').owlCarousel({
	    loop:true,
	    margin:8,
	    items:3,
	    loop:true,
	    nav:true,
	    smartSpeed:1200,
	    dots:false,
	    autoplay: false,
	    autoplayTimeout:5000,
	    autoplayHoverPause:true,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	        },
	        768:{
	            items:2,
	        },
	        1200:{
	            items:2,
	        },
	    }
	});


	$('.testi-slide').owlCarousel({
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    loop:true,
    margin:0,
    items:1,
    loop:true,
    nav:false,
    smartSpeed:2200,
    dots:true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
	})

	$('.provide-sol').owlCarousel({
    loop:true,
    margin:8,
    items:4,
    loop:true,
    nav:false,
    smartSpeed:2200,
    dots:false,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        768:{
            items:2,
        },
        992:{
            items:3,
        },
        1200:{
            items:4,
        },
    }
})

 });
 </script> 


<?php get_footer(); ?>

<script type="text/javascript">
$(document).ready(function(){
	$('#bootstrap-touch-slider').bsTouchSlider();	
})
</script>