document.addEventListener("DOMContentLoaded", function () {

    const experienciaSelect = document.getElementById("experiencia");
    const qtdPessoas = document.getElementById("pessoas");
    const totalInput = document.getElementById("total");
    const form = document.getElementById("formReserva");

    // PAGAMENTO
    const metodoEl = document.getElementById("metodo_pagamento");
    const areaPix = document.getElementById("area_pix");
    const areaCartao = document.getElementById("area_cartao");
    const parcelasEl = document.getElementById("parcelas");
    const valorParcelaEl = document.getElementById("valor_parcela");

    // CALCULAR TOTAL
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
            atualizarParcelas();
            return;
        }

        const total = preco * pessoas;
        totalInput.value = total.toFixed(2);

        atualizarParcelas();
    }

    // PARCELAS
    function atualizarParcelas() {
        const total = parseFloat(totalInput.value.replace(",", "."));
        if (isNaN(total) || total <= 0) {
            valorParcelaEl.value = "0.00";
            return;
        }

        const parcelas = parseInt(parcelasEl.value);
        valorParcelaEl.value = (total / parcelas).toFixed(2);
    }

    // MOSTRAR / ESCONDER ÁREAS DE PAGAMENTO
    metodoEl.addEventListener("change", function () {

        areaPix.classList.add("d-none");
        areaCartao.classList.add("d-none");

        if (this.value === "pix") {
            areaPix.classList.remove("d-none");
        }

        if (this.value === "cartao") {
            areaCartao.classList.remove("d-none");
            atualizarParcelas();
        }
    });

    parcelasEl.addEventListener("change", atualizarParcelas);

    experienciaSelect.addEventListener("change", atualizarTotal);
    qtdPessoas.addEventListener("input", atualizarTotal);

    atualizarTotal();

    // ENVIO DO FORMULÁRIO
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const preco = getPrecoSelecionado();
        const pessoasVal = parseInt(qtdPessoas.value, 10);

        if (!preco) {
            alert("Selecione uma experiência válida.");
            return;
        }

        if (isNaN(pessoasVal) || pessoasVal < 1) {
            alert("Quantidade mínima é 1 pessoa.");
            return;
        }

        if (!confirm("Confirmar reserva?")) return;

        atualizarTotal();

        // Enviar via AJAX
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/registrar_experiencia.php", true);

        xhr.onload = function () {
            const resp = xhr.responseText.trim();
            if (resp.includes("OK")) {
                alert("Reserva realizada com sucesso!");
                window.location.href = "index.html";
            } else {
                alert("Erro: " + resp);
            }
        };

        xhr.onerror = function () {
            alert("Erro ao conectar com o servidor.");
        };

        xhr.send(formData);
    });

});
