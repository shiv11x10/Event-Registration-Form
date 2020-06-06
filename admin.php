<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "stackhack";

$conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

 if (array_key_exists("present", $_POST)) {

$sql = "UPDATE `registrations` SET Present = 'YES' WHERE id = ".$_POST['admin_enter'];
    
        if (mysqli_query($conn, $sql)) {
          
            echo "<script>alert('sucessfull!!')</script>";
       } else {
       
            echo "<script>alert('not sucessfull!!')</script>";
       
       }
}
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="txt" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Take Attendences</h2>
                <form name="send" method="POST" >
                    <div class="form-group">
                        <label class="cols-sm-2 control-label" for="admin_enter">Enter the ID</label>
                        <input class="form-control" type="text" name="admin_enter" placeholder = "ID" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="present" value="Mark Present">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Number of Registrations</h2>
                <table class='table table-bordered'>
                <tr>
                <th>REgistration type</th><th>Count</th>
                </tr>
                <tbody>

                    <?php
                    $sqlQuery = "SELECT `Registration type`, COUNT(*) FROM `registrations` GROUP BY `Registration type`";    

                    if($result = mysqli_query($conn, $sqlQuery)){
                    foreach($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['Registration type'] . "</td>";
                    echo "<td>" . $row['COUNT(*)'] . "</td>";
                    echo "</tr>"; 
                    }
                    }else{
                        echo mysqli_error($conn);
                    }
                    ?>
                </tbody>
                    </table>
            </div>
        </div>

    <div class="row">
            <div class="col-12">
                <h2>Registrations</h2>
                <table class='table table-bordered'>
                <tr>
                <th>id</th><th>Name</th><th>Date</th>
                </tr>
                <tbody>

                    <?php
                    $sqlQuery = "SELECT `id`, `Name`, `date` FROM `registrations`";    

                    if($result = mysqli_query($conn, $sqlQuery)){
                    foreach($result as $row) {
                    echo "<tr>";
                    echo "<td><a href='#exampleModal' data-toggle='modal' onclick='show(this.innerHTML)'>" . $row['id'] . "</a></td>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "</tr>"; 
                    }
                    }else{
                        echo mysqli_error($conn);
                    }
                    ?>
                </tbody>
                    </table>
            </div>
        </div>

<script>
    function show(str) {
    var xhttp;
  if (str == "") {
    document.getElementById("txt").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("txt").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "get.php?q="+str, true);
  xhttp.send();
}
</script>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>