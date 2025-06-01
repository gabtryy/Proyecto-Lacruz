  <?php
  include_once('vistas/header2.php');
  $provedor = listarProvedor();
  ?>
<div class="container py-4 h-100">
    <div class="row align-items-center mb-4">
       
        <div class="col-md-3">
            <a href="<?php echo $URL; ?>/index.php?action=provedores_registro" style="text-decoration: none; color: inherit;">
                <div class="cardj step-card text-white noselec">
                    <div class="row g-0">
                        <div class="card-body p-md-2 mx-md-2">
                            <div class="text-center">
                                <h4 class="mt-1 mb-2 pb-1">Registrar Provedor</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
       
        <div class="col-md-6 text-center">
            <h2 class="mb-0">Provedores</h2> 
        </div>
        
        
        <div class="col-md-3"></div>
    </div>
    
  
</div>
  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-12">
        <div class="cardj rounded-3 text-white">
          <div class="row g-0">
            
              <div class="card-body p-md-5 mx-md-4">

                
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
      <?php foreach($provedor as $provedores): ?>
            <tr>
                <td><?= $provedores['rif'] ?></td>
                <td><?= $provedores['nombre'] ?></td>
                <td>
                  <div class="contend">
                  <?= $provedores['correo'] ?> 
                  </div>
                </td>
                <td><?= $provedores['telefono'] ?></td>
                <td style="display: flex; gap: 5px">
                    <a href="index.php?action=editarServicio&id_servicio=<?= $provedores['rif'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="index.php?action=eliminarP&rif=<?= $provedores['rif'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este Servicio?');">Eliminar</a>
                </td>
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

 