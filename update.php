<?php
require_once "database.php";
 
$fname = $lname = "";
$fname_err = $lname_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
    $input_fname = trim($_POST["fname"]);
    if(empty($input_fname)){
        $fname_err = "Please enter a Name.";
    } else{
        $fname = $input_fname;
    }
    
    $input_lname = trim($_POST["lname"]);
    if(empty($input_lname)){
        $lname_err = "Please enter a Last Name.";     
    } else{
        $lname = $input_lname;
    }
    
    if(empty($fname_err) && empty($lname_err)){

        $sql = "UPDATE userlist SET fname='".$fname."', lname='".$lname."' WHERE id='".$id."'";
        $stmt = $dataLink->prepare($sql);
        $stmt->execute();
        header("location: index.php");
        exit();
        $stmt->close();
        
    }
    $dataLink->close();
} else{

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM userlist WHERE id = ?";
        if($stmt = $dataLink->prepare($sql)){

            $param_id = $id;
            $stmt->bind_param("i", $param_id);
            
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $fname = $row["fname"];
                    $lname = $row["lname"];
                } else{
                    echo "Something went wrong. Please try again later.";
                    exit();
                }
                
            } else{
                echo "Something went wrong. Please try again later.";
            }

        }

        $stmt->close();

        $dataLink->close();
    }  else{
        echo "Something went wrong. Maybe ID doesnt Exist.";
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>fname</label>
                            <input type="text" name="fname" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                            <span class="invalid-feedback"><?php echo $fname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>lname</label>
                            <textarea name="lname" class="form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>"><?php echo $lname; ?></textarea>
                            <span class="invalid-feedback"><?php echo $lname_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id;?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>