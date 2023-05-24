let myForm = document.querySelector("#myForm");

myForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const guardarDatos = Object.fromEntries(new FormData(e.target));

    if(guardarDatos.resistencia == "" || guardarDatos.intensidad == ""){
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

// Construir el algoritmo para determinar el voltaje de un circuito a partir de la resistencia y la intensidad de corriente.