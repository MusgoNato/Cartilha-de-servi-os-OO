<?php

namespace Cartilha\BD;
use PDO;
use Cartilha\BD\Banco;

class Servico
{
    public $id_secretaria;

    /**
     * Construtor
     * @param mixed $id_secretaria
     */
    function __construct($id_secretaria)
    {
        $this->id_secretaria = $id_secretaria;
    }

    /**
     * Exibe os serviços
     */
    public function exibeServicos()
    {
        $banco = Banco::getInstance();
        $conexao = $banco->getConexao();

        // Usando prepared statement para evitar SQL Injection
        $query = $conexao->prepare("SELECT * FROM `servico` WHERE ID_secretaria = :id_secretaria");
        $query->bindParam(':id_secretaria', $this->id_secretaria, PDO::PARAM_INT);
        $query->execute();  

        $servicos = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($servicos)) 
        {
            
            if(isset($_REQUEST['servico']) && is_numeric($_REQUEST['servico'])) 
            {
                $servico_id = (int)$_REQUEST['servico'];

                // Percorro dentro dos serviços ate achar o indice que foi passado pela url
                $servico = null;
                foreach($servicos as $s) 
                {
                    if($s['ID_servico'] == $servico_id)
                    {
                        $servico = $s;
                        break;
                    }
                }

                if($servico) 
                {
                    echo "<div class='container my-4'>";
                    echo "<div class='card shadow-sm'>";
                    echo "<div class='card-header bg-primary text-white text-center'>";
                    echo "<h5>Detalhes do Serviço</h5>";
                    echo "</div>";
                    echo "<div class='card-body'>";
                    echo "<ul class='list-group list-group-flush'>";
                    echo "<li class='list-group-item'><strong>Descrição:</strong> " . htmlspecialchars($servico['descricao']) . "</li>";
                    echo "<li class='list-group-item'><strong>Local de acesso:</strong> " . htmlspecialchars($servico['local_de_acesso']) . "</li>";
                    echo "<li class='list-group-item'><strong>Canais de acesso:</strong> " . htmlspecialchars($servico['canais_de_acesso']) . "</li>";
                    echo "<li class='list-group-item'><strong>Forma de solicitação:</strong> " . htmlspecialchars($servico['forma_de_solicitacao']) . "</li>";
                    echo "<li class='list-group-item'><strong>Público alvo:</strong> " . htmlspecialchars($servico['publico_alvo']) . "</li>";
                    echo "<li class='list-group-item'><strong>Categoria do serviço:</strong> " . htmlspecialchars($servico['categoria_do_servico']) . "</li>";
                    echo "<li class='list-group-item'><strong>Setor inicial:</strong> " . htmlspecialchars($servico['setor_inicial']) . "</li>";
                    echo "<li class='list-group-item'><strong>Documentos obrigatórios:</strong> " . htmlspecialchars($servico['documentos_obrigatorios']) . "</li>";
                    echo "<li class='list-group-item'><strong>Legislação:</strong> " . htmlspecialchars($servico['legislacao']) . "</li>";
                    echo "<li class='list-group-item'><strong>Observações:</strong> " . htmlspecialchars($servico['observacoes']) . "</li>";
                    echo "<li class='list-group-item'><strong>Tipo:</strong> " . htmlspecialchars($servico['tipo']) . "</li>";
                    echo "<li class='list-group-item'><strong>Tempo estimado em dias:</strong> " . htmlspecialchars($servico['tempo_estimado_dias']) . "</li>";
                    echo "<li class='list-group-item'><strong>Custo de serviço:</strong> " . htmlspecialchars($servico['custo_de_servico']) . "</li>";
                    echo "</ul>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                } 
                else 
                {
                    echo "<p>Serviço não encontrado.</p>";
                }
            }
            else
            {
                echo "<div class='container mt-4'>";
                echo "<div class='row g-4'>"; // Flexbox para espaçamento entre os cards
                foreach($servicos as $servico) 
                {
                    echo "<div class='col-md-4'>"; // Coluna para ajustar largura
                    echo "<div class='card shadow-sm' style='width: 18rem;'>"; // Tamanho fixo do card
                    echo "<div class='card-body d-flex flex-column'>"; // Corpo flexível para alinhamento
                    echo "<h5 class='card-title text-truncate'>" . htmlspecialchars($servico['titulo']) . "</h5>";
                    echo "<p class='card-text text-truncate'>" . htmlspecialchars($servico['descricao']) . "</p>";
                    echo "<div class='mt-auto'>"; // Coloca o botão no final do card
                    echo "<a href='?secretaria={$this->id_secretaria}&servico={$servico['ID_servico']}' class='btn btn-primary'>Saiba mais</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>"; // Fim da linha
                echo "</div>"; // Fim do container
            }
        }
        else
        {
            echo "<div class='alert alert-warning text-center mt-4' role='alert'>";
            echo "<strong>Nenhum serviço encontrado!</strong>";
            echo "</div>";
        }
    }
}
?>