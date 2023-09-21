function cambioInput(){

  const rbPersona = document.querySelector("#rbPersona");
  const rbEmpresa = document.querySelector("#rbEmpresa");

  const nombres = document.querySelector("#nombres");
  const apellidos = document.querySelector("#apellidos");
  const rsocial = document.querySelector("#rsocial");
  const ruc = document.querySelector("#ruc");

  const dni = document.querySelector("#dni");
  const correo = document.querySelector("#correo");
  const direccion = document.querySelector("#direccion");
  const telefono = document.querySelector("#telefono");

  // Rereferencias span 
  const span_dni = document.querySelector("#span-dni");
  const span_correo = document.querySelector("#span-correo");
  const span_direccion = document.querySelector("#span-direccion");
  const span_telefono = document.querySelector("#span-telefono");

  //Referencia iconos 
  const iconEmp = document.querySelector("#icon-emp");
  const iconRuc = document.querySelector("#icon-ruc");



  if(rbPersona.checked){

    iconEmp.classList.add('bx-user'); 
    iconEmp.classList.remove('bi-buildings'); 

    iconRuc.classList.add('bx-user');
    iconRuc.classList.remove('bi-file-earmark');

    nombres.type = "text";
    apellidos.type = "text";
    nombres.type = "text";
    apellidos.type = "text";
    dni.type = "text";
    correo.type = "text"; 
    direccion.type = "text"; 
    telefono.type = "text"

    
    rsocial.type = "hidden";
    ruc.type = "hidden";

    //Aparecer span
    span_dni.style.display = "";
    span_correo.style.display = "";
    span_direccion.style.display = "";
    span_telefono.style.display = "";


  } else if (rbEmpresa.checked){

    
    
    rsocial.type = "text";
    ruc.type = "text";
    iconEmp.classList.remove('bx-user'); 
    iconEmp.classList.add('bi-buildings'); 

    iconRuc.classList.remove('bx-user');
    iconRuc.classList.add('bi-file-earmark');
      //Ocultar inputs
    nombres.type = "hidden";
    apellidos.type = "hidden";
    dni.type = "hidden";
    correo.type = "hidden"; 
    direccion.type = "hidden"; 
    telefono.type = "hidden"; 

    // Ocultar span 

    span_dni.style.display = "none";
    span_correo.style.display = "none";
    span_direccion.style.display = "none";
    span_telefono.style.display = "none";



  }



}