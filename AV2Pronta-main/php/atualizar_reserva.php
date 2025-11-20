<?php
require "conexao.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Requisição inválida.";
    exit;
}

$id = intval($_POST['id']);
$nome = $_POST['nome_cliente'];
$email = $_POST['email_cliente'];
$telefone = $_POST['telefone_cliente'];
$id_acomodacao = intval($_POST['id_acomodacao']);
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];

$metodo_pagamento = $_POST['metodo_pagamento'];
$parcelas = $_POST['parcelas'] ?: null;
$valor_parcela = $_POST['valor_parcela'] ?: null;

// Recalcular valor total
$stmt = $con->prepare("SELECT preco FROM acomodacoes WHERE id = ?");
$stmt->bind_param("i", $id_acomodacao);
$stmt->execute();
$preco = $stmt->get_result()->fetch_assoc()['preco'];
$stmt->close();

$days = (strtotime($data_fim) - strtotime($data_inicio)) / (60*60*24);
$valor_total = $days * $preco;

$stmt = $con->prepare("
UPDATE reservas SET 
id_acomodacao=?, nome_cliente=?, email_cliente=?, telefone_cliente=?,
data_inicio=?, data_fim=?, valor_total=?,
metodo_pagamento=?, parcelas=?, valor_parcela=?
WHERE id=?
");

$stmt->bind_param(
    "isssssdssis",
    $id_acomodacao, $nome, $email, $telefone,
    $data_inicio, $data_fim, $valor_total,
    $metodo_pagamento, $parcelas, $valor_parcela,
    $id
);

if ($stmt->execute()) {
    header("Location: ../html/admin_reservas.html");
    exit;
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}
