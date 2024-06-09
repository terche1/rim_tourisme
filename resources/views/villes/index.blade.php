<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Styles CSS ici */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffc107; /* Jaune */
            color: #212529; /* Couleur de texte foncée */
            border: 1px solid #ffc107; /* Bordure jaune */
        }

        .btn-warning:hover {
            background-color: #e0a800; /* Jaune foncé au survol */
        }

        .btn-danger {
            background-color: #dc3545; /* Rouge */
            color: #fff; /* Couleur de texte blanc */
            border: 1px solid #dc3545; /* Bordure rouge */
        }

        .btn-danger:hover {
            background-color: #c82333; /* Rouge foncé au survol */
        }

        .btn-info {
            background-color: #6c757d; /* Gris foncé */
            color: #fff; /* Couleur de texte blanc */
            border: 1px solid #6c757d; /* Bordure gris foncé */
        }

        .btn-info:hover {
            background-color: #5a6268; /* Gris foncé au survol */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .alert {
            padding: 8px;
            margin-bottom: 16px;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
        }

        td img {
              max-width: 20%;
            height: auto;
            display: block;
            margin-top: 10px;
        }
        
         /* Style pour les icônes */
        .btn i {
            margin-right: 5px;
        }

        /* Style pour la barre de recherche */
        .search-container {
            margin-bottom: 20px;
            display: inline-block;
              border-radius: 8px;
            width: 45%;
            float: right; /* Alignez à droite */
            vertical-align: middle;
        }

        .search-container input[type=text] {
            padding: 8px;
            margin-top: 8px;
            font-size: 17px;
              border-radius: 8px;
            border: none;
            width: 80%;
            background: #f1f1f1;
        }
        

        .search-container button {
            padding: 10px 15px;
            margin-top: 8px;
            background:  #6c757d;
            font-size: 17px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            color: white;
        }

        .search-container button:hover {
            background: #007bff;
        }
    </style>
    <title>Liste des Villes</title>
</head>
<body>
    <div class="container">
      <a href="{{ route('home') }}" class="btn btn-primary mb-3">Home</a>
       <div class="search-container">
            <input type="text" placeholder="Rechercher une ville...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>
        <h1>Liste des Villes</h1>
        <a href="{{ route('villes.create') }}" class="btn btn-primary">Ajouter une Ville</a>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <br>
          <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Localisation</th>
                    <th>Distance</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($villesData as $ville)
                    <tr>
                        <td>{{ $ville['nom'] }}</td>
                        <td>{{ $ville['type'] }}</td>
                        <td><a href="{{ $ville['localisation'] }}">Voir sur la carte</a></td>
                        <td>{{ $ville['distance'] }}</td>
                        <td><img src="{{ $ville['photo'] }}" style="max-width: 50px;"></td> 
                        <td>
                            <a href="{{ route('villes.show', $ville['id']) }}" class="btn btn-info"><i class="fas fa-eye"></i> </a>
                            <a href="{{ route('villes.edit', $ville['id']) }}" class="btn btn-warning"><i class="fas fa-edit"></i> </a>
                            <form action="{{ route('villes.destroy', $ville['id']) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
