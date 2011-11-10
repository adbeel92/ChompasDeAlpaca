<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginControl extends CI_Controller{
    function login(){
        $this->load->model('Usuario','',true);
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $login = $this->Usuario->log_in($username, $password);
        $user = $this->Usuario->getUsuarioByUsername($username);
        
        $data['title']= 'Chompas de Alpaca';
        $data['msjError'] = $login;
        
        $datos['title']='Chompas de Alpaca';
        if($user!=null){
            $datos['nombreCompleto'] = $user->_nombre.' '.$user->_apellido;
            $datos['rol']=$user->_rol;
            $datos['adm_id'] = $user->_id;
            $this->load->model('Chompa');
            $datos['chompasCarrito'] = $this->Chompa->getAll();
            $data['mensaje']='';
        }
        
        if($login==' ')
            $this->load->view('inicio.html',$datos);
        else
            $this->load->view('login.html',$data);
    }
    function logout(){
        $data['title']= 'Chompas de Alpaca';
        $data['msjError'] = ' ';
        $this->load->view('login.html',$data);
    }
}

?>
