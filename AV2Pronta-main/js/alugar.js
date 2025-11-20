document.addEventListener("DOMContentLoaded", function () {

    const selectAcomodacao = document.getElementById("select_acomodacao");
    const idField = document.getElementById("id_acomodacao");
    const precoField = document.getElementById("preco");
    const titulo = document.getElementById("titulo");

    const inicioEl = document.getElementById("inicio");
    const fimEl = document.getElementById("fim");
    const valorEl = document.getElementById("valor");

    const metodoEl = document.getElementById("metodo_pagamento");
    const areaPix = document.getElementById("area_pix");
    const areaCartao = document.getElementById("area_cartao");
    const parcelasEl = document.getElementById("parcelas");
    const valorParcelaEl = document.getElementById("valor_parcela");

    // -----------------------------------------
    // 1) Carregar todas as acomodações
    // -----------------------------------------
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/listar_acomodacoes.php", true);

    xhr.onload = function () {
        const lista = JSON.parse(this.responseText);
        let html = `<option value="">Selecione...</option>`;

        lista.forEach(a => {
            html += `<option value="${a.id}" data-preco="${a.preco}" data-nome="${a.nome}">
                        ${a.nome} — R$ ${a.preco}
                     </option>`;
        });

        selectAcomodacao.innerHTML = html;
    };

    xhr.send();

    // -----------------------------------------
    // 2) Quando escolher acomodação
    // -----------------------------------------
    selectAcomodacao.addEventListener("change", function () {
        const op = this.selectedOptions[0];

        if (!op.value) {
            idField.value = "";
            precoField.value = "";
            titulo.textContent = "Finalizar Aluguel";
            return;
        }

        idField.value = op.value;
        precoField.value = op.getAttribute("data-preco");

        titulo.textContent = "Alugar: " + op.getAttribute("data-nome");

        calcular();
    });

    // -----------------------------------------
    // 3) Cálculo do valor total
    // -----------------------------------------
    function calcular() {
        const preco = parseFloat(precoField.value);
        const inicio = new Date(inicioEl.value);
        const fim = new Date(fimEl.value);

        if (isNaN(preco) || !inicioEl.value || !fimEl.value) {
            valorEl.value = "0.00";
            return;
        }

        const diff = (fim - inicio) / (1000 * 60 * 60 * 24);

        const total = diff > 0 ? (diff * preco) : 0;

        valorEl.value = total.toFixed(2);

        atualizarParcelas();
    }

    inicioEl.addEventListener("change", calcular);
    fimEl.addEventListener("change", calcular);

    // -----------------------------------------
    // 4) Parcelas
    // -----------------------------------------
    function atualizarParcelas() {
        const total = parseFloat(valorEl.value);

        if (isNaN(total) || total <= 0) {
            valorParcelaEl.value = "0.00";
            return;
        }

        const parcelas = parseInt(parcelasEl.value);
        valorParcelaEl.value = (total / parcelas).toFixed(2);
    }

    parcelasEl.addEventListener("change", atualizarParcelas);

    // -----------------------------------------
    // 5) Mostrar PIX / Cartão
    // -----------------------------------------
    metodoEl.addEventListener("change", function () {
        areaPix.classList.add("d-none");
        areaCartao.classList.add("d-none");

        if (this.value === "pix") {
            areaPix.classList.remove("d-none");
        } else if (this.value === "cartao") {
            areaCartao.classList.remove("d-none");
            atualizarParcelas();
        }
    });

});
