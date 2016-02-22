<table border="1">
    <tr>
        <td>Id</td>
        <td>Nombre</td>
        <td>Info</td>
        <td>URL</td>
    </tr>
<?php foreach($listaTiendas as $tienda): ?>
    <tr>
        <td><?=$tienda->id?></td>
        <td><?=$tienda->name?></td>
        <td><?=$tienda->info?></td>
        <td><a href="<?=$tienda->URL?>"><?=$tienda->URL?></a></td>
    </tr>
<?php endforeach; ?>
</table>	