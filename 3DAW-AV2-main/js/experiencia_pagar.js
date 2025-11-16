
document.addEventListener("DOMContentLoaded", function () {
  const experienciaSelect = document.getElementById("experiencia");
  const qtdPessoas = document.getElementById("pessoas");
  const totalInput = document.getElementById("total");
  const form = document.getElementById("formReserva");

 
  function getPrecoSelecionado() {
    if (!experienciaSelect) return 0;
    const opcao = experienciaSelect.selectedOptions[0];
    if (!opcao) return 0;
    const precoAttr = opcao.getAttribute("data-preco");
    const preco = parseFloat(precoAttr);
    return isNaN(preco) ? 0 : preco;
  }
  
  function atualizarTotal() {
    const preco = getPrecoSelecionado();
    const pessoas = parseInt(qtdPessoas.value, 10);
    
    if (!preco || isNaN(pessoas) || pessoas < 1) {
      totalInput.value = "";
      return;
    }

    const total = preco * pessoas;
    totalInput.value = total.toFixed(2);
  }
  
  if (experienciaSelect) experienciaSelect.addEventListener("change", atualizarTotal);
  if (qtdPessoas) qtdPessoas.addEventListener("input", atualizarTotal);
  

  atualizarTotal();

  
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const preco = getPrecoSelecionado();
      const pessoasVal = parseInt(qtdPessoas.value, 10);
      
      if (!preco) {
        alert("Por favor, selecione uma experiência válida.");
        return;
      }
      
      if (isNaN(pessoasVal) || pessoasVal < 1) {
        alert("Informe uma quantidade válida de pessoas (mínimo 1).");
        return;
      }

      if (!confirm("Confirmar reserva?")) return;

      atualizarTotal();

      const formData = new FormData(form);

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "php/registrar_experiencia.php", true);

      xhr.onload = function () {
        if (xhr.status === 200) {
          const resp = xhr.responseText.trim();
          if (resp === "OK" || resp.toUpperCase().indexOf("OK") !== -1) {
            alert("Reserva realizada com sucesso!");
            form.reset();
            atualizarTotal();
          } else {
            alert("Resposta do servidor: " + resp);
          }
        } else {
          alert("Erro ao registrar reserva. Código: " + xhr.status);
        }
      };

      xhr.onerror = function () {
        alert("Erro de conexão ao enviar a reserva.");
      };

      xhr.send(formData);
    });
  }
  
});
