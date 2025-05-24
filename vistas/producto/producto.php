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
                 
                  <h4 class="mt-1 mb-5 pb-1">Productos</h4>
                </div>
                
                <table class="table table-transparent">
  <thead>
    <tr>
      
      <th scope="col">NOMBRE</th>
      <th scope="col">materia prima</th>
      <th scope="col">P/U</th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <tr class="" href="#">
      <td>desinfectante</td>
      <td>Alcohol, etanol, cloro</td>
      <td>5000</td>
      
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
        
        <div class="col-xl-5 mb-3"> 
            <a href="<?php echo $URL; ?>/index.php?action=producto_registro" style="text-decoration: none; color: inherit;">
                <div class="cardj step-card text-white noselec">
                    <div class="row g-0">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h4 class="mt-1 mb-10 pb-1">Registrar producto</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        
        <div class="col-xl-5 mb-3"> 
            <a href="<?php echo $URL; ?>/index.php?action=provedores" style="text-decoration: none; color: inherit;">
                <div class="cardj step-card text-white noselec">
                    <div class="row g-0">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h4 class="mt-1 mb-10 pb-1">provedores</h4> 
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
         <div class="col-xl-5 mb-3"> 
            <a href="<?php echo $URL; ?>/index.php?action=materia" style="text-decoration: none; color: inherit;">
                <div class="cardj step-card text-white noselec">
                    <div class="row g-0">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h4 class="mt-1 mb-10 pb-1">materia prima</h4> 
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
  