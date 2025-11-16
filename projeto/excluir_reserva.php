<?php
require "conexao.php";

if (!isset($_GET["id"])) {
    echo "ID inválido";
    exit;
}

$id = intval($_GET["id"]);

$sql = "DELETE FROM reservas WHERE id = $id";

if ($con->query($sql)) {
    echo "Reserva excluída com sucesso!";
} else {
    echo "Erro ao excluir: " . $con->error;
}
