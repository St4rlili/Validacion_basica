<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Validación</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="resultado">
    <h1>Resultado del Formulario</h1>

    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'exito'): ?>
        <div>
            <p><?php echo $_SESSION['mensaje']; ?></p>
            <h3>Datos ingresados:</h3>
            <ul>
                <li>Nombre: <?php echo htmlspecialchars($_SESSION['datos']['nombre']); ?></li>
                <li>Apellido: <?php echo htmlspecialchars($_SESSION['datos']['apellido']); ?></li>
                <li>Email: <?php echo htmlspecialchars($_SESSION['datos']['email']); ?></li>
            </ul>
        </div>
    <?php elseif (isset($_SESSION['status']) && $_SESSION['status'] === 'error'): ?>
        <div class="errores">
            <h3>Por favor, corrige los siguientes errores:</h3>
            <ul>
                <?php foreach ($_SESSION['errores'] as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <p>No hay datos para mostrar.</p>
    <?php endif; ?>

    <br>
    <a href="index.html">Volver al formulario</a>

    <?php session_unset(); ?>
</body>
</html>
