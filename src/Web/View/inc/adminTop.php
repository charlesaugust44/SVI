<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="$inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="$inc/css/controlPanel.css">

    <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <title>SVI - <?php echo $title ?></title>

    <style>
        .btn:hover {
            cursor: pointer;
        }

        .formContainer {
            padding-top: 55px;
            padding-left: 15px;
        }

        .formContainer .btn {
            margin: 5px;
            margin-left: 0;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>SVI<br>
                <small>Painel de Controle</small>
            </h3>
        </div>

        <ul class="list-unstyled components">
            <p>
                <small>Bem vindo</small>
                <br> <?php echo Auth::getName() ?></p>
            <li>
                <a href="/Evento/Lista/<?php if (Auth::levelCheck(Auth::$LVL2)) { ?>Aracaju<?php } ?>"><i class="far fa-fw fa-calendar-alt"></i>&nbsp;&nbsp;Eventos</a>
            </li>
            <?php if (Auth::levelCheck(Auth::$LVL2)) { ?>
                <li>
                    <a href="/Venda/ListaGeral/Aracaju"><i class="fas fa-fw fa-file-invoice-dollar"></i>&nbsp;&nbsp;Vendas</a>
                </li>
                <li>
                    <a href="/Administrador/Lista"><i class="fa fa-fw fa-user-alt"></i>&nbsp;&nbsp;Administradores</a>
                </li>
            <?php } ?>
            <li>
                <a href="/Administrador/Logout"><i class="fa fa-fw fa-sign-out-alt"></i>&nbsp;&nbsp;Sair</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-times"></i>
                </button>

            </div>
        </nav>
