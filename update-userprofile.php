<?php
include "db_conn.php";
include "validate_access_token.php";
$response = array();
$params = json_decode(file_get_contents("php://input"));
$queryc = "SELECT * FROM users WHERE access_token ='$access_token' AND email= '$email';";
$result = mysqli_query($conn,$queryc);
$count = mysqli_num_rows($result);
if($count>=1)
  { 
      $response['valid']='true';
    if(isset($params->facebook_link)||isset($params->password)||isset($params->twitter_link)||isset($params->instagram_link)||isset($params->youtube_link)||isset($params->reddit_link)||isset($params->cloud_link)&&isset($params->email)) 
      {
   $response['valid'] ='true';
   $facebook_link = $params->facebook_link;
   $psd = $params->password;
   $password = hash('sha256',$psd);
   $twitter_link = $params->twitter_link;
   $instagram_link = $params->instagram_link;
   $youtube_link = $params->youtube_link;
   $reddit_link = $params->reddit_link;
   $cloud_link = $params->cloud_link;
   $email = $params->email;
   $response['message'] = "data received";
   echo json_encode($response);
      }
  
  $queryu = "UPDATE users
          SET password = '$password',twitter_link = '$twitter_link',instagram_link = '$instagram_link',
              youtube_link = '$youtube_link',facebook_link = '$facebook_link', reddit_link = '$reddit_link',cloud_link = '$cloud_link'
          WHERE email ='$email';";

       $result = mysqli_query($conn,$queryu);   
      
      $response['message'] = "Successfully Updated";
      echo json_encode($response);   
 }else
 {
  echo "not a valid login";
 }
    
