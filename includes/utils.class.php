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

/*
 *
 */
class Tags_All_In_One_Utils {

    public static function getTaxonomies() {
        $taxonomies = array();
        $taxonomies_list = get_taxonomies( array('show_tagcloud' => true), 'objects' );

        if ( count($taxonomies_list) > 0 ) {
            foreach ( $taxonomies_list as $key => $taxonomy ) {
                if ( $post_type = get_post_type_object( $taxonomy->object_type[0] ) ) {
                    if (  preg_match('/tag/', $taxonomy->name) ) {
                        $taxonomies[$key] = $post_type->label .' / '. $taxonomy->label;
                    }
                }
            }
        }

        return $taxonomies;
    }

    public static function getUnits() {
        return array('px' => 'px',
                     'pt' => 'pt',
                    );
    }

    public static function getOrdersBy() {
        return array('name'  => __('Name', 'tags-all-in-one'),
                     'count' => __('Count', 'tags-all-in-one'),
                    );
    }

    public static function getOrders() {
        return array('asc'  => __('Ascending', 'tags-all-in-one'),
                     'desc' => __('Descending', 'tags-all-in-one'),
                     'rand' => __('Random', 'tags-all-in-one')
                    );
    }

    public static function getTooltip( $text = null, $type = 'help' ) {
        if( $text == null ) {
            return null;
        }

        if ( in_array( $type, array('help', 'warning') ) ) {
            switch ($type) {
                case 'warning':
                    $type = 'warning';
                    break;
                case 'help':
                default:
                    $type = 'editor-help';
                    break;
            }
        }
        return '<a href="" title="' . $text . '" class="tags-all-in-one-tooltip tooltip-' . $type . '"><span class="dashicons dashicons-' . $type . '" title="' . __('Hint', 'tags-all-in-one') . '"></span></a>';
    }
}
