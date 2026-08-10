<?php
include "../infra/conexao.php";
$id = $_GET["id"];
$sql = "DELETE FROM livros WHERE id=$id";
mysqli_query($conexao,$sql);
header("Location: ../index.php");
?>