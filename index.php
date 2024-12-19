<?php

require_once 'vendor/autoload.php';

use Cartilha\BD\Banco;
use Cartilha\BD\Servico;

$banco = new Banco('localhost', 'root', 'cartilha', '', 'secretarias');

// Caso dentro da url exista o id da secretaria, passo o id ao construtor, para listar os servicos relacionados a essa secretaria
if(isset($_REQUEST['secretaria']))
{
    
    $secretaria = new Servico($_REQUEST['secretaria']);

    echo "<h3>Serviços</h3>";
    $secretaria->exibe_servicos();

}

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
            $banco->exibe_secretarias();
        ?>
    </div>
</body>
</html>