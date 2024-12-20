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
            // Quando existir a variavel servico na url, entao mostro as informacoes do servico
            if(isset($_REQUEST['servico']))
            {
                // Jogada de indice pra pegar o servico correto
                $i = ((int)$_REQUEST['servico']) - ((int)$_REQUEST['secretaria']);
                
                echo "<ul class='list-group'>";
                echo "<li class='list-group-item'>". htmlspecialchars($servicos[$i]['descricao'])."</li>";
                echo "<li class='list-group-item'>Local de acesso: ". htmlspecialchars($servicos[$i]['local_de_acesso'])."</li>";
                echo "<li class='list-group-item'>Canais de acesso: ". htmlspecialchars($servicos[$i]['canais_de_acesso'])."</li>";
                echo "<li class='list-group-item'>Forma de solicitação: ". htmlspecialchars($servicos[$i]['forma_de_solicitacao'])."</li>";
                echo "<li class='list-group-item'>Publico alvo: ". htmlspecialchars($servicos[$i]['publico_alvo'])."</li>";
                echo "<li class='list-group-item'>Categoria do serviço: ". htmlspecialchars($servicos[$i]['categoria_do_servico'])."</li>";
                echo "<li class='list-group-item'>Setor inicial: ". htmlspecialchars($servicos[$i]['setor_inicial'])."</li>";
                echo "<li class='list-group-item'>Documentos obrigatórios: ". htmlspecialchars($servicos[$i]['documentos_obrigatorios'])."</li>";
                echo "<li class='list-group-item'>Legislação: ". htmlspecialchars($servicos[$i]['legislacao'])."</li>";
                echo "<li class='list-group-item'>Observações: ". htmlspecialchars($servicos[$i]['observacoes'])."</li>";
                echo "<li class='list-group-item'>Tipo: ". htmlspecialchars($servicos[$i]['tipo'])."</li>";
                echo "<li class='list-group-item'>Tempo estimado em dias: ". htmlspecialchars($servicos[$i]['tempo_estimado_dias'])."</li>";
                echo "<li class='list-group-item'>Custo de serviço: ". htmlspecialchars($servicos[$i]['custo_de_servico'])."</li>";
                echo "</ul>";
            }
            else
            {
                foreach($servicos as $servico)
                {
                    echo "<div class='card' style='width: 18rem;''>";
                    echo "<a href='?secretaria={$this->id_secretaria}&servico={$servico['ID_servico']}'>" . htmlspecialchars($servico['titulo'])."</a>";
                    echo "</div>";
                }
            }
            
        }
    }
}

?>