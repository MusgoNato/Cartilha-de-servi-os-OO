<hr class="border border-primary border-3 opacity-75">
<header class="container mt-4 text-center">
    <h1 class="text-primary">Cartilha de Serviços</h1>
</header>
<hr class="border border-primary border-3 opacity-75">

<!-- Campo de Busca -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <a class="navbar-brand text-primary font-weight-bold" href="index.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
        </svg>
        Home
    </a>
    <form method="GET" class="form-inline my-2 my-lg-0 ml-auto">
        <input class="form-control mr-sm-3" type="search" name="search" placeholder="O que procura?" aria-label="Search" required>
        <button class="btn btn-primary" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </form>
</nav>


<?php

require_once 'vendor/autoload.php';

use Cartilha\BD\Banco;
use Cartilha\BD\Servico;

$banco = Banco::getInstance(); 

// Exibe os serviços de uma secretaria específica
if (isset($_REQUEST['secretaria'])) 
{
    $servico = new Servico($_REQUEST['secretaria']);
    $servico->exibeServicos();
}

// Exibe os resultados da busca
if (isset($_GET['search'])) 
{
    $banco->resultadoBusca($_GET['search']);
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
    <link rel="stylesheet" href="style.css">
    <title>Cartilha</title>
</head>
<body>
    <div class="container mt-5">
    <hr class="border border-primary border-3 opacity-75">
    <h2 class="text-center mb-4" style="font-size: 2.5rem; font-weight: 700; color:rgb(76, 175, 173);">Secretarias</h2>
    <hr class="border border-primary border-3 opacity-75">
    <div class="row g-4">
        <?php
            // Chamo a listagem de secretarias
            $banco->exibeSecretarias();
        ?>
    </div>
</div>

</body>
</html>