<?php
require "conexao.php";

$id = $_POST['id_acomodacao'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$valor = $_POST['valor_total'];

$sql = "INSERT INTO reservas (id_acomodacao, nome_cliente, email_cliente, telefone_cliente, data_inicio, data_fim, valor_total)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("isssssd", $id, $nome, $email, $telefone, $data_inicio, $data_fim, $valor);

if ($stmt->execute()) {
    echo "<script>alert('Reserva concluída com sucesso!'); window.location.href='index.html';</script>";
} else {
    echo "Erro ao reservar: " . $con->error;
}
?>
