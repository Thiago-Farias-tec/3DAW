function login(event) {
    event.preventDefault(); 

    const form = document.getElementById("form-login");
    const dados = new FormData(form);

    fetch("../php/login.php", {
        method: "POST",
        body: dados
    })
    .then(res => res.json())
    .then(retorno => {
        if (retorno.success) {
            alert("Login realizado com sucesso!");
            window.location.href = "../../adm/html/dashboard.html"; 
        } else {
            alert(retorno.message);
        }
    })
    .catch(err => {
        alert("Erro ao fazer login: " + err);
    });
}
