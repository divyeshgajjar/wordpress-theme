<?php

function custom_breadcrumbs($custom_taxonomy=null,$url="") {

    // Settings
    $separator          = '';
    $breadcrums_id      = '';
    $breadcrums_class   = 'bcrumbs';
    $home_title         = 'Home';
    $product_url         = $url;

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'newsevent';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrums
        echo '<ul>';

        // Home page
        echo '<li class="breadcrumb-item"><a href="' . Site_url() . '" title="' . $home_title . '"> <i class="fa fa-home"></i> </a></li>';

       
        // echo '<li class="separator separator-home"> ' . $separator . ' </li>';
        //echo '<li class="item-home"><a class="bread-link bread-home" href="'.$product_url.'" title="Products">Products</a></li>';
        //echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

            echo '<li class="item-current breadcrumb-item item-archive active">' . post_type_archive_title($prefix, false) . '</li>';

        }  else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

            // If post is a custom post type
            $post_type = get_post_type();

             $category = get_terms($custom_taxonomy, array( 'name' => single_cat_title( '', false ),'hide_empty' => 0,) );
       //print("<pre>");print_r($category);
             if(!empty($category)){

            $cat_parents = $category[0]->parent;

            if($cat_parents != '0'){
             $get_cat_parents = get_term( $cat_parents,$custom_taxonomy );

                    echo '<li class="item-cat  breadcrumb-item item-cat-' . $get_cat_parents->term_id . ' item-cat-' . marutiholiday_uc_words($get_cat_parents->name) . '"><a class="bread-cat bread-cat-' . $get_cat_parents->term_id . ' bread-cat-' . $get_cat_parents->slug . '" href="' . get_term_link($get_cat_parents) . '" title="' . $cat_name . '">' . marutiholiday_uc_words($get_cat_parents->name) . '</a></li>';
                    //echo '<li class="separator"> ' . $separator . ' </li>';
            }
             }else{

            // If it is a custom post type display name and link
            if(!empty($post_type)){
            /* if($post_type != 'post' ) {
               $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                //echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type_object  . '" href="' . $post_type_archive . '" title="' . marutiholiday_uc_words($post_type_object->labels->name) . '">' . marutiholiday_uc_words($post_type_object->labels->name) . '</a></li>';
               // echo '<li class="separator"> ' . $separator . ' </li>';

                } 
*/            }
             }

            $custom_tax_name = get_queried_object()->name;

            echo '<li class="breadcrumb-item">  News & Event</li><li class="item-current breadcrumb-item item-archive">' . marutiholiday_uc_words($custom_tax_name) . '</li>';

        } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

               /* echo ' <li class="item-cat  breadcrumb-item item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . get_permalink(92). '" title="Products">Products</a></li>'; */

                echo ' <li class="item-cat  breadcrumb-item item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . get_permalink(127). '"  title="">News & Event</a></li>';

               // echo '<li class="separator"> ' . $separator . ' </li>';

            }
              
            // Get post category info

            $category = get_the_category();

            if(!empty($category)) {

                // Get last category post is in
                $last_category = end(array_values($category));

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat breadcrumb-item">'.$parents.'</li>';
                   // $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);

            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                // modify chirag
                $taxonomy_terms = @array_slice($taxonomy_terms, -1, 1, false);
               // print("<pre>");print_r($taxonomy_terms);print("</pre>");
                // modify chirag
                        $cat_parents =  $taxonomy_terms[0]->parent;
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
               $cat_name       = marutiholiday_uc_words($taxonomy_terms[0]->name);
            }
            if(!empty($cat_parents)){

                    $get_cat_parents = get_term( $cat_parents,$custom_taxonomy );

                    echo '<li class="item-cat  breadcrumb-item item-cat-' . $get_cat_parents->term_id . ' item-cat-' . $get_cat_parents->name . '"><a class="bread-cat  bread-cat-' . $get_cat_parents->term_id . ' bread-cat-' . $get_cat_parents->slug . '" href="' . get_term_link($get_cat_parents) . '" title="' . $cat_name . '">' . $get_cat_parents->name . '</a></li>';
                    //echo '<li class="separator"> ' . $separator . ' </li>';

            }
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current breadcrumb-item item-' . $post->ID . ' active">'  . get_the_title() . '</li>';

            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {

                echo '<li class="item-cat  breadcrumb-item item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . get_permalink(92). '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                //echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current breadcrumb-item item-' . $post->ID . ' active"><p class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</p></li>';

            } else {

      /* echo '<li class="item-current breadcrumb-item item-' . $post->ID . ' active">' . get_the_title() . '</li>';*/
        echo '<li class="item-current breadcrumb-item item-' . $post->ID . '">' . get_the_title() . '</li>';

            }

        } else if ( is_category() ) {

            // Category page
            echo '<li class="item-current breadcrumb-item item-cat"><p class="bread-current bread-cat">' . single_cat_title('', false) . '</p></li>';

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                foreach ( $anc as $ancestor ) {
           $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" title="' . get_the_title($ancestor) . '" href="'.get_permalink($ancestor).'">' . marutiholiday_uc_words(get_the_title($ancestor)) . '</a></li>';
                    //$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;
                // Current page
                echo '<li class="item-current breadcrumb-item item-' . $post->ID . '">' . marutiholiday_uc_words(get_the_title()) . '</li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current breadcrumb-item item-' . $post->ID . ' ">' . marutiholiday_uc_words(get_the_title()) . '</li>';

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = marutiholiday_uc_words($terms[0]->name);

            // Display the tag name
            echo '<li class="item-current breadcrumb-item item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><p class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</p></li>';

        } elseif ( is_day() ) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
           // echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            //echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current breadcrumb-item item-' . get_the_time('j') . '"><p class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</p></li>';

        } else if ( is_month() ) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            //echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><p class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</p></li>';

        } else if ( is_year() ) {

            // Display year archive
            echo '<li class="item-current breadcrumb-item item-current-' . get_the_time('Y') . '"><p class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</p></li>';

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo '<li class="item-current breadcrumb-item item-current-' . $userdata->user_nicename . '"><p class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</p></li>';

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="item-current breadcrumb-item item-current-' . get_query_var('paged') . '"><p class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</p></li>';

        } else if ( is_search() ) {

            // Search results page
            echo '<li class="item-current breadcrumb-item item-current-' . get_search_query() . '"><p class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</p></li>';

        } elseif ( is_404() ) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ul>';

    }

}
