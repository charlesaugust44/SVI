<?php
$eventos = $data['Eventos'];
$cidade = $data['Cidade'];
?>
<head>
    <?php
    require_once $GLOBALS['view'] . 'inc/head.php'
    ?>
    <style>
        .pagination {
            margin-top: 4em;
            justify-content: center;
            width: 100%;
        }

        .col {
            margin-top: 40px;
        }

        .header .col {
            margin: 0px;
            padding-left: 15px;
        }
    </style>
    <link href="$inc/css/evento.css" rel="stylesheet">
    <title>SVI - <?php echo $cidade ?></title>
</head>

<body>
<div id="wrapper">
    <?php
    require_once $GLOBALS['view'] . 'inc/header.php';
    ?>

    <div class="intro topbg" style="background-image: url($inc/images/bg.jpg)">
        <div class="dtable hw100">
            <div class="dtable-cell hw100">
                <div class="container text-center">
                    <h1 class="intro-title"> Procure Eventos Proximo de Você </h1>
                    <div class="row search-row">
                        <div class="col-xl-8 col-sm-8 search-col relative">
                            <i class="fa fa-map-marker-alt icon-append"></i>
                            <select class="form-control has-icon" name="cidade" id="cidade" style="height: 48px">
                                <?php
                                include $GLOBALS['view'] . "inc/cidades.php"
                                ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-sm-4 search-col" id="buscar">
                            <button class="btn btn-primary btn-block" style="height: 48px"><i class="fa fa-search"></i>&nbsp;BUSCAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.intro -->

    <div class="main-container">
        <div class="container">
            <h1>Eventos em <?php echo $cidade ?>:</h1>
            <div class="row">
                <?php
                if (count($eventos) > 0)
                {
                    foreach ($eventos as $e)
                    { ?>

                        <div class="col col-lg-4">
                            <a href="/Evento/Detalhe/<?php echo $e->getId() ?>">
                                <div class="boxEvento">
                                    <div class="eventoBanner" style="background: url('$inc/images/<?php echo $e->getBanner() ?>');background-size: cover;background-position: center center;">
                                        <span class="eventoPreco">&emsp;R$ <?php echo number_format($e->getPreco(), 2, ',', ' ') ?>&emsp;</span>
                                    </div>
                                    <div class="eventoInfo">
                                        <time class="poster-card__date">
                                            <?php
                                            $date = new DateTime($e->getDataInicio() . ' ' . $e->getHoraInicio());
                                            $dstr = strftime("%a, %d %b %H:%M", $date->getTimestamp());
                                            $dpos = strpos($dstr,'b');
                                            if($dpos==2)
                                                $dstr[1] = 'a';
                                            echo $dstr;
                                            ?>
                                        </time>
                                        <span><?php echo $e->getTitulo() ?></span><br>
                                        <small><?php echo $e->getSubtitulo() ?></small>
                                        <br>
                                        <small class="eventoEndereco"><?php echo $e->getEndereco() ?></small>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php }
                }
                else
                {
                    echo "<h2 style='margin: auto auto'>Nenhum evento encontrado!</h2>";
                } ?>
            </div>
            <div class="text-xs-center">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
                </ul>
            </div>

            <br>

        </div>
        <!-- /.main-container -->

        <?php
        require_once $GLOBALS['view'] . 'inc/footer.php';
        ?>

    </div>
    <!-- /.wrapper -->

    <!-- Le javascript
    ================================================== -->
    <script src="$inc/js/jquery.min.js"></script>
    <script src="$inc/js/bootstrap.min.js"></script>
    <script src="$inc/js/main.js"></script>
    <script>
        $("#buscar").click(function () {
            window.location.href = "/Evento/Busca/" + $("#cidade").val();
        });
    </script>
</body>