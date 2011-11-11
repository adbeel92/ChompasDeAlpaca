<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ChompasControl extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('Cart');
        $this->load->model('Chompa','',true);
        $this->load->model('Pedido','',true);
    }

    function add(){
        $id = $this->input->post('idChompaCarrito');
        $qty= $this->input->post('qty');
        $chompa = $this->Chompa->getChompa($id);
        $datosToAdd = array('id'=>$id,
                           'qty'=>$qty,
                           'price'=>$chompa->_precio,
                           'name'=>$chompa->_nombre);
        $cart=$this->cart->contents();
        if(count($cart)>0){
            foreach($cart as $c){//as chompa
                if($c['id'] == $id){
                    $d['rowid'] = $id;
                    $d['qty'] = $qty;
                    $this->cart->update($d);
                }
            }
            $this->cart->insert($datosToAdd);
        }
        $this->cart->insert($datosToAdd);

        $datos['nombreCompleto'] = $this->input->post('nombreCompleto');
        $datos['rol']= $this->input->post('rol');
        $datos['adm_id']= $this->input->post('adm_id');
        $datos['title']= 'Chompas de Alpaca';
        $datos['cart']=$this->cart->contents();
        $this->load->view('CarritoCompra.html', $datos); 
        
    }
    
    function verChompas(){
        $data['nombreCompleto'] = $this->input->post('nombreCompleto');
        $data['rol']= $this->input->post('rol');
        $data['adm_id']= $this->input->post('adm_id');

        $chompas=$this->Chompa->getAll();
        $data['title']= 'Chompas de Alpaca';
        $data['chompas']=$chompas;
        $this->load->view('VerChompas.html',$data);
    }
    function verPedidos(){
        $data['nombreCompleto'] = $this->input->post('nombreCompleto');
        $data['rol']= $this->input->post('rol');
        $pedidos=$this->Pedido->getAllPedidos();
        $data['adm_id']= $this->input->post('adm_id');
        $data['title']= 'Chompas de Alpaca';
        $data['pedidos']=$pedidos;
        $this->load->view('VerPedidos.html',$data);
    }
    function volver(){
        $datos['nombreCompleto'] = $this->input->post('nombreCompleto');
        $datos['rol']= $this->input->post('rol');
        $datos['adm_id']= $this->input->post('adm_id');
        $datos['title']= 'Chompas de Alpaca';
        $datos['chompasCarrito'] = $this->Chompa->getAll();   
        $this->load->view('inicio.html', $datos);
    }
}

?>
