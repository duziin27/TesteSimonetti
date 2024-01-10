<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db = 'Simonetti';

$conexao = new mysqli($hostname, $username, $password, $db);
if ($conexao->connect_errno){
    echo "Falha na conexão!";
}

/*
$criabanco = "CREATE DATABASE Simonetti";
if ($conexao->query($criabanco) === TRUE) {
    echo "Banco criado com sucesso.";
}
*/

/*
$criatabela = "CREATE TABLE investimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    data_criacao DATE NOT NULL,
    valor_inicial DECIMAL(10, 2) NOT NULL
)";
if ($conexao->query($criatabela) === TRUE) {
    echo "Tabela criada com sucesso.";
}
*/

?>