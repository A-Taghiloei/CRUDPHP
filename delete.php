<?php
if(isset($_GET["id"]) && !empty($_GET["id"])){
    require_once "database.php";
    
    $id = trim($_GET["id"]);
    $sql = "DELETE FROM userlist WHERE id='".$id."'";
    $stmt = $dataLink->prepare($sql);
    $stmt->execute();
    header("location: index.php");
    exit();
    $stmt->close();
}
?>