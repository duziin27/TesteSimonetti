<?php

require_once('banco.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $data_criacao = $_POST['data_criacao'];
    $valor_inicial = $_POST['valor_inicial'];
    $data_atual = date('Y-m-d');


    // criando, validando dados e garantindo que o investimento não seja futuro
    if (strtotime($data_criacao) > strtotime($data_atual) && ($valor_inicial >= 0)) {
        header('Content-Type: application/json');
        echo json_encode(['mensagem' => "Erro: A data de criação não pode ser futura ou negativa."]);
    } else {
        $sql = "INSERT INTO investimentos (usuario, data_criacao, valor_inicial) VALUES ('$usuario', '$data_criacao', '$valor_inicial')";

        if ($conexao->query($sql) === TRUE) {
            header('Content-Type: application/json');
            echo json_encode(['mensagem' => "Investimento criado com sucesso."]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['mensagem' => "Erro ao criar investimento: "]);
        }
    }
}

?>