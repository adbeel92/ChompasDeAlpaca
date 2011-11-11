<?php

class Pedido extends CI_Model{
    var $_id;
    var $_insumo;
    var $_adm;
    var $_fecha;
    var $_detalle;

    public function __construct($id="", $insumo="",$adm="",$fecha="",$detalle="") {
        parent::__construct();
        $this->_id=$id;
        $this->_insumo=$insumo;
        $this->_adm = $adm;
        $this->_fecha=$fecha;
        $this->_detalle=$detalle;
    }
    public function getId(){return $this->_id;}
    public function getInsumo(){return $this->_insumo;}
    public function getAdm(){return $this->_adm;}
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
            $adm = $pedido->id_admin;
            $fecha = $pedido->fecha;
            $detalle = $pedido->detalle;
            $listaPedidos[] = new Pedido($id,$insumo,$adm,$fecha,$detalle);
        }
        return $listaPedidos;
    }
    function ingresarPedido(Pedido $pedido){
        $data=array(
            'id'=>$pedido->getId(),
            'id_insumo'=>$pedido->getInsumo(),
            'id_admin'=>$pedido->getAdm(),
            'fecha'=>$pedido->getFecha(),
            'detalle'=>$pedido->getDetalle()
        );
        $this->db->insert('pedidos',$data);
    }
}

?>
