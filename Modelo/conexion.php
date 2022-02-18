<?php
    class Conexion{
        function conectar(){
            $conexion = mysqli_connect("local host","root"," ","sistemaalmacen");
            mysqli_query($conexion, "SET NAMES 'utf8' ");
            return $conexion;   
        }
        function desconectar($conexion){
            mysqli_close($conexion);             
        }
    }
?>