<option value="Alagoinhas">Alagoinhas</option>
<option value="Aracaju" selected>Aracaju</option>
<option value="Campina Grande">Campina Grande</option>
<option value="Criciúma">Criciúma</option>
<option value="Eunapolis">Eunapolis</option>
<option value="Feira de Santana">Feira de Santana</option>
<option value="Itabuna">Itabuna</option>
<option value="Maceio">Maceio</option>
<option value="Manaus">Manaus</option>
<option value="Mossoró">Mossoró</option>
<option value="Osasco">Osasco</option>
<option value="Patos">Patos</option>
<option value="Quixadá">Quixadá</option>
<option value="Salvador">Salvador</option>
<option value="Santa Ines">Santa Ines</option>
<option value="Santo Antonio de Jesus">Santo Antonio de Jesus</option>
<option value="São Luis">São Luis</option>
<option value="Teixeira de Freitas">Teixeira de Freitas</option>
<option value="Vitória da Conquista">Vitória da Conquista</option>
<script>
    let selected = "<?php echo $cidade ?>";
    let options = document.getElementsByTagName('option');

    for (let i = 0; i < options.length; i++)
    {
        if(options[i].value == selected)
        {
            options[i].setAttribute("selected","selected");
            break;
        }
    }
</script>