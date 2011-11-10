<?php

class Chompa extends CI_Model{
    var $_id;
    var $_insumoId;
    var $_nombre;
    var $_precio;
    var $_stockMin;
    var $_stockAct;
    var $_unidadesPedido;
    public function __construct($id="",$insumoId="",$nombre="",$precio="",$stockMin="",$stockAct="",$unidadesPedido="") {
        parent::__construct();
        $this->_id = $id;
        $this->_insumoId = $insumoId;
        $this->_nombre = $nombre;
        $this->_precio = $precio;
        $this->_stockMin = $stockMin;
        $this->_stockAct=$stockAct;
        $this->_unidadesPedido = $unidadesPedido;
    }
    public function getId(){return $this->_id;}
    public function getInsumoId(){return $this->_insumoId;}
    public function getNombre(){return $this->_nombre;}
    public function getStockMin(){return $this->_stockMin;}
    public function getStockAct(){return $this->_stockAct;}
    public function getUnidadesPedido(){return $this->_unidadesPedido;}
    
    function getAll(){
        $query = $this->db->get('chompas');
        $lista = $query->result();
        $listaAll=array();
        foreach($lista as $c){
            $id = $c->id;
            $insumoId = $c->id_insumo;
            $nombre = $c->nombre;
            $precio = $c->precio;
            $stockMin=$c->stock_min;
            $stockAct=$c->stock_actual;
            $unidadesPedido = $c->unidades_pedido;
            $listaAll[] = new Chompa($id, $insumoId, $nombre, $precio, $stockMin, $stockAct, $unidadesPedido);
        }
        return $listaAll;
    }
    function getChompa($id){
        $chompas = $this->getAll();
        foreach($chompas as $c){   
            if($c->_id== $id)
                return $c;
        }
    }
    
    
}

?>
