<?php
include __DIR__ . '/conexao.php';

$id   = $_POST['id'];
$nome = $_POST['nome'];
$data = $_POST['data'];
$hora = $_POST['hora'];

$sql = "UPDATE clientes SET nome=?, data=?, hora=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $nome, $data, $hora, $id);

if ($stmt->execute()) {
    echo "Cliente alterado com sucesso!";
} else {
    echo "Erro ao alterar cliente: " . $conn->error;
}
?>
