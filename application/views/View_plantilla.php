<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Camisetas de Fútbol</title>

        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?= base_url() ?>assets/template/css/owl.carousel.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/template/style.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/template/css/responsive.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/estilos.css">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/favicon.png" />
    </head>
    <body>

        <div class="header-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="user-menu">
                            <ul>
                                <li><a href="<?= base_url() . 'index.php/Registro' ?>"><i class="fa fa-user"></i> Registro Usuario</a></li>
                                <li><a href="<?= base_url() . 'index.php/Login' ?>"><i class="fa fa-user"></i> Login</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-3">
                        <div class="user-menu">
                            <ul>
                                <?php if ($this->session->userdata('logged_in')): ?>
                                        <li><a href="<?= base_url() . 'index.php/Login/Logout' ?>"><i class="fa fa-user"></i><?= $this->session->userdata('username'); ?>, <!--<i class="glyphicon glyphicon-log-out"></i>--> Cerrar sesión</a></li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Ajustes de usuario"><span class="glyphicon glyphicon-cog"></span> <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Modificar Usario</a></li>
                                            <li><a href="<?=base_url().'index.php/EliminarUsuario'?>"><span class="glyphicon glyphicon-trash"></span> Eliminar Usuario</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="site-branding-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo">
                            <h1><a href="">Camisetas <span>de Fútbol</span> <img src="<?= base_url() ?>assets/ball.png" style="height: 65px; width: 65px;"></a></h1>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="shopping-item">
                            <a href="<?= base_url() . 'index.php/Carrito' ?>">Carrito - 
                                <span class="cart-amunt"><?= $this->myCarrito->precio_total() ?> €</span> <i class="fa fa-shopping-cart"></i>
                                <span class="product-count"><?= $this->myCarrito->articulos_total() ?></span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="mainmenu-area">
            <div class="container">
                <div class="row">                     
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="<?php if (isset($homeactive)) {
                                    echo $homeactive;
                                }
                                ?>"><?= anchor('', 'Home') ?></li>
                            <li class="<?php if (isset($categoriaactive)) {
                                    echo $categoriaactive;
                                }
                                ?>"><?= anchor('Categorias/ver', 'Categoría') ?></li>                        
                            <li class="<?php if (isset($carritoactive)) {
                                    echo $carritoactive;
                                }
                                ?>"><?= anchor('Carrito', 'Carrito') ?></li>
                        </ul>
                    </div>  
                </div>
            </div>
        </div> 

        <div class="product-big-title-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-bit-title text-center">
                            <h2><?php if (isset($titulo))
                                    echo $titulo;
                                ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php if (isset($cuerpo))
    echo $cuerpo;
?>

        <!-- PRE PIE -->
        <div class="footer-top-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-about-us">
                            <h2>Camisetas <span>de Fútbol</span></h2>
                            <p>Camisetas de Fútbol SL</p>
                            <p>isacm94@gmail.com</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- PIE -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright">
                            <p>&copy; 2016 Isabel María Calvo Mateos - Todos los derechos reservados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery.min.js"></script>    
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>    
        <script src="<?= base_url() ?>assets/template/js/owl.carousel.min.js"></script>
        <script src="<?= base_url() ?>assets/template/js/jquery.sticky.js"></script>
        <script src="<?= base_url() ?>assets/template/js/jquery.easing.1.3.min.js"></script>
        <script src="<?= base_url() ?>assets/template/js/main.js"></script>
        <script src="<?= base_url() ?>assets/js/script.js"></script>
        <script src="<?= base_url() ?>assets/js/menudesplegable.js"></script>
    </body>
</html>
