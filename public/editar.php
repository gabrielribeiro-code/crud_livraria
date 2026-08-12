<?php

include "../infra/conexao.php";

$id = $_GET["id"];

$stmt = mysqli_prepare(
    $conexao,

"SELECT * FROM livros WHERE id = ? "
);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$livro =mysqli_fetch_assoc($resultado);

//Aqui então nos preparamos o codigo, executamos ele e depois jogamos o resultado a linha da variavel $resultado
// serve explicitamente para isso, para pegar o resultado da consulta que acabou de ser executada e guarda na variavel resultado. O resto 
// do code é igual o que já vinhamos fazer nas outras páginas.

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Livraria</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>CRUD - Livraria</h1>
    </header>
    <main>
        <h2>Editando o livro <?php echo $livro["titulo"]?>!</h2>
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $livro["id"]?>">

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?php echo $livro["titulo"]?>">
            <br>
            <label for="autor">Autor:</label>
            <input type="text" name="autor" value="<?php echo $livro["autor"]?>">
            <br>
            <label for="ano">Ano de Publicação:</label>
            <input type="number" name="ano" value="<?php echo $livro["ano"]?>">
            <br>
            <button type="submit">Atualizar</button>
        </form>

    </main>
    <footer>

    </footer>


</body>

</html>