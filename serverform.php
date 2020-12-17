<?php

// Include config file
require_once "./resources/config.php";
?>

<?php 
    session_start();
    include("./resources/template/header.php");
    // Used to check if the user is logged in if not redirect them back to hompage
    if((!isset($_SESSION["loggedin"])) && $_SESSION["loggedin"] != true){
    header("location: ./");
    exit;
    }
?>

<?php 
if (!empty($_GET['edit'])) {
  $user  = $_SESSION["id"];
  $current_server = $_GET['server_id'];
  $sql = "SELECT id,name,description,owner,summary_description,status,players FROM servers where id='$current_server'";
  $result = mysqli_query($link, $sql);
  $server = mysqli_fetch_row($result);

  if ($user == $server[3]) {
    $name = $server[1];
    $description = $server[2];
    $summary_description = $server[4];
    $status = $server[5];
    $players = $server[6];
  }else {
    echo $user;
    echo $server[3];
  }

}

?>
<link rel="stylesheet" href="./css/dashboard.css" />
    <main>

      <section class="left-tabs">
      <select name="cars" class="Select-tab" id="cars">
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="mercedes">Mercedes</option>
        <option value="audi">Audi</option>
      </select>
      </section>
      <section class="right-content">
        <h1>+ New Server</h1>
        <form action="<?php echo (!empty($_GET['edit'])) ? "includes/edit.inc.php?id=".$_GET['server_id']  :  "includes/serverpost.inc.php"; ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">Server Name:</label>
            <input type="text" name="server_name" value="<?php echo (!empty($_GET['edit'])) ? $name  :  ""; ?>"  class="form-control input-block-level" id="exampleInputEmail1" aria-describedby="titlehelp" placeholder="E.g. Cool Hytale Server">
            <small id="titlehelp" class="form-text text-muted">The title should be short and catchy. It will be used the most</small>
          </div>

          <div class="form-group">
            <label for="server-summary">Server Image:</label>
            <input type="file" class="form-control-file"  name="fileToUpload" id="fileToUpload">
            <span class="help-block"></span>
            <small id="titlehelp" class="form-text text-muted"><?php echo (!empty($_GET['edit'])) ? "Please re-upload new image"  :  ""; ?> </small>
          </div>

          <div class="form-group">
            <label for="server-summary">Player Amount:</label>
            <input value="<?php echo (!empty($_GET['edit'])) ? $players  :  ""; ?>" type="number" name="player_amount" class="form-control input-block-level" id="server-players" placeholder="e.g We would like to invite you to join us on this amazing server."></input>
            <span class="help-block"></span>
          </div>

          <div class="form-group">
            <label for="server-summary">Server status:</label>
            <select class="form-select form-control" id="server-status" name="server_status" aria-label="Server status select">
              <option value="Online" selected>Online</option>
              <option value="Offline">Offline</option>
            </select>
            <span class="help-block"></span>
          </div>

          <div class="form-group">
            <label for="server-summary">Short server Summary (150 characters):</label>
            <textarea  type="text" name="server_summary" class="form-control input-block-level" id="server-summary" placeholder="e.g We would like to invite you to join us on this amazing server."><?php echo (!empty($_GET['edit'])) ? $summary_description  :  ""; ?></textarea>
            <span class="help-block"></span>
          </div>

          <div class="form-group">
            <label for="server-description">Enter server Description:</label>
            <textarea rows="4" name="server_description"  type="text" class="form-control input-block-level" id="server-description" placeholder="e.g A long description for people really interested in the server to read when they visit the server page."><?php echo (!empty($_GET['edit'])) ? $description  :  ""; ?></textarea>
            <span class="help-block"></span>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </section>
    </main>

<?php    
  include("./resources/template/footer.php");
?>    
