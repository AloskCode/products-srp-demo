<?php
// simples formulário HTML
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Produto</h1>
    <form method="post" action="create.php">
        <label>
            Nome:<br/>
            <input type="text" name="name" maxlength="100"/>
        </label>
        <br/><br/>
        <label>
            Preço:<br/>
            <input type="number" name="price" step="0.01" min="0"/>
        </label>
        <br/><br/>
        <button type="submit">Salvar</button>
    </form>
    <hr/>
    <a href="products.php">Ver produtos</a>
</body>
</html>
