<?php
$title = "Lista de Eventos";

IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminTop.php";
IC::end();

$cidade = $data['Cidade'];
$eventos = $data['Eventos'];
?>
    <link href="$inc/css/evento.css" rel="stylesheet">
    <style>
        .eventoBanner .right svg {
            float: right;
            margin-top: 4px;
            margin-right: 5px;
        }

        .eventoBanner .left svg {
            float: left;
            margin-top: 4px;
            margin-left: 5px;
            margin-right: 0;
        }

        .bcontainer * {
            float: right;
        }

        .bcontainer select {
            width: 170px;

        }
    </style>
<?php if (Auth::levelCheck(Auth::$LVL2)) { ?>
    <script>
        function goToCity()
        {
            let city = document.getElementById('cidade').value;
            window.location.href = "/Evento/Lista/" + city;
        }
    </script>
<?php } ?>
    <div class="formContainer" style="width: 96%">
        <a href="/Evento/ShowCadastrar">
            <button class="btn btn-success btCadastrar"><i class="fa fa-plus"></i>&emsp;Cadastrar Evento</button>
        </a>
        <?php if (Auth::levelCheck(Auth::$LVL2)) { ?>
            <div class="float-right bcontainer">
                <button class="btn btn-primary btn-block" onclick="goToCity()" style="width: 40px;margin: 0;height: 38px;margin: 0 5px 0 5px">
                    <i class="fa fa-search"></i></button>
                <select class="form-control has-icon" name="cidade" id="cidade" style="">
                    <?php
                    include $GLOBALS['view'] . "inc/cidades.php"
                    ?>
                </select>
            </div>
        <?php } ?>
        <br><br>
        <h2>Eventos
            <small>(<?php echo $cidade ?>)</small>
        </h2>
        <br><br>
        <div class="row">
            <?php
            if (count($eventos) != 0)
            {
                foreach ($eventos as $e)
                { ?>
                    <div class="col col-lg-4">
                        <div class="boxEvento">
                            <div class="eventoBanner"
                                 style="background: url('$inc/images/<?php echo $e->getBanner() ?>');background-size: cover;background-position: center center;">

                                <div class="right float-right">
                                    <?php if (Auth::levelCheck(Auth::$LVL2)) { ?>
                                        <button style="width: 30px;height: 30px;padding: 0"
                                                class="btn btn-danger fa fa-times" data-toggle="modal"
                                                onclick="s2d(<?php echo $e->getId() ?>,'evento')"
                                                data-target="#modalDeletar" title="Deletar"></button>

                                        <a href="/Evento/ShowEditar/<?php echo $e->getId() ?>">
                                            <button style="width: 30px;height: 30px;padding: 5px"
                                                    class="btn btn-warning fa fa-pencil-alt" title="Editar"></button>
                                        </a>
                                    <?php } ?>
                                    <?php if (Auth::levelCheck()) { ?>
                                        <a href="/Evento/Detalhe/<?php echo $e->getId() ?>">
                                            <button style="width: 30px;height: 30px;padding: 5px"
                                                    class="btn btn-primary fa fa-link" title="Link do Evento"></button>
                                        </a>
                                    <?php } ?>
                                </div>

                                <div class="left float-left">
                                    <?php if (Auth::levelCheck(Auth::$LVL2)) { ?>
                                        <a href="/Venda/Lista/<?php echo $e->getId() ?>">
                                            <button style="width: 30px;height: 30px;padding: 5px"
                                                    class="btn btn-info fa fa-file-invoice-dollar" title="Vendas"></button>
                                        </a>
                                    <?php } ?>
                                    <?php if (Auth::levelCheck()) { ?>
                                        <a href="/Participante/ShowCheckin/<?php echo $e->getId() ?>">
                                            <button style="width: 30px;height: 30px;padding: 5px"
                                                    class="btn btn-success fa fa-user-check" title="Check-In"></button>
                                        </a>
                                    <?php } ?>
                                </div>

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
                    </div>
                <?php }
            }
            else
            {
                ?>
                <h4>&emsp;Nenhum Evento Cadastrado!</h4>
                <?php
            }
            ?>
        </div>
    </div>
<?php
$from = 'Evento';
require_once $GLOBALS['view'] . "inc/deleteModal.php";

IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminBottom.php";
IC::end();
?>