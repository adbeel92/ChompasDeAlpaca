<?php

class Chompa extends CI_Model{
    var $_id;
    var $_insumo;
    var $_nombre;
    var $_precio;
    var $_stockMin;
    var $_stockAct;
    var $_unidadesPedido;
    public function __construct($id="",$insumo="",$nombre="",$precio="",$stockMin="",$stockAct="",$unidadesPedido="") {
        parent::__construct();
        $this->_id = $id;
        $this->_insumo = $insumo;
        $this->_nombre = $nombre;
        $this->_precio = $precio;
        $this->_stockMin = $stockMin;
        $this->_stockAct=$stockAct;
        $this->_unidadesPedido = $unidadesPedido;
    }
    public function getId(){return $this->_id;}
    public function getInsumo(){return $this->_insumo;}
    public function getNombre(){return $this->_nombre;}
    public function getPrecio(){return $this->_precio;}
    public function getStockMin(){return $this->_stockMin;}
    public function getStockAct(){return $this->_stockAct;}
    public function getUnidadesPedido(){return $this->_unidadesPedido;}
    
    function getAll(){
        $query = $this->db->get('chompas');
        $lista = $query->result();
        
        $this->load->model('Insumo');
        $listaInsumos = $this->Insumo->getAllInsumos();
        
        $listaAll=array();
        foreach($lista as $c){
            $id = $c->id;
            foreach($listaInsumos as $i){
                if($i->getId() == $c->id_insumo)
                    $insumo = $i->getNombre();
            }
            $nombre = $c->nombre;
            $precio = $c->precio;
            $stockMin=$c->stock_min;
            $stockAct=$c->stock_actual;
            $unidadesPedido = $c->unidades_pedido;
            $listaAll[] = new Chompa($id, $insumo, $nombre, $precio, $stockMin, $stockAct, $unidadesPedido);
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
    function actualizarStockActual(Chompa $chompa){
        //$sql = "UPDATE `chompasdb`.`chompas` SET `stock_actual` = \'200\' WHERE `chompas`.`id` = 1;
        $data=array(
            'id'=>$chompa->getId(),
            'id_insumo'=>$chompa->getInsumo(),
            'nombre'=>$chompa->getNombre(),
            'precio'=>$chompa->getPrecio(),
            'stock_min'=>$chompa->getStockMin(),
            'stock_actual'=>$chompa->getStockAct(),
            'unidades_pedido'=>$chompa->getUnidadesPedido()
        );
        $this->db->where('id',$chompa->getId());
        $this->db->update('chompas',$data);
    }
    
}

?>
