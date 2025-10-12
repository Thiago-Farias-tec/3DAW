<?php
$arquivo = "perguntas.txt";

function criarArquivo($arquivo) {
  if (!file_exists($arquivo)) {
    file_put_contents($arquivo, "pergunta1;pergunta2;pergunta3;pergunta4;pergunta5;\n");
  }
}

if(isset($_POST['acao'])){
  $p = [];
  for($i=1;$i<=5;$i++) $p[$i] = $_POST["pergunta$i"] ?? '';
  criarArquivo($arquivo);
  if($_POST['acao']=="salvar"){
    file_put_contents($arquivo, implode(";", $p).";\n", FILE_APPEND);
  }
}

if(isset($_GET['del'])){
  $linhas = file($arquivo);
  unset($linhas[$_GET['del']]);
  file_put_contents($arquivo, implode("", $linhas));
}

if(file_exists($arquivo)){
  $linhas = file($arquivo);
  foreach($linhas as $i => $linha){
    if($i == 0) continue;
    $d = explode(";", trim($linha));
    if(count($d)<5) continue;
    echo "$d[0] | $d[1] | $d[2] | $d[3] | $d[4] ";
    echo "<button onclick='deletar($i)'>Excluir</button><br>";
  }
}
?>
