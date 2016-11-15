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
  "to_Account"=> "8194381656",
  "Amount"=> 1000.00,
  //"key"=> "test if not kong&non bank"
  //"key" => "4R02vZ4c69"
  "key" => "kaiimook1111"
);

$url_send ="http://bank.route.in.th:9999/api/transfer";
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

$result = sendPostData($url_send, $str_data);
echo $result;
$res = json_decode($result);
echo $res;
// $success = $res->{'success'};
// $error_message = $res->{'error_message'};

// if($success == true){
//   echo "OMG ";
//   echo($error_message);
// }
// else
// {
//   echo($error_message);
// }
?>
