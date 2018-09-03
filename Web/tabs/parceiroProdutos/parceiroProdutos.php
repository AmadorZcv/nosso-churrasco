<?php
session_start();
$parcid = $_SESSION['parcid'];

?>

<html>
<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" href="../../css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link rel="stylesheet" href="index.css">
    </head>

    <body>
    <a class="waves-effect waves-orange btn white lighten-3 black-text" style="left: 10; top: 10" href="../parceiros.php">Voltar</a>
    <br>
        <div class="container amber accent-2" id="grupo_detalhes_container">
                <div class="row">
                    <div class="col s11 ">
                    <div class="card white">
                        <div class="card-content s8 black-text">
                        <span class="card-title black-text" align="center"><b>Produtos:</b></span>
                        <ul class="collection" style="position:absolute; width:815; height:255; z-index:1; overflow: auto">
            <?php
require_once '../../config.php';
$sql = "SELECT nome, preco
                FROM produtos
                WHERE parceiros_id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, 'i', $parcid);
    // Set parameters
    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Store result
        $result = mysqli_stmt_get_result($stmt);
        $collection = "collection-item avatar";
        $materialIcons = "material-icons circle";
        $grupoImagem = "grupo-imagem";
        while ($row = mysqli_fetch_array($result)) {
            $produtoNome = $row["nome"];
            $preco = $row["preco"];
            echo "<li class='$collection'>";
            echo "<i class='$materialIcons'>";
            echo "<div class='$grupoImagem' align='center'>";
            echo "</div>";
            echo "</i>";
            echo "<p>$produtoNome</p>";
            echo "<p>R$ $preco Kg</p>";
            echo "</p>";
            echo "</li>";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}

mysqli_close($link);
?>

                        </ul>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <div class="card-action black-text">
                        <a href="../produtos/produtos.php">Cadastrar Produto.</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
