<p align="center"><a href="https://www.dbseller.com.br/" target="_blank"><img src="https://www.dbseller.com.br/assets/img/LogoDBseller1.png" width="200" alt="DBSeller logo"></a></p>

# Correção Issues Segunda Etapa Processo Seletivo Desenvolvedor Júnior

> <b>Desenvolvedor:</b> Caio Albuquerque

> <b>Data Entrega:</b>

- [Issue 1 - Página em Branco](#1---página-em-branco)
- [Issue 2 - Fatal error](#2---fatal-error)
- [Issue 3 - Validaçao de período](#3---validaçao-de-período)
- [Issue 4 - Implementar o Cadastro de Áreas](#4---implementar-o-cadastro-de-áreas)
- [Issue 5 - Implementar o Cadastro de Tarefas](#5---implementar-o-cadastro-de-tarefas)

> Observações Iniciais: Como o teste descreve explicitamente para fixar os bugs, me levou a entender que eu não deveria 
> tentar recriar o projeto e sim apenas realizar as alterações.

## 1 - Página em Branco

Utilizei duas condições:

- `1°)` Caso o parâmetro não tenho sido passado na query oufor "empty" eu direciono pra view `inicio`;
- `2°)` Se o path não for relativo a uma view eu retorno a págian de erro com o código `404`;
- `3°)` E por default eu retorno a view relativa ao path;

## 2 - Fatal error

A solução da issue 1 ([Página em Branco](#1---página-em-branco)) já resolve este problema.

## 3 - Validaçao de período

Fiz a validação diretamente no Javascript. Quando ocorrer a entrada de um período inválido será mostrado o erro no canto
superior da tela. Porém também estou verificando na view da agenda e retornando pra página inicial quando os meses forem
inválidos.

## 4 - Implementar o Cadastro de Áreas

Foi realizado o CRUD para áreas, optei por deixar o botão de delete e de editar diretamente na tabela a esquerda, na 
coluna "actions". Realizei todas as operações com JS utilizando o backend como Api. 

## 5 - Implementar o Cadastro de Tarefas

