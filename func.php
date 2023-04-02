<?php

function sms($phone,$message){

  
    $parma= '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Body>
        <SendMsg xmlns="http://tempuri.org/">
          <User>etoo</User>
          <PWD>etoo@123</PWD>
          <SMSText>'.$message.'</SMSText>
          <Sender>EtooPlay</Sender>
          <nums>249'.$phone.'</nums>
        </SendMsg>
      </soap:Body>
    </soap:Envelope>';
   
   
    $URL="http://196.202.134.90/dsms/sendmessage.asmx?op=SendMsg";
   
   
    $ch = curl_init($URL);
    //echo 'Content-Length: '.strlen($parma);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; encoding="utf-8"','Content-Length: '.strlen($parma)));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parma);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
    $output = curl_exec($ch);
   
    if(curl_errno($ch)){
       echo curl_error($ch);
    }
   
    curl_close($ch);

   
  }


  function sendMail($to){
    $subject = '[Order Status] Council notification';
    $from = 'info@etooplay.com';

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    
    // Create email headers
    $headers .= 'From: Council notification '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

$message = file_get_contents("index.html");

    
     mail('a.etoo78@gmail.com', $subject, $message, $headers) or die(error_get_last()['message']);

  }


  function user_page($page_id,$group_id){

    require 'conn.php';

    $sql = "select * from per_groups where group_id = ?";
        $r = $conn->prepare($sql);
        $r->bind_param('i',$group_id);
        $r->execute();
        $rr = $r->get_result();
        while($per = $rr->fetch_assoc()){
            $PageArray[] = $per['page_id'];
        }

        if(!in_array($page_id,$PageArray)){

          return "<script>location.href='home.php';</script>";

        }
  }


  function user_oparetion($page_id,$group_id){

    require 'conn.php';

     $sql = "select * from per_groups where group_id = ? and page_id = ?";
        $r = $conn->prepare($sql);
        $r->bind_param('ii',$group_id,$page_id);
        $r->execute();
        $rr = $r->get_result();
        $per = $rr->fetch_assoc();

        return $per;

  }





?>