<?php
// key
// kaiimook1111
// kong2222
// non3333
// CONST_MRNONZ = "UX239I4NB1"
// CONST_CESE   = "746H32ABMN"
// Non = 01iTqwqgh7
// Kong = 4R02vZ4c69
$data = array(
  "from_Account"=> "1234567890",
  "to_Account"=> "5495100020",
  "Amount"=> 100000.00,
  //"key"=> "test if not kong&non bank"
  "key" => "746H32ABMN"
);

$url_send ="http://glacial-gorge-51031.herokuapp.com/api/transfer";
// $str_data = http_build_query($data);
$str_data = json_encode($data);

function sendPostData($url, $post){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $result = curl_exec($ch);
  curl_close($ch);  // Seems like good practice
  return $result;
}

echo " " . sendPostData($url_send, $str_data);

?>
