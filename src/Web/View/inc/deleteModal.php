<div class="modal fade" tabindex="-1" role="dialog" id="modalDeletar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Você está prestes a deletar um <span id="type"></span>, deseja continuar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="deletes()">Sim</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>
<script>
    toDelete = 0;

    function s2d(id, type)
    {
        toDelete = id;
        $('#type').html(type);
    }

    function deletes()
    {
        window.location.href = "/<?php echo $from ?>/Deletar/" + toDelete;
    }
</script>