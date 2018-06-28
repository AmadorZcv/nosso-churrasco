<?php
// Include config file
require_once '../../config.php';

$churrascoId = $_GET['churrasId'];
$churrascoNome = $data = $local = $hora = "";
$churrascoNome_err = $data_err = $local_err = $hora_err = "";

$sql = "SELECT B.churras_name, B.churras_datetime, B.churras_ds_adress, B.churras_image
                                        FROM churrasco B
                                        WHERE B.id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, 'i', $churrascoId);
    // Set parameters
    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Store result
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_array($result)) {
            $churrascoNome = $row["churras_name"];
            $data = substr($row["churras_datetime"], 0, 10);
            $local = $row["churras_ds_adress"];
            $hora = substr($row['churras_datetime'], 11, 5);

        }
        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $churras_name, $churras_datetime, $churras_adress, $churras_image);
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
    mysqli_stmt_close($stmt);
}
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
    if (empty($churrascoNome_err) && empty($data_err) && empty($local_err)) {
        echo $churrascoId;
        // Prepare a select statement
        $sql = "UPDATE churrasco
        SET  churras_name 			= ?
            ,churras_datetime		= ?
            ,churras_ds_adress		= ?
            ,churras_image			= ?
        WHERE id = ?";
        $churrascoId = trim($_POST['churrascoId']);
        $blob = "a";
        $dataFormatada = "${data} ${hora}:00";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'ssssi', $churrascoNome, $dataFormatada, $local, $blob, $churrascoId);
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
                        <input id="local" name="local" type="text" class="validate" value="<?php echo $local; ?>">
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
                    <input id="churrascoId" name="churrascoId" type="hidden" class="timepicker" value="<?php echo $churrascoId; ?>">
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