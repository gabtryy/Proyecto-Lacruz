<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="/proyecto-lacruz/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/proyecto-lacruz-j/vista/css/login.css">
  
</head>
<body>

  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-8">
        <div class="card rounded-3 text-white">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="vista/images/logo.png"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Multiservicios Lacruz</h4>
                </div>
                
                <form method = "POST" action="index.php?c=login&m=validar">
                  

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="usuario" name = "usuario" class="form-control"
                      placeholder="usuario" />
                   
                  </div>

                  <div data-mdb-input-init class="form-outline  mb-4">
                    <input type="password" id="clave" class="form-control" name = "clave" id = "clave" placeholder="password"/>
                    
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

    
      <script> src ="proyecto-lacruz-j/bootstrap/js/bootstrap.min.js"</script>
    <script> src ="proyecto-lacruz-j/bootstrap/js/bootstrap.bundle.min.js"</script>
</body>
</html>
