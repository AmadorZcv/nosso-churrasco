<?php
// Include config file
require_once '../../config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = 'Entre com um nome de usuario';
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = 'Entre com uma senha';
    } else {
        $password = trim($_POST['password']);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT user_login,user_password FROM user WHERE user_login= ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 's', $username);
            // Set parameters
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: ../../tabs/index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = 'Senha invalida';
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = 'Não encontramos conta com esse nome';
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

 <!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <title>Login</title>
</head>

<body background="https://pixnio.com/free-images/2017/08/02/2017-08-02-09-14-23-1000x665.jpg">
    <div class="valign-wrapper" style="width:100%;height:100%;position: absolute;">
        <div class="valign" style="width:100%;">
            <div class="container">
                <div class="row">
                    <div class="col s6 center-align">
                        <h3 class="header">Nosso Churrasco</h3>
                        <img src="../../assets/img/simboloPorcao.png" alt="Nosso Churrascao" class="center-align">
                    </div>
                    <div class="col s6">
                        <div>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="input-field">
                                    <label for="username">Nome de usuario</label>
                                    <input id="username" type="text" name="username" class="validate" value="<?php echo $username; ?>">
                                    <span class="help-block">
                                        <?php echo $username_err; ?>
                                    </span>
                                  
                                </div>
                                <div class="input-field">
                                    <label>Senha</label>
                                    <input type="password" name="password" class="form-control">
                                    <button type="submit">Churrascar!!!</button>  <span class="help-block">
                                        <?php echo $password_err; ?>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="buttonContainer">
                            <a HREF="../registerScreen/register.php">
                                <button type="button" class="cancelbtn">Registrar</button>
                            </a>
                            <button type="submit" class="recuperarbtn">Recuperar Senha</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>