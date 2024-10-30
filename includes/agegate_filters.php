<?php
  
  function agegate_the_content($content)
  {
	  global $post;
	  
	  if (agegate_get_minage() && !agegate_continueread())
	  {
		 
		  ob_start();
		  require agegate_formsPATH.'/form.php';
		  $content = ob_get_contents();
		  ob_end_clean();
		  return $content;
	  } else
	  return $content;
  }
  add_filter('the_content', 'agegate_the_content', 1, 900);
  
  
  function agegate_continueread()
  {
	  global $post;
	  
	  $key     = sprintf('bagegate_%s', $post->ID);

	  if (isset($_COOKIE[$key]))
	  {
		  return (convert_date($_COOKIE[$key]) <= convert_date(agegate_get_minage()));
		  
	  }
	  return false;
  }
  
  function agegate_detectagepost()
  {

	if (isset($_POST['postid']))
	{
		$postid   = $_POST['postid'];
		$thispost = get_post($postid);
		
        $agegate_minage = $_POST['agegate_minyear'] . "-" . $_POST['agegate_minmonth'] . "-" . $_POST['agegate_minday'];
		
		if (convert_date($agegate_minage) <= convert_date(agegate_get_minage($thispost)))
		{

			$key = sprintf('bagegate_%s', $thispost->ID);	
			setcookie($key, $agegate_minage);
			
			wp_redirect($_SERVER['REQUEST_URI'], 301);
			exit;
		}	
	} 
  }
  
  function convert_date($date){
    $dates = explode("-", $date);
    if (count($dates) != 3)
        return PHP_INT_MAX;
    else
        return $date[0] * 365 + $date[1] * 12 + $date[2];
  }
  add_action('wp', 'agegate_detectagepost',1,1); /* Not We need to execute this before any content is shown */
?>