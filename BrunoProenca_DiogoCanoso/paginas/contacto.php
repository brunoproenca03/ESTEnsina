<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <title>
      Contacto
    </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="bootstrap-icons.css">
    <link rel="stylesheet" href="owl.carousel.min.css">
    <link rel="stylesheet" href="owl.theme.default.min.css">
  </head>
  <body>
      <header class="position-relative">
      <div class="background position-absolute z-index_-1 w-100 h-100">
        <img class="cover" src="#hero-cover.2.png" alt="" >
        <div class="filter basic"></div>
      </div>
      <div class="navbar z-index-10 w-100 py-0 light-background-color">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light w-100 position-static" id="">
            <a class="navbar-brand" href="index.php">
            <h1 class="h3 mt-0">
              ESTensina
            </h1></a><button class="navbar-toggler" type="button" data-bs-target="#navbarSupportedContent" data-bs-toggle="collapse" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse py-4 py-lg-0 ms-xl-4 mt-4 mt-lg-0" id="navbarSupportedContent">
              <ul class="navbar-nav align-items-center mx-auto">
                <li class="nav-item">
                  <a class="nav-link link px-3" href="index.php"><span>Home</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link link px-3" href="contacto.php"><span>Contacto</span></a>
                </li>
              </ul>
              <ul class="navbar-nav ms-auto align-items-center mt-4 mt-lg-0 me-lg-4">
                
                <li class="nav-item">
                  <a class="nav-link px-0" href="PaginaUtilizador.php"><button class="btn primary-color btn-round btn-outline border-0" style="padding: 12px 14px"><span class="small ms-1">Página Utilizador</span></button></a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link px-0" href="login.php"><button class="btn primary-color btn-round btn-outline border-0" style="padding: 12px 14px">
                  <?php
                      include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
                      include "tipoUtilizadores.php";
                      session_start();
                      if(isset($_SESSION["user"]) && isset($_SESSION["id"]) && ($_SESSION["tipo_utilizador"] != VISITANTE || $_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO) ){
                         $sql = "SELECT nome FROM utilizador WHERE nome = '" . $_SESSION["user"] . "'";
                         $retval = mysqli_query($conn, $sql);
                         if (!$retval) {
                            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
                          }                      
                         $row = mysqli_fetch_array($retval);
                         $nome = $row['nome'];
                         echo '<span class="small ms-1">'.$nome.'</span>';
                      } else {
                        echo '<span class="small ms-1">Login / Registar</span>';
                      }  
                    ?>
                  </button></a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
      
    <div>
      <div class="background position-absolute z-index_-1 w-100 h-100">
        <img class="cover" src="back.jpg" alt="">
        <div class="filter light-filter-diagonal"></div>
      </div>
      <div class="container py-5">
        <div class="row">
          <div class="col-lg-7">
            <div class="round py-5 text-center text-lg-start">
              <div>
                <h2 class="h2 text-color" style="margin-top: 5px">
                  Contacte-nos
                </h2>
              </div>
              <div class="card-content" style="margin-top: 40px">
                <div class="row">
                  <div class="form-group col-md-6">
                    <input class="form-control" type="text" placeholder="Nome Completo">
                  </div>
                  <div class="form-group col-md-6 mt-3 mt-md-0">
                    <input class="form-control" type="text" placeholder="Email">
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="form-group col-md-6">
                    <select class="form-select">
                      <option>
                        Esclarecimento de Duvidas
                      </option>
                      <option>
                        Preços
                      </option>
                      <option>
                        Erro ao inscrever-se num curso
                      </option>
                      <option>
                        Erro ao fazer o login
                      </option>
                      <option>
                        Erro ao registar-se como aluno
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-6 mt-3 mt-md-0">
                    <select class="form-select">
                      <option>
                         Local - Suporte técnico 
                      </option>
                      <option>
                        Lisboa
                      </option>
                      <option>
                        Castelo Branco
                      </option>
                    </select>
                  </div>
                </div>
                <textarea class="form-control" placeholder="Mensagem" style="margin-top: 20px"></textarea>
              </div><button class="btn primary-color" style="margin-top: 40px"><span>Enviar</span></button>
            </div>
          </div>
        </div>
      </div>


      

      <div class="container">
        <h2 class="h2 text-color" style="margin-top: 10px">
        A nossa localização
        </h2>
        <div class="row">
          <div class="col-md-6">
            <table class="table table-sm mt-3" margin top = 20px>
              <tbody>
                <tr>
                  <th>Segunda-feira</th>
                  <td>09:00 - 20:00</td>
                </tr>
                <tr>
                  <th>Terça-feira</th>
                  <td>09:00 - 20:00</td>
                </tr>
                <tr>
                  <th>Quarta-feira</th>
                  <td>09:00 - 20:00</td>
                </tr>
                <tr>
                  <th>Quinta-feira</th>
                  <td>09:00 - 20:00</td>
                </tr>
                <tr>
                  <th>Sexta-feira</th>
                  <td>09:00 - 20:00</td>
                </tr>
                <tr>
                  <th>Sábado</th>
                  <td>09:00 - 20:00</td>
                </tr>
                <tr>
                  <th>Domingo</th>
                  <td>Fechado</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3064.607220964582!2d-7.503166224288204!3d39.8158014715426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd3d5e98d4cf51e3%3A0x339d579788b71b0a!2sUrbaniza%C3%A7%C3%A3o%20Quinta%20Dr.%20Beir%C3%A3o%2030%2C%206000-226%20Castelo%20Branco!5e0!3m2!1spt-PT!2spt!4v1686854854955!5m2!1spt-PT!2spt" width="720" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
      <footer>
          <div class="position-relative dark-background-color">
            <div class="container py-5">
              <div class="row justify-content-between align-items-center">
                <div class="col-md-8 mb-4 mb-lg-0">
                  <h3 class="h3 light-text-color">
                    ESTensina -  Melhor Centro de Formações do Distrito 
                  </h3>
                  <p class="paragraph light-text-color" style="margin-top: 10px">
                    Urbanização Quinta Dr. Beirão, Lote 30
                  </p>
                </div>
                <div class="col-lg-3 col-md-4 text-center">
                  <button class="btn primary-color">Contacte-nos</button>
                </div>
              </div>
            </div>
          </div>
          <div class="position-relative light-gray-1">
            <div class="container py-4">
              <div class="row justify-content-between align-items-center">
                <div class="col-md-7 mb-5 mb-md-0">
                  <h6 class="h6 second-text-color">
                    COPYRIGHT © BRUNO PROENCA & DIOGO CANOSO
                  </h6>
                </div>
                <div class="col-md-3 text-center">
                  <div class="card-content py-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
      
    <script src="jquery-3.4.1.min.js"></script> 
    <script src="bootstrap.bundle.min.js"></script> 
    <script src="owl.carousel.min.js"></script> 
    <script src="tools.js"></script>
  </body>
</html>