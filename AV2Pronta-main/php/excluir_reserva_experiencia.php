<?php
require "conexao.php";

if (!isset($_GET['id'])) {
    echo "ID inválido";
    exit;
}

$id = intval($_GET['id']);

$sql = "DELETE FROM reservas_experiencias WHERE id = $id";

if ($con->query($sql)) {
    echo "Reserva excluída!";
} else {
    echo "Erro: " . $con->error;
}
