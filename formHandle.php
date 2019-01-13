<?php 

$tmp = $_FILES['userfile']['tmp_name']; 
$filename = $_FILES['userfile']['name']; 
move_uploaded_file($tmp, './uploads/'.$filename); 


$filepath = realpath('./uploads/'.$filename);
$post = array('file_content' => '@'.$filepath); 


$ch = curl_init(); 
curl_setopt_array($ch, array( 
CURLOPT_URL => 'http://api.voximplant.com/platform_api/CreateCallList/?account_id=2482237&api_key=ed0d0ea5-aeb3-4dd0-95a3-025c781bc957&rule_id=2299546&priority=1&max_simultaneous=2&num_attempts=2&name=callList', 
CURLOPT_RETURNTRANSFER => true, 
CURLOPT_POST => true, 
CURLOPT_POSTFIELDS => $post,  
CURLOPT_SSL_VERIFYPEER => false, 
CURLOPT_HTTPHEADER => array( 
'Content-type' => 'text/csv' 
) 
));  


$res = curl_exec($ch); 
curl_close($ch);

$result = json_decode($res, true);
if ($result['result']) {
    echo 'Список загружен и запущен!';
} else {
    echo 'Ошибка';
    echo ($result['error']['msg']);
}