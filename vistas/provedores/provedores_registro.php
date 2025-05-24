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
                 
                  <h4 class="mt-1 mb-5 pb-1">provedor nuevo</h4>
                </div>
                
                  <form method = "POST" action="index.php?action=entrar">
                  
                    <H5>RIF</H5>
                 <div data-mdb-input-init class="form-outline  mb-4">
                    <input type="number" id="rif" class="form-control" name = "rif" id = "rif" placeholder="introdusca el RIF"/>
                    
                  </div>
                    <H5>nombre</H5>
                  
                   <div data-mdb-input-init class="form-outline mb-4">
                    <input type="nombre" id="nombre" name = "nombre" class="form-control"
                      placeholder="indrodusca el nombre" />
            
                  </div>
                       <H5>telefono</H5>
                 <div data-mdb-input-init class="form-outline  mb-4">
                    <input type="number" id="telefono" class="form-control" name = "telefono" id = "telefono" placeholder="introdusca el nro de telefono"/>
                    
                  </div>
                      <H5>correo</H5>
                 <div data-mdb-input-init class="form-outline  mb-4">
                    <input type="email" id="email" class="form-control" name = "email" id = "email" placeholder="introdusca un correo electronico"/>
                    
                  </div>
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button  data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-info" type="submit" name = "btnLogin" >ingresar</button>
                   
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