<?php
include __DIR__ . '/conexao.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM horario_funcionamento WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    echo "✅ Horário excluído com sucesso!";
  } else {
    echo "❌ Erro ao excluir horário: " . $conn->error;
  }
} else {
  echo "ID inválido!";
}
?>
