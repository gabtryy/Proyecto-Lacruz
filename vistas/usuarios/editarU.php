<?php
  include_once('vistas/header2.php');
  ?>
    <div class="text-center">
                 
                  <h4 class="mt-1 mb-5 pb-1"></h4>
    </div>
    <div class="text-center">
                 
                  <h4 class="mt-1 mb-2 pb-1">Actualizar usuario</h4>
    </div>
  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-12">
        <div class="cardj rounded-3 text-white">
          <div class="row g-0">
            
              <div class="card-body p-md-5 mx-md-4">

                  <form action="index.php?action=editarU&id=<?=$usuario['id'] ?>" method="POST">
                    <H5>Nombre</H5>
                  
                   <div data-mdb-input-init class="form-outline mb-4">
                    <input type="nombre" id="nombre" name = "nombre" class="form-control"
                      value="<?= htmlspecialchars($usuario['nombre']??'')?>"/>
            
                  </div>
                       <H5>email</H5>
                  
                   <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="email" name = "email" class="form-control"
                      value="<?= htmlspecialchars($usuario['email']??'')?>" />
            
                  </div>
                    <H5>password</H5>
                 <div data-mdb-input-init class="form-outline  mb-4">
                    <input type="number" id="password1" class="form-control" name = "password1" value="<?= htmlspecialchars($usuario['password1']??'')?>"/>
                    
                  </div>
                  </div>
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button  type="submit" class="btn btn-outline-info">Guardar</button>
                   <a style="margin-left: 20px;" href="index.php?action=usuarios" class="btn btn-outline-info">Cancelar</a>
                  </div>

         
                </form>

              </div>
            </div>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>