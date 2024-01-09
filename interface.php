<?php
require_once('banco.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste da API de Investimentos</title>
</head>

<body>

    <h2>Criar Investimento</h2>
    <form action="API.php" method="post">

        <label for="usuario">Nome:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="data_criacao">Data de Criação:</label>
        <input type="date" id="data_criacao" name="data_criacao" required>

        <label for="valor_inicial">Valor Inicial:</label>
        <input type="number" id="valor_inicial" name="valor_inicial" required>

        <button type="submit">Criar Investimento</button>
    </form>

    <hr>

    <h2>Visualizar Investimento</h2>
    <form action="API.php" method="get">

        <label for="id_investimento">ID do Investimento:</label>
        <input type="number" id="id_investimento" name="id_investimento" required>

        <button type="subtmit">Visualizar Investimento</button>
    </form>

    <div id="resultado"></div>
</body>

</html>

</body>

</html>