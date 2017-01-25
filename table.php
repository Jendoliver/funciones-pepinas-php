<?php
/*
*
* table.php: librería de funciones relacionadas con la creación de tablas automática
*
*/

function createTable($con, $res)
{
    $row = mysqli_fetch_assoc($res);
    echo "<table border=2px><th>"; // principio de tabla
    foreach($row as $key => $value) // header tabla
    {
        echo "<td>$key</td>";
    }
    echo "</th>";

    do // llenar tabla con el contenido de la query
    {
        echo "<tr>"; // principio de fila
        foreach($row as $key => $value) // llenamos una fila
            echo "<td>$value</td>";
        echo "</tr>"; // final de fila
    } while ($row = mysqli_fetch_assoc($res)); // mientras queden registros en la query
    echo "</table>"; // final de tabla
}

function createTableModify($con, $res, $primary) // Imprime una tabla con los resultados de una query, añadiendo una columna con botones de modificar --- $con = conexion bbdd, $res = resultado query
{
    $row = mysqli_fetch_assoc($res);
    echo "<table border=2px><th>";
    foreach($row as $key => $value) // header tabla
    {
        echo "<td>$key</td>";
    }
    echo "<td>Modificar</td></th>"; // columna de botón modificar

    do // llenar tabla con el contenido de la query
    {
        echo "<tr>"; // principio de fila
        foreach($row as $key => $value) // llenamos una fila
        {
            if($key == $primary) // pillamos la primary para lanzar el modify sobre eso
            {    
                $type = $key;
                session_start();
                $_SESSION["primary"] = $value;
            }
            echo "<td>$value</td>";
        }
        echo "<input type='submit' name='$type' formaction='modificardatos.php' value='MODIFICAR'>"; // botón de modificar envía a una página modificardatos.php donde se gestionan según el caso
    } while ($row = mysqli_fetch_assoc($res));
    echo "</table>";
}