<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ChompasControl extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('Cart');
        $this->load->model('Chompa','',true);
        $this->load->model('Pedido','',true);
        $this->load->model('Insumo','',true);
        $this->load->model('Usuario','',true);
    }

    function add(){
        $id = $this->input->post('idChompaCarrito');
        $qty= $this->input->post('qty');
        $datos['nombreCompleto'] = $this->input->post('nombreCompleto');
        $datos['rol']= $this->input->post('rol');
        $datos['adm_id']= $this->input->post('adm_id');
        $datos['title']= 'Chompas de Alpaca';
        $chompa = $this->Chompa->getChompa($id);
        if($qty != null && $qty <= $chompa->getStockAct()){
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
            $datos['mensaje']='';
            $datos['cart']=$this->cart->contents();
            $this->load->view('CarritoCompra.html', $datos);
        }else{
            $datos['chompasCarrito'] = $this->Chompa->getAll();
            $datos['mensaje']='Ingrese otra cantidad para agregar al carrito.';
            $this->load->view('inicio.html', $datos);
        }
    }
    function updateCart(){  
        $this->load->library('Cart');
        $rowid = $this->input->post('rowId');
        $data = array('rowid' => $rowid, 'qty' => 0);
        $this->cart->update($data);
        
        $datos['cart']=$this->cart->contents();
        $datos['nombreCompleto'] = $this->input->post('nombreCompleto');
        $datos['rol']= $this->input->post('rol');
        $datos['adm_id']= $this->input->post('adm_id');
        $datos['title']= 'Chompas de Alpaca';
        $this->load->view('CarritoCompra.html', $datos);
    }
    function destroy(){  
        $this->cart->destroy();  
        
        $datos['cart']=$this->cart->contents();
        $datos['nombreCompleto'] = $this->input->post('nombreCompleto');
        $datos['rol']= $this->input->post('rol');
        $datos['adm_id']= $this->input->post('adm_id');
        $datos['title']= 'Chompas de Alpaca';
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
        $msj = "<p id='msjNo'>No hay Pedidos </p>";
        $data['title']= 'Chompas de Alpaca';
        $data['pedidos']=$pedidos;
        $data['msj']=$msj;
        
        $this->load->view('VerPedidos.html',$data);
    }
    function comprar(){
        $carrito = $this->cart->contents();
        $chompas = $this->Chompa->getAll();
        foreach($carrito as $chompaCarrito){
            $chompaFound = $this->Chompa->getChompa($chompaCarrito['id']);
            
            $id = $chompaFound->getId();
            $insumo = $chompaFound->getInsumo();
            $insumoId = $this->Insumo->getIdByInsumo($insumo);
            $nombre = $chompaFound->getNombre();
            $precio = $chompaFound->getPrecio();
            $stockMin = $chompaFound->getStockMin();
            $stockAct = $chompaFound->getStockAct() - $chompaCarrito['qty'];
            $unidadesPedido = $chompaFound->getUnidadesPedido();
            
            $chompaToUpdate = new Chompa($id, $insumoId, $nombre, $precio, $stockMin, $stockAct, $unidadesPedido);
            $this->Chompa->actualizarStockActual($chompaToUpdate);
        }
        $this->cart->destroy();
        $this->verificarStockActual();
    }
    function verificarStockActual(){
        $datos['title']= 'Chompas de Alpaca';
        $datos['nombreCompleto'] = $this->input->post('nombreCompleto');
        $datos['rol']= $this->input->post('rol');
        $datos['adm_id']= $this->input->post('adm_id');
        $datos['mensaje']='';
        $chompas = $this->Chompa->getAll();
        $datos['chompasCarrito'] = $chompas;
        $estado = false;
        foreach($chompas as $chompa){
            if($chompa->getStockAct() <= $chompa->getStockMin()){
                $chompasHacerPedido[] = $chompa;
                $estado=true;
            }
        }
        if($estado==true){
            $datos['chompasHacerPedido'] = $chompasHacerPedido;
            $this->load->view('RealizarPedido.html', $datos);
        }else
            $this->load->view('inicio.html', $datos);
    }
    function realizarPedido(){
        $id = $this->input->post('id');
        $insumo = $this->input->post('insumo');
        $insumoId = $this->Insumo->getIdByInsumo($insumo);
        $adm = $this->input->post('adm_id');
        $admId = $this->Usuario->getIdByUsername($adm);
        $fecha = date("Y-m-d G:i:s");
        $detalle = $this->input->post('detalle');
        $unidadesMas = $this->input->post('unitsPedido');
        
        $pedido = new Pedido(null, $insumoId, 2, $fecha, $detalle);
        $this->Pedido->ingresarPedido($pedido);
        
        $chompaFound = $this->Chompa->getChompa($id);
        $id = $chompaFound->getId();
        $insumo2 = $chompaFound->getInsumo();
        $insumoId = $this->Insumo->getIdByInsumo($insumo2);
        $nombre = $chompaFound->getNombre();
        $precio = $chompaFound->getPrecio();
        $stockMin = $chompaFound->getStockMin();
        $stockAct = $chompaFound->getStockAct() + $unidadesMas;
        $unidadesPedido = $chompaFound->getUnidadesPedido();
        $chompaToUpdate = new Chompa($id, $insumoId, $nombre, $precio, $stockMin, $stockAct, $unidadesPedido);
        $this->Chompa->actualizarStockActual($chompaToUpdate);
        $this->verificarStockActual();
    }
}

?>
