<?php
    require('dbconnection.php');

    if(isset($_POST['submitted'])){
        $fullname = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }

    // checking if the entered email is repeated or not
    $sql= "SELECT * FROM users WHERE email=?";
    $stmt= $connection->prepare($sql);
    $stmt-> bind_param("s", $email);
    $stmt->execute();
    $result= $stmt->get_result();

    if($result->num_rows > 0){
        echo "Email already exists";
    }
    else{
        $sql="INSERT INTO users (name, email, phone, address, password) VALUES (?,?,?,?,?)";
        $stmt= $connection->prepare($sql);
        $stmt-> bind_param("ssiss", $fullname, $email, $phone, $address, $password);
        
        if($stmt-> execute()){
            echo "successfully registered";
            header("Location:login.html");
        }
        else{
            echo "Failed to register";
        }
    }
?>