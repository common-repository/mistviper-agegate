<?php

function agegate_add_model_meta()
{
	add_meta_box( 'agegate_metabox', __( 'AgeGate', agegate_TRANSLATIONDOMAIN), 'agegate_metabox', 'post', 'normal', 'high' );
	
}

function agegate_metabox()
{
	global $post;
	
	// Use nonce for verification ... ONLY USE ONCE!
	echo '<input type="hidden" name="agegatemeta_noncename" id="agegatemeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	
	$value = get_post_meta($post->ID, 'minage', true);
    $values = explode("-", $value);
	$promptext = get_post_meta($post->ID, 'promptext', true);
	
	if (empty($promptext)) 
	 $promptext = agegate_DEFAULT_MESSAGE;
	 
	?>
    <label for="promptext"><?php echo __("Use this text to prompt the readers:", agegate_TRANSLATIONDOMAIN ); ?></label><br />
    <textarea rows="5" cols="35" name="promptext" id="promptext"><?php echo $promptext; ?></textarea><br />
    
    <label for="minage"><?php echo __("Min. age to open content:", agegate_TRANSLATIONDOMAIN ); ?></label><br />
    <select name="agegate_minmonth" id="agegate_minmonth" style="width:100px;">
        <option value="0">--</option>
    <?php
        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        for($i = 1; $i <= 12; $i++){
            $j = $i - 1;
            if ($i == $values[1]){
                echo "<option value=\"$i\" selected>$months[$j]</option>";
            } else {
                echo "<option value=\"$i\">$months[$j]</option>";
            }
        }
    ?>
    </select>
    <select name="agegate_minday" id="agegate_minday" style="width:50px;">
        <option value="0">--</option>
    <?php
        for($i = 1; $i <= 31; $i++){
            if ($i == $values[2]){
                echo "<option value=\"$i\" selected>$i</option>";
            } else {
                echo "<option value=\"$i\">$i</option>";
            }
        }
    ?>
    </select>
    <select name="agegate_minyear" id="agegate_minyear" style="width:75px;">
        <option value="0">--</option>
    <?php
        for($i = date('Y'); $i >= 1900; $i--){
            if ($i == $values[0]){
                echo "<option value=\"$i\" selected>$i</option>";
            } else {
                echo "<option value=\"$i\">$i</option>";
            }
        }
    ?>
    </select>
    <?php
}

function agegate_save_model_meta($post_id, $post)
{
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['agegatemeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post->ID ))
		return $post->ID;
	} else {
		if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	}
    
    if ($_POST['agegate_minyear'] == 0 || $_POST['agegate_minmonth'] == 0 || $_POST['agegate_minday'] == 0) {
        $mydata['minage'] = 0;
    } else {
        $mydata['minage']    = $_POST['agegate_minyear'] . "-" . $_POST['agegate_minmonth'] . "-" . $_POST['agegate_minday'];
    }
	$mydata['promptext'] = $_POST['promptext'];
	
	foreach ($mydata as $key => $value) { //Let's cycle through the $mydata array!
		if( $post->post_type == 'revision' ) return; //don't store custom data twice
		$value = implode(',', (array)$value); //if $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { //if the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { //if the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); //delete if blank
	}
}

/* Use the admin_menu action to define the custom boxes */
add_action('admin_menu', 'agegate_add_model_meta');
add_action('save_post',  'agegate_save_model_meta', 1, 2);
?>