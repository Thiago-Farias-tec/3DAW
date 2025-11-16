<?php
include __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $sql = "INSERT INTO clientes (nome, data, hora) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $data, $hora);

    if ($stmt->execute()) {
        echo "Cliente adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar cliente: " . $conn->error;
    }
}
?>
