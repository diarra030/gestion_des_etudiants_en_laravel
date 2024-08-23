<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edumin - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.png">
    <link href="/css/style.css" rel="stylesheet">

</head>

<body style="background-image: url('{{ asset("images/abstract-timekeeper.png") }}'); background-size:cover;
  background-position: center; background-repeat: no-repeat; height: 100vh;">
    <div class="authincation h-100" style="tran">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Connecter Vous</h4>
                                    @if (session('status'))
                                      <div class="alert alert-success text-white">
                                           {{session('status')}}
                                        </div>
                                    @endif
                
                                     @if (session('error'))
                                       <div class="alert alert-danger text-white">
                                             {{session('error')}}
                                        </div>
                                      @endif

                                    <form action="/login/traitement" method="post">
                                      @csrf
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                                            <div class="invalid-feedback">
                                              Champs obligatoire
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                            <div class="invalid-feedback">
                                              Champs obligatoire
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Se Connecter</button>
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


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="/vendor/global/global.min.js"></script>
	<script src="/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="/js/custom.min.js"></script>
    <script src="/js/dlabnav-init.js"></script>

</body>

</html>