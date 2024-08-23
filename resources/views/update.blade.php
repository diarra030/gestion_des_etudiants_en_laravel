<!DOCTYPE html>
<html lang="en">

<head>
	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edumin - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.png">
    <link rel="stylesheet" href="/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/css/style.css">
	
	<!-- Pick date -->
    <link rel="stylesheet" href="/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="/vendor/pickadate/themes/default.date.css">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="/images/logo-white.png" alt="">
                <img class="logo-compact" src="/images/logo-text-white.png" alt="">
                <img class="brand-title" src="/images/logo-text-white.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    @if (Auth::guard('client')->check() && Auth::guard('client')->user()->photo_profil)
                                    <img src="{{ asset('storage/' . Auth::guard('client')->user()->photo_profil) }}" width="100" class="img-fluid rounded-circle" alt="Photo de profil">
                               
                                @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="/profil-utilisateur" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item ai-icon">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                            <span class="ml-2">Logout </span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

       <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a class="" href="/espace-membre" aria-expanded="false">
                            <i class="la la-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-user"></i>
                            <span class="nav-text">Utilisateurs</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/liste-utilisateur">Listes des Utilisateurs</a></li>
                            <li><a href="/register">Ajouter un Utilisateur</a></li>
                            
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-users"></i>
                            <span class="nav-text">Etudiants</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/liste-etudiant">Liste des Etudiants</a></li>
                            <li><a href="/ajouter-etudiant">Ajouter Etudiants</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="la la-dollar"></i>
                        <span class="nav-text">Matières</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="/matieres">Ajouter une matière</a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

		
		
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
				    
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Modifier un Etudiant</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Etudiant</li>
                            <li class="breadcrumb-item active">Modifier un Etudiant</li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-xl-12 col-xxl-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
								<h5 class="card-title">
                  <ul>
                    @foreach($errors->all() as $error)
                    <li class="alert alert-danger"> {{$error}} </li>
                    
                    @endforeach
                    </ul>
                    
                    
                    <div class="container">
                    @if (session('status'))
                    <div class="alert alert-success">
                      {{session('status')}}
                    </div>
                    @endif
                </h5>
							</div>
							<div class="card-body">
                                <form Action="/update/traitement" method="POST" enctype="multipart/form-data">
                                  @csrf
									<div class="row">
                                        <input type="text" name="id" class="d-none" value="{{$etudiant->id}}">
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Nom</label>
												<input type="text" class="form-control" name="nom" value="{{$etudiant->nom}}">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Prénom</label>
												<input type="text" class="form-control" name="prenom" value="{{$etudiant->prenom}}">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label class="form-label">Classe</label>
												<input type="text" class="form-control" name="classe" value="{{$etudiant->classe}}">
											</div>
										</div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                              <label for="photo" class="form-label">Changer la photo</label>
                                              <input type="file" class="form-control" id="photo" name="photo">
                                            </div>
                                        </div>
                                        
										
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                              <center>
                                                <label for="photo" class="form-label">Photo actuelle</label><br>
                                              @if($etudiant->photo)
                                                  <img src="{{ Storage::url($etudiant->photo) }}" alt="Photo de {{ $etudiant->nom }}" width="100" style="border-radius: 50%;">
                                              @else
                                              <img src="{{ asset('images/default-photo.jpg') }}" alt="Photo par défaut" width="100" style="border-radius: 50%;">
                                              @endif
                                              </center>
                                            </div>
                                        </div>
										
										
										<div class="col-lg-6 col-md-12 col-sm-12">
											<button type="submit" class="btn btn-success">Modifier</button>
										</div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                          <a href="/delete-etudiant/{{$etudiant->id}}" class="btn btn-danger">Supprimer</a>
                                        </div>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">DexignLab</a> 2020</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
<script src="/vendor/global/global.min.js"></script>
	<script src="/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="/js/custom.min.js"></script>
	<script src="/js/dlabnav-init.js"></script>

	<!-- Svganimation scripts -->
    <script src="/vendor/svganimation/vivus.min.js"></script>
    <script src="/vendor/svganimation/svg.animation.js"></script>
    <script src="/js/styleSwitcher.js"></script>
	
	<!-- pickdate -->
    <script src="/vendor/pickadate/picker.js"></script>
    <script src="/vendor/pickadate/picker.time.js"></script>
    <script src="/vendor/pickadate/picker.date.js"></script>
	
	<!-- Pickdate -->
    <script src="/js/plugins-init/pickadate-init.js"></script>

</body>
</html>