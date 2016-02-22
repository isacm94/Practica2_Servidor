<div style="font-weight:bold">Operar</div>
<ul class="nav nav-pills nav-stacked">
<?php foreach($listaTiendas as $tienda): ?>
    <li><a href="<?=site_url('agregador/tienda/'.$tienda->id)?>"><?=$tienda->name?></a></li>
<?php endforeach; ?>
</ul>	

<div style="font-weight:bold">Registrar</div>
<div>
    <a href="<?=site_url('agregador/lista') ?>">Lista</a><br/>
    <a href="<?=site_url('agregador/registra') ?>">Registra</a><br/>
    <br/><br/>
</div>
<div>
<div style="font-weight:bold">MODO DEPURACIÓN</div>
    <?php if ($this->session->userdata('depurar')) : ?>
    -Activado-<br/>
    <a href="<?=site_url('agregador/depurar/0') ?>">Desactiva</a><br/>
    <?php else : ?>
    -Desactivado-<br/>
    <a href="<?=site_url('agregador/depurar/1') ?>">Activa</a><br/>
    <?php endif; ?>
</div>