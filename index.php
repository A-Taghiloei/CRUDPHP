<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>
<body>

	<div class="wrapper">
		<div class="row col-md-10" >
			<form method="post" ACTION="add.php" class="form-horizontal col-md-6 col-md-offset-3">
			<h2>Simple CRUD</h2>
			<div class="form-group">
				<div class="col-sm-10">
				<input type="text" name="fname"  class="form-control" id="fname" placeholder="First Name" />
			</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10">
					<input type="text" name="lname"  class="form-control" id="lname" placeholder="Last Name" />
				</div>
			</div>
			
			<input type="submit" class="btn btn-primary col-md-10 col-md-offset-10" value="Add New Nme" />
			</form>
		</div>
	</div>

    <div class="wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "database.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM userlist";
                    if($result = $dataLink->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>First Name</th>";
                                        echo "<th>Last Name</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['fname'] . "</td>";
                                        echo "<td>" . $row['lname'] . "</td>";
                                        echo '<td>';
                                            echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip">update</a>';
                                            echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip">delete</a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    $dataLink->close();
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>