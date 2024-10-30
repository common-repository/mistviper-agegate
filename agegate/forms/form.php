<div class="agegate_container">
     <div class="agegate_image"></div>	
    <form id="agegate_pageblock" action="" method="post">
    <div class="agegate_message"><?php echo agegate_get_promptmessage(); ?></div><br>
    <div class="agegate_age"> </div>
    <select name="agegate_minmonth" id="agegate_minmonth" style="width:100px;">
    <?php
        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        for($i = 1; $i <= 12; $i++){
            $j = $i - 1;
            echo "<option value=\"$i\">$months[$j]</option>";
        }
    ?>
    </select>
    <select name="agegate_minday" id="agegate_minday" style="width:50px;">
    <?php
        for($i = 1; $i <= 31; $i++){
            echo "<option value=\"$i\">$i</option>";
        }
    ?>
    </select>
    <select name="agegate_minyear" id="agegate_minyear" style="width:75px;">
    <?php
        for($i = date('Y'); $i >= 1900; $i--){
            echo "<option value=\"$i\">$i</option>";
        }
    ?>
    </select><br>
     <div class="agegate_submit">
       <input type="submit" value="<?php echo __("Submit", agegate_TRANSLATIONDOMAIN ); ?>" />
       <input type="hidden" name="postid" value="<?php echo $post->ID; ?>" />
        <input type="hidden" name="agegatepost_noncename_<?php echo $post->ID; ?>" id="agegatepost_noncename_<?php echo $post->ID; ?>" value="<?php echo agegate_NUONCETARGET  ?>" />
	 </div>
  </form>
</div>
<div class="agegate_clear"></div>