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
                 
                  <h4 class="mt-1 mb-5 pb-1">usuarios</h4>
                </div>
                
                <table class="table table-transparent">
  <thead>
    <tr>
      <th scope="col">CEDULA</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">CORREO</th>
      <th></th>

    </tr>
  </thead>
  <tbody>
 <?php foreach ($usuarios as $usuarios): ?>
            <tr>
                <td><?= $usuarios['id'] ?></td>
                <td><?= $usuarios['nombre'] ?></td>
                <td><?= $usuarios['email'] ?></td>

            </tr>
            <?php endforeach; ?>
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
                 
                  <h4 class="mt-1 mb-10 pb-1">Registrar usuario</h4>
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
