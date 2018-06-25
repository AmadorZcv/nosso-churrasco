<html>
<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" href="../../css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="grupo.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link rel="stylesheet" href="index.css">
    </head>
    
    <body>
    <a class="waves-effect waves-orange btn white lighten-3 black-text" style="left: 10; top: 10" href="../index.php">Voltar</a>
    <br>
        <div class="container amber accent-2" id="grupo_detalhes_container">
                <div class="row">
                    <div class="col s11 ">
                    <div class="card white">
                        <div class="card-content s8 black-text">
                        <span class="card-title black-text" align="center"><b>Grupos:</b></span>
                        <ul class="collection" style="position:absolute; width:815; height:255; z-index:1; overflow: auto">
                        <?php
                        require_once '../../config.php';
$sql = "SELECT * FROM churrasco";
$result = mysqli_query($link,"SELECT * FROM churrasco");
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            // Set parameters
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                $result2 =mysqli_stmt_get_result($stmt);
                mysqli_fetch_array($result2,MYSQLI_NUM);
                $collection="collection-item avatar";
                $materialIcons = "material-icons circle";
                $grupoImagem = "grupo-imagem";
                
                while($row = mysqli_fetch_array($result))
                    {
                       $churrasName = $row["churras_name"];
                       echo "<li class='$collection'>";
                       echo  "<i class='$materialIcons'>";
                       echo  "<div class='$grupoImagem' align='center'>";
                       echo  " <img src='../../assets/img/simboloPorcao.png' alt='imagem do grupo' style='width: 50px; height: 50px'>";
                       echo"</div>";
                       echo "</i>";
                       echo "<a class='title' href='../detalhes_do_grupo/grupo_detalhes.php'>'$churrasName'</a>";
                       echo "<p>PAGOU A COLETA";
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
                        <a href="../criar_grupo/index.php">Criar Novo Grupo.</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body> 
</html>