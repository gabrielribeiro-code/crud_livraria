<?php

include "../infra/conexao.php";

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$ano = $_POST["ano"];

$stmt = mysqli_prepare(
    $conexao,
    "UPDATE livros SET titulo = ?, autor = ?, ano = ? WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "ssii", $titulo, $autor,$ano, $id);

mysqli_stmt_execute($stmt);


//Aqui nos aplicamos a logica de preparar, executar e pegar o resultado alterando a forma como estava
// antes para nãa dar erro no envio do POST.
// O "ssii" no código significa string, string, inteiro e inteiro e a parte inteira dele serve para dizer quais valores vão ocupar os ?.

header("Location: ../index.php");

?>