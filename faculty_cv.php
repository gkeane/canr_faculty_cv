<?php
/*
Plugin Name: Faculty CV
Plugin URI: https://github.com/gkeane/canr_faculty_cv
Description: Plugin to handle faculty cvs
Version: 1.0
Author: Greg Keane
Author URI: http://canr.udel.edu
License: GPLv2
*/

add_action( 'init', 'create_faculty_cv' );

function create_faculty_cv() {
    register_post_type( 'faculty_cv',
        array(
            'labels' => array(
                'name' => 'Faculty CVs',
                'singular_name' => 'Faculty CV',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Faculty CV',
                'edit' => 'Edit',
                'edit_item' => 'Edit Faculty CV',
                'new_item' => 'New Faculty CV',
                'view' => 'View',
                'view_item' => 'View Faculty CV',
                'search_items' => 'Search Faculty CVs',
                'not_found' => 'No Faculty CVs found',
                'not_found_in_trash' => 'No Faculty CVs found in Trash',
                'parent' => 'Parent Faculty CV'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title',   'thumbnail'),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
            'has_archive' => true
        )
    );
}

add_action( 'admin_init', 'my_admin' );

function my_admin() {
    add_meta_box( 'faculty_cv_meta_box',
        'Faculty CV Details',
        'display_faculty_cv_meta_box',
        'faculty_cv', 'normal', 'high'
    );
}

function display_faculty_cv_meta_box( $faculty_cv ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $faculty_name = esc_html( get_post_meta( $faculty_cv->ID, 'faculty_name', true ) );
    $faculty_phone = esc_html( get_post_meta( $faculty_cv->ID, 'faculty_phone', true ) );
	$faculty_email = esc_html( get_post_meta( $faculty_cv->ID, 'faculty_email', true ) );
	$faculty_office = esc_html( get_post_meta( $faculty_cv->ID, 'faculty_office', true ) );
	$faculty_website = esc_html( get_post_meta( $faculty_cv->ID, 'faculty_website', true ) );
    ?>
    <table>
        <tr>
            <td style="width: 100%">Name</td>
            <td><input type="text" size="80" name="faculty_cv_faculty_name" value="<?php echo $faculty_name; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Phone</td>
            <td><input type="text" size="80" name="faculty_cv_faculty_phone" value="<?php echo $faculty_phone; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Email</td>
            <td><input type="text" size="80" name="faculty_cv_faculty_email" value="<?php echo $faculty_email; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Office Location</td>
            <td><input type="text" size="80" name="faculty_cv_faculty_office" value="<?php echo $faculty_office; ?>" /></td>
        </tr>
    <tr>
            <td style="width: 100%">Website</td>
            <td><input type="text" size="80" name="faculty_cv_faculty_website" value="<?php echo $faculty_website; ?>" /></td>
        </tr>
    </table>
    <?php
}

add_action( 'save_post', 'add_faculty_cv_fields', 10, 2 );

function add_faculty_cv_fields( $faculty_cv_id, $faculty_cv ) {
    // Check post type for movie reviews
    if ( $faculty_cv->post_type == 'faculty_cv' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['faculty_cv_faculty_name'] ) && $_POST['faculty_cv_faculty_name'] != '' ) {
            update_post_meta( $faculty_cv_id, 'faculty_name', $_POST['faculty_cv_faculty_name'] );
        }
        if ( isset( $_POST['faculty_cv_faculty_phone'] ) && $_POST['faculty_cv_faculty_phone'] != '' ) {
            update_post_meta( $faculty_cv_id, 'faculty_phone', $_POST['faculty_cv_faculty_phone'] );
        }
		if ( isset( $_POST['faculty_cv_faculty_email'] ) && $_POST['faculty_cv_faculty_email'] != '' ) {
            update_post_meta( $faculty_cv_id, 'faculty_email', $_POST['faculty_cv_faculty_email'] );
        }
		if ( isset( $_POST['faculty_cv_faculty_office'] ) && $_POST['faculty_cv_faculty_office'] != '' ) {
            update_post_meta( $faculty_cv_id, 'faculty_office', $_POST['faculty_cv_faculty_office'] );
        }
		if ( isset( $_POST['faculty_cv_faculty_office'] ) && $_POST['faculty_cv_faculty_office'] != '' ) {
            update_post_meta( $faculty_cv_id, 'faculty_office', $_POST['faculty_cv_faculty_office'] );
        }
    }
}
?>
