let myForm = document.querySelector("#myForm");

myForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const guardarDatos = Object.fromEntries(new FormData(e.target));

    if(guardarDatos.numero == ""){
        alert("Por favor llenar los campos");
    } else {
        let config = {
            method: "POST",
            header: {"Content-Type":"application/json"},
            body: JSON.stringify(guardarDatos)
        }
        let res = await( await fetch("api.php", config)).text();
        document.querySelector("pre").innerHTML = res;   
    }
})

// Dado un número indicar si es par o impar y si es mayor de 10