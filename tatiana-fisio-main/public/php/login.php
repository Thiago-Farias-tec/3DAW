<?php

include __DIR__ . '/../../adm/php/conexao.php';

header('Content-Type: application/json; charset=utf-8');

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$email || !$senha) {
    echo json_encode([
        "success" => false,
        "message" => "Preencha todos os campos."
    ]);
    exit;
}

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "success" => false,
        "message" => "Email não encontrado."
    ]);
    exit;
}

$usuario = $result->fetch_assoc();


if ($usuario['senha'] !== $senha) {
    echo json_encode([
        "success" => false,
        "message" => "Senha incorreta."
    ]);
    exit;
}

echo json_encode([
    "success" => true
]);
exit;
?>
