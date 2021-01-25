<?php
    session_start();
    include("./resources/template/header.php");
?>


<link rel="stylesheet" href="./css/server.css" />
    <main>
        <?php 
                  require_once "./resources/config.php";
                  // Get server id from the query string and use it to get data from database
                  $current_server = $_GET["id"];
                  $sql = "SELECT name,description,image FROM servers where id=$current_server";

                  // Vote Code used to display if the vote was successful or not
                  $vote_status = "";
                  if(isset($_GET["vote_status"])) {
                    $vote_status = $_GET["vote_status"];
                  }
                    if ($vote_status == "success") {
                        $vote_status_message = "The vote was Successfully registered.";
                    } else if ($vote_status == "failed") {
                      $vote_status_message = "The vote failed to register, You may have voted more than 3 times for this server.";
                      // changes failed to danger as failed isnt a bootstrap style for alerts
                      $vote_status = "danger";
                    } else {
                    $vote_status_message = "";
                  }

                  // Gets the data from the database and if there is data will loop over it and display it as html element
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

                      <div class="alert alert-'. $vote_status .'" role="alert">
                      '. $vote_status_message .'
                    </div>
                      <div class="server-info">
                      <img
                          class="large-image"
                          src="uploads/'. $row["image"] .'"
                          alt="Server Image"
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
                    }
                  }


              ?>
        
    </main>

<?php    
  include("./resources/template/footer.php");
?>
