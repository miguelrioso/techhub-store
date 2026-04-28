<?php
session_start();

$mensaje_compra = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }


    if (isset($_POST['finalizar'])) {

        require_once __DIR__ . "/../../config/database.php";
        $database = new Database();
        $conn = $database->connect();

        $usuario_id = $_SESSION['usuario']['id'];

        $stmt = $conn->prepare("INSERT INTO ordenes (usuario_id) VALUES (:usuario_id)");
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();

        $orden_id = $conn->lastInsertId();


        foreach ($_SESSION['carrito'] as $producto_id) {
            $stmt = $conn->prepare("INSERT INTO detalle_orden (orden_id, producto_id, cantidad) 
                                    VALUES (:orden_id, :producto_id, 1)");

            $stmt->bindParam(":orden_id", $orden_id);
            $stmt->bindParam(":producto_id", $producto_id);
            $stmt->execute();
        }


        $_SESSION['carrito'] = [];


        $_SESSION['mensaje_compra'] = "Compra realizada con éxito";
    }

    elseif (isset($_POST['vaciar'])) {
        $_SESSION['carrito'] = [];
    }


    elseif (isset($_POST['eliminar'])) {
        if (isset($_POST['index'])) {
            $index = $_POST['index'];
            unset($_SESSION['carrito'][$index]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }
    }


    elseif (isset($_POST['producto_id'])) {
        $_SESSION['carrito'][] = $_POST['producto_id'];
    }
}


$listaProductos = [];
while($row = $productos->fetch(PDO::FETCH_ASSOC)) {
    $listaProductos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TechHub Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        .carrito {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .price {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }

        button {
            margin-top: 10px;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 90%;
            }
        }
    </style>
</head>

<body>

<h1>TechHub Store</h1>

<!-- MENSAJE COMPRA -->
<?php if (isset($_SESSION['mensaje_compra'])) : ?>
    <p style="text-align:center; color:green; font-weight:bold; margin-top:10px;">
        <?php echo $_SESSION['mensaje_compra']; ?>
    </p>
    <?php unset($_SESSION['mensaje_compra']); ?>
<?php endif; ?>

<!-- USUARIO -->
<?php if (isset($_SESSION['usuario'])) : ?>
    <p style="text-align:center;">
        Bienvenido, <?php echo $_SESSION['usuario']['nombre']; ?>
    </p>

    <form action="/techhub/public/logout.php" method="POST" style="text-align:center; margin-top:10px;">
        <button type="submit" style="background:red;">Cerrar sesión</button>
    </form>

<?php endif; ?>

<div class="carrito">
    <p>
        Carrito: <?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?> productos
    </p>

    <form method="POST">
        <button type="submit" name="vaciar">Vaciar carrito</button>
    </form>

    <form method="POST">
        <button type="submit" name="finalizar">Finalizar compra</button>
    </form>

    <?php if (!empty($_SESSION['carrito'])) : ?>
        <h3>Productos en el carrito:</h3>

        <?php foreach($_SESSION['carrito'] as $index => $id) : ?>
            <?php foreach($listaProductos as $p) : ?>
                <?php if ($p['id'] == $id) : ?>
                    <form method="POST" style="margin-bottom:5px;">
                        <span><?php echo $p['nombre']; ?></span>
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <button type="submit" name="eliminar">❌</button>
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>

    <?php endif; ?>
</div>

<div class="container">
<?php foreach($listaProductos as $row) : ?>
    <div class="card">
        <h3><?php echo $row['nombre']; ?></h3>
        <p><?php echo $row['descripcion']; ?></p>
        <div class="price">$<?php echo $row['precio']; ?></div>

        <form method="POST" class="form-agregar">
            <input type="hidden" name="producto_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Agregar al carrito</button>
        </form>
    </div>
<?php endforeach; ?>
</div>

<script src="/techhub/public/js/carrito.js"></script>

</body>
</html>