<?php

$host = "localhost";
$user = "root";      
$pass = "";           
$db   = "alunos";     


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if (isset($_POST['acao']) && $_POST['acao'] == "salvar") {

    $nome = $_POST['nome'] ?? '';
    $matricula = $_POST['matricula'] ?? '';
    $cpf = $_POST['cpf'] ?? '';


    if (!empty($nome) && !empty($matricula) && !empty($cpf)) {

        $stmt = $conn->prepare("INSERT INTO aluno (nome, matricula, cpf) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $matricula, $cpf);

        if ($stmt->execute()) {
            echo "Registro inserido com sucesso!";
        } else {
            echo "Erro ao inserir: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Preencha todos os campos.";
    }

    exit;
}

$conn->close();
?>
