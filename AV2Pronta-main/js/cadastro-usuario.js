document.getElementById("formCadastro").addEventListener("submit", function(e) {
    e.preventDefault();

    const dados = new FormData(this);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "../php/cadastro-usuario.php", true);

    xhr.onload = function () {
        const div = document.getElementById("resultado");

        if (xhr.status === 200) {
            const resposta = xhr.responseText;

            if (resposta === "OK") {
                div.innerHTML = "<span class='text-success'>Cadastro realizado! Redirecionando...</span>";
                setTimeout(() => window.location.href = "login.html", 2000);
            } else {
                div.innerHTML = "<span class='text-danger'>" + resposta + "</span>";
            }
        } else {
            div.innerHTML = "<span class='text-danger'>Erro ao enviar dados.</span>";
        }
    };

    xhr.send(dados);
});
