<?php 

get_header(); 

$img_id = post_id_get_fetured_image($post->ID,'full');
$img_id = (($img_id) ? $img_id : get_template_directory_uri()."/sub-images/bg-logo.png");

?>




<div class="middle-part">
   <div class="sub-banner">
      <div class="container psr">
         <div class="profile-content testmonial-title"><h3> Articles</h3></div>
         <div class="banner-logo"><img class="img-responsive" src="<?php echo $img_id; ?>" alt="Shreesava"></div>
      </div>
   </div>
   <div class="about-us articles-scssn padtb50">
      <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                <div class="articles-category">
                <?php dynamic_sidebar( 'article_information' ); ?>
				
                </div>  
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12 pull-left bdrl">
              <div class="row">

<?php if ( have_posts() ) : ?>			

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>              
               
              </div>
              <div class="row">
                    <div class="col-md-12">
                      <div class="tag-share">
                          <?php wordpress_numeric_post_nav(); ?>
                      </div>
                    </div>
             </div>			  
            </div>
          </div>
      </div>
    </div>
</div>







<?php get_footer(); ?>
