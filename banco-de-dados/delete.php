<?php include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM aluno WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: read.php");
exit;
