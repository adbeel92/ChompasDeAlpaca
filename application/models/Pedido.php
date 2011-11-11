<?php

class Pedido extends CI_Model{
    var $_id;
    var $_insumo;
    var $_fecha;
    var $_detalle;

    public function __construct($id="", $insumo="",$fecha="",$detalle="") {
        parent::__construct();
        $this->_id=$id;
        $this->_insumo=$insumo;
        $this->_fecha=$fecha;
        $this->_detalle=$detalle;
    }
    public function getId(){return $this->_id;}
    public function getInsumo(){return $this->_insumo;}
    public function getFecha(){return $this->_fecha;}
    public function getDetalle(){return $this->_detalle;}
    function getAllPedidos(){
        $query = $this->db->get('pedidos');
        $lista = $query->result();
        $listaPedidos = array();
        
        $this->load->model('Insumo');
        $listaInsumos = $this->Insumo->getAllInsumos();
        
        foreach($lista as $pedido){
            $id = $pedido->id;
            
            foreach($listaInsumos as $i){
                if($i->getId() == $pedido->id_insumo)
                    $insumo = $i->getNombre();
            }
            
            $fecha = $pedido->fecha;
            $listaPedidos[] = new Pedido($id,$insumo,  $fecha);
        }
        return $listaPedidos;
    }
}

?>
