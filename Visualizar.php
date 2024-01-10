<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API de visualizar</title>
</head>

<body>
    <h2>Visualizar Investimento</h2>
    <form action="view.php" method="get">

        <label for="data_atual">Data atual:</label>
        <input type="date" id="data_atual" name="data_atual" required>

        <label for="usuario">Nome do proprietario:</label>
        <input type="text" id="usuario" name="usuario" required>

        <button type="subtmit">Visualizar Investimento</button>
    </form>
</body>

</html>