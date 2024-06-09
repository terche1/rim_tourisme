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
    <title>Modifier un restaurant</title>
</head>
<body>

    <div class="container">
     
    
          <h1>Modifier un Restaurant</h1>
              
    <a href="{{ route('villes.show', $villeId) }}" class="btn btn-primary mb-3">Retour à la liste des restaurants</a>
<br>
<br>
  <form action="{{ route('restaurants.update', ['villeId' => $villeId, 'restaurantId' => $restaurantId]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $restaurant['nom'] }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $restaurant['description'] }}</textarea>
        </div>
        <div class="form-group">
            <label for="localisation">Localisation</label>
            <input type="text" name="localisation" class="form-control" value="{{ $restaurant['localisation']->latitude() . ', ' . $restaurant['localisation']->longitude() }}" required>

        </div>
        <div class="form-group">
            <label for="photo">Photo (URL)</label>
            <input type="text" name="photo" class="form-control" value="{{ $restaurant['photo'] }}">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
