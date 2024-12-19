<?php

namespace Cartilha\BD;
use PDO;
use PDOException;

class Banco
{
    private $host;
    private $username;
    private $name_bd;
    private $pass;

    public $table_name;

    private $conexao;

    /**
     * Summary of __construct
     * @param mixed $host
     * @param mixed $username
     * @param mixed $name_bd
     * @param mixed $pass
     */
    function __construct($host, $username, $name_bd, $pass, $table_name)
    {
        $this->host = $host;
        $this->username = $username;
        $this->name_bd = $name_bd;
        $this->pass = $pass;
        $this->table_name = $table_name;

        $this->conecta_bd();

    }

    /**
     * Conecta ao banco de dados
     * @return void
     */
    private function conecta_bd()
    {
        try
        {
            // Faço a conexao por meio do atributo privado da classe, evitando criar um novo objeto e nao usar ele. Após isso seto atributos para tratar os erros como exceção 
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->name_bd}", $this->username, $this->pass);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e)
        {
            die("Não foi possível se conectar ao banco de dados!");
        }
    }


    public function listar()
    {   
        // Prepara e executa o camndo SQL
        $query = $this->conexao->prepare("SELECT * FROM `secretarias`");
        $query->execute();

        // Transformo em um vetor de objetos para iterar sobre as linhas da tabela selecionada
        $linhas = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($linhas))
        {
            foreach($linhas as $linha)
            {
                // Passo para a url o id da secretaria pego do banco de dados
                echo "<li><a href='?ID_secretaria=".$linha['ID_secretaria']."'>".$linha['nome']."</a><li>\n";
            }
        }   
    }
}   

?>