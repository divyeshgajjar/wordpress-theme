<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package divyesh
 */


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
                <div class="col-md-12  pad8">
                  <div class="articles article-details">
                  <?php divyesh_post_single_thumbnail(); ?>                    
                       <div class="articles-content articles-deatils-content">
                              <ul>
                                <?php divyesh_entry_footer();  ?>
                               <?php divyesh_posted_on();  ?>
                              </ul>
                             <?php the_title( '<h3>', '</h3>' ); ?>                      
                            <?php echo apply_filters('the_content',$post->post_content ); ?>
                      </div>
                  </div>				    
				  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="tag-share">
                          <?php echo do_shortcode('[Sassy_Social_Share]' ); ?>
                        <div class="previous">
                        <?php  previous_post_link('%link', '<i class="fa fa-angle-double-left"></i> Previous post');  ?>
                        <?php next_post_link('%link', 'Next post <i class="fa fa-angle-double-right"></i>'); ?>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
















<?php
//get_sidebar();
get_footer();
