<?php
$evento = $data["Evento"];
$datei = new DateTime($evento->getDataInicio() . " 00:00:00");
?>
<head>
    <?php
    require_once $GLOBALS['view'] . 'inc/head.php'
    ?>
    <link href="$inc/css/styleBusca.css" rel="stylesheet">
    <title>SVI - <?php echo $evento->getTitulo() ?></title>
</head>

<body>
<div id="wrapper">
    <?php if (isset($data['success'])) { ?>
        <script>
            window.history.pushState(null, '', '/Evento/Detalhe/<?php echo $evento->getId() ?>');
            alert("Inscrição Efetuada Com Sucesso!")
        </script>
    <?php } ?>

    <?php
    require_once $GLOBALS['view'] . 'inc/header.php';
    ?>

    <div class="intro" style="overflow: hidden">
        <div class="dtable topbg"
             style="width:110%;height:110%;margin-left:-40px;margin-top:-40px;background: url('$inc/images/<?php echo $evento->getBanner() ?>');background-size:cover;filter:blur(20px)">
            &nbsp;
        </div>
    </div>

    <div class="overContainer">
        <div class="hr">
            <div class="banner" style="background: url('$inc/images/<?php echo $evento->getBanner() ?>');background-size: cover;background-position: center center;">
            </div>
            <div class="info">
                <div class="row">
                    <div class="col col-12">
                        <div class="date">
                            <p class="date-month"><?php echo strtoupper(strftime("%b", $datei->getTimestamp())); ?></p>
                            <p class="date-day"><?php echo strftime("%d", $datei->getTimestamp()); ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12">
                        <div class="titulo">
                            <span><br><?php echo $evento->getCidade() . ' - ' . $evento->getTitulo() ?></span>
                        </div>
                        <small><?php echo $evento->getSubtitulo() ?></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12">
                        <br><span class="preco">&emsp;R$ <?php echo number_format($evento->getPreco(), 2, ',', ' ') ?>&emsp;</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12 text-center">
                        <br>
                        <a href="/Participante/Checar/<?php echo $evento->getId() ?>">
                            <button class="btn btn-primary btn-block btn-increver">INSCREVER-SE</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="detalhes2 text">

        </div>
        <div class="row text descricacao">
            <div class="col col-lg-8">
                <span>
                    <h4><i class="fa fa-file-alt"></i> DESCRIÇÃO</h4>
                    <br>
                    <?php
                    echo $evento->getDescricao()
                    ?>
                </span>
            </div>
            <div class="col col-4 detalhes">
                <h4><i class="fa fa-calendar-alt"></i> DATA</h4>
                <?php

                $dstr = strftime("%a, %d %b de %Y<br>", $datei->getTimestamp());
                $dpos = strpos($dstr,'b');
                if($dpos==2)
                    $dstr[1] = 'a';
                echo $dstr;
                echo "Duração de " . $evento->getDuracao() . " dia" . (($evento->getDuracao() > 1) ? "s" : "");

                ?>
                <br><br>
                <h4><i class="fa fa-clock"></i> HORA</h4>
                <?php
                $horai = substr($evento->getHoraInicio(), 0, 5);
                $horat = substr($evento->getHoraTermino(), 0, 5);
                echo "Das $horai até $horat";
                ?>
                <br><br>
                <h4><i class="fa fa-map-marker-alt"></i> LOCALIZAÇÃO</h4>
                <span>
                <?php
                echo $evento->getEndereco()
                ?>
                    </span><br>
                <a href="#">Ver no mapa</a>
            </div>
            <script>
                let d1 = document.getElementsByClassName('detalhes');
                let d2 = document.getElementsByClassName('detalhes2');

                d2[0].innerHTML = d1[0].innerHTML;
            </script>
        </div>
    </div>

    <?php
    require_once $GLOBALS['view'] . 'inc/footer.php';
    ?>
</div>
<!-- /.wrapper -->

<div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="modalSuccess" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Inscrição Finalizada com sucesso!</h4>
            </div>
        </div>
    </div>
</div>

<!-- Le javascript
================================================== -->
<script src="$inc/js/jquery.min.js"></script>
<script src="$inc/js/bootstrap.min.js"></script>
<script src="$inc/js/main.js"></script>
</body>