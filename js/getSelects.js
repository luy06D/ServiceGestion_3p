document.addEventListener("DOMContentLoaded", () => {

  const lsCliente = document.querySelector("#idcliente");


  function getClientes(){
    const parameters = new URLSearchParams();
    parameters.append("op", "getCliente");

    fetch("../controllers/contratos.controller.php", {
      method: 'POST',
      body: parameters
    })
    .then(response => response.json())
    .then(data => {
      lsCliente.innerHTML = "<option value=''>Seleccione</option>";
      data.forEach(element => {
        const optionTag = document.createElement("option");
        optionTag.value = element.idcliente
        optionTag.text = element.clientes;
        lsCliente.appendChild(optionTag);
        
      });
    });
  }

  getClientes();

})