<?php
require "conexao.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST['senha'];
$data_nasc = $_POST["data_nascimento"];
$identificador = "U"; // Usuário comum

// Verifica se já existe
$sql = $con->prepare("SELECT email FROM usuarios WHERE email = ?");
$sql->bind_param("s", $email);
$sql->execute();
$sql->store_result();

if ($sql->num_rows > 0) {
    echo "E-mail já cadastrado!";
    exit;
}

$sql = $con->prepare("INSERT INTO usuarios (nome, email, senha, data_nascimento, identificador)
                      VALUES (?, ?, ?, ?, ?)");
$sql->bind_param("sssss", $nome, $email, $senha, $data_nasc, $identificador);

if ($sql->execute()) {
    echo "OK";
} else {
    echo "Erro ao cadastrar usuário.";
}
