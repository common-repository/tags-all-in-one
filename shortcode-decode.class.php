<?php
/*
Author: Marcin Gierada
Author URI: http://www.teastudio.pl/
Author Email: m.gierada@teastudio.pl
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class TagsAllInOneShortcodeDecode {
    public static function initialize($atts, $content = null, $code = "") {
        return TagsAllInOneGenerator::generate($atts);
    }
}
add_shortcode("tags_all_in_one", array("TagsAllInOneShortcodeDecode", "initialize"));
?>