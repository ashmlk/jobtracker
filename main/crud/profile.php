<?php

session_start(); 
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../registration/login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../registration/login.php");
}

require_once "config.php";
$username = $_SESSION['username'];
$sql = "SELECT COUNT(*) as total FROM applications WHERE user_username='$username'";
$result = mysqli_query($link, $sql);
$data= mysqli_fetch_assoc($result);
$total_apps = $data['total']; // this is to get the total number of applications for user

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d3a3fc2f19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="../../js/main.js" type="text/javascript"></script>
    <link href="../../assets/style.css" rel="stylesheet">
</head>

<body style="min-height:100vh !important;">
    <?php  if (isset($_SESSION['username'])) : ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="base.php"><span class="mx-1"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
</svg></span>Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                        <a class="nav-link" href="profile.php"><span class="mx-1"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg><span>Profile
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="base.php?logout='1'"><span class="mx-1"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg><span>Logout                    
                        </a>
                    </li>
            </ul>
        </div>
    </nav>
    <div class="container" style="min-height:100vh !important;">
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-md-6" >
                <div class="card mb-2" style="margin-top:10rem;">
                    <div class="card-body ">
                        <div class="d-flex w-100 justify-content-center">
                        <img class="img-fluid rounded-circle" width="150px" src="https://avatars.dicebear.com/api/identicon/'<?php echo md5($username) ?>'.svg"/>
                        </div>                        
                        <h4 class="text-center my-2 mt-3"><?php echo $username?></h4>
                        <div class="border-top mt-1 pt-2">
                            <h6 class="text-center"><?php echo $total_apps ?> Applications</h6>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <div>
                                <div class="my-1">
                                <a class="btn btn-lg btn-primary my-2 w-100" href="../registration/reset-password.php">Reset Password</a>
                                </div>                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <?php endif ?>

</body>
<?php include '../global/footer.php';?>
</html>