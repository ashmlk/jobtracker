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
$title = $company = $type= $date = $priority = $notes = "";
$title_err = $company_err = $type_err = $date_err = "";
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Enter the position which you applied for.";
    } elseif(!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $title_err = "Please enter a valid position (Alphabetical letters).";
    } else{
        $title = $input_title;
    }

    $input_company = trim($_POST["company"]);
    if(empty($input_company)){
        $company_err = "Enter the company which you are applying for.";     
    } else{
        $company = $input_company;
    }
 
    $input_type = trim($_POST["application-type"]);
    if(empty($input_type)){
        $type_err = "Please choose from one of the application types.";     
    } else {
        $type= $input_type;
    }

    $input_type = trim($_POST["application-type"]);
    if(empty($input_type)){
        $type_err = "Please choose from one of the application types.";     
    } else {
        $type= $input_type;
    }

    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $type_err = "Please set the date that you applied.";     
    } else {
        $date = $input_date;
    }


    $notes = addslashes(htmlspecialchars(trim($_POST["notes"])));
    $priority = (int)trim($_POST["priority"]);
    $id = ($_POST["id"]);
    if(empty($title_err) && empty($company_err) && empty($type_err) && empty($date_err)){
        $sql = "UPDATE applications SET position='$title', company='$company', type='$type', date='$date', notes='$notes', Priority='$priority', user_username='$username' WHERE id = '$id' ";           
        if (!mysqli_query($link, $sql)) {
            echo("Error description: " . mysqli_error($link));
        }
    }

    mysqli_close($link);
    header('location: base.php');

} else{

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        $sql = "SELECT * FROM applications WHERE id = '$id'";
        $result = mysqli_query($link, $sql);
        if($result){
            $param_id = $id;
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $title = $row["position"];
                $company = $row["company"];
                $date = $row["date"];
                $priority = $row["priority"];
                $notes = $row["notes"];
                $app_slc = $int_slc = $off_slc = $ref_slc = $dec_slc = '';
                $t = $row['type'];
                if($t == 'application'){
                    $app_slc = 'selected';
                } else if($t == 'interview'){
                    $int_slc = 'selected';
                } else if($t == 'offer'){
                    $off_slc = 'selected';
                } else if($t == 'rejected'){
                    $ref_slc = 'selected';
                } else if($t == 'declined'){
                    $dec_slc = 'selected';
                }
            } else{
                header("location: registration/errors.php");
                exit();
            }
        } else {
            echo("Error description: " . mysqli_error($link));
        }
        mysqli_close($link);
    }  else{
        header("location: ../registration/errors.php");
        exit();
    }
}
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

<body>
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
        <div class="row">
        <div class="col-md-3 p-2 mt-3 d-none d-md-block">
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
            <div class="col-md-9 p-2 pt-3 pl-3">
                <div class="w-75 ml-5 card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="text-center">Add Application</h4>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                                <label>Position</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                                <span class="help-block"><?php echo $title_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($company_err)) ? 'has-error' : ''; ?>">
                                <label>Company</label>
                                <input type="text" name="company" class="form-control" value="<?php echo $company; ?>">
                                <span class="help-block"><?php echo $company_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                                <label>Application Type</label>
                                <select name="application-type" class="custom-select" id="inputGroupSelect01">
                                    <option <?php echo $app_slc; ?> value="application">Application</option>
                                    <option <?php echo $int_slc; ?> value="interview">Interview</option>
                                    <option <?php echo $dec_slc; ?> value="declined">Declined</option>
                                    <option <?php echo $off_slc; ?> value="offer">Offer</option>
                                    <option <?php echo $rej_slc; ?> value="rejected">Rejected</option>                                   
                                </select>
                                <span class="help-block"><?php echo $position_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($company_err)) ? 'has-error' : ''; ?>">
                                <label>Date</label>
                                <input type="text" id="datepicker" name="date" class="form-control" value="<?php echo $date; ?>">
                                <span class="help-block"><?php echo $date_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($company_err)) ? 'has-error' : ''; ?>">
                                <label>Notes</label>
                                <textarea name="notes" class="form-control"><?php echo $notes; ?></textarea>
                            </div>
                            <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                                <label>Priority</label>
                                <select name="priority" class="custom-select" id="inputGroupSelect01">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="base.php" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/main.js" type="text/javascript"></script>
    <?php endif ?>
</body>
<?php include '../global/footer.php';?>
</html>