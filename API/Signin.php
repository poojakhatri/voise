<?php

  class Signin{

    public function __construct($apiName, $params, $lib){

      $response = [];

      if(isset($params['email'], $params['password'])){
        $response['valid'] = 'true';
        $email = $params['email'];
        $password =hash('sha256',$params['password']);

        $query = "SELECT * FROM users WHERE email='$email' AND  password ='$password'";
        $result = mysqli_query($lib['database'],$query);
        $count = mysqli_num_rows($result);

        $response = ($count >= 1)
          ? $response = ['valid' => 'true', 'message' => "login successfull" ]
          : $response = ['valid' => 'false', 'message' => "invalid Login or Password" ];
      }else{
         $response['message']="invalid Login or Password";

      }

      echo json_encode($response,JSON_UNESCAPED_SLASHES);
    }
  }

?>
