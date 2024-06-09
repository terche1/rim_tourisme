<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Styles CSS ici */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
    <title>Mettre à jour la Ville</title>
</head>
<body>

    <div class="container">
     <!-- Bouton de retour à la page Ville -->
        <a href="{{ route('villes.index') }}" class="btn btn-primary mb-3">Retour à la liste des Villes</a>
        <h1>Mettre à jour la Ville</h1>
        <form action="{{ route('villes.update', $ville['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ $ville['nom'] }}" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control" value="{{ $ville['type'] }}" required>
            </div>
            <div class="form-group">
                <label for="localisation">Localisation</label>
                <input type="text" name="localisation" id="localisation" class="form-control" value="{{ $ville['localisation'] }}" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="text" name="photo" id="photo" class="form-control" value="{{ $ville['photo'] }}" required>
            </div>
            <div class="form-group">
                <label for="distance">Distance</label>
                <input type="text" name="distance" id="distance" class="form-control" value="{{ $ville['distance'] }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
