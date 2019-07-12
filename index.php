<?php
 $token = "kjEv3TVS76bQUNkI2Xhse5L9O8hNHY1hQM9nkmn5l3N";

 $mes = $_GET['mes'];
 $stickerPkg = 3; //stickerPackageId
$stickerId = 240; //stickerId

 define('LINE_API',"https://notify-api.line.me/api/notify");  

 $res = notify_message($mes,$stickerPkg,$stickerId,$token);

 print_r($res);

 function notify_message($message,$stickerPkg,$stickerId,$token){

  $data = array('message' => $message,
  'stickerPackageId'=>$stickerPkg,
      'stickerId'=>$stickerId);

  $data = http_build_query($data,'','&');

  $header = array( 

          'http'=>array(

             'method'=>'POST',

             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"

                       ."Authorization: Bearer ".$token."\r\n"

                       ."Content-Length: ".strlen($data)."\r\n",

             'content' => $data

          ),

  );

  $context = stream_context_create($header);

  $result = file_get_contents(LINE_API,FALSE,$context);

  $res = json_decode($result);

  return $res;

 }
 ?>
