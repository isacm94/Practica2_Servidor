<table border="1">
    <tr>
        <td></td>
        <td>Id</td>
        <td>Nombre</td>
        <td>Info</td>
        <td>URL</td>
    </tr>
<?php foreach($listaTiendas as $tienda): ?>
    <tr>
        <td><span style="font-size:1.5em; font-weight: bold">
                <a href="<?=site_url('agregador/borra/'.$tienda->id)?>" style="color:red">X
                </a>
            </span>
        </td>
        <td><?=$tienda->id?></td>
        <td><?=$tienda->name?></td>
        <td><?=$tienda->info?></td>
        <td><a href="<?=$tienda->URL?>"><?=$tienda->URL?></a></td>
    </tr>
<?php endforeach; ?>
</table>	