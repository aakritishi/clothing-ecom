<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname='ecommerce';
    $port='4306';
    $connection=mysqli_connect($servername,$username,$password,$dbname,$port);
    if ($connection) {
        echo "successfully connect";
     } else {
         echo "failed". mysqli_error($connection);
     }
?>