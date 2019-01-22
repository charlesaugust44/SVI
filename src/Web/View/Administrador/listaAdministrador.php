<?php
$title = "Lista de Administradores";
$admins = $data['Administradores'];
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminTop.php";
IC::end();
?>

<div class="formContainer">
    <a href="/Administrador/ShowCadastrar">
        <button class="btn btn-success"><i class="fa fa-plus"></i>&emsp;Cadastrar</button>
    </a>
    <br><br>
    <?php
    if (isset($data['Administradores']))
    {
        $index = 0;
        if (!$admins[0]->isOrganizador())
        {
            ?>
            <h2>Administradores</h2><br>
            <table class="table">
                <thead>
                <tr>
                    <td>Nome</td>
                    <td>Usuario</td>
                    <td></td>
                </tr>
                </thead>
                <?php

                for ($index = 0; $index < count($admins); $index++)
                {
                    if ($admins[$index]->isOrganizador())
                        break;
                    ?>
                    <tr>
                        <td><?php echo $admins[$index]->getNome() ?></td>
                        <td><?php echo $admins[$index]->getUsuario() ?></td>
                        <td>
                            <a href="/Administrador/ShowEditar/<?php echo $admins[$index]->getId() ?>">
                                <button style="width: 30px;height: 30px;padding: 4px" class="btn btn-warning fa fa-pencil-alt"></button>
                            </a>
                            <button style="width: 30px;height: 30px;padding: 0" class="btn btn-danger fa fa-times" data-toggle="modal" onclick="s2d(<?php echo $admins[$index]->getId() ?>,'administrador')" data-target="#modalDeletar"></button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
        ?>

        <?php

        if ($index < count($admins))
        {
            ?>
            <h2>Organizadores</h2><br>
            <table class="table">
                <thead>
                <tr>
                    <td>Nome</td>
                    <td>Usuario</td>
                    <td>Cidade</td>
                    <td></td>
                </tr>
                </thead>
                <?php

                for ($index; $index < count($admins); $index++)
                {
                    ?>
                    <tr>
                        <td><?php echo $admins[$index]->getNome() ?></td>
                        <td><?php echo $admins[$index]->getUsuario() ?></td>
                        <td><?php echo $admins[$index]->getCidade() ?></td>
                        <td>
                            <a href="/Administrador/ShowEditar/<?php echo $admins[$index]->getId() ?>">
                                <button style="width: 30px;height: 30px;padding: 4px" class="btn btn-warning fa fa-pencil-alt"></button>
                            </a>
                            <button style="width: 30px;height: 30px;padding: 0" class="btn btn-danger fa fa-times" data-toggle="modal" onclick="s2d(<?php echo $admins[$index]->getId() ?>,'organizador')" data-target="#modalDeletar"></button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    ?>
</div>
<?php
$from = 'Administrador';
require_once $GLOBALS['view']."inc/deleteModal.php";
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminBottom.php";
IC::end();
?>

