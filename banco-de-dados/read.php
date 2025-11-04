<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: auto; }
        th, td { padding: 10px; border: 1px solid #444; text-align: center; }
        a { padding: 6px 12px; border-radius: 4px; color: white; text-decoration: none; }
        .edit { background: #007bff; }
        .delete { background: #d11a2a; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Alunos Cadastrados</h2>

<?php
$sql = "SELECT * FROM aluno";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['matricula']}</td>
                <td>{$row['cpf']}</td>
                <td>
                    <a class='edit' href='update.php?id={$row['id']}'>Editar</a>
                    <a class='delete' href='delete.php?id={$row['id']}'
                       onclick='return confirm(\"Deseja realmente excluir?\")'>Excluir</a>
                </td>
              </tr>";
    }

    echo "</table>";

} else {
    echo "<p style='text-align:center;'>Nenhum aluno encontrado.</p>";
}
?>

<br>
<center><a href="index.html">← Voltar para Home</a></center>

</body>
</html>
