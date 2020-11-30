  
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login | JTracker</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container" style="min-height:100vh !important;">
        <div class="bg-white border-transparent card p-3" style="margin-top:15rem !important;">
            <div class="col-md-4 my-auto mx-auto text-center">
                <div class="border-bottom mb-2 pb-1  header">
                    <h4 class="text-dark text-center">
                        Login
                    </h4>
                </div>
            </div>
            <div class="mt-3 row d-flex align-items-center">
                <div class="col-md-4 my-auto mx-auto">
                    <div class="form">
                        <form method="post" action="login.php">
                            <?php include('errors.php'); ?>
                            <div class="form-group ">
                                <input class="form-control" type="text" placeholder="Username" name="username">
                            </div>
                            <div class="form-group ">
                                <input class="form-control" placeholder="Password" type="password" name="password">
                            </div>
                            <div class="form-group ">
                                <button class="form-control" type="submit" class="btn" name="login_user">Login</button>
                            </div>
                            <p>
                                Not yet a member? <a href="signup.php">Sign up</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
<?php include '../global/footer.php';?>
</html>