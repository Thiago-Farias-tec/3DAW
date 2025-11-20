document.addEventListener("DOMContentLoaded", () => {

    const selectAula = document.getElementById("aula");
    const quantidadeEl = document.getElementById("quantidade");
    const totalEl = document.getElementById("total");
    const form = document.getElementById("formAula");

    // PAGAMENTO
    const metodoEl = document.getElementById("metodo_pagamento");
    const areaPix = document.getElementById("area_pix");
    const areaCartao = document.getElementById("area_cartao");
    const parcelasEl = document.getElementById("parcelas");
    const valorParcelaEl = document.getElementById("valor_parcela");

    function atualizarTotal() {
        const preco = parseFloat(selectAula.selectedOptions[0]?.getAttribute("data-preco")) || 0;
        const qtd = parseInt(quantidadeEl.value) || 0;

        if (preco > 0 && qtd > 0) {
            const total = preco * qtd;
            totalEl.value = total.toFixed(2);
            atualizarParcelas();
        } else {
            totalEl.value = "0.00";
        }
    }

    function atualizarParcelas() {
        const total = parseFloat(totalEl.value);

        if (isNaN(total) || total <= 0) {
            valorParcelaEl.value = "0.00";
            return;
        }

        const parcelas = parseInt(parcelasEl.value) || 1;
        valorParcelaEl.value = (total / parcelas).toFixed(2);
    }

    // MOSTRAR / ESCONDER CAMPOS DE PAGAMENTO
    metodoEl.addEventListener("change", () => {
        areaPix.classList.add("d-none");
        areaCartao.classList.add("d-none");

        if (metodoEl.value === "pix") {
            areaPix.classList.remove("d-none");
        }

        if (metodoEl.value === "cartao") {
            areaCartao.classList.remove("d-none");
            atualizarParcelas();
        }
    });

    parcelasEl.addEventListener("change", atualizarParcelas);
    selectAula.addEventListener("change", atualizarTotal);
    quantidadeEl.addEventListener("input", atualizarTotal);

    atualizarTotal();

    // ENVIAR FORMULÁRIO
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        if (!confirm("Confirmar reserva?")) return;

        const formData = new FormData(form);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/registrar_aula.php", true);

        xhr.onload = () => {
            if (xhr.responseText.includes("OK")) {
                alert("Reserva realizada com sucesso!");
                window.location.href = "index.html";
            } else {
                alert("Erro: " + xhr.responseText);
            }
        };

        xhr.send(formData);
    });
});
