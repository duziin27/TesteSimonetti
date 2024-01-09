<?php

require_once('banco.php');

// criando o investimento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $data_criacao = $_POST['data_criacao'];
    $valor_inicial = $_POST['valor_inicial'];
    $data_atual = date('Y-m-d');
    
    // Validar dados e garantir que o investimento não seja negativo
    if (strtotime($data_criacao) > strtotime($data_atual)) {
        echo "Erro: A data de criação não pode ser futura.";
    } else {
        $sql = "INSERT INTO investimentos (usuario, data_criacao, valor_inicial) VALUES ('$usuario', '$data_criacao', '$valor_inicial')";

        if ($conexao->query($sql) === TRUE) {
            echo "Investimento criado com sucesso.";
        } else {
            echo "Erro ao criar investimento: " . $conexao->error;
        }
    }
}

// calculo do ganho mensal
function calcularGanhoMensal($valor_inicial, $data_criacao, $data_atual) {
    $taxa_juros_mensal = 0.0052;
    $diferenca_meses = (strtotime($data_atual) - strtotime($data_criacao)) / (60 * 60 * 24 * 30);
    $ganho_total = $valor_inicial * pow(1 + $taxa_juros_mensal, $diferenca_meses);

    return $ganho_total - $valor_inicial;
}

// visualizar um investimento
 if($_SERVER['REQUEST_METHOD'] === 'GET'  && isset($_GET['id_investimento'])){
    $id_investimento = $_GET['id_investimento'];

    $sql = "SELECT * FROM investimentos WHERE id = '$id_investimento'";

    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();

        // Calcular o saldo esperado
        $data_atual = date('Y-m-d');
        $ganho_mensal = calcularGanhoMensal($linha['valor_inicial'], $linha['data_criacao'], $data_atual);
        $saldo_esperado = $linha['valor_inicial'] + $ganho_mensal;
        

        header('Content-Type: application/json');
        echo json_encode(['investimento' => [
            'proprietario' => $linha['usuario'],
            'valor_inicial' => $linha['valor_inicial'],
            'data_inicial' => $linha['data_criacao'],
            'saldo_esperado' => $saldo_esperado,
        ]]);
    } else {
        echo json_encode(['erro' => 'Investimento não encontrado']);
    }
}

//listar investimentos de uma pessoa com paginação
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $por_pagina = 10;
    $offset = ($pagina - 1) * $por_pagina;

    $sql = "SELECT * FROM investimentos WHERE usuario = '$usuario' LIMIT $por_pagina OFFSET $offset";

    $resultado = $conexao->query($sql);

    $investimentos = [];
    while ($linha = $resultado->fetch_assoc()) {
        // Calcular o saldo esperado considerando o ganho composto
        $data_input = $_POST['data'] ?? 1;
        $data_atual = date('Y-m-d', strtotime($data_input));
        $ganho_mensal = calcularGanhoMensal($linha['valor_inicial'], $linha['data_criacao'], $data_atual);
        $saldo_esperado = $linha['valor_inicial'] + $ganho_mensal;

        $investimentos[] = [
            'id' => $linha['id'],
            'valor_inicial' => $linha['valor_inicial'],
            'saldo_esperado' => $saldo_esperado,
        ];
    }

    echo json_encode(['investimentos' => $investimentos]);
}

// Fechar a conexão com o banco de dados
$conexao->close();

?>
