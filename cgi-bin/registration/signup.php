<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Signup | JTracker</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-dark">
    <div class="container" style="min-height:100vh !important;">
        <div class="vg-white border-transparent card p-3" style="margin-top:15rem !important;">
            <div class="col-md-4 my-auto mx-auto text-center">
                <div class="border-bottom mb-2 pb-1  header">
                    <h4 class="text-dark text-center">
                        Sign up
                    </h4>
                </div>
            </div>
            <div class="mt-3 row d-flex align-items-center">
                <div class="col-md-4 my-auto mx-auto">
                    <div class="form">
                        <form method="post" action="signup.php">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username"
                                    value="<?php echo $username; ?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password_1">
                            </div>
                            <div class="form-group">
                                <label>Confirm password</label>
                                <input class="form-control" type="password" name="password_2">
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" name="reg_user">Sign up</button>
                            </div>
                            <p>
                                Already a member? <a href="login.php">Sign in</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>