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
        if (self::$instance === null) 
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

        if (count($linhas)) 
        {
            foreach ($linhas as $linha) 
            {
                echo "<div class='card' style='width: 18rem;'>";
                echo "<img src=''...' class='card-img-top' alt=''...'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($linha['nome']) . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($linha['descricao']) . "</p>";
                echo "<a href='?secretaria=" . $linha['ID_secretaria'] . "' class='btn btn-primary'>Acesse Serviços</a>";
                echo "</div>";
                echo "</div>";
            }
        }
    }

    /**
     * Exibe os resultados da busca
     * 
     * @param string $input_procura
     */
    public function resultadoBusca($input_procura)
    {
        $query = $this->conexao->prepare("SELECT * FROM `servico` WHERE titulo LIKE :search OR descricao LIKE :search");
        $query->bindValue(':search', "%$input_procura%", PDO::PARAM_STR);
        $query->execute();

        $linhas = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($linhas)) 
        {
            echo "<h2 align='center'>Resultados da busca</h2>";
            echo "<div class='container'>";
            echo "<div class='row'>";
            foreach ($linhas as $linha) 
            {
                echo "<div class='col-md-4 d-flex align-items-stretch'>"; // Alinhamento uniforme dos cards
                echo "<div class='card card-custom'>"; // Classe personalizada
                echo "<img src=''...' class='card-img-top' alt=''...'>";
                echo "<div class='card-body d-flex flex-column'>"; // Flexbox para alinhar conteúdo
                echo "<h5 class='card-title'>" . htmlspecialchars($linha['titulo']) . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($linha['descricao']) . "</p>";
                echo "<div class='mt-auto'>"; // Coloca o botão no final do card
                echo "<a href='?secretaria={$linha['ID_secretaria']}&servico={$linha['ID_servico']}' class='btn btn-primary'>Saiba mais</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }
        else 
        {
            echo "<b>Nenhum resultado encontrado!</b>\n";
        }
        echo "</div>";
        echo "</div>";
    }
}
?>