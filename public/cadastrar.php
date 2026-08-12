<?php

include "../infra/conexao.php";

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$ano = $_POST["ano"];


$stmt = mysqli_prepare(
    $conexao,

"INSERT INTO livros (titulo,autor,ano) VALUES ('?','?','?')";
);

mysqli_stmt_bind_param($stmt, "ssii", $titulo, $autor,$ano, $id);

mysqli_stmt_execute($stmt);


header("Location: ../index.php");
?>