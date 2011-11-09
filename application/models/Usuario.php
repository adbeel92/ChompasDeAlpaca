<?php
class Usuario extends CI_Model{
    var $_id;
    var $_username;
    var $_password;
    var $_nombre;
    var $_apellido;
    var $_rol;
    public function __construct($id="",$username="",$password="",$nombre="",$apellido="",$rol="") {
        parent::__construct();
        $this->_id = $id;
        $this->_username = $username;
        $this->_password = $password;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_rol = $rol;
    }
    public function getId() {return $this->_id;}
    public function getUsername() {return $this->_username;}
    public function getPassword() {return $this->_password;}
    public function getNombre() {return $this->_nombre;}
    public function getApellido() {return $this->_apellido;}
    public function getRol() {return $this->_rol;}
    
    function getAllUsuarios(){
        $query = $this->db->get('usuarios');
        $lista = $query->result();
        $listaUsers = array();
        foreach($lista as $user){
            $id = $user->id;
            $username= $user->username;
            $password = $user->password;
            $nombre = $user->nombre;
            $apellido = $user->apellido;
            $rol = $user->rol;
            $listaUsers[] = new Usuario($id, $username, $password, $nombre, $apellido, $rol);
        }
        return $listaUsers;
    }
    function getUsuarioByUsername($username){
        $users = $this->getAllUsuarios();
        foreach($users as $u){
            if($u->_username== $username)
                return $u;
        }
    }
    function log_in($username,$password){
        $usuario = $this->getUsuarioByUsername($username);
        if($usuario != null){
            $pass = md5($password);
            if($username==null || $password==null){
                return "Usuario o Contraseña no ingresada.";
            }elseif($usuario->_password==$pass){
                    return ' ';
                }
                else{
                    return "La contraseña es incorrecta.";
                }
        }else
            return "El usuario no existe.";
    }

}

?>
