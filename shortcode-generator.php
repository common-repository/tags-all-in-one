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

?>

<script type="text/javascript">
function insert_shortcode() {
    if ( jQuery('#tags-all-in-one-form .field-invalid').length > 0) {
        alert("<?php _e('Error detected.\nPlease correct your form and try again.', 'tags-all-in-one') ?>");
    } else {
        var taxonomies = jQuery("#tags-form input[name='taxonomy']:checked").map(function() {
            return jQuery(this).val();
        }).get().join();

        var shortcode = '[tags_all_in_one';

        jQuery('#tags-all-in-one-form .tags-all-in-one-left-sidebar').find(':input').filter(function() {
            var val = null;

            if(this.type != "button") {
                if(jQuery.trim( this.name ) != "taxonomy") {
                    if(this.type == "checkbox") {
                        val = this.checked ? "true" : "false";
                    }else {
                        val = this.value;
                    }

                    shortcode += ' '+jQuery.trim( this.name )+'="'+jQuery.trim( val )+'"';
                }
            }
        });

        if( taxonomies.length > 0) {
            shortcode += ' taxonomy="'+taxonomies.toString()+'"';
        }

        shortcode +=']';

        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
        tb_remove();
    }
}
</script>

<div class="widget metabox-holder has-right-sidebar tags-all-in-one-form" id="tags-all-in-one-form">
    <div  class="tags-all-in-one-right-sidebar">
        <br />
        <?php include( 'includes/plugin-info.php' ); ?>
    </div>

    <div class="tags-all-in-one-left-sidebar">
        <br />
        <table cellspacing="0" cellpadding="00">
            <thead>
                <tr>
                    <th colspan="2">
                        <h2><?php _e('Display options', 'tags-all-in-one') ?></h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php _e('Limit', 'tags-all-in-one'); ?>:</th>
                    <td>
                        <input class="tags-all-in-one-field field-validate" type="number" name="number" id="number" value="20" size="5" required min="1" pattern="^[d+]$" />
                    </td>
                </tr>
            <tr>
                <th><?php _e('Smallest font size', 'tags-all-in-one'); ?>:</th>
                <td>
                    <input class="tags-all-in-one-field field-validate" type="text" name="smallest" id="smallest" value="12" size="5" required pattern="^[1-9](\.?[1-9])*$" />
                </td>
            </tr>
            <tr>
                <th><?php _e('Largest font size', 'tags-all-in-one'); ?>:</th>
                <td>
                    <input class="tags-all-in-one-field field-validate" type="text" name="largest" id="largest" value="24" size="5" required pattern="^[1-9](\.?[1-9])*$" />
                </td>
            </tr>
            <tr>
                <th><?php _e('Unit of font size', 'tags-all-in-one'); ?>:</th>
                <td>
                    <select class="select tags-all-in-one-field" name="unit" id="unit">
                    <?php
                            $unit_list = Tags_All_In_One_Utils::getUnits();
                            foreach($unit_list as $key => $list) {
                                echo "<option value=\"". $key ."\">". $list ."</option>";
                            }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><?php _e('Separator', 'tags-all-in-one'); ?>:</th>
                <td>
                    <input class="tags-all-in-one-field" type="text" name="separator" id="separator" value="" size="5" />
                </td>
            </tr>
            <tr>
                <th><?php _e('Order by', 'tags-all-in-one'); ?>:</th>
                <td>
                    <select class="select tags-all-in-one-field" name="orderby" id="orderby">
                    <?php
                            $orderby_list = Tags_All_In_One_Utils::getOrdersBy();
                            foreach($orderby_list as $key => $list) {
                                echo "<option value=\"". $key ."\">". $list ."</option>";
                            }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><?php _e('Order', 'tags-all-in-one'); ?>:</th>
                <td>
                    <select class="select tags-all-in-one-field" name="order" id="order">
                    <?php
                            $order_list = Tags_All_In_One_Utils::getOrders();
                            foreach($order_list as $key => $list) {
                                echo "<option value=\"". $key ."\">". $list ."</option>";
                            }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <fieldset style="padding:0 10px 10px 10px;">
                        <legend><?php _e('Select what you want to display', 'tags-all-in-one') ?></legend>

                        <p><?php _e('Tags from', 'tags-all-in-one'); ?>:</p>
                        <ul>
                        <?php
                                $taxanomies_list = Tags_All_In_One_Utils::getTaxonomies();
                                foreach($taxanomies_list as $key => $list) {
                                    echo "<li><input class=\"checkbox tags-all-in-one-field\" type=\"checkbox\" value=\"". $key ."\" name=\"taxonomy\" id=\"taxonomy-". $key ."\" /><label for=\"taxonomy-". $key ."\">". $list ."</label></li>";
                                }
                        ?>
                        </ul>
                        <p><?php _e('or', "wp-posts-carousel") ?></p>
                        <input class="checkbox tags-all-in-one-field" type="checkbox" value="1" name="post" id="post" /> <?php _e('tags from this content', 'tags-all-in-one'); ?></td>
                    </fieldset>
                </td>
            </tr>
        </table>

        <br />
        <input type="button" class="button button-primary button-large" value="<?php _e('Insert Shortcode', 'tags-all-in-one') ?>" onClick="insert_shortcode();">
    </div>
</div>
