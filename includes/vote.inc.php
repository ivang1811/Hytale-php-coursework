<?php 
    require_once "../resources/config.php";
    $server_id = $_GET["id"];
    $sql = "UPDATE servers SET votes = votes + 1 WHERE id = $server_id";

    mysqli_query($link, $sql);

    header("Location: ../server.php?id=$server_id")

?>