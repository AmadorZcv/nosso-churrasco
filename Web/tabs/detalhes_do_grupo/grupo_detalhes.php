<html>
<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="grupo-detalhes.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
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
                        <span class="card-title"><b>Nome do Grupo</b></span>
                    </div>  
                    <div class="card-content">
                    <p>Adicionar a porcetagem da coleta.</p>
                    </div>
                    <div class="card-action">
                    <a href="#">Sair do grupo.</a>
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
                        <a href="#">Fazer compras</a>
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
                    </div>
                </div>
            </div>
        </div>
    </body> 
</html>