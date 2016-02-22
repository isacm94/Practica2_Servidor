<?php

class Gestor_Tiendas_Model extends CI_Model
{
 
    private $fileName;
        
    private $xmlProductos;    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    /**
     * Carga los datos de la tienda seleccionada
     * @param type $nombreTienda
     */
    public function Load($nombreTienda)
    {
        // Guardaremos la información en un fichero en formato JSON
        $this->fileName=__DIR__.'/'.$nombreTienda.'.xml';

        $this->xmlProductos= 
                new SimpleXMLElement(file_get_contents($this->fileName));    
       
    }
    
    public function Total()
    {
        return count($this->xmlProductos);
    }
    
    /**
     * Devuelve la lista de productos, desde la posición indicada
     * @param type $offset  Desplazamiento desde el inicio
     * @param type $limit   Nº de productos a devolver
     * @return type
     */
    public function Lista($offset, $limit)
    {
        $offset=(int)$offset;
        $limit=(int) $limit;
        
        $listaProductosDevolver=array();

        for($idx=$offset; 
               $idx<count($this->xmlProductos) && $idx-$offset<$limit; $idx++)
        {
            $producto=$this->xmlProductos->producto[$idx];
            $listaProductosDevolver[]=array(
                'nombre'=>(string) $producto->nombre, 
                'descripcion'=>(string) $producto->descripcion, 
                'precio'=>(string) $producto->precio,
                'img'=>(string) $producto->img,
                'url'=>site_url('service/tienda01/producto/'. (string) $producto->id)
            );            
        }

//        foreach($this->xmlProductos->producto as $p)
//        {
//            $listaProductosDevolver[]=array(
//                'nombre'=>(string) $p->nombre, 
//                'descripcion'=>(string) $p->descripcion, 
//                'precio'=>(string) $p->precio,
//                'img'=>(string) $p->img,
//                'url'=>site_url('service/tienda01/'. (string) $p->id)
//            );
//        }
        return $listaProductosDevolver; //$listaProductosDevolver;
    }
}
