<?php
// Include config file
require_once '../../config.php';

// Define variables and initialize with empty values
$parcname = $password = "";
$parcname_err = $password_err = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if parcname is empty
    if (empty(trim($_POST["parcname"]))) {
        $parcname_err = 'Entre com um nome de usuario';
    } else {
        $parcname = trim($_POST["parcname"]);
    }

    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = 'Entre com uma senha';
    } else {
        $password = trim($_POST['password']);
    }

    // Validate credentials
    if (empty($parcname_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT parc_login,parc_password,id,parc_fantasy_name FROM parceiros WHERE parc_login= ?";
        $parc_id ="";
        $parc_name="";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 's', $parcname);
            // Set parameters
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                // Check if parcname exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $parcname, $hashed_password,$parc_id,$parc_name);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            /* Password is correct, so start a new session and
                            save the parcname to the session */
                            echo "here";
                            session_start();
                            $_SESSION['parcname'] = $parcname;
                            $_SESSION['parcid'] = $parc_id;
                            $_SESSION['parcname']=$parc_name;
                            header("location: ../../tabs/parceiros.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = 'Senha invalida';
                        }
                    }
                } else {
                    // Display an error message if parcname doesn't exist
                    $parcname_err = 'Não encontramos conta com esse nome';
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
                                    <label for="parcname">Nome de usuario</label>
                                    <input id="parcname" type="text" name="parcname" class="validate" value="<?php echo $parcname; ?>">
                                    <span class="help-block">
                                        <?php echo $parcname_err; ?>
                                    </span>
                                  
                                </div>
                                <div class="input-field">
                                    <label>Senha</label>
                                    <input type="password" name="password" class="form-control">
                                    <button type="submit">Entrar</button>  <span class="help-block">
                                        <?php echo $password_err; ?>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="buttonContainer">
                            <a HREF="../registerParceiroScreen/registerParceiro.php">
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