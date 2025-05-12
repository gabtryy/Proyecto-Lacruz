<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link href="/proyecto-lacruz/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
   <style>
        body {
            background-image: linear-gradient(to bottom right,rgb(0, 109, 136),rgba(0, 6, 124, 0.9));
            min-height: 100vh; 
        }
        .card {
            background-image: linear-gradient(to bottom right,rgb(0, 140, 255),rgba(0, 4, 255, 0.9));
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.64); 
        }
        .form-control {
            background-color: #e9ecef; 
            border: 1px solid #ced4da; 
        }
        .form-control:focus {
            background-color: #e9ecef; 
            border-color: #80bdff; 
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); 
        }
        .btn-primary {
            background-color:linear-gradient(rgb(140, 0, 255), rgb(0, 47, 255));
            border: none;
        }

        .gradient-custom-2 {
            background-image: 
                linear-gradient(to bottom right, rgba(170, 207, 255, 0.7), rgba(0, 47, 255, 0.68)),
                url('vistas/images/aseo-limpieza.jpg');
            background-size: cover;
            background-position: 85% 15%;
            background-repeat: no-repeat;
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }
        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
</head>
<body>

  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-8">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="vistas/images/logo.png"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Multiservicios lacruz</h4>
                </div>
                
                <form method = "POST" action="controladores/login.php">
                  

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name = "email" class="form-control"
                      placeholder="email address" />
                   
                  </div>

                  <div data-mdb-input-init class="form-outline  mb-4">
                    <input type="password" id="password" class="form-control" name = "password" id = "password" placeholder="password"/>
                    
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button  data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-info" type="submit" name = "btnLogin" >ingresar</button>
                   
                  </div>

         
                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-8">
                <h4 class="mb-5">mira nuestro catalogo de servicios y productos</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  <br>
                  <button  data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light" type="submit" name = "btnLogin" >catalogo</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Bootstrap JS y dependencias -->
      <script> src ="proyecto-lacruz/bootstrap/js/bootstrap.min.js"</script>
    <script> src ="proyecto-lacruz/bootstrap/js/bootstrap.bundle.min.js"</script>
</body>
</html>