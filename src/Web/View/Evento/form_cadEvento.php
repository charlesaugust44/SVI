<?php
$title = "Cadastrar Evento";
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminTop.php";
IC::end();
?>
<div class="formContainer" style="max-width: 95%">
    <a href="/Evento/Lista/Aracaju">
        <button class="btn btn-success"><i class="fa fa-chevron-left"></i>&emsp;Voltar</button>
    </a>
    <br><br>
    <form action="/Evento/Cadastrar" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="txtNome">Titulo*</label>
            <input name="titulo" type="text" class="form-control" id="txtTitulo" placeholder="Titulo" required>
        </div>

        <div class="row">
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtSubtitulo">Subtitulo*</label>
                    <input name="subtitulo" type="text" class="form-control" id="txtSubtitulo" placeholder="Subtitulo" required>
                </div>
            </div>
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtBanner">Banner*</label>
                    <input name="imagem" type="file" accept="image/*" class="form-control-file" id="txtBanner" placeholder=":TODO" required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtCategoria">Categoria*</label>
                    <input name="categoria" type="text" class="form-control" id="txtCategoria" placeholder="Categoria" required>
                </div>
            </div>
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtPreco">Preco*</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <div class="input-group-text">R$</div>
                        </div>
                        <input name="preco" type="number" step=".01" class="form-control" id="txtPreco" placeholder="0,00" required>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtData">Data*</label>
                    <input name="data" type="date" class="form-control" id="txtData" value="<?php echo date("Y-m-d") ?>" required><br>
                </div>
            </div>
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtDuracao">Duracao*</label>
                    <div class="input-group mb-2">
                        <input name="duracao" type="number" class="form-control" id="txtDuracao" placeholder="Duracao do Evento" required>
                        <div class="input-group-addon">
                            <div class="input-group-text">Dias</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtHoraInicio">Hora de Início*</label>
                    <input name="horaInicio" type="time" class="form-control" id="txtHoraInicio" required><br>
                </div>
            </div>
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtHoraTermino">Hora de Término*</label>
                    <input name="horaTermino" type="time" class="form-control" id="txtHoraTermino" placeholder="Duracao do Evento (Dias)" required>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtCidade">Cidade*</label>
                    <select name="cidade" class="form-control" id="txtCidade" required>
                        <?php
                        $cidade = "Aracaju";
                        include $GLOBALS['view'] . "inc/cidades.php"
                        ?>
                    </select>
                </div>
            </div>
            <div class="col col-sm-6">
                <div class="form-group">
                    <label for="txtEndereco">Endereco*</label>
                    <input name="endereco" type="text" class="form-control" id="txtEndereco" required><br>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="txtDescricao">Descrição*</label>
            <textarea id="txtDescricao" class="form-control" name="descricao" style="height: 500px" required></textarea>
        </div>

        <button type="reset" class="btn btn-warning">Limpar</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

</div>
<?php
IC::start(IC::$VIEW . '/Administrador');
require_once "../inc/adminBottom.php";
IC::end();
?>