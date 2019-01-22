<head>
    <?php
    require_once $GLOBALS['view'] . 'inc/head.php';
    $evento = $data['Evento'];
    ?>
    <style>
        .formContainer {
            margin: auto auto;
            border: solid 1px #ccc;
            border-top: none;
            border-bottom: none;
            max-width: 500px;
            font-size: 13pt;
            padding: 10px;
        }

        small {
            font-size: 9pt;
            color: #666;
        }
    </style>
</head>

<body>
<div id="wrapper">
    <?php
    require_once $GLOBALS['view'] . 'inc/header.php';
    ?>
    <div class="main-container">
        <div class="formContainer">
            <form action="/Participante/Inscricao/<?php echo $evento->getId() ?>" method="post">

                <div class="row">
                    <div class="banner" style="width:95%;height:10em;margin:auto auto;background: url('$inc/images/<?php echo $evento->getBanner() ?>');background-size: cover;background-position: center center;">
                    </div>
                    <div class="row " style="margin: auto auto">
                        <h3 class="p-0">
                            <?php echo $evento->getTitulo() ?><br>
                            <small style="line-height: 2em;"><?php echo $evento->getSubtitulo() ?></small>
                            <br>
                            <small style="line-height: 2em;font-size: 0.6em">R$
                                <?php echo number_format($evento->getPreco(), 2, ',', ' ') ?>&emsp;
                            </small>
                        </h3>

                        <br><br>

                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="txtCpf">CPF*</label>
                    <input name="cpf" type="text" class="form-control" id="txtCpf" placeholder="000.000.000-00" required autocomplete="off">
                    <small>&emsp;Para fazer check-in no evento será necessário a carteira de identidade.</small>
                    <?php if (isset($data['isCadastrado'])) { ?>
                        <small style="color: #f00"><br>&emsp;O CPF informado já está cadastrado neste evento.</small>
                    <?php } ?>
                </div>

                <small>* Campos Obrigatórios.
                </small>
                <div class="float-right">
                    <a href="/Evento/Detalhe/<?php echo $evento->getId() ?>">
                        <button type="button" class="btn btn-danger">Voltar</button>
                    </a>
                    <button type="submit" class="btn btn-success">Próximo</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- JQuery.JS -->
<script src="$inc/js/jquery.min.js"></script>
<script src="$inc/js/jquery.mask.js"></script>
<script>
    $('#txtCpf').mask('000.000.000-00');
</script>


