<?php

/*
Plugin Name: Souje Components
Plugin URI: http://www.burnhambox.com/souje-shop
Description: Components for Souje theme.
Version: 1.1.2
Author: Burnhambox
Author URI: http://www.burnhambox.com
License: GNU
*/

/* Share Icons */
if ( !function_exists( 'souje_shortcode_share' ) ) {
  function souje_shortcode_share( $atts ) {

  	$output = '';

  	$a = shortcode_atts( array(
        'ID' => '0',
    ), $atts );

  	if ( $a['ID'] == '' ) { $a['ID'] = 0; }

    //

    $souje_show_share = get_theme_mod( 'souje_show_share', 1 );
    if ( is_page() ) {
    	$souje_show_share = get_theme_mod( 'souje_show_share_page', 1 );
    }
    $meta_share = get_post_meta( $a['ID'], 'souje-share-meta-box-checkbox', true );
    if ( $meta_share ) {
    	$souje_show_share = 0;
    }

    if ( $souje_show_share && ( is_single() || is_page() ) ) {
    	$output .= '<div class="souje_widget_social">';
          $output .= '<ul class="clearfix">';
              $output .= '<li class="share-facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url( get_permalink( $a['ID'] ) ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
              $output .= '<li class="share-twitter"><a href="https://twitter.com/share?url=' . esc_url( get_permalink( $a['ID'] ) ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
              $output .= '<li class="share-google"><a href="https://plus.google.com/share?url=' . esc_url( get_permalink( $a['ID'] ) ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
          $output .= '</ul>';
      $output .= '</div>';
    }

  	return $output;

  }
}
add_shortcode( 'souje_share', 'souje_shortcode_share' );
/* */

class souje_widget_ads extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_ads', esc_html__( '11. Souje Widget: Ads', 'souje' ), array( 'description' => esc_html__( "You can place your Ad code into this widget.", 'souje' ) ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

		<p><textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text') ); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( current_user_can( 'unfiltered_html' ) ) {

			$instance['text'] = $new_instance['text'];

		} else {

			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );

		}

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

        <div id="<?php echo esc_attr( $this->id ); ?>" class="<?php if ( function_exists( 'souje_footer_widgets_outer' ) ) { souje_footer_widgets_outer( $id ); } ?>souje_widget_ads clearfix"><?php echo apply_filters( 'widget_text', $instance['text'] ); ?></div>

		<?php

	}

	function defaults() {

		$defaults = array( 'text' => '' );
		return $defaults;

	}

}

class souje_widget_category_posts extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_category_posts', esc_html__( '03. Souje Widget: Category/Tag Posts', 'souje' ), array( 'description' => esc_html__( "Display the posts belong to a specific category or tag.", 'souje' ), 'classname' => 'souje_widget_category_posts' ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

        <p><?php echo esc_html__( 'Title:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" class="widefat" /></p>
        <p><?php echo esc_html__( 'Number of posts to show:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>
        <p><?php echo esc_html__( 'Taxonomy:', 'souje' ); ?></p>
        <p>
        <input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'list_type' ) ); ?>" type="radio" value="cat" <?php esc_attr( checked( $instance['list_type'], 'cat' ) ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php echo esc_html__( 'Category Posts', 'souje' ); ?></label>
        </p>
        <p>
        <input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'tag' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'list_type' ) ); ?>" type="radio" value="tag" <?php esc_attr( checked( $instance['list_type'], 'tag' ) ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'tag' ) ); ?>"><?php echo esc_html__( 'Tag Posts', 'souje' ); ?></label>
        </p>
        <hr />
        <p><strong><?php echo esc_html__( 'Categories', 'souje' ); ?></strong></p>
        <p>
        <?php
		$cat_args = array(
			'show_option_none' => esc_html__( '- Select a Category -', 'souje' ),
			'show_count' => 1,
			'hide_empty' => 0,
			'id' => esc_attr( $this->get_field_name( 'category' ) ),
			'name' => esc_attr( $this->get_field_name( 'category' ) ),
			'selected' => esc_attr( $instance['category'] ),
			'class' => 'postform widefat',
		);
		wp_dropdown_categories( $cat_args );
		?>
		</p>
        <p><em><?php echo esc_html__( 'Only used if "Category Posts" is selected.', 'souje' ); ?></em></p>
        <p><?php echo esc_html__( 'Excluded Categories:', 'souje' ); ?><br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'exclude_cats' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['exclude_cats'] ); ?>" /></p>
        <p><em><?php echo esc_html__( 'Useful when a post has more than one category.', 'souje' ); ?><br />
        <?php echo esc_html__( 'Write category IDs you want to hide. Use comma (,) between them. Example: 2,5,8', 'souje' ); ?></em></p>
        <hr />
        <p><strong><?php echo esc_html__( 'Tags', 'souje' ); ?></strong></p>
        <p>
        <?php
		$tag_args = array(
			'show_option_none' => esc_html__( '- Select a Tag -', 'souje' ),
			'show_count' => 1,
			'hide_empty' => 0,
			'id' => esc_attr( $this->get_field_name( 'tag' ) ),
			'name' => esc_attr( $this->get_field_name( 'tag' ) ),
			'selected' => esc_attr( $instance['tag'] ),
			'class' => 'postform widefat',
			'taxonomy' => 'post_tag',
		);
		wp_dropdown_categories( $tag_args );
		?>
		</p>
        <p><em><?php echo esc_html__( 'Only used if "Tag Posts" is selected.', 'souje' ); ?></em></p>
        <p><?php echo esc_html__( 'Excluded Tags:', 'souje' ); ?><br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'exclude_tags' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['exclude_tags'] ); ?>" /></p>
        <p><em><?php echo esc_html__( 'Useful when a post has more than one tag.', 'souje' ); ?><br />
        <?php echo esc_html__( 'Write tag IDs you want to hide.', 'souje' ); ?></em></p>
        <hr />
        <p><?php echo esc_html__( 'Excluded Posts:', 'souje' ); ?><br />
        <input name="<?php echo esc_attr( $this->get_field_name( 'exclude_posts' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['exclude_posts'] ); ?>" /></p>
        <p><em><?php echo esc_html__( 'Write post IDs you want to hide.', 'souje' ); ?></em></p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = $new_instance['name'] ? strip_tags( $new_instance['name'] ) : esc_html__( 'Category Posts', 'souje' );
		$instance['count'] = $new_instance['count'] ? strip_tags( $new_instance['count'] ) : 5;
		$instance['category'] = $new_instance['category'];
		$instance['tag'] = $new_instance['tag'];
		$instance['list_type'] = $new_instance['list_type'];
		$instance['exclude_cats'] = $new_instance['exclude_cats'];
		$instance['exclude_tags'] = $new_instance['exclude_tags'];
		$instance['exclude_posts'] = $new_instance['exclude_posts'];

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		echo wp_kses_post( $before_widget );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$count = $instance['count'];
		$category = $instance['category'];
		$tag = $instance['tag'];
		$list_type = $instance['list_type'];
		$exclude_cats = $instance['exclude_cats'];
		$exclude_tags = $instance['exclude_tags'];
		$exclude_posts = $instance['exclude_posts'];

		$cpw_rand = rand( 1, 9999999 );

		echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

		$posts_to_exclude = explode( ',', esc_attr( $exclude_posts ) );

		if ( $list_type == 'cat' ) {

			$cats_to_exclude = explode( ',', esc_attr( $exclude_cats ) );

			$loop_args = array(

				'showposts' => esc_attr( $count ),
				'cat' => $category,
				'ignore_sticky_posts' => 1,
				'category__not_in' => $cats_to_exclude,
				'post__not_in' => $posts_to_exclude

			);

		} else {

			$tags_to_exclude = explode( ',', esc_attr( $exclude_tags ) );

			$loop_args = array(

				'showposts' => esc_attr( $count ),
				'tag_id' => $tag,
				'ignore_sticky_posts' => 1,
				'tag__not_in' => $tags_to_exclude,
				'post__not_in' => $posts_to_exclude

			);

		}

		$widget_query = new WP_Query( $loop_args );

		while ( $widget_query->have_posts() ) : $widget_query->the_post();

		?>

			<a class="posts-widget-wrapper clearfix <?php echo esc_attr( 'cpw-' . $cpw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
				<?php echo the_post_thumbnail( 'souje-small-thumbnail-image' ); ?>
				<div class="posts-widget-container <?php if ( has_post_thumbnail() ) { echo 'posts-widget-container-with-t'; } ?>">
					<div class="table-cell-middle"><?php if ( get_theme_mod( 'souje_show_widget_date', 0 ) ) { ?><div class="posts-widget-date"><?php echo get_the_date(); ?></div><?php } ?><div class="posts-widget-title"><?php echo get_the_title(); ?></div></div>
				</div>
			</a>

		<?php endwhile;

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

	}

	function defaults() {

		$defaults = array( 'name' => esc_html__( 'Category Posts', 'souje' ), 'count' => 5, 'category' => -1, 'tag' => -1, 'list_type' => 'cat', 'exclude_cats' => '', 'exclude_tags' => '', 'exclude_posts' => '' );
		return $defaults;

	}

}

class souje_widget_empty_space extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_empty_space', esc_html__( '12. Souje Widget: Empty Space', 'souje' ), array( 'description' => esc_html__( "An extra empty space between your widgets.", 'souje' ) ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

        <p><?php echo esc_html__( 'Height:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['count'] = $new_instance['count'] ? strip_tags( $new_instance['count'] ) : 40;

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		$count = apply_filters( 'widget_title', $instance['count'] );

		?>

		<div id="<?php echo esc_attr( $this->id ); ?>" class="<?php if ( function_exists( 'souje_footer_widgets_outer' ) ) { souje_footer_widgets_outer( $id ); } ?>souje_widget_empty_space" style="height: <?php echo esc_attr( $count ); ?>px;"></div>

        <?php

	}

	function defaults() {

		$defaults = array( 'count' => 40 );
		return $defaults;

	}

}

class souje_widget_facebook extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_facebook', esc_html__( '09. Souje Widget: Find Us on Facebook', 'souje' ), array( 'description' => esc_html__( "Show your Facebook page's lovers.", 'souje' ) ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

		<p><?php echo esc_html__( 'Facebook Page Username:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'page' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['page'] ); ?>" class="widefat" /></p>
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php echo esc_html__( 'Height (min. 130):', 'souje' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['height'] ); ?>" style="width: 55px;" />
		</p>
        <p>
        <input class="checkbox" type="checkbox" value="1" <?php esc_attr( checked( $instance['faces'], 1 ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'faces' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'faces' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'faces' ) ); ?>"><?php echo esc_html__( "Show Friend's Faces ('Height' value must be at least 215.)", 'souje' ); ?></label>
		</p>
        <p>
        <input class="checkbox" type="checkbox" value="1" <?php esc_attr( checked( $instance['posts'], 1 ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'posts' ) ); ?>"><?php echo esc_html__( "Show Page Posts ('Height' value must be at least 300.)", 'souje' ); ?></label>
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['page'] = $new_instance['page'] ? strip_tags( $new_instance['page'] ) : 'burnhambox';
		$instance['height'] = $new_instance['height'] ? strip_tags( $new_instance['height'] ) : 400;
		$instance['faces'] = !empty( $new_instance['faces'] );
		$instance['posts'] = !empty( $new_instance['posts'] );

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		$page = apply_filters( 'widget_title', $instance['page'] );
		$height = $instance['height'];
		$faces = $instance['faces'];
		$posts = $instance['posts'];

		?>

        <div id="<?php echo esc_attr( $this->id ); ?>" class="<?php if ( function_exists( 'souje_footer_widgets_outer' ) ) { souje_footer_widgets_outer( $id ); } ?>souje_widget_facebook">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              <?php $facebook_sdk_language = get_bloginfo( 'language' ); ?>
              js.src = "//connect.facebook.net/" + "<?php echo str_replace( '-', '_', $facebook_sdk_language ); ?>" + "/sdk.js#xfbml=1&version=v2.4";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-page" data-href="https://www.facebook.com/<?php echo esc_attr( $page ); ?>" data-width="300" data-height="<?php echo esc_attr( $height ); ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="<?php if ( $faces ) { echo 'true'; } else { echo 'false'; } ?>" data-show-posts="<?php if ( $posts ) { echo 'true'; } else { echo 'false'; } ?>"><div class="fb-xfbml-parse-ignore"></div></div>
        </div>

        <?php

	}

	function defaults() {

		$defaults = array( 'page' => 'burnhambox', 'height' => 400, 'faces' => 1, 'posts' => 1 );
		return $defaults;

	}

}

class souje_widget_image extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_image', esc_html__( '06. Souje Widget: Image', 'souje' ), array( 'description' => esc_html__( "Display an image with an optional title.", 'souje' ) ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

        <p><?php echo esc_html__( 'Image Path:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'path' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['path'] ); ?>" class="widefat" /></p>
        <p>
        <em><?php echo esc_html__( 'To find the image path, go to "Media > Library", click the image and see the "URL" field.', 'souje' ); ?></em>
        </p>
        <p><?php echo esc_html__( 'Title:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" class="widefat" /></p>
        <p><?php echo esc_html__( 'Link:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['link'] ); ?>" class="widefat" /></p>
        <p>
		<input class="checkbox" type="checkbox" value="1" <?php esc_attr( checked( $instance['target'], 1 ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php echo esc_html__( 'Open in new window', 'souje' ); ?></label>
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

	    $instance['name'] = $new_instance['name'];
		$instance['path'] = $new_instance['path'];
		$instance['link'] = $new_instance['link'];
		$instance['target'] = !empty( $new_instance['target'] );

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$path = $instance['path'];
		$link = $instance['link'];
		$target = $instance['target'];

		$iw_rand = rand( 1, 9999999 );

		?>

        <div id="<?php echo esc_attr( $this->id ); ?>" class="<?php if ( function_exists( 'souje_footer_widgets_outer' ) ) { souje_footer_widgets_outer( $id ); } ?>souje_widget_image <?php echo esc_attr( 'iw-' . $iw_rand ); ?>">
            <div class="image-widget-wrapper clearfix"><?php if ( $link ) { echo '<a href="' . esc_attr( $link ) . '" target="'; if ( $target ) { echo '_blank'; } else { echo '_self'; } echo '">'; } ?>
            <?php if ( $path ) { ?><img alt="img-alt" src="<?php echo esc_attr( $path ); ?>" /><?php } ?>
            <?php if ( $name ) { ?>
                <div class="image-widget-container fading">
                    <div class="iwt-outer"><div class="image-widget-title"><span class="iwt-border"><?php echo esc_attr( $name ); ?></span></div></div>
                </div>
            <?php } ?>
            <?php if ( $link ) { echo '</a>'; } ?></div>
        </div>

		<?php

	}

	function defaults() {

		$defaults = array( 'name' => esc_html__( 'About Me', 'souje' ), 'path' => '', 'link' => '', 'target' => 0 );
		return $defaults;

	}

}

class souje_widget_popular_posts extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_popular_posts', esc_html__( '02. Souje Widget: Popular Posts', 'souje' ), array( 'description' => esc_html__( "Display the most popular posts.", 'souje' ), 'classname' => 'souje_widget_popular_posts' ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

		<p><?php echo esc_html__( 'Title:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" class="widefat" /></p>
        <p><?php echo esc_html__( 'Number of posts to show:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>
        <p>
        <input class="checkbox" type="checkbox" value="1" <?php esc_attr( checked( $instance['day_limit'], 1 ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'day_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'day_limit' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'day_limit' ) ); ?>"><?php echo esc_html__( 'Include last 60 days only', 'souje' ); ?></label>
		</p>
        <p><?php echo esc_html__( 'Popularity Type:', 'souje' ); ?></p>
        <p>
        <input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'comment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'popularity_base' ) ); ?>" type="radio" value="comment" <?php esc_attr( checked( $instance['popularity_base'], 'comment' ) ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'comment' ) ); ?>"><?php echo esc_html__( 'Comment Based', 'souje' ); ?></label>
        </p>
        <p>
        <input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'view' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'popularity_base' ) ); ?>" type="radio" value="view" <?php esc_attr( checked( $instance['popularity_base'], 'view' ) ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'view' ) ); ?>"><?php echo esc_html__( 'View Based', 'souje' ); ?></label>
        </p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = $new_instance['name'] ? strip_tags( $new_instance['name'] ) : esc_html__( 'Popular Posts', 'souje' );
		$instance['count'] = $new_instance['count'] ? strip_tags( $new_instance['count'] ) : 5;
		$instance['day_limit'] = !empty( $new_instance['day_limit'] );
		$instance['popularity_base'] = $new_instance['popularity_base'];

		return $instance;

	}

	function filter_where( $where = '' ) {

		$where .= " AND post_date > '" . date( 'Y-m-d', strtotime( '-' . 60 .' days' ) ) . "'";
		return $where;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		echo wp_kses_post( $before_widget );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$count = $instance['count'];
		$day_limit = $instance['day_limit'];
		$popularity_base = $instance['popularity_base'];

		$ppw_rand = rand( 1, 9999999 );

		echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

		if ( $popularity_base == 'comment' ) {

			$loop_args = array(

				'posts_per_page' => esc_attr( $count ),
				'orderby' => 'comment_count',
				'ignore_sticky_posts' => 1

			);

		} else {

			$loop_args = array(

				'posts_per_page' => esc_attr( $count ),
				'orderby'   => 'meta_value_num',
				'meta_key'  => 'post_views_count',
				'ignore_sticky_posts' => 1

			);

		}

		if ( $day_limit ) { add_filter( 'posts_where', array( $this, 'filter_where' ) ); }
		$widget_query = new WP_Query( $loop_args );
		if ( $day_limit ) { remove_filter( 'posts_where', array( $this, 'filter_where' ) ); }

		while( $widget_query->have_posts() ) : $widget_query->the_post();

		?>

            <a class="posts-widget-wrapper clearfix <?php echo esc_attr( 'ppw-' . $ppw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
				<?php echo the_post_thumbnail( 'souje-small-thumbnail-image' ); ?>
				<div class="posts-widget-container <?php if ( has_post_thumbnail() ) { echo 'posts-widget-container-with-t'; } ?>">
					<div class="table-cell-middle"><?php if ( get_theme_mod( 'souje_show_widget_date', 0 ) ) { ?><div class="posts-widget-date"><?php echo get_the_date(); ?></div><?php } ?><div class="posts-widget-title"><?php echo get_the_title(); ?></div></div>
				</div>
			</a>

		<?php endwhile;

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

	}

	function defaults() {

		$defaults = array( 'name' => esc_html__( 'Popular Posts', 'souje' ), 'count' => 5, 'day_limit' => 1, 'popularity_base' => 'comment' );
		return $defaults;

	}

}

class souje_widget_post extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_post', esc_html__( '05. Souje Widget: Post', 'souje' ), array( 'description' => esc_html__( "Display a single post.", 'souje' ) ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		global $post;
		$posts = get_posts( array( 'numberposts' => -1 ) );

		?>

        <p><?php echo esc_html__( 'Original Post:', 'souje' ); ?>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_name( 'post_id' ) ); ?>"  name="<?php echo esc_attr( $this->get_field_name( 'post_id' ) ); ?>">
        	<option <?php echo esc_attr( $instance['post_id'] ) == 0 ? 'selected="selected"' : '';?> value="0"><?php echo esc_html__( '- Select a Post -', 'souje' ); ?></option>
			<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
        	<option <?php if ( $post->ID == esc_attr( $instance['post_id'] ) ) { echo 'selected="selected"'; } ?> value="<?php echo esc_attr( $post->ID ); ?>"><?php the_title(); ?></option>
			<?php endforeach; ?>
		</select>
		</p>
        <p><?php echo esc_html__( 'Alternative Post:', 'souje' ); ?>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_name( 'post_id_alt' ) ); ?>"  name="<?php echo esc_attr( $this->get_field_name( 'post_id_alt' ) ); ?>">
        	<option <?php echo esc_attr( $instance['post_id_alt'] ) == 0 ? 'selected="selected"' : '';?> value="0"><?php echo esc_html__( '- Select an Alternative Post -', 'souje' ); ?></option>
			<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
        	<option <?php if ( $post->ID == esc_attr( $instance['post_id_alt'] ) ) { echo 'selected="selected"'; } ?> value="<?php echo esc_attr( $post->ID ); ?>"><?php the_title(); ?></option>
			<?php endforeach; ?>
		</select>
		</p>
        <p>
        <em><?php echo esc_html__( 'To avoid duplicated posts, you can set an alternative post which will be shown instead of the original one, on the original post page. Or simply hide this widget on the original post page by checking the box below.', 'souje' ); ?></em>
        </p>
        <p>
		<input class="checkbox" type="checkbox" value="1" <?php esc_attr( checked( $instance['hide_widget'], 1 ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'hide_widget' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_widget' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'hide_widget' ) ); ?>"><?php echo esc_html__( 'Hide this widget on the original post page', 'souje' ); ?></label>
		</p>
        <p>
		<input class="checkbox" type="checkbox" value="1" <?php esc_attr( checked( $instance['target'], 1 ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php echo esc_html__( 'Open in new window', 'souje' ); ?></label>
		</p>
        <p>
        <input class="checkbox" type="checkbox" value="1" <?php esc_attr( checked( $instance['date'], 1 ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php echo esc_html__( 'Display post date', 'souje' ); ?></label>
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['date'] = !empty( $new_instance['date'] );
		$instance['post_id'] = $new_instance['post_id'];
		$instance['post_id_alt'] = $new_instance['post_id_alt'];
		$instance['hide_widget'] = !empty( $new_instance['hide_widget'] );
		$instance['target'] = !empty( $new_instance['target'] );

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		$date = $instance['date'];
		$post_id = $instance['post_id'];
		$post_id_alt = $instance['post_id_alt'];
		$hide_widget = $instance['hide_widget'];
		$target = $instance['target'];

		$pw_rand = rand( 1, 9999999 );

		if ( $post_id != 0 && ( get_the_ID() != $post_id || ( get_the_ID() == $post_id && !$hide_widget ) ) ) {

			if ( get_the_ID() == $post_id && $post_id_alt != 0 ) { $post_id = $post_id_alt; }

			$widget_query = new WP_Query( array( 'p' => $post_id ) );

			while ( $widget_query->have_posts() ) : $widget_query->the_post(); ?>

                <div id="<?php echo esc_attr( $this->id ); ?>" class="<?php if ( function_exists( 'souje_footer_widgets_outer' ) ) { souje_footer_widgets_outer( $id ); } ?>souje_widget_post <?php echo esc_attr( 'pw-' . $pw_rand ); ?>">
					<?php echo '<a class="clearfix" href="' . esc_url( get_the_permalink() ) . '" target="'; if ( $target ) { echo '_blank'; } else { echo '_self'; } echo '">'; ?>
                    <?php the_post_thumbnail( 'souje-thumbnail-image' ); ?>
                    <div class="post-widget-container fading<?php if ( !has_post_thumbnail() ) { echo ' pwc-woi'; } ?>">
                        <?php if ( $date ) { ?><div class="post-widget-date"><?php echo get_the_date(); ?></div><?php } ?>
                        <div class="post-widget-title"><?php the_title(); ?></div>
                    </div>
                    </a>
                </div>

			<?php endwhile;

			wp_reset_postdata();

		}

	}

	function defaults() {

		$defaults = array( 'date' => 1, 'post_id' => 0, 'post_id_alt' => 0, 'hide_widget' => 0, 'target' => 0 );
		return $defaults;

	}

}

class souje_widget_recent_comments extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_recent_comments', esc_html__( '07. Souje Widget: Recent Comments', 'souje' ), array( 'description' => esc_html__( "Display the latest comments.", 'souje' ), 'classname' => 'souje_widget_recent_comments' ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

		<p><?php echo esc_html__( 'Title:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" class="widefat" /></p>
        <p><?php echo esc_html__( 'Number of comments to show:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>
        <p>
        <input class="checkbox" type="checkbox" value="1" <?php esc_attr( checked( $instance['avatar'], 1 ) ); ?> id="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'avatar' ) ); ?>"><?php echo esc_html__( 'Display avatars', 'souje' ); ?></label>
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = $new_instance['name'] ? strip_tags( $new_instance['name'] ) : esc_html__( 'Comments', 'souje' );
		$instance['count'] = $new_instance['count'] ? strip_tags( $new_instance['count'] ) : 5;
		$instance['avatar'] = !empty( $new_instance['avatar'] );

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		echo wp_kses_post( $before_widget );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$count = $instance['count'];
		$avatar = $instance['avatar'];

		echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

		$rcw_rand = rand( 1, 9999999 );
		$avatar_size = 60;
		$approvedCounter = 0;

		$comments_query = new WP_Comment_Query();
		$comments = $comments_query->query( array( 'number' => 50 ) );

		if ( $comments ) {

			foreach( $comments as $comment ) {

				if ( $comment->comment_approved && $approvedCounter < $count && !post_password_required( $comment->comment_post_ID ) ) {

					$approvedCounter ++;

					$link = get_permalink( $comment->comment_post_ID ) . '#comment-' . esc_attr( $comment->comment_ID );

					?>

                    <a class="posts-widget-wrapper clearfix <?php echo esc_attr( 'rcw-' . $rcw_rand ); ?>" href="<?php echo esc_url ( $link ); ?>">
                        <?php if ( $avatar && get_option( 'show_avatars' ) ) { ?><?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?><?php } ?>
                        <div class="posts-widget-container <?php if ( $avatar && get_option( 'show_avatars' ) ) { echo 'posts-widget-container-with-t'; } ?>">
                            <div class="table-cell-middle"><div class="posts-widget-date"><?php echo get_comment_author( $comment->comment_ID ); ?></div><div class="posts-widget-title"><?php echo get_the_title( $comment->comment_post_ID ); ?></div></div>
                        </div>
                    </a>

				<?php }

			}

		}

		echo wp_kses_post( $after_widget );

	}

	function defaults() {

		$defaults = array( 'name' => esc_html__( 'Comments', 'souje' ), 'count' => 5, 'avatar' => 1 );
		return $defaults;

	}

}

class souje_widget_recent_posts extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_recent_posts', esc_html__( '01. Souje Widget: Recent/Random Posts', 'souje' ), array( 'description' => esc_html__( "Display the most recent or random posts.", 'souje' ), 'classname' => 'souje_widget_recent_posts' ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

		<p><?php echo esc_html__( 'Title:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" class="widefat" /></p>
        <p><?php echo esc_html__( 'Number of posts to show:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['count'] ); ?>" style="width: 50px;" /></p>
        <p><?php echo esc_html__( 'Display Options:', 'souje' ); ?></p>
        <p>
        <input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'recent' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'list_type' ) ); ?>" type="radio" value="recent" <?php esc_attr( checked( $instance['list_type'], 'recent' ) ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'recent' ) ); ?>"><?php echo esc_html__( 'Show Recent Posts', 'souje' ); ?></label>
        </p>
        <p><input class="radio" id="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'list_type' ) ); ?>" type="radio" value="random" <?php esc_attr( checked( $instance['list_type'], 'random' ) ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>"><?php echo esc_html__( 'Show Random Posts', 'souje' ); ?></label>
        </p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = $new_instance['name'] ? strip_tags( $new_instance['name'] ) : esc_html__( 'Recent Posts', 'souje' );
		$instance['count'] = $new_instance['count'] ? strip_tags( $new_instance['count'] ) : 5;
		$instance['list_type'] = $new_instance['list_type'];

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		echo wp_kses_post( $before_widget );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$count = $instance['count'];
		$list_type = $instance['list_type'];

		$rpw_rand = rand( 1, 9999999 );

		echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

		if ( $list_type == 'recent' ) {

			$loop_args = array(

				'showposts' => esc_attr( $count ),
				'ignore_sticky_posts' => 1

			);

		} else {

			$loop_args = array(

				'showposts' => esc_attr( $count ),
				'orderby' => 'rand',
				'ignore_sticky_posts' => 1

			);

		}

		$widget_query = new WP_Query( $loop_args );

		while ( $widget_query->have_posts() ) : $widget_query->the_post();

		?>

            <a class="posts-widget-wrapper clearfix <?php echo esc_attr( 'rpw-' . $rpw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
				<?php echo the_post_thumbnail( 'souje-small-thumbnail-image' ); ?>
				<div class="posts-widget-container <?php if ( has_post_thumbnail() ) { echo 'posts-widget-container-with-t'; } ?>">
					<div class="table-cell-middle"><?php if ( get_theme_mod( 'souje_show_widget_date', 0 ) ) { ?><div class="posts-widget-date"><?php echo get_the_date(); ?></div><?php } ?><div class="posts-widget-title"><?php echo get_the_title(); ?></div></div>
				</div>
			</a>

		<?php endwhile;

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

	}

	function defaults() {

		$defaults = array( 'name' => esc_html__( 'Recent Posts', 'souje' ), 'count' => 5, 'list_type' => 'recent' );
		return $defaults;

	}

}

class souje_widget_search extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_search', esc_html__( '10. Souje Widget: Search', 'souje' ), array( 'description' => esc_html__( "A search form for your site.", 'souje' ) ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		?>

        <div id="<?php echo esc_attr( $this->id ); ?>" class="<?php if ( function_exists( 'souje_footer_widgets_outer' ) ) { souje_footer_widgets_outer( $id ); } ?>clearfix souje_widget_search">
            <form class="search-widget-form" role="search" method="get" id="swf-id" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input class="search-widget-input" type="text" value="<?php echo esc_attr( souje_translation( '_Keyword' ) ); ?>" name="s" id="swi-id" />
            </form>
            <div class="search-widget-icon fading"><i class="fa fa-search"></i></div>
        </div>

        <?php

	}

	function defaults() {

		$defaults = array();
		return $defaults;

	}

}

class souje_widget_selected_posts extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_selected_posts', esc_html__( '04. Souje Widget: Selected Posts', 'souje' ), array( 'description' => esc_html__( "Display the posts you've selected.", 'souje' ), 'classname' => 'souje_widget_selected_posts' ) );

	}

	function form( $instance ) {

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		global $post;
		$posts = get_posts( array( 'numberposts' => -1 ) );
		$first_selector = esc_html__( '- Select a Post -', 'souje' );

		?>

        <p><?php echo esc_html__( 'Title:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" class="widefat" /></p>

        <?php

		for ( $x = 0; $x < 5; $x++ ) {

			echo '<p>' . esc_html__( 'Post', 'souje' ) . ' ' . ( $x + 1 ) . ':';
			echo '<select class="widefat" id="' . esc_attr( $this->get_field_name( 'post_id_' . $x ) ) . '"  name="' . esc_attr( $this->get_field_name( 'post_id_' . $x ) ) . '">';
			echo '<option ';
			echo esc_attr( $instance['post_id_' . $x ] ) == 0 ? 'selected="selected"' : '';
			echo ' value="0">' . esc_html( $first_selector ) . '</option>';
			foreach( $posts as $post ) : setup_postdata( $post );
				echo '<option ';
				if ( $post->ID == esc_attr( $instance['post_id_' . $x ] ) ) { echo 'selected="selected"'; }
				echo ' value="' . esc_attr( $post->ID ) . '">' . get_the_title() . '</option>';
			endforeach;
			echo '</select></p>';

		}

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name'] = $new_instance['name'] ? strip_tags( $new_instance['name'] ) : esc_html__( 'Selected Posts', 'souje' );
		$instance['post_id_0'] = $new_instance['post_id_0'];
		$instance['post_id_1'] = $new_instance['post_id_1'];
		$instance['post_id_2'] = $new_instance['post_id_2'];
		$instance['post_id_3'] = $new_instance['post_id_3'];
		$instance['post_id_4'] = $new_instance['post_id_4'];

		return $instance;

	}

	function widget( $args, $instance ) {

		extract( $args );

		$instance = wp_parse_args( ( array ) $instance, $this->defaults() );

		echo wp_kses_post( $before_widget );

		$name = apply_filters( 'widget_title', $instance['name'] );
		$post_id_0 = $instance['post_id_0'];
		$post_id_1 = $instance['post_id_1'];
		$post_id_2 = $instance['post_id_2'];
		$post_id_3 = $instance['post_id_3'];
		$post_id_4 = $instance['post_id_4'];

		$spw_rand = rand( 1, 9999999 );

		echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

		$loop_args = array(

			'post_type' => 'post',
			'post__in' => array( $post_id_0, $post_id_1, $post_id_2, $post_id_3, $post_id_4 ),
			'ignore_sticky_posts' => 1,
			'orderby' => 'post__in'

		);

		$widget_query = new WP_Query( $loop_args );

		while ( $widget_query->have_posts() ) : $widget_query->the_post();

		?>

			<a class="posts-widget-wrapper clearfix <?php echo esc_attr( 'spw-' . $spw_rand ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
				<?php echo the_post_thumbnail( 'souje-small-thumbnail-image' ); ?>
				<div class="posts-widget-container <?php if ( has_post_thumbnail() ) { echo 'posts-widget-container-with-t'; } ?>">
					<div class="table-cell-middle"><?php if ( get_theme_mod( 'souje_show_widget_date', 0 ) ) { ?><div class="posts-widget-date"><?php echo get_the_date(); ?></div><?php } ?><div class="posts-widget-title"><?php echo get_the_title(); ?></div></div>
				</div>
			</a>

		<?php endwhile;

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

	}

	function defaults() {

		$defaults = array( 'name' => esc_html__( 'Selected Posts', 'souje' ), 'post_id_0' => 0, 'post_id_1' => 0, 'post_id_2' => 0, 'post_id_3' => 0, 'post_id_4' => 0 );
		return $defaults;

	}

}

class souje_widget_social extends WP_Widget {

	function __construct() {

		parent::__construct( 'souje_widget_social', esc_html__( '08. Souje Widget: Social', 'souje' ), array( 'description' => esc_html__( "Show your social account icons.", 'souje' ), 'classname' => 'souje_widget_social' ) );

	}

	function form( $instance ) {

    if ( function_exists( 'souje_social_names' ) ) {

  		$account_names = souje_social_names();
  		$defaults = array( 'name' => esc_html__( 'Social', 'souje' ) );
  		foreach ( $account_names as $key ) { $defaults[ $key ] = 'http://'; }
  		$instance = wp_parse_args( ( array ) $instance, $defaults );

  		?>

  		<p><?php echo esc_html__( 'Title:', 'souje' ); ?> <input name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" class="widefat" /></p>
          <p><em><?php echo esc_html__( 'Write the entire URL addresses. Leave blank if not preferred.', 'souje' ); ?></em></p>

          <?php

  		foreach ( souje_social_labels() as $key => $lbl ) {

  			echo '<p>' . esc_html( $lbl ) . ': <input name="' . esc_attr( $this->get_field_name( $account_names[ $key ] ) ) . '" type="text" value="' . esc_attr( $instance[ $account_names[ $key ] ] ) . '" class="widefat" /></p>';

  		}

    }

	}

	function update( $new_instance, $old_instance ) {

    if ( function_exists( 'souje_social_names' ) ) {

  		$instance = $old_instance;

  		$instance['name'] = $new_instance['name'] ? strip_tags( $new_instance['name'] ) : esc_html__( 'Social', 'souje' );

  		foreach ( souje_social_names() as $key ) {

  			$instance[ $key ] = $new_instance[ $key ] ? strip_tags( $new_instance[ $key ] ) : 'http://';

  		}

  		return $instance;

    }

	}

	function widget( $args, $instance ) {

    if ( function_exists( 'souje_social_names' ) ) {

  		extract( $args );

  		$defaults = array( 'name' => esc_html__( 'Social', 'souje' ) );
  		foreach ( souje_social_names() as $key ) { $defaults[ $key ] = 'http://'; }
  		$instance = wp_parse_args( ( array ) $instance, $defaults );

  		echo wp_kses_post( $before_widget );

  		$icons = souje_social_icons();
  		$social_accounts = array();

  		$name = apply_filters( 'widget_title', $instance['name'] );

  		foreach ( souje_social_names() as $key ) {

  			$$key = $instance[ $key ];
  			array_push( $social_accounts, $$key );

  		}

  		$sw_rand = rand( 1, 9999999 );  ?>

          <?php

  		echo wp_kses_post( $before_title ) . esc_attr( $name ) . wp_kses_post( $after_title );

  		echo '<ul class="clearfix ' . esc_attr( 'sw-' . $sw_rand ) . '">';

  		foreach ( $social_accounts as $key => $sa ) {

  			if ( $sa != 'http://' && $sa != '' ) {

  				echo '<li><a href="' . esc_url( $sa ) . '" target="_blank"><i class="fa ' . esc_attr( $icons[ $key ] ) . '"></i></a></li>';

  			}

  		}

  		echo '</ul>';

  		echo wp_kses_post( $after_widget );

    }

	}

}

if ( !function_exists( 'souje_widgets_register' ) ) {
	function souje_widgets_register() {

		// Register Widgets
		if ( class_exists( 'souje_widget_ads' ) ) { register_widget( 'souje_widget_ads' ); }
		if ( class_exists( 'souje_widget_search' ) ) { register_widget( 'souje_widget_search' ); }
		if ( class_exists( 'souje_widget_social' ) ) { register_widget( 'souje_widget_social' ); }
		if ( class_exists( 'souje_widget_image' ) ) { register_widget( 'souje_widget_image' ); }
		if ( class_exists( 'souje_widget_empty_space' ) ) { register_widget( 'souje_widget_empty_space' ); }
		if ( class_exists( 'souje_widget_recent_comments' ) ) { register_widget( 'souje_widget_recent_comments' ); }
		if ( class_exists( 'souje_widget_facebook' ) ) { register_widget( 'souje_widget_facebook' ); }
		if ( class_exists( 'souje_widget_post' ) ) { register_widget( 'souje_widget_post' ); }
		if ( class_exists( 'souje_widget_recent_posts' ) ) { register_widget( 'souje_widget_recent_posts' ); }
		if ( class_exists( 'souje_widget_popular_posts' ) ) { register_widget( 'souje_widget_popular_posts' ); }
		if ( class_exists( 'souje_widget_selected_posts' ) ) { register_widget( 'souje_widget_selected_posts' ); }
		if ( class_exists( 'souje_widget_category_posts' ) ) { register_widget( 'souje_widget_category_posts' ); }

	}
}
add_action( 'widgets_init', 'souje_widgets_register' );

/* Hit Counter */
if ( !function_exists( 'souje_get_post_views' ) ) {
	function souje_get_post_views( $postID ) {

		$count_key = 'post_views_count';
		$count = get_post_meta( $postID, $count_key, true );

		if ( $count == '' ) {

			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, 0 );
			return 0;

		}

		return $count;

	}
}

if ( !function_exists( 'souje_set_post_views' ) ) {
	function souje_set_post_views( $postID ) {

		$count_key = 'post_views_count';
		$count = get_post_meta( $postID, $count_key, true );

		if ( $count == '' ) {

			$count = 0;
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, 0 );

		} else {

			$count ++;
			update_post_meta( $postID, $count_key, $count );

		}

	}
}
/* */

/* Add Custom Post Options */
if ( !function_exists( 'souje_add_meta_box' ) ) {
	function souje_add_meta_box() {

		add_meta_box( 'souje-meta-box', esc_html__( 'Souje Post Options', 'souje' ), 'souje_meta_box_markup', array( 'post', 'page' ), 'side', 'low' );

	}
}
add_action( 'add_meta_boxes', 'souje_add_meta_box' );

if ( !function_exists( 'souje_meta_box_markup' ) ) {
	function souje_meta_box_markup( $object ) {

		wp_nonce_field( basename( __FILE__ ), 'souje-meta-box-nonce' );

		$souje_woi_meta_box_checkbox_value = get_post_meta( $object->ID, 'souje-woi-meta-box-checkbox', true );
		$souje_sidebar_meta_box_checkbox_value = get_post_meta( $object->ID, 'souje-sidebar-meta-box-checkbox', true );
		$souje_share_meta_box_checkbox_value = get_post_meta( $object->ID, 'souje-share-meta-box-checkbox', true ); ?>

        <?php if ( $object->post_type == 'post' ) { ?>

        <p><input name="souje-woi-meta-box-checkbox" id="souje-woi-meta-box-checkbox" type="checkbox" value="true"<?php if ( $souje_woi_meta_box_checkbox_value == 'true' ) { echo ' checked'; } ?>><label for="souje-woi-meta-box-checkbox"> <?php echo esc_html__( 'Hide Featured Image on Post Page', 'souje' ); ?></label></p>

        <?php } ?>

        <p><input name="souje-sidebar-meta-box-checkbox" id="souje-sidebar-meta-box-checkbox" type="checkbox" value="true"<?php if ( $souje_sidebar_meta_box_checkbox_value == 'true' ) { echo ' checked'; } ?>><label for="souje-sidebar-meta-box-checkbox"> <?php echo esc_html__( 'Hide Sidebar on Post Page', 'souje' ); ?></label></p>
        <p><input name="souje-share-meta-box-checkbox" id="souje-share-meta-box-checkbox" type="checkbox" value="true"<?php if ( $souje_share_meta_box_checkbox_value == 'true' ) { echo ' checked'; } ?>><label for="souje-share-meta-box-checkbox"> <?php echo esc_html__( 'Hide Share Icons on Post Page', 'souje' ); ?></label></p>

	<?php }
}

if ( !function_exists( 'souje_save_meta_box' ) ) {
	function souje_save_meta_box( $post_id, $post, $update ) {

		if ( !isset( $_POST['souje-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['souje-meta-box-nonce'], basename( __FILE__ ) ) ) { return $post_id; }
		if ( !current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

		$souje_woi_meta_box_checkbox_value = '';
		$souje_sidebar_meta_box_checkbox_value = '';
		$souje_share_meta_box_checkbox_value = '';

		if( isset( $_POST['souje-woi-meta-box-checkbox'] ) ) { $souje_woi_meta_box_checkbox_value = $_POST['souje-woi-meta-box-checkbox']; }
		if( isset( $_POST['souje-sidebar-meta-box-checkbox'] ) ) { $souje_sidebar_meta_box_checkbox_value = $_POST['souje-sidebar-meta-box-checkbox']; }
		if( isset( $_POST['souje-share-meta-box-checkbox'] ) ) { $souje_share_meta_box_checkbox_value = $_POST['souje-share-meta-box-checkbox']; }

		update_post_meta( $post_id, 'souje-woi-meta-box-checkbox', $souje_woi_meta_box_checkbox_value );
		update_post_meta( $post_id, 'souje-sidebar-meta-box-checkbox', $souje_sidebar_meta_box_checkbox_value );
		update_post_meta( $post_id, 'souje-share-meta-box-checkbox', $souje_share_meta_box_checkbox_value );

	}
}
add_action( 'save_post', 'souje_save_meta_box', 10, 3 );
/* */

?>
