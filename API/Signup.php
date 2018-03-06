<?php

  class Signup{

    public function __constuct( $apiName, $params, $lib ){

      $response = [];

      if(isset($params['email'],$params['password'],$params['firstname'],$params['lastname'])){
        $email= $params['email'];
        $firstname = $params['firstname'];
        $lastname = $params['lastname'];
        $password = hash('sha256',$params['password']);
        $bandname = $params['bandname'];
        $access_token = bin2hex(openssl_random_pseudo_bytes(16));

         if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $response['ERROR']='EMAIL address format error';
         }else{

           $sql = "SELECT * FROM users WHERE email = '$email';";
           $emailDB = mysqli_query($conn,$sql);
           $count = mysqli_num_rows($emailDB);

            if($count >=1) {
              $response['message']='This email address is already in use';
            }
            else{
              if(!empty($params['bandname'])) {
                $query = "INSERT INTO users(email,firstname,lastname,password,bandname,access_token) VALUES('$email','$firstname','$lastname','$password','$bandname','$access_token');";
                $insrtDB = mysqli_query($lib['database'],$query);
                $response['message'] =" you are successfully registered";
              } else {
                $query1 = "INSERT INTO users(email,firstname,lastname,password,access_token) VALUES('$email','$firstname','$lastname','$password','$access_token');";
                $insrtDB1 = mysqli_query($lib['database'],$query1);
                $response['success message'] = "you are registered";
              }
           }
        }
      }else{
          $response['message']="fill all the field";
      }
      echo json_encode($response,JSON_UNESCAPED_SLASHES);
    }

  }

?>
