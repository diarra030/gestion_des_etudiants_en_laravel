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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/style.css">


    <style>
        @media print {
            /* Cachez les éléments non nécessaires lors de l'impression */
            .cacher {
                display: none;
            }
            /* Ajustez le style pour l'impression */
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
        }
        </style>
	

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

        <!--**********************************
            Sidebar start
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
                            <li><a href="/ajouter-etudiant">Ajouter un Etudiant</a></li>
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
                            <h4>A propos de l'Etudiant</h4>
                        </div>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                            @endif
                
                                @if (session('error'))
                          <div class="alert alert-danger">
                          {{session('error')}}
                          </div>
                          @endif
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Etudiant</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">a propos de l'etudiant</a></li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-xl-3 col-xxl-4 col-lg-4">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="text-center p-3 overlay-box" style="background-image: url(/images/big/img1.jpg);">
										<div class="profile-photo">
											<img src="images/profile/profile.png" width="100" class="img-fluid rounded-circle" alt="">
                                            @if($etudiant->photo)
                                            <img src="{{ Storage::url($etudiant->photo) }}" alt="Photo de {{ $etudiant->nom }}" width="100" class="img-fluid rounded-circle">
                                            @else
                                            <img src="{{ asset('images/default-photo.jpg') }}" alt="Photo par défaut" width="100" class="img-fluid rounded-circle">
                                            @endif
										</div>
										<h3 class="mt-3 mb-1 text-white">
                                            {{ $etudiant->nom }} {{ $etudiant->prenom }}
                                        </h3>
									</div>
									
									<div class="card-footer text-center border-0 mt-0">								
										<a href="/update-etudiant/{{$etudiant->id}}" class="btn btn-primary btn-rounded px-4 cacher">Modifier</a>
										<button onclick="window.print()" class="cacher btn btn-secondary">Imprimer</button>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h2 class="card-title">about me</h2>
									</div>
									<div class="card-body pb-0">
					
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex px-0 justify-content-between">
												<strong>Genre</strong>
												<span class="mb-0">Male</span>
											</li>
											<li class="list-group-item d-flex px-0 justify-content-between">
												<strong>Classe:</strong>
												<span class="mb-0">{{ $etudiant->classe }}</span>
											</li>
											<li class="list-group-item d-flex px-0 justify-content-between">
												<strong>Email</strong>
												<span class="mb-0">info@example.com</span>
											</li>
											<li class="list-group-item d-flex px-0 justify-content-between">
												<strong>Téléphone</strong>
												<span class="mb-0">+01 123 456 7890</span>
											</li>
										</ul>
									</div>
									
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-xl-9 col-xxl-8 col-lg-8">
						<div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">A propos de l'Etudiant</a></li>
                                            <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link">Matières</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="about-me" class="tab-pane fade active show">
                                                <div class="profile-personal-info pt-4">
                                                    <h4 class="text-primary mb-4">Information Personnel</h4>
                                                    <div class="row mb-4">
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                            <h5 class="f-w-500">Nom <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{ $etudiant->nom }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                            <h5 class="f-w-500">Prénom <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{ $etudiant->prenom }}</span>
                                                        </div>
                                                    </div>
													<div class="row mb-4">
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                            <h5 class="f-w-500">Classe <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{ $etudiant->classe }}</span>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
												
                                            
												<div class="profile-about-me">
                                                    <div class="border-bottom-1 pb-4">
                                                        <h2>Matieres de l'etudiant</h2>
        <table class="table" id="example1">
            <thead>
                <tr>
                    <th>Nom Matières</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etudiant->matieres as $matiere)
               
                <tr>
                    <td>{{ $matiere->nom }}</td>
                    <td>
                        <form action="{{ route('etudiants.removeMatiere', [$etudiant->id, $matiere->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-rounded">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
                                                    </div>
                                                </div>
                                            </div>
											<div id="my-posts" class="tab-pane fade">
                                                <div class="my-post-content pt-3">
                                                    
                                                    
                                                    <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                    
                                                        <a class="post-title" href="javascript:void()">
                                                            <h4>Attribuer des matières</h4>
                                                        </a>
                                                        <form action="{{ route('etudiants.assignMatiere', $etudiant->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <label for="matieres">Sélectionnez une matière :</label>
                                                            <select name="matieres[]" id="matieres" >
                                                                @foreach ($allMatieres as $matiere)
                                                                    <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                                                                @endforeach
                                                            </select>
                                                            <button type="submit" class="btn btn-success btn-rounded">Attribuer</button>
                                                        </form>
                                                        
                                                    </div>
                                                    
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      new DataTable('#example1');
    </script>
	
</body>
</html>