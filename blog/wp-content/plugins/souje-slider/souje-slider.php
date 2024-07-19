<?php
/*
Plugin Name: Souje Slider
Plugin URI: http://www.burnhambox.com/souje
Description: Souje Slider
Version: 1.0
Author: Burnhambox
Author URI: http://www.burnhambox.com
License: GNU
*/

/* Slider Post Type */
function souje_create_slider_post_type() {

	$labels = array(
		'all_items' => 'All Slides',
		'edit_item' => 'Edit Slide',
		'add_new' => 'Add New Slide',
		'add_new_item' => 'Add New Slide',
		'not_found' => 'No slides found.',
		'not_found_in_trash' => 'No slides found in Trash.',
	);

	$args = array(
		'labels' => $labels,
		'public' => false,
		'show_ui' => true,
		'menu_icon' => 'dashicons-images-alt',
		'capability_type' => 'post',
		'rewrite' => array( 'slide_group', 'post_tag' ),
		'label'  => 'Souje Slider',
		'supports' => array( 'thumbnail' ),
	);

	register_post_type( 'slider', $args );

}
add_action( 'init', 'souje_create_slider_post_type' );
/* */

/* Add Meta Box */
function souje_slider_add_meta_box() {

	add_meta_box( 'souje-slide-meta-box', 'Slide Properties', 'souje_slide_meta_box_markup', 'slider', 'normal', 'high' );

}
add_action( 'add_meta_boxes', 'souje_slider_add_meta_box' );

function souje_slide_meta_box_markup( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'souje-slider-meta-box-nonce' );

	$souje_slide_title = get_post_meta( $post->ID, 'souje-slide-title', true );
	$souje_slide_url = get_post_meta( $post->ID, 'souje-slide-url', true );
	$souje_slide_new_window = get_post_meta( $post->ID, 'souje-slide-new-window', true );
	$souje_slide_to_post = get_post_meta( $post->ID, 'souje-slide-to-post', true );
	$souje_slide_simple = get_post_meta( $post->ID, 'souje-slide-simple', true );

	$posts = get_posts( array( 'numberposts' => -1 ) );

	?>

    <p>
    <b>a)</b> You can directly insert a post into your slider by selecting it from the <b>"Post Direction"</b> drop down. After selecting it, you can override its properties <em>(Title, Slide Image etc.)</em> if you wish.
    <br />
    <b>b)</b> To create a brand new slide, just do not select a post and fill in the other fields <em>(Title, URL etc.)</em>.
    </p>
    <p>
    <b>Note:</b> Don't forget that you should use the same group name for the slides/posts you want to see in the same slider. See <a href="edit-tags.php?taxonomy=slide_group&post_type=slider"><em>Slide Groups</em></a>.
    </p>
    <hr />
	<p>Post Direction:<br />
	<select id="souje-slide-to-post" name="souje-slide-to-post" class="widefat" style="max-width: 300px;">
        <option <?php echo esc_attr( $souje_slide_to_post ) == 0 ? 'selected="selected"' : '';?> value="0">- Select a Post -</option>
		<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
        <option <?php echo $post->ID == esc_attr( $souje_slide_to_post ) ? 'selected="selected"' : '';?> value="<?php echo esc_attr( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></option>
		<?php endforeach; ?>
	</select>
	</p>
	<p>Title:<br />
	<input type="text" name="souje-slide-title" id="souje-slide-title" value="<?php echo esc_attr( $souje_slide_title ); ?>" class="widefat" style="max-width: 300px;" />
	</p>
    <p>URL:<br />
	<input type="text" name="souje-slide-url" id="souje-slide-url" value="<?php echo esc_url( $souje_slide_url ); ?>" class="widefat" style="max-width: 300px;" />
	</p>
    <p><input name="souje-slide-new-window" id="souje-slide-new-window" type="checkbox" value="true"<?php if ( $souje_slide_new_window == 'true' ) { echo ' checked'; } ?>><label for="souje-slide-new-window"> Open in new window</label></p>
    <p><input name="souje-slide-simple" id="souje-slide-simple" type="checkbox" value="true"<?php if ( $souje_slide_simple == 'true' ) { echo ' checked'; } ?>><label for="souje-slide-simple"> Show the "Slide Image" only</label></p>

<?php }

function souje_slider_save_meta_box( $post_id ) {

	if ( !isset( $_POST['souje-slider-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['souje-slider-meta-box-nonce'], basename( __FILE__ ) ) ) { return $post_id; }
	if ( !current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

	$souje_slide_title = '';
	$souje_slide_url = '';
	$souje_slide_new_window = '';
	$souje_slide_to_post = '';
	$souje_slide_simple = '';

	if( isset( $_POST['souje-slide-title'] ) ) { $souje_slide_title = $_POST['souje-slide-title']; }
	if( isset( $_POST['souje-slide-url'] ) ) { $souje_slide_url = $_POST['souje-slide-url']; }
	if( isset( $_POST['souje-slide-new-window'] ) ) { $souje_slide_new_window = $_POST['souje-slide-new-window']; }
	if( isset( $_POST['souje-slide-to-post'] ) ) { $souje_slide_to_post = $_POST['souje-slide-to-post']; }
	if( isset( $_POST['souje-slide-simple'] ) ) { $souje_slide_simple = $_POST['souje-slide-simple']; }

	update_post_meta( $post_id, 'souje-slide-title', $souje_slide_title );
	update_post_meta( $post_id, 'souje-slide-url', $souje_slide_url );
	update_post_meta( $post_id, 'souje-slide-new-window', $souje_slide_new_window );
	update_post_meta( $post_id, 'souje-slide-to-post', $souje_slide_to_post );
	update_post_meta( $post_id, 'souje-slide-simple', $souje_slide_simple );

}
add_action( 'save_post', 'souje_slider_save_meta_box' );
/* */

/* Manage/Edit/Move Columns & Meta Boxes */
function souje_slider_columns( $columns ) {

	$new_columns = array(
		'cb' => '<input type=\"checkbox\" />',
		'souje-slide-image' => 'Image',
		'souje-slide-title' => 'Title',
		'souje-slide-groups' => 'Slide Groups',
		'souje-slide-to-post' => 'Post Direction',
		'souje-slide-url' => 'URL',
	);

	return $new_columns;

}
add_filter( 'manage_slider_posts_columns' , 'souje_slider_columns' );

function souje_slider_custom_columns( $column, $post_id ) {

	switch ( $column ) {
		case 'souje-slide-image':
			$temp_image_path = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'souje-small-thumbnail-image' );
			if ( $temp_image_path ) { $final_image_path = $temp_image_path[0]; } else { $final_image_path = plugin_dir_url( __FILE__ ) . 'images/no-thumbnail.png'; }
			echo '<a href="post.php?post=' . esc_attr( $post_id ) . '&action=edit"><img src="' . esc_url( $final_image_path ) . '" /></a>';
			break;
		case 'souje-slide-title':
			$temp_title = get_post_meta( $post_id, 'souje-slide-title', true );
			if ( $temp_title ) { $temp_title = '<b>' . wp_kses_post( $temp_title ) . '</b>'; } else { $temp_title = '<em>No Title</em>'; }
			echo '<a href="post.php?post=' . esc_attr( $post_id ) . '&action=edit">' . wp_kses_post( $temp_title ) . '</a>';
			break;
		case 'souje-slide-groups':
			$terms = get_the_terms( $post_id, 'slide_group' );
			if ( is_array( $terms ) ) {
				foreach( $terms as $key => $term ) {
					$terms[$key] = '<a href="edit.php?post_type=slider&slide_group=' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</a>';
				}
				echo implode( ', ', $terms );
			}
			break;
		case 'souje-slide-to-post':
			$temp_post_title = get_the_title( get_post_meta( $post_id, 'souje-slide-to-post', true ) );
			if ( $temp_post_title != 'Auto Draft' && $temp_post_title != '' ) { echo '<b>' . wp_kses_post( $temp_post_title ) . '</b>'; } else { echo '&mdash;'; }
			break;
		case 'souje-slide-url':
			$temp_url = get_post_meta( $post_id, 'souje-slide-url', true );
			if ( $temp_url ) { echo esc_url( $temp_url ); } else { echo '&mdash;'; }
			break;
	}

}
add_action( 'manage_posts_custom_column', 'souje_slider_custom_columns', 10, 2 );

function souje_slider_edit_slide_groups_columns( $columns ) {

	unset( $columns['description'], $columns['slug'] );

	$new_columns = array(
		'souje-slide-shortcode' => 'Slider Shortcode',
	);

    return array_merge( $columns, $new_columns );

}
add_filter( 'manage_edit-slide_group_columns', 'souje_slider_edit_slide_groups_columns' );

function souje_slide_groups_columns( $out, $column, $term_id ) {

	switch ( $column ) {
		case 'souje-slide-shortcode':
			$term = get_term( $term_id, 'slide_group' );
			$out = '<input style="width: 100%;" readonly type="text" value="[soujeslider group=&quot;' . esc_attr( $term->slug ) . '&quot;]" />';
			break;
	}

	return $out;

}
add_filter( 'manage_slide_group_custom_column', 'souje_slide_groups_columns', 10, 3 );

function souje_slider_move_meta_boxes(){

    remove_meta_box( 'postimagediv', 'slider', 'side' );
    add_meta_box( 'postimagediv', 'Slide Image', 'post_thumbnail_meta_box', 'slider', 'normal', 'low' );

}
add_action( 'do_meta_boxes', 'souje_slider_move_meta_boxes' );
/* */

/* Slide Group Taxonomy */
function souje_slide_group_tax() {

	$labels = array(
		'add_new_item' => 'Add New Slide Group',
		'edit_item' => 'Edit Slide Group',
		'separate_items_with_commas' => 'Separate groups with commas',
		'choose_from_most_used' => 'Choose from the most used groups',
		'not_found' => 'No groups found.',
	);

	register_taxonomy( 'slide_group', 'slider', array(
			'label' => 'Slide Groups',
			'labels' => $labels,
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'rewrite' => false,
		)
	);

}
add_action( 'init', 'souje_slide_group_tax' );
/* */

/* Hide "Quick Edit" link */
function souje_slider_hide_quick_edit( $actions, $post ){

	global $current_screen;

    if( $current_screen->post_type == 'slider' ) {
		unset( $actions['inline hide-if-no-js'] );
	}

    return $actions;

}
add_filter( 'post_row_actions', 'souje_slider_hide_quick_edit', 10, 2 );
/* */

/* Slider Shortcode */
function souje_slider_shortcode( $atts = null ) {

	global $add_my_script, $ss_atts;
	$add_my_script = true;
	$ss_atts = shortcode_atts(
		array(
			'group' => '',
			'limit' => -1,
		), $atts, 'soujeslider'
	);

	$args = array(
		'post_type' => 'slider',
		'posts_per_page' => $ss_atts['limit'],
	);

	if ( $ss_atts['group'] != '' ) {
		$args['tax_query'] = array(
			array( 'taxonomy' => 'slide_group', 'field' => 'slug', 'terms' => $ss_atts['group'] )
		);
	}

	$the_query = new WP_Query( $args );
	$slides = array();

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {

			$the_query->the_post();

			$souje_slide_title = get_post_meta( get_the_ID(), 'souje-slide-title', true );
			$souje_slide_url = get_post_meta( get_the_ID(), 'souje-slide-url', true );
			$souje_slide_new_window = get_post_meta( get_the_ID(), 'souje-slide-new-window', true );
			$souje_slide_to_post = get_post_meta( get_the_ID(), 'souje-slide-to-post', true );
			$souje_slide_simple = get_post_meta( get_the_ID(), 'souje-slide-simple', true );

			$slide_target = '_self';
			if ( $souje_slide_new_window ) {
				$slide_target = '_blank';
			}

			$slide_title = '';
			if ( $souje_slide_title ) {
				$slide_title = $souje_slide_title;
			} else if ( $souje_slide_to_post ) {
				$slide_title = get_the_title( $souje_slide_to_post );
			}

			$slide_url = '';
			$slide_a_open = '<div>';
			$slide_a_close = '</div>';
			if ( $souje_slide_url ) {
				$slide_url = $souje_slide_url;
			} else if ( $souje_slide_to_post ) {
				$slide_url = get_the_permalink( $souje_slide_to_post );
			}
			if ( $slide_url ) {
				$slide_a_open = '<a href="' . esc_url( $slide_url ) . '" target="' . esc_attr( $slide_target ) . '">';
				$slide_a_close = '</a>';
			}

			$slide_image_ID = 0;
			$slide_image = '<div class="null_slide_image"></div>';
			$slide_image_thumbnail = '<img alt="" class="null_slide_image_thumbnail">';
			if ( has_post_thumbnail() ) {
				$slide_image_ID = get_the_ID();
			} else if ( $souje_slide_to_post ) {
				$slide_image_ID = $souje_slide_to_post;
			}
			$slide_image_path = wp_get_attachment_image_src( get_post_thumbnail_id( $slide_image_ID ), 'souje-slider-image' );
			$slide_image_thumbnail_path = wp_get_attachment_image_src( get_post_thumbnail_id( $slide_image_ID ), 'souje-thumbnail-image' );
			if ( $slide_image_path ) {
				$slide_image = '<img class="slide-image" alt="" src="' . esc_url( $slide_image_path[0] ) . '">';
				$slide_image_thumbnail = '<img alt="" src="' . esc_url( $slide_image_thumbnail_path[0] ) . '">';
			}

			$slide_thumbnail_container = '<div class="slide-lens"></div><div class="slide-thumbnail-container clearfix">' . $slide_image_thumbnail . '<div class="slide-thumbnail-inner fading"><div class="table-cell-middle"><div class="slide-title">' . esc_attr( $slide_title ) . '</div></div></div></div>';
			if ( $souje_slide_simple ) {
				$slide_thumbnail_container = '<div class="slide-thumbnail-container clearfix">' . $slide_image_thumbnail . '</div>';
			}

			$slides[] = $slide_a_open . $slide_image . $slide_thumbnail_container . $slide_a_close;

		}
	}

	wp_reset_query();

	return '<div class="souje-slider-container"><div class="owl-carousel">' . implode( '', $slides ) . '</div></div>';

}
add_shortcode( 'soujeslider', 'souje_slider_shortcode' );
/* */

/* Slide Ordering Engine */
class souje_slider_order_engine {

    function __construct() {

		add_action( 'admin_init', array( $this, 'souje_slider_refresh' ) );
		add_action( 'admin_init', array( $this, 'souje_slider_load_scripts' ) );
		add_action( 'wp_ajax_update-menu-order', array( $this, 'souje_slider_update_order' ) );
		add_action( 'pre_get_posts', array( $this, 'souje_slider_pre_get_posts' ) );

    }

	function souje_slider_check_scripts() {

        $active = false;
        $objects = array( 'slider' );
        if ( isset( $_GET['orderby'] ) || strstr( $_SERVER['REQUEST_URI'], 'action=edit') || strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post-new.php' ) ) { return false; }
        if ( isset( $_GET['post_type'] ) && !isset( $_GET['taxonomy'] ) && in_array( $_GET['post_type'], $objects ) ) { $active = true; }
        return $active;

    }

    function souje_slider_load_scripts() {

		if ( $this->souje_slider_check_scripts() ) {
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'souje-slider-order-js', plugin_dir_url( __FILE__ ) . 'assets/slider-order.js', array( 'jquery' ), null, true );
			wp_enqueue_style( 'souje-slider-order-css', plugin_dir_url( __FILE__ ) . 'assets/slider-order.css', array(), null );
		}

    }

    function souje_slider_refresh() {

        global $wpdb;

		$result = $wpdb->get_results("
			SELECT count(*) as cnt, max(menu_order) as max, min(menu_order) as min
			FROM $wpdb->posts
			WHERE post_type = 'slider' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
		");

		$results = $wpdb->get_results("
			SELECT ID
			FROM $wpdb->posts
			WHERE post_type = 'slider' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
			ORDER BY menu_order ASC
		");

		foreach ( $results as $key => $result ) {
			$wpdb->update( $wpdb->posts, array( 'menu_order' => $key + 1 ), array( 'ID' => $result->ID ) );
		}

    }

    function souje_slider_update_order() {

        global $wpdb;
        parse_str( $_POST['order'], $data );

        if ( !is_array( $data ) )
            return false;

        $id_arr = array();
        foreach ( $data as $key => $values ) {
            foreach ( $values as $position => $id ) {
                $id_arr[] = $id;
            }
        }

        $menu_order_arr = array();
        foreach ( $id_arr as $key => $id ) {
            $results = $wpdb->get_results( "SELECT menu_order FROM $wpdb->posts WHERE ID = " . intval( $id ) );
            foreach ( $results as $result ) {
                $menu_order_arr[] = $result->menu_order;
            }
        }

        sort( $menu_order_arr );

        foreach ( $data as $key => $values ) {
            foreach ( $values as $position => $id ) {
                $wpdb->update( $wpdb->posts, array( 'menu_order' => $menu_order_arr[$position] ), array( 'ID' => intval( $id ) ) );
            }
        }

    }

    function souje_slider_pre_get_posts( $wp_query ) {

        $objects = array( 'slider' );

        if ( isset( $wp_query->query['post_type'] ) && !isset( $_GET['orderby'] ) ) {
            if ( in_array( $wp_query->query['post_type'], $objects ) ) {
                $wp_query->set( 'orderby', 'menu_order' );
                $wp_query->set( 'order', 'ASC' );
            }
        }

    }

}
$souje_slider_order_engine = new souje_slider_order_engine();
/* */
?>
