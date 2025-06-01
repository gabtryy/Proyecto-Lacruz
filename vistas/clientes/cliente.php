  <?php
  include_once('vistas/header2.php');
  $cliente = listarcliente();
  ?>
  
<div class="container py-4 h-100">
    <div class="row align-items-center mb-4">
       
        <div class="col-md-3">
            <a href="<?php echo $URL; ?>/index.php?action=registrar_cliente" style="text-decoration: none; color: inherit;">
                <div class="cardj step-card text-white noselec">
                    <div class="row g-0">
                        <div class="card-body p-md-2 mx-md-2">
                            <div class="text-center">
                                <h4 class="mt-1 mb-2 pb-1">Registrar Clientes</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
       
        <div class="col-md-6 text-center">
            <h2 class="mb-0">Clientes</h2> 
        </div>
        
        
        <div class="col-md-3"></div>
    </div>
    
  
</div>
     
  <div class="container py-2 h-100">
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
      <th scope="col">DIRECCION</th>
      <th scope="col">FECHA DE REGISTRO</th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($cliente as $cliente): ?>
            <tr>
                <td><?= $cliente['rif'] ?></td>
                <td><?= $cliente['nombre'] ?></td>
                <td><?= $cliente['correo'] ?></td>
                <td><?= $cliente['telefono'] ?></td>
                <td><?= $cliente['direccion'] ?></td>
                <td><?= $cliente['fecha_registro'] ?></td>
                <td>
                    <a href="index.php?action=editarcliente&rif=<?= $cliente['rif'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="index.php?action=eliminarC&rif=<?= $cliente['rif'] ?>" class="btn btn-dark btn-sm" onclick="return confirm('¿Desea eliminar este producto?');">Eliminar</a>
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

   
    </div>
  </div>
