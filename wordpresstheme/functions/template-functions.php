<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package divyesh
 */

if ( ! function_exists( 'divyesh_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function divyesh_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
	
		$date = date('d-m-Y',strtotime(get_the_date()));		
		$new = date('j<\s\up>S</\s\up> F, Y', strtotime($date));
        $new=(($date)?$new:''); 

        echo '<li><i class="fa fa-clock-o"></i>' . $new . '</li>';


}
endif;



if ( ! function_exists( 'divyesh_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function divyesh_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'divyesh' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'divyesh_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function divyesh_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'divyesh' ) );
			if ( $categories_list ) {

				
				/* translators: 1: list of categories. */
				printf( '<li><i class="fa fa-file-o"></i> %s</li>', $categories_list ); // WPCS: XSS OK.
			//	printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'divyesh' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'divyesh' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				//printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'divyesh' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}


	

		
	}
endif;

if ( ! function_exists( 'divyesh_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */

	function divyesh_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :
			?>

		<div class="col-md-4 pad0"> <span><?php the_post_thumbnail(); ?></span></div>

		<?php else : ?>

			<div class="col-md-4 pad0"> <span><?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?></span></div>

		<?php
		endif; // End is_singular().
	}
endif;


function divyesh_custom_get_image(){
	global $post;			
	$image_url = get_field('article_image',$post->ID);
	$youtub_url = get_field('youtub_link',$post->ID);
	if(!empty($image_url) && empty($youtub_url)){	
		echo "<div class='col-md-4 pad0'> <span><img src=".$image_url." alt='articles' class='img-responsive'></span></div><div class='col-md-8'>";
	}else if(!empty($youtub_url) && empty($image_url)){
		echo '<div class="col-md-4 pad0"> <span><iframe src="'.$youtub_url.'" width="100%" height="280" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></span></div><div class="col-md-8">';
	}else{		
		/*echo "<div class='col-md-4 pad0'><span><img src=".get_template_directory_uri()."/images/no-image.jpg' alt='articles' class='img-responsive'></span></div>";*/

		echo "<div class='col-md-12'>";
	}
}

function divyesh_post_single_thumbnail(){
	global $post;			
	$image_url = get_field('article_image',$post->ID);
	$youtub_url = get_field('youtub_link',$post->ID);
	if(!empty($image_url) && empty($youtub_url)){	
		echo "<span><img src=".$image_url." alt='articles' class='img-responsive'></span>";
	}
	if(!empty($youtub_url) && empty($image_url)){
		echo '<span><iframe src="'.$youtub_url.'" width="990" height="450" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></span>';
	}
	
}
