<?php    
    session_start();
    include("./resources/template/header.php");
?>
    <link rel="stylesheet" href="./css/index.css" />
    <main>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-white active-sort" onclick="sortTable('ranked',this)">Ranked</button>
        <button type="button" class="btn btn-white" onclick="sortTable('newest',this)">Newest</button>
        <button type="button" class="btn btn-white" onclick="sortTable('alphabetical',this)">alphabetical</button>
        <button type="button" class="btn btn-white" onclick="sortTable('players',this)">Players</button>
      </div>
      <div class="table" id="phone-table">
          <?php 
                  require_once "./resources/config.php";
                  $sql = "SELECT id, status, name, image,players,votes, created_at  FROM servers ORDER BY votes DESC";

                  $result = mysqli_query($link, $sql);

                  $result_check = mysqli_num_rows($result);
                  $counter = 1;

                  if ($result_check > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '            
                      <article class="phone-server"  data-created="'. $row['created_at'] . '">
                        <div>
                        <a href="./server.php?id='. $row['id'] . '">
                          <img
                            src="uploads/'.$row['image'].'"
                            class="img-fluid"
                            alt="Responsive image"
                          />
                          </a>
                        </div>
                        <div class="rank">
                          <span>'. $counter .'</span>
                        </div>
                        <ul class="phone-info">
                          <li><i class="fas fa-info-circle"></i>  '.$row['name'].'</li>
                          <li><i class="fas fa-user-friends"></i>  '.$row['players'].'</li>
                          <li><i class="fas fa-tachometer-alt"></i> '.$row['status'].'</li>
                          <li><i class="fas fa-poll"></i>  '.$row['votes'].'</li>
                        </ul>
                      </article>';
                      $counter += 1;
                    }
                  }
              ?>
                </div>


      <table class="table" id="full-table">
        <thead class="servers-header">
          <tr>
            <th class="col-rank" scope="col"><i class="fas fa-angle-double-up"></i> Rank</th>
            <th class="col-name" scope="col"><i class="fas fa-info-circle"></i> Name</th>
            <th class="col-server" scope="col">Server</th>
            <th class="col-player" scope="col"><i class="fas fa-user-friends"></i>  Player</th>
            <th class="col-status" scope="col"><i class="fas fa-tachometer-alt"></i> Status</th>
            <th class="col-vote" scope="col"><i class="fas fa-poll"></i> Votes</th>
          </tr>
        </thead>
        <tbody>
          <?php 
                  require_once "./resources/config.php";
                  $sql = "SELECT id, status, name, image,players, summary_description,votes, created_at  FROM servers ORDER BY votes DESC";

                  $result = mysqli_query($link, $sql);

                  $result_check = mysqli_num_rows($result);
                  $counter = 1;

                  if ($result_check > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '            
                      <tr data-created="'. $row['created_at'] . '">
                        <th scope="row">'. $counter .'</th>
                        <td>'.$row['name'].'</td>
                        <td>
                        <a href="./server.php?id='. $row['id'] . '">
                          <img
                            src="uploads/'.$row['image'].'"
                            class="img-fluid"
                            alt="Responsive image"
                          />
                          </a>
                          <span>'.$row['summary_description'].'</span>
                        </td>
                        <td>'.$row['players'].'</td>
                        <td>'.$row['status'].'</td>
                        <td>'.$row['votes'].'</td>
                      </tr>';
                      $counter += 1;
                    }
                  }
              ?>
        </tbody>
      </table>
    </main>
<script>
function sortTable(method, element) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("full-table");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      if (method == "alphabetical"){
        x = rows[i].getElementsByTagName("TD")[0].innerHTML.toLowerCase();
        y = rows[i + 1].getElementsByTagName("TD")[0].innerHTML.toLowerCase();
      }
      else if (method == "newest"){
        x = new Date(rows[i].dataset.created)
        y = new Date(rows[i + 1].dataset.created)
        console.log(x)
      }
      else if (method == "ranked"){
        x = parseInt(rows[i].getElementsByTagName("TD")[4].innerHTML);
        y = parseInt(rows[i + 1].getElementsByTagName("TD")[4].innerHTML);
        console.log(x)
      }
      else if (method == "players"){
        x = parseInt(rows[i].getElementsByTagName("TD")[2].innerHTML);
        y = parseInt(rows[i + 1].getElementsByTagName("TD")[2].innerHTML);
        console.log(x)
      }
      //check if the two rows should switch place:
      if (x < y) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
  let sortButtons = document.querySelectorAll(".btn-white")
  sortButtons.forEach((item) => {
    item.classList.remove("active-sort")
  })
  element.classList.add("active-sort")
  
}
</script>
<?php    
  include("./resources/template/footer.php");
?>