<?php
$title = "Cadastrar Administrador";
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminTop.php";
IC::end();
?>

<div class="formContainer" style="max-width: 600px">
    <a href="/Administrador/Lista">
        <button class="btn btn-success"><i class="fa fa-chevron-left"></i>&emsp;Voltar</button>
    </a>
    <br><br>
    <form action="/Administrador/Cadastrar" method="post">
        <div class="form-group">
            <label for="txtNome">Nome*</label>
            <input name="nome" type="text" class="form-control" id="txtNome" placeholder="Nome Completo">
        </div>
        <div class="form-group">
            <label for="txtUsuario">Usuario*</label>
            <input name="usuario" type="text" class="form-control" id="txtUsuario" placeholder="Nome de Usuário">
        </div>
        <div class="form-group">
            <label for="txtSenha">Senha*</label>
            <input name="senha" type="password" class="form-control" id="txtSenha" placeholder="Nova Senha"><br>
            <input name="senha2" type="password" class="form-control" id="txtSenha2"
                   placeholder="Insira a Senha Novamente">
        </div>
        <div class="form-check">
            &emsp;
            &emsp;
            <input name="isOrganizador" type="checkbox" class="form-check-input" id="chbIsOrganizador"
                   style="margin-top: 6px"
                   onclick="toggleInput('organizadorData',0)">
            <label class="form-check-label" for="chbIsOrganizador" style="padding-left: 0">Organizador</label>
        </div>
        <div class="form-group" id="organizadorData" style="display: none">
            <label for="txtCidade">Cidade*</label>
            <select name="cidade" class="form-control" id="txtCidade">
                <?php
                $cidade = "Aracaju";
                include $GLOBALS['view'] . "inc/cidades.php"
                ?>
            </select>
        </div>
        <button type="reset" class="btn btn-warning" onclick="toggleInput('organizadorData',1)">Limpar</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<?php
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminBottom.php";
IC::end();
?>