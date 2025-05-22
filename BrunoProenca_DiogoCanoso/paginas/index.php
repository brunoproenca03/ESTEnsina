<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <title>ESTensina</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="bootstrap-icons.css" />
    <link rel="stylesheet" href="owl.carousel.min.css" />
    <link rel="stylesheet" href="owl.theme.default.min.css" />
  </head>
  <body>
    <header class="position-relative">
      <div class="navbar z-index-10 w-100 py-0 light-background-color">
        <div class="container">
          <nav
            class="navbar navbar-expand-lg navbar-light w-100 position-static"
            id=""
          >
            <a class="navbar-brand" href="index.php">
              <h1 class="h3 mt-0">ESTensina</h1></a
            ><button
              class="navbar-toggler"
              type="button"
              data-bs-target="#navbarSupportedContent"
              data-bs-toggle="collapse"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div
              class="collapse navbar-collapse py-4 py-lg-0 ms-xl-4 mt-4 mt-lg-0"
              id="navbarSupportedContent"
            >
              <ul class="navbar-nav align-items-center mx-auto">
                <li class="nav-item">
                  <a class="nav-link link px-3" href="index.php"
                    ><span>Home</span></a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link link px-3" href="contacto.php"
                    ><span>Contacto</span></a
                  >
                </li>
              </ul>
              <ul
                class="navbar-nav ms-auto align-items-center mt-4 mt-lg-0 me-lg-4"
              >
                <li class="nav-item">
                  <a class="nav-link px-0" href="PaginaUtilizador.php"
                    ><button
                      class="btn primary-color btn-round btn-outline border-0"
                      style="padding: 12px 14px"
                    >
                      <span class="small ms-1">Página Utilizador</span>
                    </button></a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link px-0" href="login.php"
                    ><button
                      class="btn primary-color btn-round btn-outline border-0"
                      style="padding: 12px 14px"
                    >
                    <?php
                      include 'C:\xampp\htdocs\BrunoProenca_DiogoCanoso\basedados\basedados.h';
                      include 'tipoUtilizadores.php';
                      session_start();
                      if(isset($_SESSION["user"]) && ($_SESSION["tipo_utilizador"] != VISITANTE || $_SESSION["tipo_utilizador"] != ALUNO_NAO_VALIDADO) && isset($_SESSION["id"])){
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
                    </button></a
                  >
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <div
        class="carousel slide"
        id="carouselExampleCaptions"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              class="cover background position-absolute z-index_-1"
              src="Formacao.jpg"
              alt=""
            />
            <div class="carousel-content container py-6 py-lg-9 px-4">
              <div class="row justify-content-center">
                <div
                  class="text-center col-md-6 justify-content-center py-lg-5"
                >
                  <h1 class="h1 light-text-color mt-4">
                    Bem-vindo ao Centro de Formação ESTensina
                  </h1>
                  <h4 class="h4 light-text-color" style="margin-top: 40px">
                    Ajudamos pessoas a atingirem os seus objetivos
                  </h4>
                  <div class="cta" style="margin-top: 35px">
                    <button class="btn primary-color btn-lg">
                      <span class="h3">INSCREVA-SE</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img
              class="cover background position-absolute z-index_-1"
              src="Formacao2.jpg"
              alt=""
            />
            <div class="carousel-content container py-6 py-lg-9 px-4">
              <div class="row justify-content-center">
                <div
                  class="text-center col-md-6 justify-content-center py-lg-5"
                >
                  <h1 class="h1 light-text-color mt-4">
                    Bem-vindo ao Centro de Formação ESTensina
                  </h1>
                  <h4 class="h4 light-text-color" style="margin-top: 40px">
                    Ajudamos pessoas a atingirem os seus objetivos
                  </h4>
                  <div class="cta" style="margin-top: 35px">
                    <button class="btn primary-color btn-lg">
                      <span class="h3">INSCREVA-SE</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators my-0 mx-1">
          <li
            class="active"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
          ></li>
          <li
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1"
          ></li>
        </ol>
        <a
          class="carousel-control-next"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next"
          href="#"
          ><span class="carousel-control-next-icon"></span></a
        ><a
          class="carousel-control-prev"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev"
          href="#"
          ><span class="carousel-control-prev-icon"></span
        ></a>
      </div>
    </header>
    <section>
      <div class="container py-5 py-lg-7">
        <div class="row justify-content-center align-items-stretch mt-5">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a
              class="card-item cover d-flex align-items-end overflow-hidden"
              href="#"
              style="padding: 0 0 20px 0; height: 500px"
            >
              <div class="media bg-cover zoom">
                <img class="cover" src="formacao3.jpg" alt="" />
                <div class="filter basic"></div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 mb-5 mb-lg-0">
            <a
              class="card-item cover d-flex align-items-end overflow-hidden"
              href="#"
              style="padding: 0 0 20px 0; height: 500px"
            >
              <div class="media bg-cover zoom">
                <img class="cover" src="pessoa2.jpg" alt="" />
                <div class="filter basic"></div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 mb-5 mb-lg-0">
            <a
              class="card-item cover d-flex align-items-end overflow-hidden"
              href="#"
              style="padding: 0 0 20px 0; height: 242px"
            >
              <div class="media bg-cover zoom">
                <img class="cover" src="linguagens2.jpg" alt="" />
                <div class="filter basic"></div>
              </div> </a
            ><a
              class="card-item cover d-flex align-items-end overflow-hidden mt-3"
              href="#"
              style="padding: 0 0 20px 0; height: 242px"
            >
              <div class="media bg-cover zoom">
                <img class="cover" src="linguagens.jpg" alt="" />
                <div class="filter basic"></div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container py-7 py-md-9">
        <div class="row justify-content-center">
          <div class="text-center col-lg-6">
            <h3 class="h3 text-color">A NOSSA OFERTA PARA SI</h3>
            <p class="paragraph second-text-color" style="margin-top: 10px">
              Experimente os nossos cursos ...
            </p>
          </div>
        </div>
        <div
          class="row justify-content-center align-items-stretch mt-5 mt-lg-7"
        >
          <div class="owl-carousel owl-theme 3-items">
            <div class="product-item light-background-color light-drop-shadow">
              <div
                class="product-media position-relative"
                style="height: 200px"
              >
                <img class="zoom cover" src="php.png" alt="" />
                <div
                  class="product-actions position-absolute d-flex justify-content-center w-100"
                  style="bottom: 20px"
                ></div>
              </div>
              <div class="content-card" style="padding: 30px 30px">
                <a class="h5 d-block text-color" href="#">PHP</a>
                <div
                  class="d-flex align-items-center"
                  style="margin-top: 5px"
                ></div>
                <div class="d-flex" style="margin-top: 10px">
                  <h5
                    class="h5 secondary-text-color-1"
                    style="margin-left: 5px"
                  >
                    O preço é calculado da seguinte forma:<br> 3€ x duração do curso 
                  </h5>
                </div>
              </div>
            </div>
            <div class="product-item light-background-color light-drop-shadow">
              <div
                class="product-media position-relative"
                style="height: 200px"
              >
                <img class="zoom cover" src="JSP.jpg" alt="" />
                <div
                  class="product-actions position-absolute d-flex justify-content-center w-100"
                  style="bottom: 20px"
                ></div>
              </div>
              <div class="content-card" style="padding: 30px 30px">
                <a class="h5 d-block text-color" href="#">JSP</a>
                <div
                  class="d-flex align-items-center"
                  style="margin-top: 5px"
                ></div>
                <div class="d-flex" style="margin-top: 10px">
                  <h5
                    class="h5 secondary-text-color-1"
                    style="margin-left: 5px"
                  >
                  O preço é calculado da seguinte forma:<br> 3€ x duração do curso 
                  </h5>
                </div>
              </div>
            </div>
            <div class="product-item light-background-color light-drop-shadow">
              <div
                class="product-media position-relative"
                style="height: 200px"
              >
                <img class="zoom cover" src="Java.png" alt="" />
                <div
                  class="product-actions position-absolute d-flex justify-content-center w-100"
                  style="bottom: 20px"
                ></div>
                <div
                  class="tag position-absolute rounded danger-color text-center"
                  style="padding: 5px 10px; left: 15px; top: 10px"
                >
                  <h6 class="h6 light-text-color">Sale</h6>
                </div>
              </div>
              <div class="content-card" style="padding: 30px 30px">
                <a class="h5 d-block text-color" href="#">Java</a>
                <div
                  class="d-flex align-items-center"
                  style="margin-top: 5px"
                ></div>
                <div class="d-flex" style="margin-top: 10px">
                  <h5 class="h5 muted-text-color line-through"></h5>
                  <h5
                    class="h5 secondary-text-color-1"
                    style="margin-left: 5px"
                  >
                  O preço é calculado da seguinte forma:<br> 3€ x duração do curso 
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container py-7 py-md-9">
        <div class="row justify-content-center">
          <div class="text-center col-lg-6">
            <h3 class="h3 text-color">
              OS NOSSOS PRODUTOS PARA ALÉM DOS CURSOS
            </h3>
            <p class="paragraph second-text-color" style="margin-top: 10px">
              Esteja sempre a par das novidades
              ...
            </p>
          </div>
        </div>
        <div class="row align-items-stretch mt-5" style="margin-top: 50px">
          <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
            <div class="product-item p-3">
              <div
                class="product-media position-relative"
                style="height: 300px"
              >
                <img class="zoom cover" src="caneca.jpeg" alt="" />
              </div>
              <div class="content-card p-3" style="margin-top: 15px">
                <a class="h5 d-block text-color" href="#"
                  >Caneca para Developer </a
                >
                <div class="d-flex" style="margin-top: 10px">
                  <h5 class="h5 muted-text-color line-through">16.99€</h5>
                  <h5
                    class="h5 secondary-text-color-1"
                    style="margin-left: 5px"
                  >
                    7.91€
                  </h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="product-item p-3">
              <div
                class="product-media position-relative"
                style="height: 300px"
              >
                <img class="zoom cover" src="t-shirt.jpeg" alt="" />
              </div>
              <div class="content-card p-3" style="margin-top: 15px">
                <a class="h5 d-block text-color" href="#"
                  >T-shirt</a
                >
                <div class="d-flex" style="margin-top: 10px">
                  <h5 class="h5 muted-text-color line-through">15.48€</h5>
                  <h5
                    class="h5 secondary-text-color-1"
                    style="margin-left: 5px"
                  >
                    10.99€
                  </h5>
                </div>
                <div
                  class="d-flex align-items-center"
                  style="margin-top: 5px"
                ></div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="product-item p-3">
              <div
                class="product-media position-relative"
                style="height: 300px"
              >
                <img class="zoom cover" src="cartas.jpg" alt="" />
              </div>
              <div class="content-card p-3" style="margin-top: 15px">
                <a class="h5 d-block text-color" href="#"
                  >Baralho de Cartas</a
                >
                <div class="d-flex" style="margin-top: 10px">
                  <h5 class="h5 muted-text-color line-through">20.34€</h5>
                  <h5
                    class="h5 secondary-text-color-1"
                    style="margin-left: 5px"
                  >
                    10.20€
                  </h5>
                </div>
                <div
                  class="d-flex align-items-center"
                  style="margin-top: 5px"
                ></div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="product-item p-3">
              <div
                class="product-media position-relative"
                style="height: 300px"
              >
                <img class="zoom cover" src="capa-tele.jpg" alt="" />
              </div>
              <div class="content-card p-3" style="margin-top: 15px">
                <a class="h5 d-block text-color" href="#"
                  >Capa para telemóvel</a
                >
                <div class="d-flex" style="margin-top: 10px">
                  <h5 class="h5 muted-text-color line-through">26.44€</h5>
                  <h5
                    class="h5 secondary-text-color-1"
                    style="margin-left: 5px"
                  >
                    15.00€
                  </h5>
                </div>
                <div
                  class="d-flex align-items-center"
                  style="margin-top: 5px"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="light-gray-1">
      <div class="container py-5 py-md-9">
        <div class="row justify-content-center">
          <div class="text-center col-lg-6">
            <h2 class="h2 text-color">A opinião dos nossos clientes</h2>
            <p class="paragraph second-text-color" style="margin-top: 10px">
              Opiniões com um maior número de visualizações ou mais recentes
            </p>
          </div>
        </div>
        <div
          class="row align-items-stretch mt-5 mt-md-7"
          style="margin-top: 80px"
        >
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div
              class="card-item row align-items-stretch mx-3 light-background-color"
            >
              <div class="col-md-4" style="padding: 0">
                <img class="cover" src="testimonials-4-user-1.jpg" alt="" />
              </div>
              <div class="card-content col-md-8" style="padding: 40px 30px">
                <div>
                  <h3 class="h3 text-color">Maria Pereira</h3>
                  <h6 class="h6 text-color" style="margin-top: 5px">
                    Enfermeira
                  </h6>
                </div>
                <p class="paragraph second-text-color" style="margin-top: 15px">
                  Um bom atendimento, preços bastante acessíveis e acima de tudo
                  ainda é possível comprar diversos produtos, desde produtos domesticos a produtos para uso pessoal
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div
              class="card-item row align-items-stretch mx-3 light-background-color"
            >
              <div class="col-md-4" style="padding: 0">
                <img class="cover" src="testimonials-4-user-2.jpg" alt="" />
              </div>
              <div class="card-content col-md-8" style="padding: 40px 30px">
                <div>
                  <h3 class="h3 text-color">Regina Miles</h3>
                  <h6 class="h6 text-color" style="margin-top: 5px">
                    Professora
                  </h6>
                </div>
                <p class="paragraph second-text-color" style="margin-top: 15px">
                  Atendimento excelente. Docentes muito simpáticos e cultos
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer>
      <div class="position-relative light-gray-1">
        <div class="container py-4">
          <div class="row justify-content-between align-items-center">
            <div class="col-md-8 mb-5 mb-md-0">
              <h3 class="h3 text-color">Faça já a sua marcação</h3>
            </div>
            <div class="col-md-3 text-md-center">
              <button class="btn primary-color">
                <span class="btn-text">Contacte-nos</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="position-relative dark-background-color">
        <div class="container py-5">
          <div class="row align-items-stretch">
            <div class="col-lg-2 col-md-4 mb-5 mb-lg-0">
              <h5 class="h5 light-text-color">Informação da Empresa</h5>
              <div class="links" style="margin-top: 20px">
                <a class="link d-block light-text-color" href="#">Sobre Nós</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >Funcionarios</a
                ><a
                  class="link d-block light-text-color"
                  href="contacto.php"
                  style="margin-top: 10px"
                  >Contactos</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >Site</a
                >
              </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-5 mb-lg-0">
              <h5 class="h5 light-text-color">Jurídico</h5>
              <div class="links" style="margin-top: 20px">
                <a class="link d-block light-text-color" href="#">About Us</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >Carrier</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >We are hiring</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >Blog</a
                >
              </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-5 mb-lg-0">
              <h5 class="h5 light-text-color">Características</h5>
              <div class="links" style="margin-top: 20px">
                <a class="link d-block light-text-color" href="#"
                  >Business Marketing</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >User Analytic</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >Live Chat</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >Unlimited Support</a
                >
              </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-5 mb-lg-0">
              <h5 class="h5 light-text-color">Recursos</h5>
              <div class="links" style="margin-top: 20px">
                <a class="link d-block light-text-color" href="#"
                  >IOS & Android</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >Watch a Demo</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >Customers</a
                ><a
                  class="link d-block light-text-color"
                  href="#"
                  style="margin-top: 10px"
                  >API</a
                >
              </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-5 mb-lg-0">
              <h5 class="h5 light-text-color">Entre em Contacto</h5>
              <div class="links" style="margin-top: 20px">
                <div class="feature-item d-flex align-items-center">
                  <h6 class="h6 light-text-color" style="margin-left: 10px">
                    (+351) 272 558 536
                  </h6>
                </div>
                <div
                  class="feature-item d-flex align-items-center"
                  style="margin-top: 10px"
                >
                  <h6 class="h6 light-text-color" style="margin-left: 10px">
                    Urbanização Quinta Dr. Beirão, Lote 30
                  </h6>
                </div>
                <div
                  class="feature-item d-flex align-items-center"
                  style="margin-top: 10px"
                >
                  <h6 class="h6 light-text-color" style="margin-left: 10px">
                    geral@estensina.pt
                  </h6>
                </div>
              </div>
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
    </footer>
    <script src="jquery-3.4.1.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script src="owl.carousel.min.js"></script>
    <script src="tools.js"></script>
  </body>
</html>
