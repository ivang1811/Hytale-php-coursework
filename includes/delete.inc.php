<?php

require_once "../resources/config.php";

// Uses the server url sent to get the serverid of the server to delete
if(isset($_GET['id'])) {
    $server_id = (int)$_GET['id'];
    $sql = "DELETE FROM servers where id=$server_id";
    mysqli_query($link, $sql); 
    header("location: ../dashboard.php?server_deleted=successful");
    exit();
 }

?>