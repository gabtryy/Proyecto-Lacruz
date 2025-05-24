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
                 
                  <h4 class="mt-1 mb-5 pb-1">producto nuevo</h4>
                </div>
                
                  <form method = "POST" action="#">
                 
              
            
                <div class="row mb-3"> 
            <H5>nombre</H5>
                  
                   <div data-mdb-input-init class="form-outline mb-3">
                    <input type="nombre" id="nombre" name = "nombre" class="form-control "
                      placeholder="indrodusca el nombre" />
            
                  </div>
        <div class="col-md-6">
            <label class="form-label">materia prima:</label>
            <select class="form-select form-select-sm" name="" required>
                    <option value="">materia prima 1</option>
                    <option value="">materia prima 2</option>
                    <option value="">materia prima 3</option>
            </select>
        </div>
        
        <div class="col-md-6">
        
        </div>
         <div class="col-md-6">
            <label class="form-label"></label>
            <select class="form-select form-select-sm" name="" required>
                    <option value="">no aplica</option>
                    <option value="">materia prima 2</option>
                    <option value="">materia prima 3</option>
            </select>
         
        </div>
        
    
         <div class="col-md-6">
            <label class="form-label"></label>
            <select class="form-select form-select-sm" name="" required>
                    <option value="">no aplica</option>
                    <option value="">materia prima 2</option>
                    <option value="">materia prima 3</option>
            </select>
         
        </div>
      
    </div>
         <div class="col-md-6">
        <label for="cantidad" class="form-label">¿P/U?</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control form-control-sm" required>
        </div>
            
          
          <div class="text-center pt-4 mb-5 pb-1">
                    <button  data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-info" type="submit" name = "btnLogin" >registrar</button>
                   
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