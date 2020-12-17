<?php 
  require_once "../resources/config.php";
  session_start();
  $server_name = $_POST['server_name'];
  $server_summary = $_POST['server_summary'];
  $server_status = $_POST['server_status'];
  $server_image = $_FILES["fileToUpload"]["name"];
  $player_amount = $_POST['player_amount'];
  $server_description = $_POST['server_description'];
  $owner = $_SESSION["id"];
  $server_id = $_GET["id"];

  $sql = "UPDATE servers set name='$server_name',players='$player_amount',
  status='$server_status',summary_description='$server_summary',description='$server_description' WHERE id=$server_id ";
  echo $sql;

  if (mysqli_query($link, $sql)) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . mysqli_error($link);
  }
  


  $target_dir = dirname(__FILE__) . "/../uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($_FILES["fileToUpload"]["name"]) {
    $sql = "UPDATE servers set image='$server_image' WHERE id=$server_id ";
    if (mysqli_query($link, $sql)) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . mysqli_error($link);
      }
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
  
  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
 header("Location: ../dashboard.php?server_added=successful")

?>