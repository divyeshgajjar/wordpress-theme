<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="format-detection" content="telephone=no" />
<?php wp_head();

 ?> 
<title><?php echo the_title();?></title>

<link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">


<script type="text/javascript">
	var $ = jQuery;
</script>



</head>
<body>
<header class="site-header">
  <div class="navigations">
    <div class="top-bar">
      <div class="container">
        <div class="row">
          <ul class="nav top-bar-nav align-left social">
            <li><a href="<?php echo ((get_option('shreesava_facebook_url'))?get_option('shreesava_facebook_url'):'#') ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
            <li><a href="<?php echo ((get_option('shreesava_twitter_url'))?get_option('shreesava_twitter_url'):'#') ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo ((get_option('shreesava_instagram_url'))?get_option('shreesava_instagram_url'):'#') ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          </ul>
          <ul class="nav top-bar-nav align-right contact-details">
            <li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+9179<?php echo ((get_option('shreesava_phone_number'))?get_option('shreesava_phone_number'):'') ?>"><?php echo ((get_option('shreesava_phone_number'))?'+91-79-'.get_option('shreesava_phone_number'):'') ?></a></li>
            <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:<?php echo ((get_option('shreesava_email_address_3'))?get_option('shreesava_email_address_3'):'#') ?>"><?php echo ((get_option('shreesava_email_address_3'))?get_option('shreesava_email_address_3'):'#') ?></a></li>
          </ul>
        </div>
      </div>
    </div>
    <nav class="navbar" id="main-nav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle black-back collapsed" data-toggle="collapse" data-target="#navbar-brand-centered" id="nav-icon2"> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> </button>
          <a href="<?php echo site_url();?>" class="navbar-brand navbar-brand-centered"><img src="<?php header_image(); ?>" alt="shreesava"/></a> </div>
        <div class="collapse navbar-collapse" id="navbar-brand-centered">
        
          <?php $args = array('theme_location' => 'left', 'menu' =>'left-menu', 'depth'    => 0, 'container'  => true, 'menu_class'   => 'nav', 'items_wrap' => ' <ul class="nav navbar-nav">'.$l.'%3$s</ul>', 'container' => 'none', 'container_class' => 'menu-header', 'menu_class' => 'nav navbar-nav', 'walker'   => new BootstrapNavMenuWalker() ); wp_nav_menu($args); ?>


         <?php
         $social = '<li class="col-xs-12 nav-contact visible-xs-block visible-sm-block visible-md-block">
              <div class="row">
                <ul class="nav top-bar-nav align-left social">
                  <li><a href="'.((get_option('shreesava_facebook_url'))?get_option('shreesava_facebook_url'):'#').'"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="'.((get_option('shreesava_twitter_url'))?get_option('shreesava_twitter_url'):'#').'"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="'.((get_option('shreesava_instagram_url'))?get_option('shreesava_instagram_url'):'#').'"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
                <ul class="nav top-bar-nav align-right contact-details">
                  <li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+9179'.((get_option('shreesava_phone_number'))?get_option('shreesava_phone_number'):'').'">'.((get_option('shreesava_phone_number'))?'+91-79-'.get_option('shreesava_phone_number'):'').'</a></li>
                  <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:'.((get_option('shreesava_email_address_3'))?get_option('shreesava_email_address_3'):'#').'">'.((get_option('shreesava_email_address_3'))?get_option('shreesava_email_address_3'):'#').'</a></li>
                </ul>
              </div>
            </li>';
          $args = array('theme_location' => 'right', 'menu' =>'right-menu', 'depth'    => 0, 'container'  => true, 'menu_class'   => 'nav', 'items_wrap' => ' <ul class="nav navbar-nav navbar-right">'.$l.'%3$s'.$social.'</ul>', 'container' => 'none', 'container_class' => 'menu-header', 'menu_class' => 'nav navbar-nav', 'walker'   => new BootstrapNavMenuWalker() ); wp_nav_menu($args); ?> 

        </div>
      </div>
    </nav>
  </div>
</header>
