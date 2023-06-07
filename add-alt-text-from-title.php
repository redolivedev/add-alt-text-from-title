<?php

/**
 *
 * @link              https://www.redolive.com
 * @since             1.0.2
 * @package           add-alt-text-from-title
 *
 * @wordpress-plugin
 * Plugin Name:       Add Img Alt Tags from Page Title
 * Plugin URI:        https://www.redolive.com/
 * Description:       A super simple plugin to add alt text from attachment titles. Runs on activation or manually by appending ?generatealttext is in the url of an admin page
 * Version:           1.0.2
 * Author:            Red Olive
 * Author URI:        https://www.redolive.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       add-alt-text-from-title
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'ADD_ALT_TEXT_FROM_TITLE_VERSION', '1.0.2' );

/**
 * The code that runs during plugin activation.
 */
function activate_add_alt_text_from_title() {
	MBAddALtTextFromTitle::activate();
}
register_activation_hook( __FILE__, 'activate_add_alt_text_from_title' );


class MBAddALtTextFromTitle {
    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;

        foreach($this->find_attachments_with_no_alt() as $attachment){
            if(!strstr($attachment->post_mime_type, 'image')){
                continue;
            }

            if(! get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true )){
                $alt = ucfirst(str_replace('-',' ',$attachment->post_title));
                update_post_meta($attachment->ID, '_wp_attachment_image_alt', $alt);
            };
        }
    }

    protected function find_attachments_with_no_alt(){
        $images = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'attachment',
            'post_status' => 'inherit',
        ));

        return $images->posts;
    }

    public static function activate(){
        return new self;
    }
}
function run_MBAddALtTextFromTitle(){
    if(isset($_GET['generatealttext'])){
        new MBAddALtTextFromTitle;
    }
}
add_action('admin_init', 'run_MBAddALtTextFromTitle');
