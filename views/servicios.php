<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <main class="opacity-85 mb-5">
        <div class="container mt-5 col-12">
            <div class="card">
                <div class="card-header text-white" style="background-color: #9ACD32;" >
                    <h4 class="text-center">REGISTRO DE SERVICIOS</h4>
                </div>
                <button type="button" class=" d-grid btn btn-primary btn-lg col-12" data-bs-toggle="modal" data-bs-target="#modalId">
                  Registrar
                </button>

           </div>

           <div class="row">
            <div class="col-lg-12 mt-5">
                <table id="tabla-servicio" class="table table-sm table-striped" >
                                
                    <thead class="table-secondary">
                        <tr>
                        <th>Codigo</th>
                        <th>Tipo de servicio</th>
                            <th>Duracion estimada</th>
                            <th>Garantia</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div> 
        
    
  




                  <!-- Modal trigger button -->
                  
                  <!-- Modal Body -->
                  <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                  <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">Registro de servicio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    <div class=" input-group mt-4">   
                                      <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add' ></i></label>
                                        <input type="text" placeholder="Tipo de Servicio" class="form-control" id="tipos" >         
                                    </div>
                                  </div>
                  
                                <div class="col-lg-12">
                                <div class="input-group mt-4">
                             
                                  <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add' ></i></label>
                                  <input type="text" placeholder="Duracion Estimada" class="form-control" id="duracion" >
                                </div>  
                                </div>
              
                  
                                  <div class="col-lg-12 d-grid ">
                                      <div class="input-group mt-4">
                                          <label class="input-group-text" for="inputGroupSelect02"><i class='bx bx-cart-add' ></i></label>
                                        <input type="text" placeholder="Garantia" class="form-control" id="garantia">
                                      </div>
                                      
                                  </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <button  type="button" class="btn btn text-white  " style="background-color:#9ACD32;" id="Registrar">Registrar</button>

                            </div>
                        </div>
                    </div>
                  </div>

                  
                  
                  
                  <!-- Optional: Place to the bottom of scripts -->
                  <script>
                    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                  
                  </script>

                  <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- opcional-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- <script src="../js/addstock.js"></script> -->

    <script>
        $(document).ready(function(){

            const btnAgregar = document.querySelector('#Registrar');           

            function ListarServicio(){
                $.ajax({
                    url: '../controllers/servicios.controller.php',
                    type: 'GET',
                    data:{'operacion' : 'ListarServicios'},
                    success: function(result){
                        var table = $("#tabla-servicio").DataTable();
                        table.destroy();
                        $("#tabla-servicio tbody").html(result);
                        $("#tabla-servicio").DataTable({
                            responsive: true,
                            lengthMenu: [10, 5],
                            language:{
                                url: '../js/Spanish.json'
                            }
                        });
                    }
                })
            }

            function servicioRegister(){
        const Servicio = document.querySelector("#tipos").value.trim();
        const Duracion = document.querySelector("#duracion").value.trim();
        const Garantia = document.querySelector("#garantia").value.trim();

        Swal.fire({
            title: "¿Desea registrar una nueva formula?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "Cancelar",
            cancelButtonColor: '#3085d6',
            confirmButtonColor: '#368E5B',

        }).then((result)=>{
            if(result.isConfirmed){
                if(Servicio === '' || Duracion === '' || Garantia === '' ){
                    Swal.fire({
                          title: "Por favor, complete el campo formula",
                          icon: "warning",
                          confirmButtonColor: "#E43D2C",
                      });

                }else{
                    const parameter = new URLSearchParams();
                    parameter.append("operacion", "RegistrarServicio");
                    parameter.append("tiposervicio", document.querySelector("#tipos").value);
                    parameter.append("duracionE", document.querySelector("#duracion").value);
                    parameter.append("garantia", document.querySelector("#garantia").value);


                    fetch("../controllers/servicios.controller.php",{
                        method: 'POST',
                        body: parameter
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.status){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'La formula se registro correctamente',
                                showConfirmButton: false,
                                timer: 1500
                                })

                                ListarServicio();
                        }else{
                            Swal.fire({
                          title: "La formula ya fue registrada",
                          icon: "warning",
                          confirmButtonColor: "#E43D2C",
                      });
                            
                        }
                    });

                }

            }
        });

      }
      ListarServicio();
            
      btnAgregar.addEventListener("click", servicioRegister);
        });
    </script>                  
</body>
</html>