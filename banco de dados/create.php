<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Aluno</title>
</head>
<body>

<h2>Cadastrar Aluno</h2>

<form method="POST">
    <input type="hidden" name="acao" value="salvar">

    Nome: <input type="text" name="nome" required><br><br>
    Matrícula: <input type="text" name="matricula" required><br><br>
    CPF: <input type="text" name="cpf" required><br><br>

    <button type="submit">Salvar</button>
</form>

<?php

if (isset($_POST['acao']) && $_POST['acao'] == "salvar") {
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $cpf = $_POST['cpf'];

    $stmt = $conn->prepare("INSERT INTO aluno (nome, matricula, cpf) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $matricula, $cpf);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Registro inserido com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>❌ Erro ao inserir: {$stmt->error}</p>";
    }
}
?>

<br>
<a href="index.html">← Voltar para Home</a>

</body>
</html>
