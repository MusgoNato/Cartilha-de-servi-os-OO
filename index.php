<?php

require_once 'vendor/autoload.php';

use Cartilha\BD\Banco;

$banco = new Banco('localhost', 'root', 'cartilha', '', 'secretarias');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartilha</title>
</head>
<body>
    <h1>Cartilha de Serviços</h1>
    <div>
        <h2>Secretarias</h2>
        <?php
            // Chamo a listagem de secretarias
            $banco->listar();
        ?>
    </div>
</body>
</html>