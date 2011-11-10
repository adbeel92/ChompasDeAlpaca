<?php

class Insumo extends CI_Model{
    var $_id;
    var $_nombre;
    public function __construct($id="",$nombre="") {
        parent::__construct();
        $this->_id=$id;
        $this->_nombre=$nombre;
    }
    public function getId(){return $this->_id;}
    public function getNombre(){return $this->_nombre;}
    
    function getAllInsumos(){
        $query = $this->db->get('insumos');
        $lista = $query->result();
        $listaInsumos = array();
        foreach($lista as $insumo){
            $id = $insumo->id;
            $nombre=$insumo->nombre;
            $listaInsumos[] = new Insumo($id, $nombre);
        }
        return $listaInsumos;
    }
    
}

?>
