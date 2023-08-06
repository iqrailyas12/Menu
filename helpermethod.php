<?php
function alert_message($message)
{
	echo "<script>alert('$message')</script>";
}


function inputs($attribute)
{
	$attr="";
	foreach ($attribute as $key => $value) {
		$attr.=" $key='$value'";
	}
	echo "<input $attr />";
}


function linebreak($number)
{
	for ($i=0; $i < $number; $i++)		
		echo "<br/>";
}
function redirect($page_name)
	{
		echo "<script>location.href='$page_name'</script>";
	}
?>