<?php
$title = "Check-In";
$evento = $data['Evento'];
$vendas = $data['Vendas'];
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminTop.php";
IC::end();

usort($vendas, function ($a, $b)
{
    return strcmp($a->getParticipante()->getNome(), $b->getParticipante()->getNome());
});
?>
<script src="$inc/js/moment.min.js"></script>
<script src="$inc/js/Chart.min.js"></script>
<style>
    .tbparticipantes td, .tbparticipantes th {
        text-align: left;

    }

    .checked {
        background: #2aa240;
        color: white;
    }
</style>
<div class="formContainer">
    <a href="/Evento/Lista/<?php echo $evento->getCidade() ?>">
        <button class="btn btn-success"><i class="fa fa-chevron-left"></i>&emsp;Voltar</button>
    </a>
    <br><br>
    <h2>Vendas<br>
        <small>(<?php echo $evento->getTitulo() ?>)</small>
    </h2>
    <br>
</div>
<br><br>
<?php

if (count($vendas) > 0)
{
    ?>
    <table class="table table-striped tbparticipantes">
        <thead>
        <tr>
            <th>Participante</th>
            <th>Check-In</th>
        </tr>
        </thead>
        <?php for ($index = 0; $index < count($vendas); $index++) { ?>
            <tr>
                <td>
                    <?php
                    echo $vendas[$index]->getParticipante()->getNome();
                    echo "<br><small>(" . $vendas[$index]->getParticipante()->getCpf() . ")</small>";
                    ?>
                </td>
                <td>
                    <button class="btn <?php echo ($vendas[$index]->getCheckin() == 0) ? '' : 'checked' ?>" id="ch<?php echo $vendas[$index]->getParticipante()->getId() ?>" onclick="checkin(<?php echo $vendas[$index]->getId() ?>,this)">
                        <i class="fa fa-check"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php
}
else
{
    ?>
    <h4>&emsp;Nenhum participante confirmado!</h4>
    <?php
}
?>
</div>
<?php
$from = 'Administrador';
require_once $GLOBALS['view'] . "inc/deleteModal.php";
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminBottom.php";
IC::end();
?>
<script>
    function checkin(id, e)
    {
        $("#" + e.id + " svg").toggleClass("fas").toggleClass("fa-circle-notch").toggleClass("fa-spin");
        $.ajax({
            method: "POST",
            url: "/Participante/Checkin/<?php echo $evento->getId()?>",
            data: {
                venda: id
            },
            success: function (a) {
                if (a == "true")
                {
                    $(e).toggleClass("checked");
                    $("#" + e.id + " svg").removeClass("fas").removeClass("fa-circle-notch").removeClass("fa-spin").addClass('fa-check');
                }
                else
                {
                    alert("Erro ao conectar com o servidor!");
                    $("#" + e.id + " svg").removeClass("fas").removeClass("fa-circle-notch").removeClass("fa-spin").addClass('fa-check');
                }
            },
            error: function (a) {
                alert("Erro ao conectar com o servidor!");
                $("#" + e.id + " svg").removeClass("fas").removeClass("fa-circle-notch").removeClass("fa-spin").addClass('fa-check');
            }
        });
    }
</script>
