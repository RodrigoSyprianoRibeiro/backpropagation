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
    <link href="css/rainbow/blackboard.css" rel="stylesheet">
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
                    <ul id="tab1" class="nav nav-tabs">
                        <li class="active"><a href="#tab1-item1" data-toggle="tab">Jogo</a></li>
                        <li><a href="#tab1-item2" data-toggle="tab">Código</a></li>
                        <li><a href="#tab1-item3" data-toggle="tab">Sobre</a></li>
                        <li><a href="#tab1-item4" data-toggle="tab">Log</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab1-item1">
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
                        <div class="tab-pane fade" id="tab1-item2">
                            <div class="col-sm-12 wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
                                <h2 class="page-header">Código <strong>Fonte</strong></h2>
                                <div class="col-md-12">
                                    <ul id="tab2" class="nav nav-tabs">
                                        <li class="active"><a href="#tab2-item1" data-toggle="tab">HTML</a></li>
                                        <li><a href="#tab2-item2" data-toggle="tab">CSS</a></li>
                                        <li><a href="#tab2-item3" data-toggle="tab">JS</a></li>
                                        <li><a href="#tab2-item4" data-toggle="tab">executar.php</a></li>
                                        <li><a href="#tab2-item5" data-toggle="tab">AlgoritmosGeneticos.php</a></li>
                                        <li><a href="#tab2-item6" data-toggle="tab">Cromossomo.php</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="tab2-item1">
                                            <pre><code data-language="html"><?php include 'docs/html.txt'; ?><</code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item2">
                                            <pre><code data-language="css"><?php include 'docs/css.txt'; ?></code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item3">
                                            <pre><code data-language="javascript"><?php include 'docs/js.txt'; ?></code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item4">
                                            <pre><code data-language="php"><?php include 'docs/executar.txt'; ?></code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item5">
                                            <pre><code data-language="php"><?php include 'docs/algoritmosgeneticos.txt'; ?></code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="tab2-item6">
                                            <pre><code data-language="php"><?php include 'docs/cromossomo.txt'; ?></code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab1-item3">
                            <div class="col-sm-12 wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
                                <h2 class="page-header">Sobre o Desafio <strong>8 Rainhas</strong></h2>
                                <blockquote>
                                    <p>O desafio das 8 Rainhas tem como objetivo posicionar oito rainhas
                                    em um tabuleiro de xadrez de modo que nenhuma delas ataque nenhuma outra rainha.
                                    Será baseado nas propriedades da rainha de um jogo de xadrez.</p>

                                    <p>Podemos buscar uma solução eficiente para o problema estudando as propriedades
                                    das rainhas. Uma das propriedades da rainha é que não pode haver outra rainha na
                                    linha ou na coluna onde esta se encontra. Assim, na construção do algoritmo de
                                    solução, não tentaremos posicionar uma rainha em uma posição que esteja sendo atacada.
                                    Esta mesma propriedade também vale para as diagonais em relação as rainha já posicionadas.</p>
                                </blockquote>
                            </div>
                            <div class="col-sm-12 wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
                                <h2 class="page-header">Algoritmos <strong>Genéticos</strong></h2>
                                <blockquote>
                                    <p>Para resolver o problema foi utilizada as técnicas dos <b>Algoritmos Genéticos</b>.
                                    São algoritmos de busca baseados nos mecanismos de seleção natural e genética.</p>

                                    <p>Componentes dos <b>Algoritmos Genéticos:</b>
                                    <ul>
                                        <li>Representação (definição dos indivíduos)</li>
                                        <li>Função de avaliação (função fitness)</li>
                                        <li>População</li>
                                        <li>Mecanismo de seleção dos pais</li>
                                        <li>Operadores genéticos</li>
                                        <li>Mecanismo de seleção dos sobreviventes</li>
                                    </ul>
                                    </p>

                                    <p><b>Representação</b> foi utilizado um vetor com 8 posições, onde o índice do vetor, representa a coluna
                                    e o valor representa a linha no tabuleiro. <b>Ex.: [2, 3, 5, 7, 1, 0, 6, 4]</b>.</p>

                                    <p><b>Função de avaliação</b> é verificado quantos conflitos de rainhas existem no tabuleiro.
                                    Quanto menor o número de conflitos, melhor a aptidão do cromossomo.</p>

                                    <p><b>Mecanismo de seleção dos pais</b>, é utilizada a forma <b>Eletista</b>, onde sempre pega os melhores indivíduos.</p>

                                    <p><b>Operadores genéticos</b> foi utilizado a técnica <b>Cut-and-crossfill</b> para <b>Recombinação</b> e a
                                    técnica de <b>Swap</b> para <b>Mutação</b>.</p>
                                </blockquote>
                            </div>
                            <div class="col-sm-12 wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
                                <h2 class="page-header"><strong>Autores</strong></h2>
                                <blockquote>
                                    <p>Rodrigo Ribeiro e Taynara Rechia.</p>

                                    <footer>Trabalho da disciplina <cite title="Modelos Evolucionários e Tratamento de Incertezas">Modelos Evolucionários e Tratamento de Incertezas</cite>
                                    do curso de Ciência da Computação da UNISUL (Universidade do Sul de Santa Catarina).</footer>
                                </blockquote>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab1-item4">
                            <div class="col-sm-12 wow fadeIn" data-wow-duration="500ms" data-wow-delay="300ms">
                                <h2 class="page-header">Log de <strong>Testes</strong></h2>
                                <pre><code id="log" data-language="shell"></code></pre>
                            </div>
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
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/redes-neurais.js"></script>
    <script type="text/javascript" src="js/rainbow/rainbow.min.js"></script>
    <script type="text/javascript" src="js/rainbow/language/css.js"></script>
    <script type="text/javascript" src="js/rainbow/language/generic.js"></script>
    <script type="text/javascript" src="js/rainbow/language/html.js"></script>
    <script type="text/javascript" src="js/rainbow/language/javascript.js"></script>
    <script type="text/javascript" src="js/rainbow/language/php.js"></script>
    <script type="text/javascript" src="js/rainbow/language/shell.js"></script>
</body>
</html>
