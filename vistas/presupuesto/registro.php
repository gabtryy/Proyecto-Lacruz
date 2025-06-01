  <?php
  include_once('vistas/header2.php');
  ?>

   <div class="text-center">
                 
                  <h4 class="mt-4 mb-2 pb-1">Presupuesto</h4>
    </div>
  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-12">
        <div class="cardj rounded-3 text-white">
          <div class="row g-0">
            
              <div class="card-body p-md-5 mx-md-4">

               
                
                  <form method = "POST" action="#">
                 
              
            
                <div class="row mb-3"> 
    
        <div class="col-md-6">
            <label class="form-label">Servicio:</label>
            <select class="form-select form-select-sm" name="" required>
                    <option value="">servicio 1</option>
                    <option value="">servicio 2</option>
                    <option value="">servicio 3</option>
            </select>
        </div>
        
        <div class="col-md-6">
            <label class="form-label">cliente:</label>
            <select class="form-select form-select-sm" name="" required>
                <option value="">cliente 1</option>
                <option value="">cliente 2</option>
                <option value="">cliente 3</option>
            </select>
        </div>
         <div class="col-md-6">
            <label class="form-label">Producto:</label>
            <select class="form-select form-select-sm" name="" required>
                    <option value="">producto 1</option>
                    <option value="">producto 2</option>
                    <option value="">producto 3</option>
            </select>
         
        </div>
           <div class="col-md-6">
        <label for="cantidad" class="form-label">¿Cuánto comprará?</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control form-control-sm" required>
        </div>
    </div>
    
            
          <h4>total: 3000000</h4> 
          <div class="text-center pt-1 mb-5 pb-1">
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

  <div class="text-center">
                 
                  <h4 class="mt-2 mb-2 pb-1">Presupuestos</h4>
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
      <th scope="col">cliente</th>
      <th scope="col">servicio</th>
      <th scope="col">producto</th>
      <th scope="col">total</th>
      <th scope="col">estado</th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <tr class="" href="#">
      <th >mark</th>
      <td>pico y poda</td>
      <td>30 pipas desinfectante</td>
      <td>5000000</td>
      <td><a href="#" class ="tbc">aprobar</a> I <a href="#" class ="tbc">rechazar</a></td>
    </tr>
    <tr>
      <th >Jacob</th>
      <td>limpieza</td>
      <td>no aplica</td>
      <td>6000000</td>
      <td><a href="#" class ="tbc">aprobar</a> I <a href="#" class ="tbc">rechazar</a></td>
    </tr>
    <tr>
      <th >kevin</th>
      <td>limpieza hodromatica</td>
      <td>no aplica</td>
      <td>6000000</td>
      <td><a href="#" class ="tbc">aprobar</a> I <a href="#" class ="tbc">rechazar</a></td>
    </tr>
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