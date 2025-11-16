<?php

$conn = new mysqli("localhost", "root", "", "aluguel");


if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}


$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$id_aula = $_POST['aula'];
$quantidade = $_POST['quantidade'];
$total = $_POST['total'];


$sql = "INSERT INTO reservas_aulas 
        (id_aula, nome_cliente, email_cliente, telefone_cliente, quantidade, valor_total)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssid", $id_aula, $nome, $email, $telefone, $quantidade, $total);


if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Erro ao registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>