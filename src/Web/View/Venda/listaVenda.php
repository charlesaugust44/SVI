<?php
$title = "Vendas";
$evento = $data['Evento'];
$vendas = $data['Vendas'];
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminTop.php";
IC::end();

usort($vendas, function ($a, $b)
{
    return strcmp($a->getDataConfirmacao(), $b->getDataConfirmacao());
});

$vendas2 = $vendas;

usort($vendas2, function ($a, $b)
{
    return strcmp($a->getDataVenda(), $b->getDataVenda());
});

function getLength($vendas, $mode, $preco = 0)
{
    $count = 0;
    $total = 0;
    foreach ($vendas as $v)
    {
        switch ($mode)
        {
            case 0: // all
                $count++;
                $total += $preco;
                break;
            case 1: // pendentes
                if ($v->getDataConfirmacao() == null)
                {
                    $count++;
                    $total += $preco;
                }
                break;
            case 2: // confirmados
                if ($v->getDataConfirmacao() != null)
                {
                    $count++;
                    $total += $preco;
                }
                break;
        }
    }

    $result['precoTotal'] = $total;
    $result['length'] = $count;

    return $result;
}

function getSomas($vendas, $total)
{
    $cont = 0;
    $income = 0;
    $anterior = null;
    $resultData = "";
    $resultLabel = "";

    foreach ($vendas as $v)
    {
        $dvenda = new DateTime($v->getDataVenda());
        $dvenda = $dvenda->format('Y-m-d');

        if ($anterior == null)
        {
            $cont++;
            $anterior = $dvenda;
        }
        else if ($dvenda == $anterior)
            $cont++;
        else
        {
            $resultData .= $cont . ",";
            $resultLabel .= "\"" . (new DateTime($anterior))->format('Y-m-d') . "\",";
            if ($total)
                $cont++;
            else
                $cont = 1;

            $anterior = $dvenda;
        }
    }

    $resultData .= $cont . ",";
    $resultLabel .= "\"" . (new DateTime($anterior))->format('Y-m-d') . "\",";

    $resultLabel = trim($resultLabel, ',');
    $resultData = trim($resultData, ',');

    $data['label'] = $resultLabel;
    $data['data'] = $resultData;

    return $data;
}

$dataTotais = getSomas($vendas2, true);
$dataDiaria = getSomas($vendas2, false);
?>
    <script src="$inc/js/moment.min.js"></script>
    <script src="$inc/js/Chart.min.js"></script>
    <style>
        .pendente {
            font-weight: bold;
            color: #f00;
        }

        .tbparticipantes td, .tbparticipantes th {
            text-align: left;

        }

        #gcontainner {
            width: 75vw;
        }

        @media (max-width: 661px) {
            #gcontainner {
                width: 95vw;
            }
        }

        canvas {
            margin-top: 10px;
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
        <h3>
            <table class="table" style="width: 200px">
                <tr>
                    <th>Total</th>
                    <td>
                        <small><?php echo getLength($vendas, 0)['length'] ?></small>
                    </td>
                </tr>
                <tr>
                    <th>Pendentes</th>
                    <td>
                        <small><?php echo getLength($vendas, 1)['length'] ?></small>
                    </td>
                </tr>
                <tr>
                    <th>Confirmados</th>
                    <td>
                        <small><?php echo getLength($vendas, 2)['length'] ?></small>
                    </td>
                </tr>
            </table>
    </div>
    </h3>
    <div id="gcontainner">
        <canvas id="vendaTotal"></canvas>
        <canvas id="vendaDiaria"></canvas>
    </div>
    <br><br>

    <script>
        var total = document.getElementById("vendaTotal").getContext('2d');
        var ctotal = new Chart(total, {
            type: 'line',
            data: {
                labels: [<?php echo $dataTotais['label']?>],
                datasets: [{
                    label: 'Vendas',
                    data: [<?php echo $dataTotais['data']?>],
                    backgroundColor: 'rgba(2, 80, 150,0.6)',
                    borderColor: 'rgba(2, 80, 150,1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Vendas Totais',
                    fontSize: 24
                },
                scales: {

                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            callback: function (value, index, values) {
                                return new moment(value).format('DD MMM');
                            }
                        },
                        distribution: 'linear',
                        type: 'time',
                        time: {
                            displayFormats: {
                                hour: 'll',
                                day: 'MMM D',
                            },
                            tooltipFormat: 'll'
                        }
                    }]
                }
            }
        });

        var diaria = document.getElementById("vendaDiaria").getContext('2d');
        var cdiaria = new Chart(diaria, {
            type: 'bar',
            data: {
                labels: [<?php echo $dataDiaria['label']?>],
                datasets: [{
                    label: 'Vendas',
                    data: [<?php echo $dataDiaria['data']?>],
                    backgroundColor: 'rgba(50, 180, 0,0.6)',
                    borderColor: 'rgba(50, 180, 0,1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Vendas Diárias',
                    fontSize: 24
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            callback: function (value, index, values) {
                                return new moment(value).format('DD MMM');
                            }
                        },
                        distribution: 'linear',
                        type: 'time',
                        time: {
                            displayFormats: {
                                hour: 'll',
                                day: 'MMM D',
                            },
                            tooltipFormat: 'll'
                        }
                    }]
                }
            }
        });
    </script>

<?php

if (count($vendas) > 0)
{
    ?>
    <table class="table table-striped tbparticipantes">
        <thead>
        <tr>
            <th>Participante</th>
            <th>Data da Venda</th>
            <th>Pagamento</th>
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
                    <?php
                    $d = new DateTime($vendas[$index]->getDataVenda());
                    echo $d->format("d/m/y");
                    echo "<br><small>" . $d->format("H:i") . "</small>";
                    ?>
                </td>
                <td>
                    <?php
                    $dataConfirmacao = $vendas[$index]->getDataConfirmacao();
                    if (empty($dataConfirmacao))
                        echo "<span class='pendente'>PENDENTE</span>";
                    else
                    {
                        $d = new DateTime($dataConfirmacao);
                        echo $d->format("d/m/y");
                        echo "<br><small>" . $d->format("H:i") . "</small>";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php
}
else
{
    ?>
    <h4>&emsp;Nenhuma venda para a busca efetuada!</h4>
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