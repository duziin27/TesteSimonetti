
# API's

Teste de construção em back-end de uma API que gerencia e armazena investimentos.



## Instruções
Para testes, é necessário o uso do xamp, criar um banco com as informações do arquivo "banco.php" e inserção dos dados pelo localhost para que não haja problemas na leitura do código.

Ter pelo menos 4 itens para o uso da "Paginação".

Para o uso da paginação deve se adicionar (&&pagina="numero da pagina") no final da url
ex.: 
```http 
"TesteSimonetti/view.php?data_atual=2024-08-02&usuario=eduardo&&pagina=2"
```
#

## Criação

#### POST / TesteSimonetti/Criar.php

```http
 {
      "nome": "eduardo",
      "data_criacao": "2021-06-10",
      "valor_inicial": "123.00",
    }
```

#### Retorna

```http
  {
  "mensagem": "Investimento criado com sucesso."
}
```
#
## Visualização e Paginação

#### GET / TesteSimonetti/view.php

```http
 {
      "nome": "eduardo",
      "data_criacao": "2021-06-10",
      "valor_inicial": "123.00",
    }
```

#### Retorna

```http

{
  "investimentos": [
    {
      "id_do_investimento": "3",
      "proprietario": "eduardo",
      "data_inicial": "2021-06-10",
      "valor_inicial": "123.00",
      "saldo_esperado": 149.30445886769277
    },
    {
      "id_do_investimento": "4",
      "proprietario": "eduardo",
      "data_inicial": "2023-11-01",
      "valor_inicial": "-50.00",
      "saldo_esperado": -52.18098752988348
    },
    {
      "id_do_investimento": "7",
      "proprietario": "eduardo",
      "data_inicial": "2024-01-02",
      "valor_inicial": "125.00",
      "saldo_esperado": 129.06163939811714
    }
  ],
  "paginacao": {
    "pagina": 1,
    "itens_por_pagina": 3,
    "total_de_paginas": 3,
    "numero_de_investimentos": "7"
  }
}
```
#
## Resgate

#### GET / TesteSimonetti/resgate.php

```http
 {
      "data_atual": "2024-03-29",
      "id_do_investimento": "3",
    }
```

#### Retorna

```http
{
  "id_do_investimento": "3",
  "proprietario": "eduardo",
  "data_inicial": "2021-06-10",
  "data_retirada": "2024-03-29",
  "valor_inicial": "123.00",
  "valor_rendido": 23.797211228461094,
  "impostos": 3.569581684269164,
  "valor_total": 143.22762954419193
}
```