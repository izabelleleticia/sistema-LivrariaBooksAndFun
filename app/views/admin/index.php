<!doctype html>
<html lang="pt-BR">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BooksAndFun | Dashboard</title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="Dashboard Metre dos Motores" />
  <meta name="author" content="Alessandro Palmeira" />
  <meta name="description" content="Dashboard Metre dos Motores" />
  <meta name="keywords" content="Dashboard, Metre dos Motores, Motores, serviços, veiculo" />
  <!--end::Primary Meta Tags-->

  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
  <!--end::Fonts-->

  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->

  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->

  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="http://localhost/sistema-LivrariaBooksAndFun/public/dash/css/adminlte.css" />

  <!--end::Required Plugin(AdminLTE)-->


</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
          <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Site</a></li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">


          <!--begin::Fullscreen Toggle-->
          <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
            </a>
          </li>
          <!--end::Fullscreen Toggle-->
          <!--begin::User Menu Dropdown-->
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img src="<?php BASE_URL ?>dash/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow"
                alt="User Image" />
              <span class="d-none d-md-inline">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <!--begin::User Image-->
              <li class="user-header text-bg-primary">
                <img src="<?php BASE_URL ?>dash/assets/img/user2-160x160.jpg" class="rounded-circle shadow"
                  alt="User Image" />
                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2023</small>
                </p>
              </li>
              <!--end::User Image-->

              <!--begin::Menu Footer-->
              <li class="user-footer">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
                <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
              </li>
              <!--end::Menu Footer-->
            </ul>
          </li>
          <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
      </div>
      <!--end::Container-->
    </nav>
    <!--end::Header-->

    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="white">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
          <!--begin::Brand Image-->
          <img src="https://localhost/sistema-LivrariaBooksAndFun/public/assets/img/logoBooksandfun.png"class="imgLogo"/>
          <!--end::Brand Image-->
          <!--begin::Brand Text-->
         
          <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <!--begin::Sidebar Menu-->
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="http://localhost/sistema-LivrariaBooksAndFun/public/admin" class="nav-link">
                <i class="nav-icon bi bi-palette"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-header">Gerenciamento de Conteúdo</li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>
                  Conteúdo Site
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="http://localhost/sistema-LivrariaBooksAndFun/public/venda/listar" class="nav-link">
                    <p>Vendas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="http://localhost/sistema-LivrariaBooksAndFun/public/venda/itens_venda/listar" class="nav-link">
                    <p>Controle de vendas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="http://localhost/sistema-LivrariaBooksAndFun/public/livro/listar" class="nav-link">
                    <p>Controle de Livros</p>
                  </a>
                </li>
              
                </li>
                <li class="nav-item">
                  <a href="http://localhost/sistema-LivrariaBooksAndFun/public/livro/estoque" class="nav-link">
                    <p>Controle de estoque</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="http://localhost/sistema-LivrariaBooksAndFun/public/autor/listar" class="nav-link">
                    <p>Autores </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">Clientes</li>
            <li class="nav-item">
              <a href="http://localhost/sistema-LivrariaBooksAndFun/public/cliente/listar" class="nav-link">
                <p>👥 Clientes</p>
              </a>
            </li>

            <li class="nav-header">Front-end</li>
            <li class="nav-item">
              <a href="http://localhost/sistema-LivrariaBooksAndFun/public/serie/listar" class="nav-link">
                <p>👥 Séries</p>
              </a>
            </li>
            
            
            <li class="nav-item">
              <a href="http://localhost/sistema-LivrariaBooksAndFun/public/usuarios/listar" class="nav-link">
                <p>Usuários</p> 
              </a>
            </li>
            <li class="nav-item">
              <a href="http://localhost/sistema-LivrariaBooksAndFun/public/venda/itens_venda/listar" class="nav-link">
                <p>🎯 Imagens</p>
              </a>
            </li>

            <!-- <li class="nav-header">Equipe e Parceiros</li>
            <li class="nav-item">
              <a href="dashboard" class="nav-link">
                <p>👨‍🔧 Funcionários</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="dashboard" class="nav-link">
                <p>🚗 Marcas Parceiras</p>
              </a>
            </li>

            <li class="nav-header">Gestão de Veículos</li>
            <li class="nav-item">
              <a href="dashboard" class="nav-link">
                <p>🚘 Veículos</p>
              </a>
            </li> -->
            <!--end::Sidebar Menu-->
        </nav>
      </div>
      <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </div>
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content Header-->

      <!--begin::App Content-->
      <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">

         

          <!--begin::Row-->
          <div class="row">

            <?php
            if (isset($conteudo)) {
              $this->carregarViews($conteudo, $dados);
            } else {
              echo '<h2> Bem-vindo ao Dashboard BooksAndFun</h2>';
            }
            ?>

          </div>
          <!-- /.row (main row) -->

        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content-->
    </main>
    <!--end::App Main-->
    <!--begin::Footer-->
    <footer class="app-footer">
      <!--begin::To the end-->
      <div class="float-end d-none d-sm-inline">SENAC SMP</div>
      <!--end::To the end-->
      <!--begin::Copyright-->
      <strong>
        Copyright &copy; 2025&nbsp;
        <a href="#" class="text-decoration-none">TI26</a>.
      </strong>
      Todos os direitos reservados.
      <!--end::Copyright-->
    </footer>
    <!--end::Footer-->
  </div>


  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->


  <script src="<?php BASE_URL ?>dash/js/adminlte.js"></script>


</body>
<!--end::Body-->

</html>