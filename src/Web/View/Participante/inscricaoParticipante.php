<head>
    <?php
    require_once $GLOBALS['view'] . 'inc/head.php';
    $evento = $data['Evento'];
    $p = $data['Participante'];
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
    <div class="formContainer">
        <form action="/Participante/Inscrever/<?php echo $evento->getId() ?>" method="post">

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
                <input name="cpf" type="text" class="form-control" id="txtCpf" placeholder="000.000.000-00" required readonly value="<?php echo $data['cpf'] ?>">
                <small>&emsp;Para fazer check-in no evento será necessário a carteira de identidade.</small>
            </div>
            <div class="form-group">
                <label for="txtNome">Nome*</label>
                <input name="nome" type="text" class="form-control" id="txtNome" placeholder="Nome Completo" required value="<?php echo (empty($p)) ? '' : $p->getNome(); ?>">
            </div>
            <div class="form-group">
                <label for="txtEmail">Email*</label>
                <input name="email" type="email" class="form-control" id="txtEmail" placeholder="email@exemplo.com" required value="<?php echo (empty($p)) ? '' : $p->getEmail(); ?>">
                <small>&emsp;Este email será utilizado para enviar informaçõe sobre o pagamento e sua inscrição.
                </small>
            </div>
            <div class="form-group">
                <label for="txtPulseira">Pulseira*</label>
                <select name="pulseira" id="txtPulseira" class="form-control">
                    <option selected value="Pulseira 1">Pulseira 1</option>
                    <option value="Pulseira 2">Pulseira 2</option>
                    <option value="Pulseira 3">Pulseira 3</option>
                    <option value="Pulseira 4">Pulseira 4</option>
                </select>
            </div>
            <!--div class="form-group">
                <label for="txtIde">IDE*</label>
                <input name="ide" type="text" class="form-control" id="txtIde" placeholder="IDE" required>
            </div-->
            <small>* Campos Obrigatórios.
            </small>
            <div class="float-right">
                <a href="/Participante/Checar/<?php echo $evento->getId(); ?>">
                    <button type="button" class="btn btn-danger">Voltar</button>
                </a>
                <button type="submit" class="btn btn-success">Próximo</button>
            </div>
            <br>
            <br>
            <br>
        </form>
    </div>
</div>
</body>


