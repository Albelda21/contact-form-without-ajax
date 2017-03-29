<?php

require 'db_config.php';


if (WeGucciDb()) {

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO contact (name, email, phone, message) VALUES (:name, :email, :phone, :message)';
        $sth = $conn->prepare($sql);
        $sth->execute(array(
                'name' => post('name'),
                'email' => post('email_set'),
                'phone' => post('phone'),
                'message' => post('msg')
            ));
        }

    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }

$conn = null;
} 


?>