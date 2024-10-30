<?php
    session_start();
    require('dbconnection.php');

    if(isset($_POST["submitted"])){
        $email= $_POST['email'];
        $password= $_POST['password'];

        $sql= "SELECT * FROM users WHERE email=?";
        $stmt= $connection->prepare($sql);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result= $stmt->get_result();

        if($result-> num_rows == 1){
            $user= $result->fetch_assoc();
            if(password_verify($password, $user["password"])){
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["username"] = $user["name"];
                echo "login successfull";
                // header("Location: dashboard.php");
            }
            else{
                echo"password is incorrect";
            }
        }
    }
?>