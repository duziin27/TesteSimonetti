<?php
require_once('banco.php');

$id = $_GET['id_investimento'];
$data_atual = $_GET['data_atual'];

$sql = "SELECT * FROM investimentos WHERE id = '$id'";
$resultado = $conexao->query($sql);
$linha = $resultado->fetch_assoc();

$data_criacao = $linha['data_criacao'];
$valor_inicial = $linha['valor_inicial'];

$anos = floor((strtotime($data_atual) - strtotime($data_criacao)) / (365 * 24 * 60 * 60));

if(strtotime($linha['data_criacao']) < strtotime($data_atual)){
    
function calcularGanhoMensal($valor_inicial, $data_criacao, $data_atual) {
    $taxa_juros_mensal = 0.0052;
    $diferenca_meses = (strtotime($data_atual) - strtotime($data_criacao)) / (60 * 60 * 24 * 30);
    $ganho_mensal = $valor_inicial * pow(1 + $taxa_juros_mensal, $diferenca_meses);

    return $ganho_mensal - $valor_inicial;
}

function calcularImposto($ganho_total, $anos) {
    if ($anos < 1) {
        $percentual = 22.5;
    } elseif ($anos >= 1 && $anos < 2) {
        $percentual = 18.5;
    } else {
        $percentual = 15;
    }

    $impostos = $ganho_total * ($percentual / 100);

    return $impostos;
}

$ganho_total = calcularGanhoMensal($valor_inicial, $data_criacao, $data_atual);
$impostos = calcularImposto($ganho_total, $anos);

header('Content-Type: application/json');
echo json_encode([
    'id_do_investimento' => $linha['id'],
    'proprietario' => $linha['usuario'],
    'data_inicial' => $linha['data_criacao'],
    'data_retirada' => $data_atual,
    'valor_inicial' => $linha['valor_inicial'],
    'valor_rendido' => $ganho_total,
    'impostos' => $impostos,
    'valor_total' => $linha['valor_inicial'] + $ganho_total - $impostos,
]);
} else{
    header('Content-Type: application/json');
    echo json_encode(['mensagem' => 'A data escolhida não pode ser antes da criação do investimento']);
}

    resgate($id, $conexao);
    function resgate($id, $conexao){
        $sql = "DELETE FROM investimentos WHERE id = '$id'";
        $resultado = $conexao->query($sql);
    }

?>
