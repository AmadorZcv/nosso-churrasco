<?php
// Include config file
require_once '../../config.php';

// Define variables and initialize with empty values
$parcname = $password = $confirm_password = $email = $cnpj = $parclogin = "";
$parcname_err = $password_err = $confirm_password_err = $email_err = $cnpj_err = $parclogin_err = "";
$parc_telefone1 = '982112599';
$parc_telefone2 = '32272336';

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate parcname
    if (empty(trim($_POST["parclogin"]))) { // erro
        $parclogin_err = "Entre com um nome de usuario";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM parceiros WHERE parc_login = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $parclogin);
            // Set parameters
            $parclogin = trim($_POST["parclogin"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $parclogin_err = "Nome de usuario já utilizado";
                } else {
                    $parclogin = trim($_POST["parclogin"]);
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
        $password_err = "Entre com uma senha";
    } elseif (strlen(trim($_POST['password'])) < 1) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) { // erro
        $confirm_password_err = 'Confirme a senha';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = 'Senhas são diferentes';
        }
    }

    // Validate Email
    if (empty(trim($_POST['email']))) { // erro
        $email_err = "Entre com um email";
    } else {
        $email = trim($_POST['email']);
    }

    // Validate cnpj
    if (empty(trim($_POST['cnpj']))) { // erro
        $cnpj_err = "Entre com o cnpj";
    } else {
        $cnpj = trim($_POST['cnpj']);
    }

    // Validate parcname
    if (empty(trim($_POST['parcname']))) { // erro
        $parcname_err = "Entre com um nome";
    } else {
        $parcname = trim($_POST['parcname']);
    }

    // Check input errors before inserting in database
    if (empty($parcname_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($cnpj_err) && empty($parclogin_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO parceiros(cnpj,parc_login,parc_password,parc_fantasy_name,parc_email,parc_telefone1,parc_telefone2) VALUES (?,?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss",$cnpj,$parclogin, $password,$parcname,$email,$parc_telefone1,$parc_telefone2);

            // Set parameters
            $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            echo $email;
            echo $cnpj;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // Redirect to login page
                header("location: ../loginParceiro/loginParceiroScreen.php");
            } else {
                echo "Something went wrong. Please try again later. Segundo";
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
    <link rel="stylesheet" href="index.css">
    </head>

    <body>

        <div class="container">
        <div class="row">
            <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row form_group <?php echo (!empty($parcname_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s6">
                <input id="first_name" type="text" name="parcname" class="validate" value="<?php echo $parcname; ?>">
                <label for="first_name">Nome Completo</label>
                <span class="helper-text"><?php echo $parcname_err; ?></span>
                </div> 
                <div class="row form_group  <?php echo (!empty($parclogin_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s6">
                <input id="parclogin" type="text" name="parclogin" class="validate" value="<?php echo $parclogin; ?>">
                <label for="parclogin">Nome de Usuário</label>
                <span class="helper-text"><?php echo $parclogin_err; ?></span>
                </div>
            </div>
            </div>
           
            <div class="row form_group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s12">
                <input id="password" type="password" name="password" class="validate" value="<?php echo $password; ?>">
                <label for="password">Senha</label>
                <span class="helper-text"><?php echo $password_err; ?></span>
                </div>
            </div>

            <div class="row form_group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s12">
                <input id="password" type="password" name="confirm_password" class="validate" value="<?php echo $confirm_password; ?>">
                <label for="password">Confirme sua senha</label>
                <span class="helper-text"><?php echo $confirm_password_err; ?></span>
                </div>
            </div>
        
            <div class="row form_group  <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" class="validate" value="<?php echo $email; ?>">
                    <label for="email">E-mail</label>
                    <span class="helper-text" data-error="E-mail invalido!" data-success="">example@email.com</span>
                    <span class="helper-text"><?php echo $email_err; ?></span>
                </div>
            </div>
            <div class="row form_group  <?php echo (!empty($cnpj_err)) ? 'has-error' : ''; ?>">
                <div class="input-field col s12">
                    <input id="cnpj" type="number" class="validate" name="cnpj" value="<?php echo $cnpj; ?>">
                    <label for="cnpj">cnpj</label>
                    <span class="helper-text">02681034172</span>
                    <span class="helper-text"><?php echo $cnpj_err; ?></span>
                </div>
            </div>
           
            <div class="row form_group">
            <a class="waves-effect waves-teal btn-flat" type="reset" class="btn btn-default" value="reset">Resetar Campos</a>
            <button class="btn waves-effect waves-light" type="submit" name="action" value="submit">Enviar
            </button>
            </div>
            <p>Você já tem uma conta? <a href="../loginParceiroScreen/loginParceiroScreen.php">Entre aqui</a>.</p>
            </form>
        </div>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="js/materialize.min.js"></script>

    </body>

    <footer class="page-footer" style="background: #FF8F00">
        <div class="container">
            <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Você já tem uma conta?</h5>
                        <p class="grey-text text-lighten-4"><a style="color: white" href="../loginParceiroScreen/loginParceiroScreen.php">Entre aqui!</p>
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
            <div class="form-group <?php echo (!empty($parcname_err)) ? 'has-error' : ''; ?>">
                <label>parcname</label>
                <input type="text" name="parcname"class="form-control" value="<?php echo $parcname; ?>">
                <span class="help-block"><?php echo $parcname_err; ?></span>
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
