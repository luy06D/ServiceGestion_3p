document.addEventListener("DOMContentLoaded", () => {

  const lsCliente = document.querySelector("#cliente-ls");
  const lsTipoService = document.querySelector("#lsTipoService");
  const lsServicios = document.querySelector("#lsServicios");

  let idtiposervicio = 0;

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


  
  function getServicios(){
    console.log(idtiposervicio)
    const parameters = new URLSearchParams();
    parameters.append("op", "getServicios");
    parameters.append("idtiposervicio", idtiposervicio);

    fetch("../controllers/contratos.controller.php", {
      method: 'POST',
      body: parameters
    })
    .then(response => response.json())
    .then(data => {
      
      lsServicios.innerHTML = "<option value=''>Seleccione</option>";
      data.forEach(element => {
        const optionTag = document.createElement("option");
        optionTag.value = element.idservicio
        optionTag.text = element.nombreservicio;
        lsServicios.appendChild(optionTag);
        
        
      });
    });
  }

  function getTipoServicios(){
    const parameters = new URLSearchParams();
    parameters.append("op", "getTipoServicios");
    fetch("../controllers/contratos.controller.php", {
      method: 'POST',
      body: parameters
    })
    .then(response => response.json())
    .then(data => {      
      lsTipoService.innerHTML = "<option value=''>Seleccione</option>";
      data.forEach(element => {
        const optionTag = document.createElement("option");
        optionTag.value = element.idtiposervicio
        optionTag.text = element.tiposervicio;
        lsTipoService.appendChild(optionTag);
        

      });
    });
  }


  lsTipoService.addEventListener('change', function(){
    idtiposervicio = lsTipoService.value;
    getServicios(idtiposervicio)
  })




  getClientes();
  getServicios();
  getTipoServicios();

})