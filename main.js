let myForm = document.querySelector("#myForm");
let data = [];

myForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const guardarDatos = Object.fromEntries(new FormData(e.target));

    if(guardarDatos.nombre == "" || guardarDatos.edad == ""){
        alert("Por favor llenar los campos");
    } else {
        if(data.length <= 2){
            data.unshift(guardarDatos);
            alert(guardarDatos.nombre + " agregado con exito");
            document.querySelector("#btnContinuar").removeAttribute("disabled");
            myForm.reset();   
        }else{
            alert("Limite de registro alcanzado");
            document.querySelector("#btnRegistrar").setAttribute("disabled","");
            myForm.reset();
        } 
    }
})

document.querySelector("#btnContinuar").addEventListener("click", async(e) => {
    let config = {
        method: "POST",
        header: {"Content-Type":"application/json"},
        body: JSON.stringify(data)
    }
    let res = await( await fetch("api.php", config)).text();
    document.querySelector("pre").innerHTML = res;
})

// Construir el algoritmo que solicite el nombre y edad de 3 personas y determine el nombre de la persona con mayor edad.