  <?php
  include_once('vistas/header.php');
  ?>

  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-12">
        <div class="cardj rounded-3 text-white">
          <div class="row g-0">
            
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                 
                  <h4 class="mt-1 mb-5 pb-1">Clientes</h4>
                </div>
                
                <table class="table table-transparent">
  <thead>
    <tr>
      <th scope="col">RIF</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">CORREO</th>
      <th scope="col">TELEFONO</th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <tr class="" href="#">
      <th scope="row">1</th>
      <td>Mark</td>
      <td>@mdo</td>
      <td>0424</td>
      <td><a href="index.php?action=clientes_info" class ="tbc">Info</a></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>@fat</td>
      <td>0412</td>
      <td><a href="index.php?action=clientes_info" class ="tbc">Info</a></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>@twitter</td>
      <td>0424</td>
      <td><a href="index.php?action=clientes_info" class ="tbc">Info</a></td>
    </tr>
  </tbody>
</table>

              </div>
            </div>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

   <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-5">
         <a href="<?php echo $URL; ?>/index.php?action=registrar_cliente" style="text-decoration: none; color: inherit;">
        <div class="cardj step-card text-white noselec">
          <div class="row g-0">
            
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                 
                  <h4 class="mt-1 mb-10 pb-1">Registrar Clientes</h4>
                </div>

                </div>
            </div>
          </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
