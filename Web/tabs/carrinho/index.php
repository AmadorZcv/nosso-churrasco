
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Produtos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="index.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
</head>

<body>

    <nav class="orange row">
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo"> <img src="../../assets/img/simboloPorcao.png" alt="Nosso Churrascao" class="left hide-on-small-only"
                    width="60" height="60">
                <img src="../../assets/img/simboloPorcao.png" alt="Nosso Churrascao" class="hide-on-med-and-up" width="40" height="40"></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="left hide-on-med-and-down">
                <li><a href="../grupo/grupo.php">Grupos</a></li>
                <li><a href="badges.html">Parceiros</a></li>
                <li><a href="../index.php">Inicio</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li>
    </ul>
    <div>
        <div>
            <div class="row">
                <div class="col s6 ">
                <?php
require_once '../../config.php';
$churrascoId = $_GET['churrasId'];
function add_to_carrinho()
{
    global $link;
    $churrascoId = $_GET['churrasId'];
    $produtoId = $_GET['produtoId'];
    $produtoPreco = $_GET['produtoPreco'];
    $sql = "INSERT INTO `compra_has_produtos`(`compras_id`, `produtos_id`, `qtd`, `preco`) VALUES ($churrascoId,$produtoId,1,$produtoPreco)";
    if ($stmt3 = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        // Set parameters
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt3)) {
            header("location: ../../tabs/carrinho/index.php?churrasId=6");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

    }
    mysqli_stmt_close($stmt3);
    mysqli_close($link);
}
if (isset($_GET['addProduto'])) {
    $churrascoId = $_GET['churrasId'];
    $produtoId = $_GET['produtoId'];
    $produtoPreco = $_GET['produtoPreco'];
    $sql = "INSERT INTO `compra_has_produtos`(`compras_id`, `produtos_id`, `qtd`, `preco`) VALUES ($churrascoId,$produtoId,1,$produtoPreco)";
    if ($stmt3 = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        // Set parameters
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt3)) {
            header("location: ../../tabs/carrinho/index.php?churrasId=6");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt3);
}
$sql = "SELECT produtos.*, parceiros.parc_fantasy_name
FROM produtos
INNER JOIN parceiros ON parceiros.id=produtos.parceiros_id";
if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    // Set parameters
    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Store result
        $result = mysqli_stmt_get_result($stmt);
        $collection = "collection-item avatar";
        $materialIcons = "material-icons circle";
        $grupoImagem = "grupo-imagem";
        while ($row = mysqli_fetch_array($result)) {
            $produtoName = $row["nome"];
            $produtoPreco = $row["preco"];
            $produtoId = $row["id"];
            $parceiro = $row["parc_fantasy_name"];
            echo "<div class='col s12 m7'>";
            echo "<h2 class='header'>$produtoName</h2>";
            echo "<div class='card horizontal'>";
            echo "<div class='card-stacked'>";
            echo "<div class='card-content'>";
            echo "<p>Fornecedor : $parceiro</p>";
            echo "<p>Preço: $produtoPreco</p>";
            echo "</div>";
            echo "<div class='green card-action'>";
            echo "<a href='index.php?addProduto=true&produtoId=$produtoId&produtoPreco=$produtoPreco&churrasId=$churrascoId'>Adicionar ao carrinho</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
mysqli_stmt_close($stmt);
?>

                </div>
                <div class="col s6">
                    <div class="col s12 m7 z-depth-2">
                        <h2 class="header">Cerveja</h2>
                        <div class="card horizontal">
                            <div class="card-image">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6IJvYjhkvLkBDEgA0Myy9Xo1NWWt7Epxn7xvZWKXM8UwfL1ApJQ">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <p>Fornecedor: Amador</p>
                                    <p>Preço: 3.95</p>
                                    <p>Quantidade: 1</p>
                                </div>
                                <div class=" red card-action">
                                    <a href="#">Remover do carrinho</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="pagination">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <li class="active"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
    </div>

</body>

</html>
