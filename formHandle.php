<?php 

//загружаю на сервер 

$tmp = $_FILES['userfile']['tmp_name']; 
$filename = $_FILES['userfile']['name']; 
move_uploaded_file($tmp, './uploads/'.$filename); 


$filepath = realpath('./uploads/'.$filename); 
$file = fopen($filepath, 'w+'); 
$post = array('file_contents' => $file); 


$fp = fopen('./error.log', 'w+'); 
$ch = curl_init(); 
curl_setopt_array($ch, array( 
CURLOPT_URL => 'https://api.voximplant.com/platform_api/CreateCallList/?accou..', 
CURLOPT_RETURNTRANSFER => true, 
CURLOPT_POST => true, 
CURLOPT_POSTFIELDS => $post, 
CURLOPT_VERBOSE => true, 
CURLOPT_STDERR => $fp, 
CURLOPT_SSL_VERIFYPEER => false, 
CURLOPT_HTTPHEADER => array( 
'Content-type' => 'text/csv' 
) 
)); 
curl_setopt($ch, CURLOPT_HEADER, 1); 


$res = curl_exec($ch); 
curl_close($ch); 
fclose($fp); 
fclose($file); 
var_dump($res);