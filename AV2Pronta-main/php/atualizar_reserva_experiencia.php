<?php
require "conexao.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

$id = intval($_POST['id']);
$nome = $_POST['nome_cliente'];
$email = $_POST['email_cliente'];
$telefone = $_POST['telefone_cliente'];
$id_exp = intval($_POST['id_experiencia']);
$quantidade = intval($_POST['quantidade']);

$stmt = $con->prepare("SELECT preco FROM experiencias WHERE id=?");
$stmt->bind_param("i", $id_exp);
$stmt->execute();
$preco = $stmt->get_result()->fetch_assoc()['preco'];
$stmt->close();

$valor_total = $preco * $quantidade;

$stmt = $con->prepare("UPDATE reservas_experiencias SET id_experiencia=?, nome_cliente=?, email_cliente=?, telefone_cliente=?, quantidade=?, valor_total=? WHERE id=?");
$stmt->bind_param("isssidi", $id_exp, $nome, $email, $telefone, $quantidade, $valor_total, $id);
$stmt->execute();

header("Location: ../html/admin_reservas_experiencias.html");
exit;
