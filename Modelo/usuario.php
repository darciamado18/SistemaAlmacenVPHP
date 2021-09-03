<?php
    class Usuario{

        private $_conexion;
        private $_idusuarios;
        private $_tipoidentUsu;
        private $_noidentifUsu;
        private $_nombresUsu;
        private $_apellidosUsu;
        private $_celularUsu;
        private $_correoUsu;
        private $_direccionUsu;
        private $_rolUsu;
        private $_nick;
        private $_password;

        private $_paginacion = 10;

        function __construct($conexion, $_idusuarios, $_tipoidentUsu, $_noidentifUsu, $_nombresUsu, $_apellidosUsu, $_celularUsu, 
        $_correoUsu, $_direccionUsu, $_rolUsu, $_nick, $_password){
            $this->_conexion     = $conexion;
            $this->_idusuarios   = $_idusuarios;
            $this->_tipoidentUsu = $_tipoidentUsu;
            $this->_noidentifUsu = $_noidentifUsu;
            $this->_nombresUsu   = $_nombresUsu;
            $this->_apellidosUsu = $_apellidosUsu;
            $this->_celularUsu   = $_celularUsu;
            $this->_correoUsu    = $_correoUsu;
            $this->_direccionUsu = $_direccionUsu;
            $this->_rolUsu       = $_rolUsu;
            $this->_nick         = $_nick;
            $this->_password     = $_password;
        }

        function __get($k){
            return $this->$k;          
        }

        function __set($k, $v){
            $this->$k = $v;
        }

        function insertar(){
            $insercion = mysqli_query($this->_conexion, "INSERT INTO  
            usuarios (idusuarios, tipoidentUsu, noidentifUsu, nombresUsu, apellidosUsu, celularUsu, correoUsu, direccionUsu, rolUsu, nick, password)
            VALUES (NULL, '$this->_tipoidentUsu', '$this->_noidentifUsu', '$this->_nombresUsu', '$this->_apellidosUsu', '$this->_celularUsu', '$this->_correoUsu', '$this->_direccionUsu,
            '$this->_rolUsu', '$this->_nick', '$this->_password')");
            $auditoria = mysqli_query($this->_conexion, "INSERT INTO 
            Auditoria (idAuditoria, detalleAuditoria, idUsuarioAuditoria, fechaAuditoria)
            VALUES  (NULL, 'Inserto' ".static::class.",".$_SESSION['idusuarios'].",'CURDATE()')");
            return $insercion;
        }

        function modificar(){
            $modificacion = mysqli_query($this->_conexion, "UPDATE usuarios SET 
            tipoidentUsu = '$this->_tipoidentUsu', noidentifUsu = '$this->_noidentifUsu', nombresUsu = '$this->_nombresUsu',
            apellidosUsu = '$this->_apellidosUsu', celularUsu = '$this->_celularUsu', correoUsu = '$this->_correoUsu', 
            direccionUsu = '$this->_direccionUsu', rolUsu = '$this->_rolUsu', nick = '$this->_nick', password = '$this->_password' 
            WHERE idusuarios = $this->_idusuarios");
            $auditoria = mysqli_query($this->_conexion, "INSERT INTO 
            Auditoria (idAuditoria, detalleAuditoria, idUsuarioAuditoria, fechaAuditoria)
            VALUES  (NULL, 'Modifco' ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
            return $modificacion;
        }

        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion, "DELETE FROM usuarios 
            WHERE idusuarios = $this->_idusuarios");
            $auditoria = mysqli_query($this->_conexion, "INSERT INTO 
            Auditoria (idAuditoria, detalleAuditoria, idUsuarioAuditoria, fechaAuditoria)
            VALUES  (NULL, 'Inserto ' ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
            return $eliminacion;
        }

        function cantidadPaginas(){
            $cantidadBloques = mysqli_query($this->_conexion, 
                "SELECT CEIL (COUNT (idusuarios)/$this->_paginacion) AS cantidad FROM usuarios")
                or die(mysqli_error($this->_conexion));
                $unRegistro = mysqli_fetch_array($cantidadBloques);
                return $unRegistro['cantidad'];                
        }

        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion, "SELECT * FROM usuarios ORDER BY idusuarios 
                LIMIT $paginacion, $paginacionMax") or die (mysqli_error($this->conexion));                
            }
            return $listado;         

        }

    }
?>