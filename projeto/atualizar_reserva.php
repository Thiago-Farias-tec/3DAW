<?php
require "conexao.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Requisição inválida.";
    exit;
}

$id = intval($_POST['id'] ?? 0);
$nome = trim($_POST['nome_cliente'] ?? '');
$email = trim($_POST['email_cliente'] ?? '');
$telefone = trim($_POST['telefone_cliente'] ?? '');
$id_acomodacao = intval($_POST['id_acomodacao'] ?? 0);
$data_inicio = $_POST['data_inicio'] ?? '';
$data_fim = $_POST['data_fim'] ?? '';

// validações básicas
if ($id <= 0 || $nome === '' || $email === '' || $id_acomodacao <= 0 || $data_inicio === '' || $data_fim === '') {
    echo "Dados incompletos.";
    exit;
}

// busca preço da acomodação
$stmt = $con->prepare("SELECT preco FROM acomodacoes WHERE id = ?");
$stmt->bind_param("i", $id_acomodacao);
$stmt->execute();
$res = $stmt->get_result();
$acom = $res->fetch_assoc();
$stmt->close();

if (!$acom) {
    echo "Acomodação inválida.";
    exit;
}

$preco = floatval($acom['preco']);

// calcula dias
$d1 = strtotime($data_inicio);
$d2 = strtotime($data_fim);
$days = ($d2 - $d1) / (60*60*24);

if ($days <= 0) {
    echo "Datas inválidas.";
    exit;
}

$valor_total = $days * $preco;

// atualiza
$stmt = $con->prepare("UPDATE reservas 
    SET id_acomodacao = ?, nome_cliente = ?, email_cliente = ?, telefone_cliente = ?, 
        data_inicio = ?, data_fim = ?, valor_total = ?
    WHERE id = ?");

$stmt->bind_param("isssssdi",
    $id_acomodacao,
    $nome,
    $email,
    $telefone,
    $data_inicio,
    $data_fim,
    $valor_total,
    $id
);

if ($stmt->execute()) {
    $stmt->close();
    header("Location: admin_reservas.html");
    exit;
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}
