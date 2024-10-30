<?php

function agegate_get_promptmessage()
{
	global $post;
	
	$meta = get_post_meta($post->ID, 'promptext');
	
	if ($meta[0])
	$prompt = $meta[0];
	
	if (!empty($prompt))
	return $prompt;
	return NULL;
}


function agegate_get_minage($specialpost="")
{
	global $post;
	
	if (!empty($specialpost))
	 $post = $specialpost;
	 
	$meta = get_post_meta($post->ID, 'minage');
	
	if ($meta[0])
	$minage = $meta[0];
	
	if (!empty($minage))
	return $minage;
	return NULL;
}

?>