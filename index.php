<h1>Cartilha de Serviços</h1>

<!-- Campo de Busca -->
<div>
    <form method="GET">
        <input type="search" name="search" placeholder="Digite o que deseja buscar...">
    </form> 
</div>

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

// Mostra os resultados da busca
if(isset($_GET['search']))
{
    $banco->resultado_busca($_GET['search']);    
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Cartilha</title>
</head>
<body>
    <div>
        <h2>Secretarias</h2>
        <?php
            // Chamo a listagem de secretarias
            $banco->exibe_secretarias();
        ?>
    </div>
</body>
</html>