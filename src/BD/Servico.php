<?php

namespace Cartilha\BD;
use PDO;
use Cartilha\BD\Banco;

class Servico extends Banco
{
    public $id_secretaria;

    /**
     * Summary of __construct
     * @param mixed $id_secretaria
     */
    function __construct($id_secretaria)
    {
        $this->id_secretaria = $id_secretaria;
    }

    /**
     * Summary of lista_servico
     * @return void
     */
    public function exibe_servicos()
    {
        // Boa pratica eh usar o single ton, somente uma conexao com o banco de dados, assim evito fazer varias conexoes com o banco de dados, acaba por tornar o codigo repetitivo nesse modelo
        // Preparo a busca do servico relacionado a secretaria selecionada
        $this->conexao = new PDO("mysql:host=localhost;dbname=cartilha", "root", "");
        $query = $this->conexao->prepare("SELECT * FROM `servico` WHERE ID_secretaria = {$this->id_secretaria}");
        $query->execute();

        // Vetor criado para percorrer os servicos
        $servicos = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($servicos))
        {
            foreach($servicos as $servico)
            {
                echo "<li>" . htmlspecialchars($servico['titulo']) . "</li>";
            }
        }
        
        
    }





}

?>