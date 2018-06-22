<?php
// Include config file
require_once '../../config.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) { // erro
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE user_name = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $username);
            // Set parameters
            $username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if (empty(trim($_POST['password']))) { // erro
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 1) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) { // erro
        $confirm_password_err = 'Please confirm password.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = 'Password did not match.';
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO user  (user_name,user_password) VALUES (?,?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);

            // Set parameters
            $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // Redirect to login page
                header("location: ../loginScreen/login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<html>
    <head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

    </head>

    <body>


        <div class="row">
            <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row form_group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s6">
                <input id="first_name" type="text" name="username" class="validate" value="<?php echo $username; ?>">
                <label for="first_name">Nome do Usuário</label>
                </div>
            </div>
            <div class="row form_group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s12">
                <input id="password" type="password" name="password" class="validate" value="<?php echo $password; ?>">
                <label for="password">Senha</label>
                </div>
            </div>

            <div class="row form_group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s12">
                <input id="password" type="password" name="confirm_password" class="validate" value="<?php echo $confirm_password; ?>">
                <label for="password">Confirme sua senha</label>
                </div>
            </div>
            <!--
            <div class="row form_group">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate">
                    <label for="email">E-mail</label>
                    <span class="helper-text" data-error="E-mail invalido!" data-success="">example@email.com</span>
                </div>
            </div>
            -->
            <div class="row form_group">
            <a class="waves-effect waves-teal btn-flat" type="reset" class="btn btn-default" value="reset">Resetar Campos</a>
            <button class="btn waves-effect waves-light" type="submit" name="action" value="submit">Enviar
            </button>
            </div>
            <p>Você já tem uma conta? <a href="../loginScreen/login.php">Entre aqui</a>.</p>
            </form>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>

    <footer class="page-footer" style="background: #FF8F00">
        <div class="container">
            <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Você já tem uma conta?</h5>
                        <p class="grey-text text-lighten-4"><a style="color: white" href="../loginScreen/login.php">Entre aqui!</p>
                    </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">3L's</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Lucas Sales</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Lucas Amador</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Leonardo Ayres</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            </div>
        </div>
        </footer>
  </html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
    <script src="../../utilsJs/geolocation.js"></script>
</head>
<body onload="getLocation()">

    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="../loginScreen/login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html> -->
