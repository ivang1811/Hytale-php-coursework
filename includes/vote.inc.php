<?php 
    require_once "../resources/config.php";
    // first starts the session to be able to get required variables
    session_start();
    // gets the userid from the url query
    $server_id = $_GET["id"];
    $sql = "UPDATE servers SET votes = votes + 1 WHERE id = $server_id";
    // formats the voting url 
    $vote_url = "vote_". $server_id ."";
    
    // counts the amount of times the user has voted for the specific server
    if(isset($_SESSION[$vote_url])){
        $_SESSION[$vote_url] = $_SESSION[$vote_url] + 1;
    } else {
        $_SESSION[$vote_url] =  1;
    }

    // If the user hasnt voted more than 3 times run the sql query to add a vote
    if(isset($_SESSION[$vote_url]) && $_SESSION[$vote_url] > 3){
        header("Location: ../server.php?id=$server_id&vote_status=failed");
    } else {
        mysqli_query($link, $sql);

        header("Location: ../server.php?id=$server_id&vote_status=success");
    }

?>