<?php

require_once 'Functions.php';

$fun = new Functions();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));

  if(isset($data -> operation)){

  	$operation = $data -> operation;

  	if(!empty($operation)){

  		if($operation == 'register'){

  			if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> name) 
  				&& isset($data -> user -> email) && isset($data -> user -> password)){

  				$user = $data -> user;
  				$name = $user -> name;
  				$email = $user -> email;
  				$password = $user -> password;

          if ($fun -> isEmailValid($email)) {
            
            echo $fun -> registerUser($name, $email, $password);

          } else {

            echo $fun -> getMsgInvalidEmail();
          }

  			} else {

  				echo $fun -> getMsgInvalidParam();

  			}

  		}else if ($operation == 'login') {

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> password)){

          $user = $data -> user;
          $email = $user -> email;
          $password = $user -> password;

          echo $fun -> loginUser($email, $password);

        } else {

          echo $fun -> getMsgInvalidParam();

        }
      } else if ($operation == 'chgPass') {

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> old_password) 
          && isset($data -> user -> new_password)){

          $user = $data -> user;
          $email = $user -> email;
          $old_password = $user -> old_password;
          $new_password = $user -> new_password;

          echo $fun -> changePassword($email, $old_password, $new_password);

        } else {

          echo $fun -> getMsgInvalidParam();

        }
      } elseif ($operation == 'addDetails') {

            if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email)
                && isset($data -> user -> pNumber) && isset($data -> user -> address) && isset($data -> user -> carType) && isset($data -> user -> model)){
                $user = $data -> user;
                $email = $user -> email;
                $pNumber = $user -> pNumber;
                $address = $user -> address;
                $carType = $user -> carType;
                $model = $user -> model;
                echo $fun -> addDetails($email,$pNumber,$address,$carType,$model);
            }else{
                echo $fun -> getMsgInvalidParam();
            }

        }elseif ($operation == 'location') {

            if(isset($data -> user ) && !empty($data -> user) && isset($data -> location ) && !empty($data -> location) && isset($data -> location -> placename)
                && isset($data -> location -> latitude) && isset($data -> location -> longitude) && isset($data -> location -> address) && isset($data -> user -> email)){
                $user = $data -> user;
                $location = $data -> location;
                $placename = $location -> placename;
                $longitude = $location -> longitude;
                $latitude = $location -> latitude;
                $address = $location -> address;
                $email = $user -> email;
                echo $fun -> locations($placename,$latitude,$longitude,$address,$email);
            }else{
                echo $fun -> getMsgInvalidParam();
            }

        }

  	}else{

  		
  		echo $fun -> getMsgParamNotEmpty();

  	}
  } else {

  		echo $fun -> getMsgInvalidParam();

  }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET'){


  echo "Roadside Assistance Login API";

}

