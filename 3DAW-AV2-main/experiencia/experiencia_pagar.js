document.addEventListener("DOMContentLoaded", function () {

  const experienciaSelect = document.getElementById("experiencia");
  const qtdPessoas = document.getElementById("pessoas");
  const totalInput = document.getElementById("total");
  const form = document.getElementById("formReserva");

  function getPrecoSelecionado() {
    const opcao = experienciaSelect.selectedOptions[0];
    const preco = opcao ? parseFloat(opcao.getAttribute("data-preco")) : 0;
    return isNaN(preco) ? 0 : preco;
  }

  function atualizarTotal() {
    const preco = getPrecoSelecionado();
    const pessoas = parseInt(qtdPessoas.value, 10);

    if (!preco || isNaN(pessoas) || pessoas < 1) {
      totalInput.value = "";
      return;
    }

    totalInput.value = (preco * pessoas).toFixed(2);
  }

  experienciaSelect.addEventListener("change", atualizarTotal);
  qtdPessoas.addEventListener("input", atualizarTotal);

  atualizarTotal();

 
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
    xhr.open("POST", "registrar_experiencia.php", true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        const resp = xhr.responseText.trim();

        if (resp === "OK" || resp.toUpperCase().includes("OK")) {
          alert("Reserva realizada com sucesso!");

          
          window.location.href = "index.html"; 

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

});
