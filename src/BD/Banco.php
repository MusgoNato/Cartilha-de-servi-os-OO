<?php
namespace Cartilha\BD;

use PDO;
use PDOException;

/**
 * A classe Banco é responsavel por fazer a conexão somente uma vez com o banco de dados, evitando multiplas instancias do mesmo
 * Por isso é usado uma propriedade privada estatica, no codigo como um todo serão mais linhas para pegar a conexao mas somente uso uma instancia
 */
class Banco
{
    private static $instance = null;
    private $conexao;

    private $host = 'localhost'; 
    private $username = 'root';
    private $name_bd = 'cartilha';
    private $pass = '';

    /**
     * Construtor privado para evitar instância direta
     */
    private function __construct()
    {
        try 
        {
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->name_bd}", $this->username, $this->pass);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e) 
        {
            die("Não foi possível se conectar ao banco de dados: " . $e->getMessage());
        }
    }

    /**
     * Método para obter a instância única
     * 
     * @return Banco
     */
    public static function getInstance(): Banco
    {
        if(self::$instance === null) 
        {
            self::$instance = new Banco();
        }
        return self::$instance;
    }

    /**
     * Método para obter a conexão com o banco de dados
     * 
     * @return PDO
     */
    public function getConexao(): PDO
    {
        return $this->conexao;
    }

    /**
     * Exibe as secretarias
     */
    public function exibeSecretarias()
    {
        $query = $this->conexao->prepare("SELECT * FROM `secretarias`");
        $query->execute();

        $linhas = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($linhas)) 
        {
            echo "<div class='container'>";
            echo "<div class='row g-4'>"; 
            foreach($linhas as $linha) 
            {
                echo "<div class='col-md-4 d-flex align-items-stretch'>"; 
                echo "<div class='card card-custom'>"; 
                echo "<img src='' alt='' class='card-img-top'>";
                echo "<div class='card-body d-flex flex-column'>";
                echo "<h5 class='card-title text-truncate' style='max-width: 100%;'>" . htmlspecialchars($linha['nome']) . "</h5>"; 
                echo "<p class='card-text text-truncate' style='max-width: 100%;'>" . htmlspecialchars($linha['descricao']) . "</p>"; 
                echo "<a href='?secretaria=" . $linha['ID_secretaria'] . "' class='btn btn-primary mt-auto'>Acesse Serviços</a>"; 
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>"; 

        }
    }

    /**
     * Exibe os resultados da busca
     * 
     * @param string $input_procura
     */
    public function resultadoBusca($input_procura)
    {
        $query = $this->conexao->prepare("SELECT * FROM `servico` WHERE titulo LIKE '%$input_procura%' OR descricao LIKE '%$input_procura%'");
        $query->execute();

        $linhas = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($linhas)) 
        {
            echo "<h2 align='center'>Resultados da busca</h2>";
            echo "<div class='container'>";
            echo "<div class='row g-4'>"; 
            foreach($linhas as $linha) 
            {
                echo "<div class='col-md-4 d-flex align-items-stretch'>"; 
                echo "<div class='card card-custom'>"; 
                echo "<img src=''...' class='card-img-top' alt=''...'>";
                echo "<div class='card-body d-flex flex-column'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($linha['titulo']) . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($linha['descricao']) . "</p>";
                echo "<div class='mt-auto'>";
                echo "<a href='?secretaria={$linha['ID_secretaria']}&servico={$linha['ID_servico']}' class='btn btn-primary'>Saiba mais</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>"; 
            echo "</div>";
        } 
        else 
        {
            echo "<div class='alert alert-warning text-center mt-4' role='alert'>";
            echo "<strong>Nenhum resultado encontrado!</strong>";
            echo "</div>";
        }

    }
}
?>