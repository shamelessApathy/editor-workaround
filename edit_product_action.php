<?php

// I had originally been having a problem getting this to communicate but it worked just fine after making sure
// this php function responded with a json formatted 'echo'  

// Get URL Encoded description
$post_encoded = $_POST['base-encoded-description'];
// decode from base64 to URL encode
$post_base64_decoded = base64_decode($post_encoded);
// Decode description
$changed = urldecode($post_base64_decoded);

// Set Description Var
$products_description = $changed;

// Logging for debug
echo $changed;

// Check to make sure productId actually exists
?> 