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
                <li><a href="sass.html">Grupos</a></li>
                <li><a href="badges.html">Parceiros</a></li>
                <li><a href="collapsible.html">Javascript</a></li>
                <li><a href="mobile.html">Mobile</a></li>
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

                    <div class="col s12 m7 z-depth-2">
                        <h2 class="header">Cerveja</h2>
                        <div class="card horizontal">
                            <div class="card-image">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6IJvYjhkvLkBDEgA0Myy9Xo1NWWt7Epxn7xvZWKXM8UwfL1ApJQ">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <p>Fornecedor : Amador</p>
                                    <p>Preço: 3.95</p>
                                </div>
                                <div class="green card-action">
                                    <a href="#">Adicionar ao carrinho</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
