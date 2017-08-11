<?php

// I had originally been having a problem getting this to communicate but it worked just fine after making sure
// this php function responded with a json formatted 'echo'  
//$json = json_encode('what it do!');
//echo $json;

$post = $_POST['code'];
$changed = urldecode($post);
file_put_contents('np-log.txt', $changed, FILE_APPEND);
echo json_encode('got to bottom of script');
?>