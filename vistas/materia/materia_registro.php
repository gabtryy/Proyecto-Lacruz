  <?php
  include_once('vistas/header2.php');
  ?>
              <div class="text-center">
                 
                  <h4 class="mt-4 mb-4 pb-1">Materia Prima nueva</h4>
                </div>
  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-12">
        <div class="cardj rounded-3 text-white">
          <div class="row g-0">
            
              <div class="card-body p-md-5 mx-md-4">

              
                
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
                 
                  <div class="text-center pt-1 mb-5 pb-1">
                
                  </div>
                    <button  data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-info" type="submit" name = "btnLogin" >ingresar</button>
         
                </form>

              </div>
            </div>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>