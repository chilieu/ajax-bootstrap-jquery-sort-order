<?php
$data = array();
$appendix = 100;
foreach($_POST['order'] as $key => $val){
	$data[$key]['id'] = $val;
	$data[$key]['order'] = ($key + 1) * $appendix;
	//Use MySQL Query to update sorting field from here
}
print_r($data);
//commit from local branch to github
?>
