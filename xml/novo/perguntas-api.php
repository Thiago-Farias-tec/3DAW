<?php
$arquivo = "perguntas.txt";

function criarArquivo($arquivo) {
  if (!file_exists($arquivo)) {
    file_put_contents($arquivo, "pergunta1;pergunta2;pergunta3;pergunta4;pergunta5;\n");
  }
}

criarArquivo($arquivo);

if (isset($_POST['acao'])) {
  $p = [];
  for ($i = 1; $i <= 5; $i++) {
    $p[$i] = $_POST["pergunta$i"] ?? '';
  }

  $linhas = file($arquivo);

  if ($_POST['acao'] == "salvar") {
   
    file_put_contents($arquivo, implode(";", $p) . ";\n", FILE_APPEND);
  }

  if ($_POST['acao'] == "atualizar" && isset($_POST['linha'])) {
    $index = (int) $_POST['linha'];
    if (isset($linhas[$index])) {
      $linhas[$index] = implode(";", $p) . ";\n";
      file_put_contents($arquivo, implode("", $linhas));
    }
  }
  exit;
}





if (isset($_GET['edit'])) {
  $linhas = file($arquivo);
  $edit = (int) $_GET['edit'];
  if (isset($linhas[$edit])) {
    $linha = $linhas[$edit];
    $dados = explode(";", trim($linha));
    echo json_encode($dados);
  } else {
    echo json_encode([]);
  }
  exit;
}


if (file_exists($arquivo)) {
  $linhas = file($arquivo);
  foreach ($linhas as $i => $linha) {
    if ($i == 0) continue; 
    $d = explode(";", trim($linha));
    if (count($d) < 5) continue;
    echo htmlspecialchars($d[0]) . " | " . htmlspecialchars($d[1]) . " | " .
         htmlspecialchars($d[2]) . " | " . htmlspecialchars($d[3]) . " | " .
         htmlspecialchars($d[4]);
    echo " <button onclick='editar($i)'>Editar</button>";

  }
}
?>
