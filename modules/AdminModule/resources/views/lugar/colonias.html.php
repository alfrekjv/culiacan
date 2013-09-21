<option value="none" selected="">Seleccione una colonia...</option>
<?php foreach ($colonias as $nombre => $id) : ?>
    <option value='<?=$id;?>'><?=utf8_encode($nombre);?></option>
<?php endforeach; ?>