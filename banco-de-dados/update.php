<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Aluno</title>
</head>
<body>

<h2>Editar Aluno</h2>

<?php
// Se veio ID pela URL, buscar o aluno
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM aluno WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $dados = $stmt->get_result()->fetch_assoc();
}
?>

<form method="POST">
    <input type="hidden" name="id" value="<?= $dados['id'] ?>">

    Nome: <input type="text" name="nome" value="<?= $dados['nome'] ?>" required><br><br>
    Matrícula: <input type="text" name="matricula" value="<?= $dados['matricula'] ?>" required><br><br>
    CPF: <input type="text" name="cpf" value="<?= $dados['cpf'] ?>" required><br><br>

    <button type="submit" name="acao" value="atualizar">Salvar Alterações</button>
</form>

<?php
if (isset($_POST['acao'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $cpf = $_POST['cpf'];

    $stmt = $conn->prepare("UPDATE aluno SET nome=?, matricula=?, cpf=? WHERE id=?");
    $stmt->bind_param("sssi", $nome, $matricula, $cpf, $id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Registro atualizado!</p>";
        echo "<a href='read.php'>Voltar à lista</a>";
    } else {
        echo "<p style='color:red;'>❌ Erro: {$stmt->error}</p>";
    }
}
?>

<br><br>
<a href="read.php">← Voltar</a>

</body>
</html>
