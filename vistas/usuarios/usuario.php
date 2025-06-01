  <?php
  include_once('vistas/header2.php');
  $usuario = listarServicio();
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
            <a href="index.php?action=crearusuario" style="text-decoration: none; color: inherit;">
                <div class="cardj step-card text-white noselec">
                    <div class="row g-0">
                        <div class="card-body p-md-2 mx-md-2">
                            <div class="text-center">
                                <h4 class="mt-1 mb-2 pb-1">Registrar Usuario</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
       
        <div class="col-md-6 text-center">
            <h2 class="mb-0">Usuario</h2> 
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
      <th scope="col">CORREO</th>
      <th scope="col">PASSWORD</th>
      <th scope="col">ACCIONES</th>
      <th></th>

    </tr>
  </thead>
  <tbody>
 <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= $usuario['nombre'] ?></td>
                <td><?= $usuario['email'] ?></td>
                <td><?= $usuario['password1'] ?></td>
                 <td>  <a href="index.php?action=editarU&id=<?= $usuario['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="index.php?action=eli&id=<?= $usuario['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este usuario?');">Eliminar</a>
                </td>
                <td></td>
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

  
