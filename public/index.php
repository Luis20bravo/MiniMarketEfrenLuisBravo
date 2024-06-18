<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <link rel="stylesheet" href="./css/tailwind.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Datos del Producto</h2>
        <form id="productoForm" action="index.php" method="post" onsubmit="return validarFormulario()">
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="nombreError" class="text-red-500 text-xs italic mt-2 hidden">El nombre debe contener solo letras.</p>
            </div>
            <div class="mb-4">
                <label for="precio" class="block text-gray-700 font-semibold mb-2">Precio por Unidad:</label>
                <input type="number" id="precio" name="precio" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="precioError" class="text-red-500 text-xs italic mt-2 hidden">El precio debe ser un número positivo.</p>
            </div>
            <div class="mb-4">
                <label for="cantidad" class="block text-gray-700 font-semibold mb-2">Cantidad en Inventario:</label>
                <input type="number" id="cantidad" name="cantidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <p id="cantidadError" class="text-red-500 text-xs italic mt-2 hidden">La cantidad debe ser un número positivo.</p>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Enviar</button>
            </div>
        </form>

        <?php

        // Función para almacenar la información del producto en un array asociativo
        function almacenarInformacion($nombre, $precio, $cantidad)
        {
            return array(
                "nombre" => $nombre,
                "precio" => $precio,
                "cantidad" => $cantidad
            );
        }

        // Array global para almacenar los productos
        $Productos = array();

        // Función para procesar el formulario y almacenar la información del producto
        function procesarFormulario()
        {
            global $Productos;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = htmlspecialchars($_POST["nombre"]);
                $precio = htmlspecialchars($_POST["precio"]);
                $cantidad = htmlspecialchars($_POST["cantidad"]);

                // Validar los datos del formulario
                if (preg_match("/^[a-zA-Z\s]+$/", $nombre) && is_numeric($precio) && $precio > 0 && is_numeric($cantidad) && $cantidad >= 0) {
                    // Almacenar la información del producto en el array global
                    $Productos[] = almacenarInformacion($nombre, $precio, $cantidad);
                }
            }
        }

        // Función para mostrar la información de los productos en una tabla
        function mostrarTablaProductos($productos)
        {
            echo "<div class='overflow-x-auto mt-8'><table class='min-w-full bg-white border border-gray-200'>
                    <thead>
                        <tr>
                            <th class='py-2 px-4 border-b border-gray-200 bg-gray-100'>Nombre del Producto</th>
                            <th class='py-2 px-4 border-b border-gray-200 bg-gray-100'>Precio por Unidad</th>
                            <th class='py-2 px-4 border-b border-gray-200 bg-gray-100'>Cantidad en Inventario</th>
                            <th class='py-2 px-4 border-b border-gray-200 bg-gray-100'>Valor Total</th>
                            <th class='py-2 px-4 border-b border-gray-200 bg-gray-100'>Estado</th>
                        </tr>
                    </thead>
                    <tbody>";
            
            foreach ($productos as $producto) {
                $nombre = $producto["nombre"];
                $precio = $producto["precio"];
                $cantidad = $producto["cantidad"];
                $valorTotal = $precio * $cantidad;
                $estado = $cantidad > 0 ? "En Stock" : "Agotado";

                echo "<tr>
                        <td class='py-2 px-4 border-b border-gray-200'>$nombre</td>
                        <td class='py-2 px-4 border-b border-gray-200'>$precio $</td>
                        <td class='py-2 px-4 border-b border-gray-200'>$cantidad</td>
                        <td class='py-2 px-4 border-b border-gray-200'>$valorTotal $</td>
                        <td class='py-2 px-4 border-b border-gray-200'>$estado</td>
                      </tr>";
            }
            
            echo "</tbody>
                  </table></div>";
        }

        // Llama a la función para procesar el formulario
        procesarFormulario();

        // Mostrar la tabla de productos
        mostrarTablaProductos($Productos);

        ?>
    </div>
    <script src="./js/validations.js"></script>
</body>
</html>
