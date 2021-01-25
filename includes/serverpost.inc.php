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

  $sql = "INSERT INTO servers (name,image,players,status,summary_description,description,owner,votes) values 
  ('$server_name','$server_image',$player_amount,'$server_status','$server_summary','$server_description','$owner',0)";

  mysqli_query($link, $sql);


  $target_dir = dirname(__FILE__) . "/../uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $return_error = "That File was not an image!";
      $uploadOk = 0;
    }
  }
  
  // Check if file already exists
  if (file_exists($target_file)) {
    $return_error = "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 50000000) {
    $return_error = "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $return_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $return_error = "Sorry, your file was not uploaded as it was not the correct format or size.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    } else {
      $return_error = "Sorry, there was an error uploading your file.";
    }
  }
  if (!empty($return_error)) {
    header("Location: ../dashboard.php?server_added=successful");
  } else {
    header("Location: ../dashboard.php?server_error=$return_error");
  }
 

?>