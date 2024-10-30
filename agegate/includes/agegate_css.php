<?php

function agegate_loadcss()
{
	?>
    <link rel="stylesheet" href="<?php echo agegate_PLUGINURL; ?>style/style.css" type="text/css" media="screen" />
    <?php
}
add_action('wp_head', 'agegate_loadcss');

?>