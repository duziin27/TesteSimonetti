<?php

$json = file_get_contents('http://localhost/TesteSimonetti/API.php?id_investimento=1');

$dados_array = json_decode($json, true);

print_r($dados_array);