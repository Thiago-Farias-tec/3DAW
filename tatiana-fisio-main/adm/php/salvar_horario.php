<?php
include __DIR__ . '/conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $dias = [
    'segunda' => 'Segunda',
    'terca'   => 'Terça',
    'quarta'  => 'Quarta',
    'quinta'  => 'Quinta',
    'sexta'   => 'Sexta'
  ];

  foreach ($dias as $chave => $nome_dia) {
    $inicio = $_POST['inicio_' . $chave] ?? null;
    $fim = $_POST['fim_' . $chave] ?? null;

    if ($inicio && $fim) {
      $sql = "UPDATE horario_funcionamento 
              SET hora_inicio = ?, hora_fim = ?
              WHERE dia_semana = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $inicio, $fim, $nome_dia);
      $stmt->execute();
    }
  }

  echo "Horários atualizados com sucesso!";
}


?>
