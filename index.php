<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trabalho da disciplina Aprendizado de Máquina da faculdade UNISUL, para trabalhar com Backpropagation." />
    <meta name="author" content="Rodrigo Sypriano Ribeiro">
    <title>Backpropagation | Aprendizado de Máquina</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/ionslider/ion.rangeSlider.css" rel="stylesheet">
    <link href="css/ionslider/ion.rangeSlider.skinNice.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head><!--/head-->

<body>

    <div class="carregando window">
        <img src="images/carregando.gif" alt="Carregando" />
    </div>
    <div id="mask"></div>

    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href="https://github.com/RodrigoSyprianoRibeiro/8rainhas" target="_blank"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
             </div>
        </div>
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <h1><img src="images/logo.png" alt="logo"> Redes Backpropagation</h1>
                    </a>

                </div>
            </div>
        </div>
    </header>
    <!--/#header-->

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-sm-3 wow fadeIn text-center padding" data-wow-duration="500ms" data-wow-delay="300ms">
                        <form id="parametros">
                            <div class="form-group">
                                <div class="knob-label">Quantidade de gerações</div>
                                <input type="text" id="quantidade_geracoes" name="quantidade_geracoes" value="" />
                            </div>
                            <div class="form-group">
                                <div class="knob-label">Tamanho vetor intermediário</div>
                                <input type="text" id="tamanho_vetor_intermediario" name="tamanho_vetor_intermediario" value="" />
                            </div>
                            <div class="form-group">
                                <div class="knob-label">% Taxa de aprendizagem</div>
                                <input type="text" id="taxa_aprendizagem" name="taxa_aprendizagem" value="" />
                            </div>
                            <div class="form-group">
                                <button type="button" id="treinar" class="btn btn-lg btn-success">Efetuar treinamento</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 wow fadeIn text-center padding" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h2>Reconhecer letra abaixo:</h2>
                        <div class="row">
                            Inserir caracter:
                            <input type="radio" name="simbolo" value="#" checked="true" disabled> #
                            <input type="radio" name="simbolo" value="." disabled> .
                            <input type="radio" name="simbolo" value="@" disabled> @
                        </div>
                        <div class="row margin-bottom">
                            <div id="quadro"></div>
                        </div>
                        <div class="row">
                            <select id="letra" name="letra" disabled>
                                <option value="">-- Selecione uma letra --</option>
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="A3">A3</option>
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="B3">B3</option>
                                <option value="C1">C1</option>
                                <option value="C2">C2</option>
                                <option value="C3">C3</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="E1">E1</option>
                                <option value="E2">E2</option>
                                <option value="E3">E3</option>
                                <option value="J1">J1</option>
                                <option value="J2">J2</option>
                                <option value="J3">J3</option>
                                <option value="K1">K1</option>
                                <option value="K2">K2</option>
                                <option value="K3">K3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 wow fadeIn text-center padding" data-wow-duration="500ms" data-wow-delay="300ms">
                        <div class="row">
                            <button type="button" id="gerar-letra" class="btn btn-lg btn-primary margin-bottom disabled"><i class="fa fa-refresh"></i> Gerar Letra</button>
                        </div>
                        <div class="row">
                            <button type="button" id="reconhecer-letra" class="btn btn-lg btn-success disabled"><i class="fa fa-flask"></i> Reconhecer letra</button>
                        </div>
                        <div id="resultado" class="row text-center hide">
                            <h2>Letra ao lado é:</h2>
                            <h1 id="letra-resultado"></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#services-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="images/home/under.png" class="img-responsive inline" alt="">
                </div>
                <div class="col-sm-12">
                    <div class="copyright-text text-center">
                        <p>&copy; Rodrigo Ribeiro 2016. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lightbox.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/bootbox.js"></script>
    <script type="text/javascript" src="js/jquery.playSound.js"></script>
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/redes-neurais.js"></script>
</body>
</html>
