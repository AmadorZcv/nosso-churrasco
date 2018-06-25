<?php
// Include config file
require_once '../../config.php';
session_start();
$user_id = $_SESSION['userid'];
// Define variables and initialize with empty values
$churrascoNome = $data = $local = $hora = "";
$churrascoNome_err = $data_err = $local_err = $hora_err =  "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["churrascoNome"]))) {
        $churrascoNome_err = 'Entre com um nome';
    } else {
        $churrascoNome = trim($_POST["churrascoNome"]);
    }
    // Check if password is empty
    if (empty(trim($_POST['data']))) {
        $data_err = 'Seleciona uma data';
    } else {
        $data = trim($_POST['data']);
    }
    // Check if password is empty
    if (empty(trim($_POST['local']))) {
        $local_err = 'Escolha uma local';
    } else {
        $local = trim($_POST['local']);
    }
    if (empty(trim($_POST['hora']))) {
        $hora_err = 'Escolha uma local';
    } else {
        $hora = trim($_POST['hora']);
    }
    // Validate credentials
    if (empty($churrascoNome_err)&& empty($data_err)&& empty($local_err) ) {
        // Prepare a select statement
        $sql = "INSERT INTO churrasco (churras_name, 
        churras_datetime, churras_ds_adress, churras_image, user_founder_id)
         VALUES(?,?,?,?,?)";
        $blob="a";
        $dataFormatada = "${data} ${hora}:00";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'ssssi', $churrascoNome , $dataFormatada ,$blob, $local,$user_id);
            // Set parameters
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                header("location: ../../tabs/index.php");
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
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Criar Grupo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="index.js"></script>
</head>

<body>
    <div class="container">
        <div class="center-align">
            <i id="upload" class="material-icons large">cloud_upload</i>
        </div>
        <div class="row z-depth-1" style="height: 80%;">
            <div class="col s5">
                <table class="striped centered">
                    <thead>
                        <tr>
                            <th class="center-align">Nome</th>
                        </tr>
                    </thead>
                    <tbody id="list">

                    </tbody>
                </table>
                <div class="row" style="padding-top: 20px">
                    <div class="col s10">
                        <input id="nome" type="text" class="validate">
                        <label for="nome">Nome do participante</label>
                    </div>
                    <div class="right-align col s2">
                        <a class="btn-floating btn-large cyan pulse" onclick="addNome(' pedrinho ')">
                            <i class="material-icons">add</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col s7">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">create</i>
                        <input id="churrascoNome" name="churrascoNome" type="text" class="validate" value="<?php echo $churrascoNome; ?>">
                        <label for="churrascoNome">Nome do churrasco</label>
                        <span class="help-block">
                                        <?php echo $churrascoNome_err; ?>
                                    </span>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">edit_location</i>
                        <textarea id="local" name="local" class="materialize-textarea" value="<?php echo $local; ?>"></textarea>
                        <label for="local">Local</label>
                        <span class="help-block">
                                        <?php echo $churrascoNome_err; ?>
                                    </span>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="data" name="data" type="text" class="datepicker" value="<?php echo $data; ?>">
                        <label for="data">Data do churrasco</label>
                        <span class="help-block">
                                        <?php echo $data_err; ?>
                                    </span>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">date_range</i>
                        <input id="hora" name="hora" type="text" class="timepicker" value="<?php echo $hora; ?>">
                        <label for="hora">Data do churrasco</label>
                        <span class="help-block">
                                        <?php echo $hora_err; ?>
                                    </span>
                    </div>

            </div>
        </div>
        <div class="center-align">
            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                <i class="material-icons right">send</i>
            </button>
        </div>
        </form>
    </div>
</body>

</html>