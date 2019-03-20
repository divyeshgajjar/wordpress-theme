<?php 
/*
	Template Name: Contact us
*/

get_header();

$img_id = post_id_get_fetured_image($post->ID,'full');
$img_id = (($img_id) ? $img_id : get_template_directory_uri()."/sub-images/bg-logo.png");

?>


<div class="middle-part">
  <div class="sub-banner">
    <div class="container psr">
      <div class="profile-content testmonial-title">
        <h3> <?php echo the_title(); ?> </h3>
      </div>
      <div class="banner-logo"><img class="img-responsive" src="<?php echo $img_id; ?>" alt="Shreesava"></div>
    </div>
  </div>
  <div class="about-us padb0">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="service-item style-1 bg-f8">
            <div class="service-icon"> <i class="fa fa-map" aria-hidden="true"></i></div>
            <div class="content">
              <h5>Address</h5>
              <p><?php echo ((get_option('shreesava_address'))?get_option('shreesava_address'):'') ?></p>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="service-item style-1 bg-f8">
            <div class="service-icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
            <div class="content">
              <h5>Fax</h5>
              <p><a href="tel:+9179<?php echo ((get_option('shreesava_fax_number'))?get_option('shreesava_fax_number'):'') ?>"><?php echo ((get_option('shreesava_fax_number'))?'+91-79-'.get_option('shreesava_fax_number'):'') ?></a></p>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="service-item style-1 bg-f8">
            <div class="service-icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
            <div class="content">
              <h5>Email Us</h5>
              <p><a href="mailto:<?php echo ((get_option('shreesava_email_address_3'))?get_option('shreesava_email_address_3'):'#') ?>"><?php echo ((get_option('shreesava_email_address_3'))?get_option('shreesava_email_address_3'):'#') ?></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="contact-form-scssn">
      <div class="container">
        <div class="row dis-tab">
        <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 padr0 verti-middle1">
          <div class="contact-form">
            <div class="row">
              <div class="col-md-12 pad5">
                <div class="profile-content testmonial-title">
                <h3>Get In Touch</h3>
                </div>
              </div>
            </div>
            <div class="row">
            <?php echo do_shortcode('[contact-form-7 id="5" title="Contact" html_id="contact_inquiry"]' ); ?>

              <!-- <form id="contact_inquiry" method="post" class="contact_inquiry" enctype="multipart/form-data">
                <input type="hidden" name="contact_inquiry" value="contact_inquiry">
                <div class="form-row">
                  <div class="col-lg-6 form-group pad5"> <span class="block">
                    <input type="text" id="firstname"  name="firstname" class="form-control" placeholder="First Name" />
                    </span> </div>
                  <div class="form-group col-lg-6 pad5"> <span class="block">
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" required />
                    </span> </div>
                  <div class="form-group col-lg-6 pad5"> <span class="block">
                    <input name="email" id="email" type="email" class="form-control" placeholder="Email" required>
                    </span> </div>
                  <div class="form-group col-lg-6 pad5"> <span class="block">
                    <input name="phone" id="phone" type="tel" class="form-control" placeholder="Phone Number">
                    </span> </div>
                      <div class="form-group col-lg-12 pad5"> <span class="block">
                    <input type="text" id="referencename" name="referencename" class="form-control" placeholder="Reference Name" required />
                    </span> </div>
                  <div class="form-group col-lg-12 pad5"> <span class="block">
                    <textarea name="message" id="Message" class="form-control" placeholder="Message"></textarea>
                    </span> </div>
                  <div class="form-group col-lg-12  pad5"> <span class="block">
                    <input type="text" name="4_letters_code" id="4_letters_code" class="form-control" placeholder="Validation Code">
                    </span> </div>
                  <div class="form-group col-lg-3 pad5">
                    <button id="button" class="btn btn-block submit" value="Submit" name="Submit" type="Submit"><i id="btn-ajax" class="fa fa-circle-notch fa-spin"></i> Submit</button>
                  </div>
                </div>
              </form> -->


            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 padl0 verti-middle1">
          <div class="inner">
            <h2 class="heading">OPENING HOURS</h2>

			<?php dynamic_sidebar( 'opening_information' ); ?>         
        

          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="map">
		<?php _e($post->post_excerpt); ?>		  
    </div>
  </div>
</div>


<?php get_footer(); ?>