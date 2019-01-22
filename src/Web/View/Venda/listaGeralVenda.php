<?php
$title = "Vendas";
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminTop.php";
IC::end();

function getLength($vendas, $mode)
{
    $count = 0;
    foreach ($vendas as $v)
    {
        switch ($mode)
        {
            case 0: // all
                $count++;
                break;
            case 1: // pendentes
                if ($v->getDataConfirmacao() == null)
                    $count++;
                break;
            case 2: // confirmados
                if ($v->getDataConfirmacao() != null)
                    $count++;
                break;
        }
    }

    return $count;
}

function getSomas($vendas, $total)
{
    $cont = 0;
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

$none = $data['None'];
$cidade = $data['Cidade'];

if (!$none)
{
    $evento = $data['Evento'];
    $vendas = $data['Vendas'];

    usort($vendas, function ($a, $b)
    {
        return strcmp($a->getDataConfirmacao(), $b->getDataConfirmacao());
    });

    $vendas2 = $vendas;

    usort($vendas2, function ($a, $b)
    {
        return strcmp($a->getDataVenda(), $b->getDataVenda());
    });

    $dataTotais = getSomas($vendas2, true);
    $dataDiaria = getSomas($vendas2, false);
}
?>
    <script src="$inc/js/moment.min.js"></script>
    <script src="$inc/js/Chart.min.js"></script>
    <script>
        function goToCity()
        {
            let city = document.getElementById('cidade').value;
            window.location.href = "/Venda/ListaGeral/" + city;
        }
    </script>
    <style>
        .pendente {
            font-weight: bold;
            color: #f00;
        }

        td, th {
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

        .bcontainer * {
            float: right;
        }

        .bcontainer select {
            width: 170px;

        }
    </style>
    <div class="formContainer">
        <div class="float-right bcontainer">
            <button class="btn btn-primary btn-block" onclick="goToCity()" style="width: 40px;margin: 0;height: 38px;margin: 0 5px 0 5px">
                <i class="fa fa-search"></i></button>
            <select class="form-control has-icon" name="cidade" id="cidade" style="">
                <?php
                include $GLOBALS['view'] . "inc/cidades.php"
                ?>
            </select>
        </div>
        <br><br>
        <h2>Vendas Totais
            <small>(<?php echo $cidade ?>)</small>
            <br>
        </h2>
        <br>
        <?php if (!$none) { ?>
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
        }
        else
        {
        ?>
            <h4>&emsp;Nenhum Evento em <?php echo $cidade ?>!</h4>
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