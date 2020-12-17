<?php
    session_start();
    include("./resources/template/header.php");
?>


<link rel="stylesheet" href="./css/server.css" />
    <main>
        <?php 
                  require_once "./resources/config.php";
                  $current_server = $_GET["id"];
                  $sql = "SELECT name,description,image FROM servers where id=$current_server";

                  $result = mysqli_query($link, $sql);

                  $result_check = mysqli_num_rows($result);
                  $counter = 0;

                  if ($result_check > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '            
                      <article class="server-block">
                      <div class="label">
                      <h1>'. $row["name"].'</h1>
                      </div>
                      <div class="server-info">
                      <img
                          class="large-image"
                          src="uploads/'. $row["image"] .'"
                          alt="Responsive image"
                      />
                      <div id="server-description">
                          <h1>Server Description</h1>
                          <p>'. $row["description"] .'</p>
                      </div>
                      <div class="server-buttons">
                      <a type="button" class="btn btn-primary" href="./includes/vote.inc.php?id='. $current_server .'">Vote</a>
                      </div>
                      </div>
        
        
                      </article>';
                      $counter += 1;
                    }
                  }


              ?>
        
    </main>

<?php    
  include("./resources/template/footer.php");
?>
