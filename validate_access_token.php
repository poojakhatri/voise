<?php
include "db_conn.php";
// include "signup.php";
$response = array();
$params = json_decode(file_get_contents("php://input"));

if(isset($params->email))
{
  $email = $params->email; 
}
 // $email = $params->email;//from where we should take this value 
$sql = "SELECT access_token FROM users WHERE email = '$email';";
$result = mysqli_query($conn,$sql) or die(mysqli_error());
$count = mysqli_num_rows($result);
// printf("count %d",$count);
if($count >=1)
     {
        $response['valid']='true';
        $response['message']="valid access_token";
        echo json_encode($response);
         while ($row = mysqli_fetch_array($result))
            {
                $access_token = $row['access_token'];
            
            }

    
     }else
     {
        $response['valid'] = '1';
        $response['error-message'] ="token error";
        echo json_encode($response);
     }




    