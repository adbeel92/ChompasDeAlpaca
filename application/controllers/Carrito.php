<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrito extends CI_Controller{
    function Cart(){  
        parent::Controller();  
        $this->load->library('cart');  
        $this->load->helper('form');  
        $this->load->helper('url');  

    }  
    function index(){  
        //load your cart view  
        $this->load->view('CarritoCompra.html');  

    }  

    function updateCart(){  
        $rowid = $this->input->post('rowid');
        $data['rowid'] = $rowid;
        $data['qty'] = 0;
        $this->cart->update($data);  
        redirect('cart');  
    } 
}

?>
