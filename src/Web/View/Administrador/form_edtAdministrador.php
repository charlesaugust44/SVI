<?php
$title = "Editar Administrador";
$admin = $data['Administrador'];
$erro = $data['SenhaErrada'];
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminTop.php";
IC::end();
?>

<div class="formContainer" style="max-width: 600px">
    <a href="/Administrador/Lista">
        <button class="btn btn-success"><i class="fa fa-chevron-left"></i>&emsp;Voltar</button>
    </a>
    <br><br>
    <form action="/Administrador/Editar/<?php echo $admin->getId() ?>" method="post">
        <div class="form-group">
            <label for="txtNome">Nome do <?php if ($admin->isOrganizador())
                    echo "Organizador"; else echo "Administrador" ?>*</label>
            <input name="nome" type="text" class="form-control" id="txtNome" placeholder="Nome Completo" required value="<?php echo $admin->getNome() ?>">
        </div>
        <div class="form-group">
            <label for="txtUsuario">Usuario*</label>
            <input name="usuario" type="text" class="form-control" id="txtUsuario" placeholder="Nome de Usuário" disabled value="<?php echo $admin->getUsuario() ?>">
        </div>
        <div class="form-group">
            <label for="txtSenhaOld">Senha</label>
            <input name="senhaOld" type="password" class="form-control<?php echo ($erro) ? " is-invalid" : "" ?>" id="txtSenhaOld" placeholder="Senha Antiga">
            <div class="invalid-feedback">
                A senha informada está incorreta!
            </div>
            <br>
            <input name="senhaNew" type="password" class="form-control" id="txtSenhaNew" placeholder="Nova Senha"><br>
            <input name="senha2" type="password" class="form-control" id="txtSenha2" placeholder="Insira a Nova Senha Novamente">
        </div>
        <?php
        $cidade = $admin->getCidade();
        if ($admin->isOrganizador())
        {
            ?>
            <div class="form-group">
                <label for="txtCidade">Cidade*</label>
                <select name="cidade" class="form-control" id="txtCidade">
                    <?php include $GLOBALS['view'] . "inc/cidades.php" ?>
                </select>
            </div>
        <?php } ?>
        <button type="reset" class="btn btn-warning">Limpar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<?php
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminBottom.php";
IC::end();
?>