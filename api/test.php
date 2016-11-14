<?php
$data = array(
  "from_Account"=> "1234567890",
  "to_Account"=> "5495100020",
  "Amount"=> true,
  //"key"=> "test if not kong&non bank"
  "key" => "746H32ABMN"
);

$url_send ="http://glacial-gorge-51031.herokuapp.com/api/transfer";
// $str_data = http_build_query($data);
$str_data = json_encode($data);
$data1 = json_decode($str_data);
$dataa = $data1->{'Amount'};
if($dataa == true){
echo($dataa."Hello");
}
?>