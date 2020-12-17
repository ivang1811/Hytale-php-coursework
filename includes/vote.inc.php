<?php 
    require_once "../resources/config.php";
    session_start();
    $server_id = $_GET["id"];
    $sql = "UPDATE servers SET votes = votes + 1 WHERE id = $server_id";
    $vote_url = "vote_". $server_id ."";
    echo $vote_url;
    

    if(isset($_SESSION[$vote_url])){
        $_SESSION[$vote_url] = $_SESSION[$vote_url] + 1;
    } else {
        $_SESSION[$vote_url] =  1;
    }
    echo $_SESSION[$vote_url];

    if(isset($_SESSION[$vote_url]) && $_SESSION[$vote_url] > 3){
        header("Location: ../server.php?id=$server_id&vote_status=failed");
        echo "Cant Vote";
    } else {
        mysqli_query($link, $sql);

        header("Location: ../server.php?id=$server_id&vote_status=success");
    }

    

?>