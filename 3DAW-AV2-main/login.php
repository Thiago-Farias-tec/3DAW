<?php
require "conexao.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    
    header("Location: admin_index.html");
    exit;
} else {
    echo "<script>alert('Login inválido!'); window.location='login.html';</script>";
    exit;
}
