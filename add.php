<?php

require_once "database.php";

$fname = $lname = "";
$fname_err = $lname_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_name = trim($_POST["fname"]);
    if(empty($input_name)){
        $fname_err = "No name Entered";
    } else{
        $fname = $input_name;
    }
    
    $last_name = trim($_POST["lname"]);
    if(empty($last_name)){
        $lname_err = "No Last Name Entered";     
    } else{
        $lname = $last_name;
    }
    

    if(empty($fname_err) && empty($lname_err)){

        $sql = "INSERT INTO userlist (fname, lname) VALUES (?, ?)";
 
        if($stmt = $dataLink->prepare($sql)){

            $param_name = $fname;
            $param_address = $lname;

            $stmt->bind_param("ss", $param_name, $param_address);

            if($stmt->execute()){
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        $stmt->close();
    }
    $mysqli->close();
}
?>