<?php

include "db_conn.php";



$response = array();

$params = json_decode(file_get_contents("php://input"));

if(!empty($params->email) && (!empty($params->password)) && (!empty($params->firstname)) && (!empty($params->lastname)))
{

   $email= $params->email;
   $firstname = $params->firstname;
   $lastname = $params->lastname;
   $psd = $params->password;
   $password = hash('sha256',$psd);
   $bandname = $params->bandname;
   $access_token = bin2hex(openssl_random_pseudo_bytes(16));
 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $response['ERROR']='EMAIL address format error'; 
      echo json_encode($response,JSON_UNESCAPED_SLASHES);
      return;
    } 
       
    $sql = "SELECT * FROM users WHERE email = '$email';";
    $emailDB = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($emailDB);

     if($count >=1) 
     {
       $response['message']='This email address is already in use';
       echo json_encode($response,JSON_UNESCAPED_SLASHES);
     }
     else
      {
       if(!empty($params->bandname))
          {
             $query = "INSERT INTO users(email,firstname,lastname,password,bandname,access_token)
                       VALUES('$email','$firstname','$lastname','$password','$bandname','$access_token');";
             $insrtDB= mysqli_query($conn,$query);
             $response['message'] =" you are successfully registered";
             echo json_encode($response);
          }else
          {
             $query1 = "INSERT INTO users(email,firstname,lastname,password,access_token)
                       VALUES('$email','$firstname','$lastname','$password','$access_token');";
            $insrtDB1 = mysqli_query($conn,$query1);   
            $response['success message'] = "you are registered";
            echo json_encode($response);
          }

    }

}

else
{
$response['message']="fill all the field";
    echo json_encode($response,JSON_UNESCAPED_SLASHES);
}



 



?> 