<?php

class Pedido extends CI_Model{
    var $_id;
    var $_fecha;
    var $_detalle;

    public function __construct($id="", $idInsumo="",$fecha="") {
        parent::__construct();
        $this->_id=$id;
        $this->_idInsumo=$idInsumo;
        $this->_fecha=$fecha;
    }
    public function getId() {return $this->_id;}
    public function getFecha() {return $this->_fecha;}
    public function getIdInsumo() {return $this->_idInsumo;}
     function getAllPedidos(){
        $query = $this->db->get('pedidos');
        $lista = $query->result();
        $listaPedidos = array();
        foreach($lista as $pedido){
            $id = $pedido->id;
            $idInsumo=$pedido->id_insumo;
            $fecha=$pedido->fecha;
            $listaPedidos[] = new Pedido($id,$idInsumo,  $fecha);
        }
        return $listaPedidos;
    }
    function getPedidoById($id){
        $pedidos = $this->getAllPedidos();
        foreach($pedidos as $p){
            if($p->_id== $id)
                return $p;
        }
    }
}

?>
