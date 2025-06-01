  <?php
  include_once('vistas/header2.php');
  $servicio = listarServicio();
  ?>
  <style>
    .contend{
    width: 300px;
    overflow-y: auto;
  }
  </style>
<div class="container py-4 h-100">
    <div class="row align-items-center mb-4">
       <?php if(isset($_SESSION['message'])) { ?>
    <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
       <?= $_SESSION['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <?php unset($_SESSION['message']); } ?>
        <div class="col-md-3">
            <a href="index.php?action=crearServicio" style="text-decoration: none; color: inherit;">
                <div class="cardj step-card text-white noselec">
                    <div class="row g-0">
                        <div class="card-body p-md-2 mx-md-2">
                            <div class="text-center">
                                <h4 class="mt-1 mb-2 pb-1">Registrar Servicio</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
       
        <div class="col-md-6 text-center">
            <h2 class="mb-0">Servicios</h2> 
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
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">DESCRIPCION</th>
      <th scope="col">PRECIO</th>
      <th scope="col">ACCIONES</th>
      
      <th></th>

    </tr>
  </thead>
  <tbody>
      <?php foreach($servicio as $servicios): ?>
            <tr>
                <td><?= $servicios['id_servicio'] ?></td>
                <td><?= $servicios['nombre'] ?></td>
                <td>
                  <div class="contend">
                  <?= $servicios['descripcion'] ?> 
                  </div>
                </td>
                <td><?= $servicios['precio_hora'].'Bs' ?></td>
                <td style="display: flex; gap: 5px">
                    <a href="index.php?action=editarServicio&id_servicio=<?= $servicios['id_servicio'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="index.php?action=eliminarServicio&id_servicio=<?= $servicios['id_servicio'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este Servicio?');">Eliminar</a>
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

  
