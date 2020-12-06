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
  $total_apps = $data['total'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d3a3fc2f19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="../../assets/style.css" rel="stylesheet">
</head>
<body>
    <?php  if (isset($_SESSION['username'])) : ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="base.php"><span class="mx-1"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
            </svg></span>Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
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
        <div class="container"style="min-height:100vh !important;">
            <div class="col-12 p-2 mt-3 d-block d-md-none" style="overflow-y:auto;">
                <div class="d-flex responsive-menu-list">
                    <div class="d-flex p-2 border-rounded align-items-center justify-content-center">
                        <span class="mx-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                </svg>
                        </span>
                        <a class="text-dark" href="base.php">
                            Applications
                        </a>
                    </div>
                    <div class="d-flex p-2 border-rounded align-items-center justify-content-center"  >
                        <span class="mx-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                        </span>
                        <a class="text-dark" href="create.php">
                            Add
                        </a>
                    </div>
                    <div class="d-flex p-2 border-rounded align-items-center justify-content-center" >
                        <span class="mx-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-inbound" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0zm-12.2 1.182a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                        </span>
                        <a class="text-dark" href="base.php?type=interview">
                            Interviews
                        </a>
                    </div>
                    <div class="d-flex p-2 border-rounded align-items-center justify-content-center" >
                        <span class="mx-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                                <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                        </span>
                        <a class="text-dark" href="base.php?type=offer">
                            Offers
                        </a>
                    </div>
                    <div class="d-flex p-2 border-rounded align-items-center justify-content-center" >
                        <span class="mx-2"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-excel" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                            <path fill-rule="evenodd" d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704z"/>
                            </svg>
                        </span>
                        <a class="text-dark" href="base.php?type=rejected">
                            Rejected
                        </a>
                    </div>
                    <div class="d-flex p-2 border-rounded align-items-center justify-content-center" >
                        <span class="mx-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-slash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path fill-rule="evenodd" d="M11.354 4.646a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                        </span>
                        <a class="text-dark" href="base.php?type=declined">
                            Declined
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 p-2 mt-3 d-none d-md-block">
                    <div class="card mb-2">
                        <div class="card-body ">
                            <div class="d-flex w-100 justify-content-center">
                            <img class="img-fluid rounded-circle" width="150px" src="https://avatars.dicebear.com/api/identicon/'<?php echo md5($username) ?>'.svg"/>
                            </div>                        
                            <h4 class="text-center my-2 mt-3"><?php echo $username?></h4>
                            <div class="border-top mt-1 pt-2">
                                <h6 class="text-center"><?php echo $total_apps ?> Applications</h6>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="mx-2">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                  </svg>
                            </span>
                            <a class="text-dark" href="base.php">
                                Applications
                            </a>
                        </li>
                        <li class="list-group-item"  >
                            <span class="mx-2">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                  </svg>
                            </span>
                            <a class="text-dark" href="create.php">
                                Add
                            </a>
                        </li>
                        <li class="list-group-item" >
                            <span class="mx-2">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-inbound" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0zm-12.2 1.182a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                  </svg>
                            </span>
                            <a class="text-dark" href="base.php?type=interview">
                                Interviews
                            </a>
                        </li>
                        <li class="list-group-item" >
                            <span class="mx-2">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                                    <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                                  </svg>
                            </span>
                            <a class="text-dark" href="base.php?type=offer">
                                Offers
                            </a>
                        </li>
                        <li class="list-group-item" >
                            <span class="mx-2"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-excel" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                                <path fill-rule="evenodd" d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704z"/>
                              </svg>
                            </span>
                            <a class="text-dark" href="base.php?type=rejected">
                                Rejected
                            </a>
                        </li>
                        <li class="list-group-item" >
                            <span class="mx-2">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-slash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd" d="M11.354 4.646a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                  </svg>
                            </span>
                            <a class="text-dark" href="base.php?type=declined">
                                Declined
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 p-2 pt-3">
                <?php
                    require_once "config.php";
                    $type_name = 'application'; // default type of application id GET request was empty
                    $username = $_SESSION['username'];
                    $sql = "SELECT * FROM applications WHERE type='application' and user_username='$username' order by 'date' ";
                    if(!empty(trim($_GET["company"])) && empty(trim($_GET["type"]))){
                        $company_name = trim($_GET["company"]);
                        $sql = "SELECT * FROM applications WHERE type='application' and user_username='$username' and company='$company_name' order by 'date' ";
                        $url = 'https://autocomplete.clearbit.com/v1/companies/suggest?query='. $company_name .''; // Clearbit API to get the logo of company if company was present in GET request
                        $obj = json_decode(file_get_contents($url), true); // decode the JSON file returned
                        $logo_url =  $obj[0]['logo'];
                        echo '
                        <div class="mt-2 mx-2 border-bottom mb-1 pb-2 d-flex justify-content-start p-2 align-items-center bg-company">
                        <div class="logo d-flex align-items-center">
                        <div class="mr-2">
                        <img class="img-fluid rounded-circle" width="75px"  src='. $logo_url .'>
                        </div>
                            <h2>'. $company_name .'</h2>
                        </div> 
                        </div>
                        ';
                    }
                    if(!empty(trim($_GET["type"])) && empty(trim($_GET["company"]))){ 
                        // if the application type was empty in GET request and company was present only filter based on company (Show all applications)
                        $type_name = trim($_GET["type"]);
                        if($type_name != 'all'){
                            $sql = "SELECT * FROM applications WHERE type='$type_name' and user_username='$username' order by 'date' ";
                        }
                    }
                    if(!empty(trim($_GET["type"])) && !empty(trim($_GET["company"]))) {
                       
                        $type_name = trim($_GET["type"]);
                        $company_name = trim($_GET["company"]);
                        if($type_name != 'all'){  // if the type was all return all types of application otherwise return type=TYPE
                            $sql = "SELECT * FROM applications WHERE type='$type_name' and user_username='$username' and company='$company_name' order by 'date' ";
                        } else {
                            $sql = "SELECT * FROM applications WHERE user_username='$username' and company='$company_name' order by 'date' ";
                        }                       
                        $url = 'https://autocomplete.clearbit.com/v1/companies/suggest?query='. $company_name .'';
                        $obj = json_decode(file_get_contents($url), true);
                        $logo_url =  $obj[0]['logo']; // based on application type return a helper text to HTML
                        if($type_name == 'application') {
                            $application_text = 'Applied Applications';
                        } else if($type_name == 'offer') {
                            $application_text = 'Offers';
                        } else if($type_name == 'declined') {
                            $application_text = 'Declined Applications';
                        } else if($type_name == 'rejected') {
                            $application_text = 'Rejected Applications';
                        } else if($type_name == 'interview') {
                            $application_text = 'Interviews';
                        } else {
                            $application_text = '';
                        }
                        echo '
                        <div class="mt-2 mx-2 border-bottom mb-1 pb-2 d-flex justify-content-between p-2 align-items-center bg-company">
                        <div class="logo d-flex align-items-center">
                        <div class="mr-2">
                        <img class="img-fluid rounded-circle" width="75px"  src='. $logo_url .'>
                        </div>
                        <div>
                            <h2>'. $company_name .'</h2><div style="margin-top:-9px;text-decoration:underline;" class="small">'. $application_text .'</div>
                            <a class="small text-muted" href="https://clearbit.com" style="font-size:12px !important;">Logo by Clearbit</a>
                        </div>
                        </div> 
                        <div>
                        <a href="base.php?company='. $company_name .'&type=all">View All</a>
                        </div>
                        </div>
                        ';
                    }
                    if($result = mysqli_query($link, $sql)){
                        $type_get = trim($_GET["type"]);
                        if(mysqli_num_rows($result) > 0){
                            echo "<div class='mx-2 row'>";                              
                                while($row = mysqli_fetch_array($result)){                                  
                                    if($type_get == "all") {
                                        $type_name = $row['type'];
                                    }
                                    if($row['notes']== "") {
                                        $row['notes'] = "N/A";
                                    }

                                    $trash_svg = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>';
                                    $edit_svg = '
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                    ';
                                    $dot_svg = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>';
                                    echo "<div class='col-md-6 p-1'>";
                                    echo "<div class='card app-container text-white bg-primary bg-custom-$type_name' >";
                                        echo "<div class='card-body'>";
                                            echo "<div class='d-flex justify-content-between border-bottom mb-2 pb-1'>";
                                            echo "<div>";
                                            echo "<h5 class='card-title '>" . $row['position'] . "</h5>";
                                            echo "</div>";
                                            echo "<div>";
                                            echo '
                                            <div class="dropdown">
                                            <button class="btn btn-sm text-white" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $dot_svg . '</button>
                                            <div class="dropdown-menu pl-2" aria-labelledby="dropdownMenuLink">';
                                            echo "<a class='small text-muted' href='update.php?id=". $row['id'] ."'>$edit_svg<span class='mx-1'>Edit</span></a>";
                                            echo "</br>";
                                            echo "<a class='text-muted small' href='delete.php?id=". $row['id'] ."'>$trash_svg<span class='mx-1'>Delete</span></a>";                                             
                                            echo '</div></div>';
                                            echo "</div>";
                                            echo "</div>";   
                                            echo "<div class='col my-1'>"; 
                                            echo "<a href='base.php?type=$type_name&company=". $row['company'] . "'>";                                    
                                            echo "<div class='h6 mb-2 lead company-name'>" . $row['company'] . "</div>";
                                            echo "</a>";
                                            echo "</div>";
                                            echo "<div class='col my-1'>"; 
                                            echo "<div class='mt-3 card-subtitle mb-2 date-name'>" . $row['date'] . "</div>";
                                            echo "</div>";
                                            echo "<div class='col my-1' style='margin-top:19px !important;'>"; 
                                            echo "<div class=' mt-3 card-subtitle mb-2 type-name text-secondary'>" . ucfirst($row['type']) . "</div>";
                                            echo "</div>";
                                            echo "<p class='mt-2 card-text app-note-holder'>Notes: " . $row['notes'] . "</p>";
                                        echo "</div>";
                                    echo "</div>";
                                    echo "</div>"; 
                                }                                                          
                            echo "</div>";
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead text-center'>No applications were found.</p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>    
        <script src="../../js/main.js" type="text/javascript"></script>
    <?php endif ?>
</body>
<?php include '../global/footer.php';?>
</html>
