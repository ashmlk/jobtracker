<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php  if (isset($_SESSION['username'])) : ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="base.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a href="base.php?logout='1'">Logout</a> 
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-3 p-2">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                            <a class="text-dark" href="base.php">
                                Applications
                            </a>
                        </li>
                        <li class="list-group-item"  >
                            <a class="text-dark" href="create.php">
                                Add
                            </a>
                        </li>
                        <li class="list-group-item" >
                            <a class="text-dark" href="interviews.php">
                                Interviews
                            </a>
                        </li>
                        <li class="list-group-item" >
                            <a class="text-dark" href="base.php">
                                Offers
                            </a>
                        </li>
                        <li class="list-group-item" >
                            <a class="text-dark" href="rejected.php">
                                Rejected
                            </a>
                        </li>
                        <li class="list-group-item" >
                            <a class="text-dark" href="declined.php">
                                Declined
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 p-2">
                <?php
                    require_once "config.php";
                    $sql = "SELECT * FROM applications WHERE type='rejected'";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<div class='row d-flex justify-content-center p-1'>";                              
                                while($row = mysqli_fetch_array($result)){
                                    echo "<div class='col-md-6 p-1'>";
                                    echo "<card class='text-white bg-danger'>";
                                        echo "<div class='card-body'>";
                                            echo "<div class='d-flex justify-content-center'>";
                                            echo "<div>";
                                            echo "<h5 class='card-title border-bottom'>" . $row['position'] . "</h5>";
                                            echo "</div>";
                                            echo "<div>";
                                            echo '
                                            <div class="dropdown show">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Dropdown link
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            ';
                                                echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            echo '</div></div>';
                                            echo "</div>";
                                            echo "</div>";                                         
                                            echo "<div class='h6 text-muted lead'>" . $row['company'] . "</div>";
                                            echo "<div class='small card-subtitle mb-2'>" . $row['date'] . "</div>";
                                            echo "<p class='mt-2 card-text text-dark'>" . $row['notes'] . "</p>";
                                        echo "</div>";
                                    echo "</card>";
                                    echo "</div>"; 
                                }                                                          
                            echo "</div>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    <?php endif ?>
  	<?php if (isset($_SESSION['success'])) : ?>
      < class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </>
  	<?php endif ?>
</body>
</html>