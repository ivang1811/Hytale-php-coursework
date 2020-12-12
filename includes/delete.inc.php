<?php

require_once "../resources/config.php";

if(isset($_GET['id'])) {
    $server_id = (int)$_GET['id'];
    $sql = "DELETE FROM servers where id=$server_id";
    mysqli_query($link, $sql); 
    header("location: ../dashboard.php?server_deleted=successful");
    exit();
 }

?>