<?php

namespace Cartilha\BD;
use PDO;
use Cartilha\BD\Banco;

class Servico
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
    public function exibeServicos()
    {
        $banco = Banco::getInstance();
        $conexao = $banco->getConexao();

        $query = $conexao->prepare("SELECT * FROM `servico` WHERE ID_secretaria = {$this->id_secretaria}");
        $query->execute();  

        $servicos = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($servicos)) 
        {
            echo "<h3 align=center>Serviços</h3>";
            
            if(isset($_REQUEST['servico']))
            {
                $i = ((int)$_REQUEST['servico']) - ((int)$_REQUEST['secretaria']);
                echo "<ul>";
                echo "<li>". htmlspecialchars($servicos[$i]['descricao'])."</li>";
                echo "<li>Local de acesso: ". htmlspecialchars($servicos[$i]['local_de_acesso'])."</li>";
                echo "<li>Canais de acesso: ". htmlspecialchars($servicos[$i]['canais_de_acesso'])."</li>";
                echo "<li>Forma de solicitação: ". htmlspecialchars($servicos[$i]['forma_de_solicitacao'])."</li>";
                echo "<li>Publico alvo: ". htmlspecialchars($servicos[$i]['publico_alvo'])."</li>";
                echo "<li>Categoria do serviço: ". htmlspecialchars($servicos[$i]['categoria_do_servico'])."</li>";
                echo "<li>Setor inicial: ". htmlspecialchars($servicos[$i]['setor_inicial'])."</li>";
                echo "<li>Documentos obrigatórios: ". htmlspecialchars($servicos[$i]['documentos_obrigatorios'])."</li>";
                echo "<li>Legislação: ". htmlspecialchars($servicos[$i]['legislacao'])."</li>";
                echo "<li>Observações: ". htmlspecialchars($servicos[$i]['observacoes'])."</li>";
                echo "<li>Tipo: ". htmlspecialchars($servicos[$i]['tipo'])."</li>";
                echo "<li>Tempo estimado em dias: ". htmlspecialchars($servicos[$i]['tempo_estimado_dias'])."</li>";
                echo "<li>Custo de serviço: ". htmlspecialchars($servicos[$i]['custo_de_servico'])."</li>";
                echo "<li>" . $servicos[$i]['descricao'] . "</li>";
                echo "</ul>";
            }
            else
            {
                echo "<div class='container'>";
                echo "<div class='row'>"; // Início da linha
                foreach ($servicos as $servico) 
                {
                    echo "<div class='col-md-4 d-flex align-items-stretch'>"; // Alinhamento uniforme dos cards
                    echo "<div class='card card-custom'>"; // Classe personalizada
                    echo "<img src=''...' class='card-img-top' alt=''...'>";
                    echo "<div class='card-body d-flex flex-column'>"; // Flexbox para alinhar conteúdo
                    echo "<h5 class='card-title'>" . htmlspecialchars($servico['titulo']) . "</h5>";
                    echo "<p class='card-text'>" . htmlspecialchars($servico['descricao']) . "</p>";
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
    }

}

?>