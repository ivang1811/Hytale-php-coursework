<?php 
    require_once "../resources/config.php";
    $sql = "SELECT id, status, name FROM servers";

    $result = $link->query($sql);

    foreach ($result as &$value) {
        echo $value;
    }


?>