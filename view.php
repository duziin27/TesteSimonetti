<?php
require_once('banco.php');

// calculo do ganho mensal
function calcularGanhoMensal($valor_inicial, $data_criacao, $data_atual)
{
    $taxa_juros_mensal = 0.0052;
    $diferenca_meses = (strtotime($data_atual) - strtotime($data_criacao)) / (60 * 60 * 24 * 30);
    $ganho_total = $valor_inicial * pow(1 + $taxa_juros_mensal, $diferenca_meses);

    return $ganho_total - $valor_inicial;
}

function num($conexao, $usuario, $data_atual)
{
    $sql = "SELECT COUNT(*) AS total FROM investimentos WHERE usuario = '$usuario' AND data_criacao < '$data_atual'";
    $resultado = $conexao->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        return $linha['total'];
    }

    return 0;
}

// visualizar os investimentos
$usuario = $_GET['usuario'] ?? 0;
$data_atual = $_GET['data_atual'] ?? 0;

// paginação
$pagina = $_GET['pagina'] ?? 1;
$por_pagina = 3;
$start = ($pagina - 1) * $por_pagina;
$numero_de_investimentos = num($conexao, $usuario, $data_atual);
$total_de_paginas = intval(ceil($numero_de_investimentos / $por_pagina));
$info = [];

$sql = "SELECT * FROM investimentos WHERE usuario = '$usuario' LIMIT $start, $por_pagina";
$resultado = $conexao->query($sql);

while ($linha = $resultado->fetch_assoc()) {
    if (strtotime($linha['data_criacao']) < strtotime($data_atual)) {
        $ganho_mensal = calcularGanhoMensal($linha['valor_inicial'], $linha['data_criacao'], $data_atual);
        $saldo_esperado = $linha['valor_inicial'] + $ganho_mensal;

        $info[] = [
            'id_do_investimento' => $linha['id'],
            'proprietario' => $linha['usuario'],
            'data_inicial' => $linha['data_criacao'],
            'valor_inicial' => $linha['valor_inicial'],
            'saldo_esperado' => $saldo_esperado,
        ];
    }
}

header('Content-Type: application/json');
echo json_encode([
    'investimentos' => $info,
    'paginacao' => [
        'pagina' => $pagina,
        'itens_por_pagina' => $por_pagina,
        'total_de_paginas' => $total_de_paginas,
        'numero_de_investimentos' => $numero_de_investimentos
    ]]
);



?>
