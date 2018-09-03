<?php
// Include config file
require_once '../../config.php';
session_start();
$parc_id = $_SESSION['parcid'];
// Define variables and initialize with empty values
$produtoNome = $preco =  "";
$produtoNome_err = $preco_err =  "";
// Processing form preco when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["produtoNome"]))) {
        $produtoNome_err = 'Digite o nome do produto';
    } else {
        $produtoNome = trim($_POST["produtoNome"]);
    }
    // Check if preco is empty
    if (empty(trim($_POST['preco']))) {
        $preco_err = 'Digite o preço do produto';
    } else {
        $preco = trim($_POST['preco']);
    }
    
    // Validate credentials
    if (empty($produtoNome_err)&& empty($preco_err)&& empty($local_err) ) {
        // Prepare a select statement
        $sql = "INSERT INTO produtos (nome,parceiros_id,preco) VALUES(?,?,?)";
      
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'sis', $produtoNome , $parc_id, $preco);
            // Set parameters
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                header("location: ../../tabs/parceiroProdutos/parceiroProdutos.php");
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
                        
                    </thead>
                    <tbody id="list">

                    </tbody>
                </table>
                <div class="row" style="padding-top: 20px">
                    
                    <div class="right-align col s2">
                       
                    </div>
                </div>
            </div>
            <div class="col s7">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">create</i>
                        <input id="produtoNome" name="produtoNome" type="text" class="validate" value="<?php echo $produtoNome; ?>">
                        <label for="produtoNome">Nome do Produto</label>
                        <span class="help-block">
                                        <?php echo $produtoNome_err; ?>
                                    </span>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">monetization_on</i>
                        <textarea id="preco" name="preco" class="materialize-textarea" value="<?php echo $preco; ?>"></textarea>
                        <label for="preco">Valor</label>
                        <span class="help-block">
                                        <?php echo $preco_err; ?>
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