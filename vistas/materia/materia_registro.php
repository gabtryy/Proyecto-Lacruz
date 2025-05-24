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
                
                  <form method = "POST" action="index.php?action=entrar">
                  
                
                    <H5>nombre</H5>
                  
                   <div data-mdb-input-init class="form-outline mb-4">
                    <input type="nombre" id="nombre" name = "nombre" class="form-control"
                      placeholder="indrodusca el nombre" />
            
                  </div>
                       <div class="">
            <label class="form-label">Provedor:</label>
            <select class="form-select " name="" required>
                    <option value="">Provedor 1</option>
                    <option value="">Provedor 2</option>
                    <option value="">Provedor 3</option>
            </select>
                </div>
                  <H5>P/U</H5>
                 <div data-mdb-input-init class="form-outline  mb-4">
                    <input type="number" id="rif" class="form-control" name = "rif" id = "rif" placeholder="introdusca el precio por unidad"/>
                    
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