<?php
    session_start();
    include("./resources/template/header.php");
    // Used to check if the user is logged in if not redirect them back to hompage
    if((!isset($_SESSION["loggedin"])) && $_SESSION["loggedin"] != true){
    header("location: ./");
    exit;
}
?>
<link rel="stylesheet" href="./css/dashboard.css" />
    <main>
      <div class="heading">
        <h1>Your Account</h1>
      </div>
      <section class="left-tabs">
        <button type="button" class="btn tab-btn selected-tab">Overview</button>
        <hr class="solid" />
        <button type="button" class="btn tab-btn">Favorite Servers</button>
        <button type="button" class="btn tab-btn">Your Servers</button>
        <hr class="solid" />
        <button type="button" class="btn tab-btn">Edit Account</button>
      </section>
      <section class="right-content">
        <h2 class="display-5">Manage servers</h2>
        <a id="create-server-button" type="button" class="btn btn-primary">Create New server</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Number</th>
              <th scope="col">Status</th>
              <th scope="col">UID</th>
              <th scope="col">Server Name</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                  require_once "./resources/config.php";
                  $current_user = $_SESSION["id"];
                  $sql = "SELECT id, status, name FROM servers where owner='$current_user'";

                  $result = mysqli_query($link, $sql);

                  $result_check = mysqli_num_rows($result);
                  $counter = 0;

                  if ($result_check > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '            
                      <tr>
                      <th scope="row">'. $counter .'</th>
                      <td>'. $row['status'] .'</td>
                      <td>'. $row['id'] .'</td>
                      <td>'. $row['name'] .'</td>
                      <td>
                        <a type="button" href="serverform.php?edit=true&server_id='. $row['id'] .'" class="btn btn-primary">Edit</a>
                        <a type="button" class="btn btn-danger delete-server" href="./includes/delete.inc.php?id='. $row['id'] .'">Delete</a>
                      </td>
                      </tr>';
                      $counter += 1;
                    }
                  }


              ?>
            
          </tbody>
        </table>
      </section>
    </main>

    <footer></footer>

    <!-- Bootstrap Javascript import -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>
  </body>



<script>
    var a = document.getElementById('create-server-button');
    a.href = `./serverform.php`
    </script>
</html>
