<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package divyesh
 */


?>

            <div class="articles">
                   <?php divyesh_custom_get_image(); ?>
                  <div class="articles-content">
                    <?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h3>', '</h3></a>' ); ?>
                        <ul>
                        <?php divyesh_entry_footer();  ?>
                      	 <?php divyesh_posted_on();  ?>
                        </ul>
<?php
   echo apply_filters('the_content',wp_trim_words($post->post_content,25));
?>
                        <a class="readmore" href="<?php echo esc_url( get_permalink() ); ?>">read more</a>
                        <div class="float-right tag-share">
                          <?php echo do_shortcode('[Sassy_Social_Share]' ); ?>
                        </div>
                    </div>
              </div>                 
        </div>

