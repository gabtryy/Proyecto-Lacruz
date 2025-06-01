<?php
  include_once('vistas/header2.php');
  $cliente = obtenerCliente($_GET['rif']);
  ?>
    <div class="text-center">
                 
                  <h4 class="mt-1 mb-5 pb-1"></h4>
    </div>
    <div class="text-center">
                 
                  <h4 class="mt-1 mb-2 pb-1">Actualizar cliente</h4>
    </div>
  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-12">
        <div class="cardj rounded-3 text-white">
          <div class="row g-0">
            
              <div class="card-body p-md-5 mx-md-4">

                   <form action="index.php?action=editarcliente&rif=<?=$cliente['rif']?>" method="POST">
                   
                    <H5>rif</H5>
                  
                   <div data-mdb-input-init class="form-outline mb-4">
                    <input type="number" id="rif" name = "rif" class="form-control"
                      value="<?= htmlspecialchars($cliente['rif']??'')?>"/>
            
                  </div>
                       <H5>Descripcion</H5>
                  
                   <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="descripcion" name = "descripcion" class="form-control"
                      value="<?= htmlspecialchars($cliente['descripcion']??'')?>" />
            
                  </div>
                    <H5>Precio</H5>
                 <div data-mdb-input-init class="form-outline  mb-4">
                    <input type="number" id="precio" class="form-control" name = "precio_hora" value="<?= htmlspecialchars($cliente['precio_hora']??'')?>"/>
                    
                  </div>
                  </div>
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button  type="submit" class="btn btn-outline-info">Guardar</button>
                   <a style="margin-left: 20px;" href="index.php?action=cli$clientes" class="btn btn-outline-info">Cancelar</a>
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