<?php
require "conexao.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {

    $usuario = $result->fetch_assoc();
    $identificador = $usuario['identificador'];

    if ($identificador === "A") {
        header("Location: ../html/admin_index.html");
        exit;
    }

    // LOGIN DE USUÁRIO NORMAL
    header("Location: ../html/index2.html");
    exit;

} else {
    echo "<script>
            alert('Login inválido!');
            window.location='../html/login.html';
          </script>";
    exit;
}
?>
