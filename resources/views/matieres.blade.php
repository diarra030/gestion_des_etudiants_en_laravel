
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ajouter une Matière</title>
</head>
<body>
    

  
    <div class="row">
        <div class="card col-md-4 col-11 mx-auto">
          <div class="card-body">
            <h1>Ajouter une Matière</h1>
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
            <form action="/matieres/traitement" method="POST" class="row g-3 mx-auto">
                @csrf
                <div class="col-12 d-grid gap-2">
                    <label for="nom">Nom de la Matière :</label>
                <input type="text" name="nom" id="nom" required>
                </div>
                <div class="col-12 d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  </div>
            </form>
          </div>
        </div>
      </div>
    <a href="/liste-etudiant">Retour à la liste des étudiants</a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>