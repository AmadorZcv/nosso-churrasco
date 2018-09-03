<?php
session_start();
$userid = $_SESSION['userid'];
$churrascoId = $_GET['churrasId'];
$churrasname;
$churras_datetime;
$churrasAdress;
$churras_image;

require_once '../../config.php';
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
            $churras_name = $row["churras_name"];
            $churras_datetime = $row["churras_datetime"];
            $churras_adress = $row["churras_ds_adress"];
            $churras_image = $row["churras_image"];
        }
        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $churras_name, $churras_datetime, $churras_adress, $churras_image);
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    $sql = "DELETE FROM  churrasco WHERE id = ?";
    $churrascoId = trim($_POST['churrascoId']);
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, 'i', $churrascoId);
        // Set parameters
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Store result
            header("location: ../../tabs/grupo/grupo.php");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
}
mysqli_close($link);
?>

<html>
<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="grupo-detalhes.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    </head>

    <body>
    <a class="waves-effect waves-orange btn white lighten-3 black-text" style="left: 10; top: 10" href="../index.php">Voltar</a>
    <br>
        <div class="container amber accent-2" id="grupo_detalhes_container">
            <!-- Informações do Grupo -->
            <div class="row col s12">
                <div class="col s6 m5">
                <div class="card">
                    <div class="grupo-imagem" align="center">
                        <img src="../../assets/img/simboloPorcao.png" alt="imagem do grupo" style="width: 250px; height: 250px">
                        <br>
                        <span class="card-title">
                        <b>
                        <?php echo $churras_name ?>
                        </b>
                        </span>
                    </div>
                    <div class="card-content">
                    <p>Adicionar a porcetagem da coleta.</p>
                    </div>
                    <div class="card-action">
                    <?php echo "<a class='title' href='../editar_grupo/index.php?churrasId=$churrascoId'>Editar Grupo</a>"; ?>
                    </div>
                </div>
                </div>

                <!-- Descrição do Grupo -->
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content black-text">
                        <span class="card-title"><b>Descrição:</b></span>
                        <p>Nosso churrasco, melhor app para organizar seu churrasco</p>
                        </div>
                    </div>
                </div>

                <!-- Lista de compras do Grupo -->
                <div class="row">
                    <div class="col s12 m6">
                    <div class="card white">
                        <div class="card-content white-text">
                        <span class="card-title black-text"><b>Lista de Compras:</b></span>
                        <div class="collection" style="position:absolute; left:10px; width:440; height:130; z-index:1; overflow: auto">
                            <a href="#!" class="collection-item black-text">Carne</a>
                            <a href="#!" class="collection-item black-text">Arroz</a>
                            <a href="#!" class="collection-item black-text">Feijão</a>
                            <a href="#!" class="collection-item black-text">Farofa</a>
                        </div>
                        <br><br><br><br><br><br>
                        </div>
                        <div class="card-action">
                        <?php echo "<a class='title' href='../carrinho/index.php?churrasId=$churrascoId&loadProdutos=true'>Fazer Compras</a>"; ?>
                        </div>
                    </div>
                    </div>
                </div>


                <!-- Membros do Grupo -->
                <div class="row">
                    <div class="col s11 ">
                    <div class="card white">
                        <div class="card-content s12 black-text">
                        <span class="card-title black-text" align="center"><b>Membros do Grupo:</b></span>

                        <ul class="collection" style="position:absolute; width:815; height:255; z-index:1; overflow: auto">
                            <li class="collection-item avatar">
                            <i class="material-icons circle">folder</i>
                            <span class="title">NOME</span>
                            <p>PAGOU A COLETA
                            </p>
                            </li>

                            <li class="collection-item avatar">
                            <i class="material-icons circle green">insert_chart</i>
                            <span class="title">NOME</span>
                            <p>NÃO PAGOU A COLETA
                            </p>
                            </li>

                            <li class="collection-item avatar">
                            <i class="material-icons circle red">play_arrow</i>
                            <span class="title">NOME</span>
                            <p>PAGOU A COLETA
                            </p>
                            </li>
                        </ul>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <div class="card-action">
                    <a href="#">Sair do Grupo</a>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <button class="btn waves-effect waves-light" type="submit" name="action"></button>
 <i class="material-icons right">delete</i>
 <input id="churrascoId" name="churrascoId" type="hidden" class="timepicker" value="<?php echo $churrascoId; ?>">
            </button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
