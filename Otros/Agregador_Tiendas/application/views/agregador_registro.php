<div><?php echo validation_errors();?></div>
<div>
<form method="post">
    <fieldset>
        <legend>Información de tienda</legend>
        <p>Nombre: <input type="text" name="name" value="<?=set_value("name")?>"/></p>
        <p>Informacion: <textarea name="info"><?=set_value('info')?></textarea></p>
        <p>URL: <input type="text" name="URL" value="<?=set_value("URL")?>"/></p>
    </fieldset>
    <p><button name="enviar" type="submit">Guardar</button>
</form>
</div>