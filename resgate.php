
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resgate</title>
</head>

<body>

    <h2>Resgate de Investimento</h2>
    <form action="rescue.php" method="get">

        <label for="data_atual">Data atual:</label>
        <input type="date" id="data_atual" name="data_atual" required>

        <label for="id_investimento">Id do investimento para o resgate:</label>
        <input type="number" id="id_investimento" name="id_investimento" required>

        <button onClick="deletar()">Retirar</button>
        
    </form>
    <script>
        
    </script>
</body>

</html>
