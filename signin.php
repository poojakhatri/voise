<?php

include "db_conn.php";

$response = array();

$params = json_decode(file_get_contents("php://input"));

if (isset($params->email) && isset($params->password))
 {

    $response['valid'] = 'true';
    $email = $params->email;
    $password=$params->password;
     $pass = hash('sha256',$password);

       
    $query = "SELECT * FROM users WHERE email='$email' AND  password ='$pass'";


    $result = mysqli_query($conn,$query);
    $count = mysqli_num_rows($result);
    print_r($count);
     
      if($count >= 1) 

          {       $response['valid'] = 'true';    
                  $response['message']= "login successfull";
                  echo json_encode($response,JSON_UNESCAPED_SLASHES);
          }
        
      else{
                   $response['valid'] = 'false';
                   $response['message']="invalid Login or Password";
                  
                   echo json_encode($response,JSON_UNESCAPED_SLASHES);
          }
    
       
  }
  else 
  {
     $response['message']="invalid Login or Password";
     echo json_encode($response,JSON_UNESCAPED_SLASHES);
  }

            

            