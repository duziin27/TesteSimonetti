<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API de criação</title>
</head>

<body>

    <h2>Criar Investimento</h2>
    <form action="create.php" method="post">

        <label for="usuario">Nome:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="data_criacao">Data de Criação:</label>
        <input type="date" id="data_criacao" name="data_criacao" required>

        <label for="valor_inicial">Valor Inicial:</label>
        <input type="number" id="valor_inicial" name="valor_inicial" required>

        <button type="submit">Criar Investimento</button>
    </form>

</body>

</html>

