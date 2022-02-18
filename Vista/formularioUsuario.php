<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulario Usuario</title>
</head>
<body>
    <header>
        <h1>Formulario Usuario</h1>
    </header>
    <table border = "1">
        <tbody>
            <tr>
                <th scope = "col"> Tipo Identificacion </th>
                <th scope = "col"> Numero De Identificacion </th>
                <th scope = "col"> Nombres </th>
                <th scope = "col"> Apellidos </th>
                <th scope = "col"> Celular </th>
                <th scope = "col"> Correo Electronico </th>
                <th scope = "col"> Direccion </th>
                <th scope = "col"> Rol </th>
                <th scope = "col"> Usuario </th>
                <th scope = "col"> Contraseña </th>
                <th scope = "col"> </th>
            </tr>

    <?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();

        include_once("../modelo/cliente.php");
        $objetoCliente = new cliente($conexion, 0, 'nombre', 'documento', 'correo');
        $listaClientes = $objetoCliente->listar(0);
        while($unRegistro = mysqli_fetch_array($listaClientes)){
            echo '<tr><form id = "fModificarCliente"'.$unRegistro["idCliente"].' action = "../controlador/ControladorCliente.php"
            method = "post">';
            echo '<td><input  type ="hidden"  name ="fIdCliente"         value ="'.$unRegistro['idCliente'].'">';
            echo '    <input  type ="text"    name ="fNombreCliente"     value ="'.$unRegistro['nombreCliente'].'"></td>';
            echo '<td><input  type ="number"  name ="fDocumentoCliente"  value ="'.$unRegistro['documentoCliente'].'"></td>';
            echo '<td><input  type ="email"   name ="fCorreoCliente"     value ="'.$unRegistro['correoCliente'].'"></td>';
            echo '<td><button type ="submit"  name ="fEnviar"            value = "MODIFICAR"></button>
                      <button type ="submit"  name ="fEnviar"            value = "ELIMINAR"></button></td>';
            echo '</form></tr>';
        }
    ?>
            <tr><form id = "fIngresarCliente" action = "..controlador/ControladorCliente.php" method = "post">
                <td><input  type = "hidden" name = "fIdCliente" value = "0"></td>
                <td><input  type = "text"   name = "fNombreCliente"></td>
                <td><input  type = "number" name = "fDocumentoCliente"></td>
                <td><input  type = "email"  name = "fCorreoCliente"></td>
                <td><button type = "submit" name = "fEnviar" value = "INGRESAR"></button>
                    <button type = "reset"  name = "fEnviar" value = "LIMPIAR"></button></td>
            </form></tr>
        </tbody>
    </table>
<?php
    mysqli_free_result($listaClientes);
    $objetoConexion -> desconectar($conexion);
?>

</body>
</html>