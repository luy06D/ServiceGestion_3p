
  
  <?php include '../principal/cabezera.php' ?>


    <!-- DataTable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
<main id="main" class="main">

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <h4 class="text-center">CLIENTES</h4>
            <hr>
             
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Age</th>
                    <th scope="col">Start Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>


 <!-- Tabla-Clientes -->
 <div class="container-lg table-responsive ">
        <h4 class="text-center">CLIENTES</h4>
        <hr>
        <button type="button" id="abrir-modal-registro" class="btn btn-primary btn-md mb-3" data-bs-toggle="modal" data-bs-target="#modal-registrar">
        <i class="bi bi-plus-circle"></i>  Nuevo
        </button>
        <div class="row">
            <div class="col-lg-12">
                <table id="tabla-cliente" class="table table-sm table-striped" >
                                
                    <thead class="table-secondary">
                        <tr>
                        <th>Código</th>
                        <th>Persona/Empresa</th>
                        <th>DNI/RUC</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Operación</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</main>


    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AJAX = JavaScript asincrónico-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- datatable-->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- opcional-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>

  $(document).ready(function (){

    function mostrarClientes(){
      $.ajax({
        url: '../controllers/clientes.php',
        type: 'GET',
        data: {'op' : 'listar_clientes'},
        success: function (result){

          var table = $("#tabla-cliente").DataTable();
          table.destroy();
          $("#tabla-cliente tbody").html(result);
          $("#tabla-cliente").DataTable({
            responsive: true,
            lengthMenu:[15,10,5],
            language: {
            url: '../js/Spanish.json'
            }
          })
        }
      })
    }


    mostrarClientes();


  })




</script>


<?php include '../principal/footer.php' ?>

