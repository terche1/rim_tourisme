<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Ville</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styles CSS ici */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 5000px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .detail {
            margin-bottom: 20px;
        }

        .detail label {
            font-weight: bold;
        }

        .detail p {
            margin-top: 0;
        }

        .detail img {
            max-width: 20%;
            height: auto;
            display: block;
            margin-top: 10px;
        }

        .back-btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
        }

        .back-btn:hover {
            background-color: #0056b3;
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
     .sous-collections {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    .compact-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px; /* Smaller font size for a more compact look */
    }

    .compact-table th, .compact-table td {
        border: 1px solid #ddd;
        padding: 4px 8px; /* Smaller padding for more compact cells */
        text-align: left;
    }

    .compact-table th {
        background-color: #f2f2f2;
    }

    .compact-table img {
        max-width: 50px;
        height: auto;
    }

    .action-btn {
        font-size: 14px;
        padding: 2px 5px;
    }

    .btn {
        padding: 5px 10px;
        margin: 2px;
    }
      .description-column {
        max-width: 200px; /* Set a maximum width for the description column */
        word-wrap: break-word; /* Break long words to fit the width */
        white-space: pre-wrap; /* Preserve white spaces and line breaks */
    }

        /* Style pour les icônes */
  
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
            background: #6c757d;
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
     <script>
        // Fonction pour filtrer les sous-collections
      function filterCollections() {
    var input = document.getElementById('searchInput');
    var filter = input.value.toLowerCase();
    var tables = document.getElementsByTagName('table');

    for (var i = 0; i < tables.length; i++) {
        var rows = tables[i].getElementsByTagName('tr');

        for (var j = 0; j < rows.length; j++) {
            var cells = rows[j].getElementsByTagName('td');
            var rowText = "";

            for (var k = 0; k < cells.length; k++) {
                rowText += cells[k].textContent || cells[k].innerText;
            }

            if (rowText.toLowerCase().indexOf(filter) > -1) {
                rows[j].style.display = "";
                found = true;
            } else {
                rows[j].style.display = "none";
            }
        }

        // Si aucun élément correspondant n'est trouvé, cacher la table
        if (found) {
            tables[i].style.display = "table";
        } else {
            tables[i].style.display = "none";
        }
    }
}
    </script>
</head>
<body>
    <div class="container">
        <a href="{{ route('villes.index') }}" class="back-btn">Retour à la liste des villes</a>
       <div class="search-container">
            <input type="text" id="searchInput" onkeyup="filterCollections()" placeholder="Rechercher...">
            <button type="submit" onclick="filterCollections()"><i class="fa fa-search"></i></button>
        </div>
        <h1>Détails de la Ville</h1>
        <div class="detail">
            <label>Nom :</label>
            <p>{{ $ville['nom'] }}</p>
        </div>
        <div class="detail">
            <label>Type :</label>
            <p>{{ $ville['type'] }}</p>
        </div>
        <div class="detail">
            <label>Localisation :</label>
            <p><a href="{{ $ville['localisation'] }}">Voir sur la carte</a></p>
        </div>
        <div class="detail">
            <label>Distance :</label>
            <p>{{ $ville['distance'] }}</p>
        </div>
        <div class="detail">
            <label>Image :</label>
            <p><img src="{{ $ville['photo'] }}"></p>
        </div>
         <div class="sous-collections">
            <div>
                <h2>Hotels</h2>
                  <a href="{{ route('hotels.create', $id) }}"  class="btn btn-primary">Ajouter un hotel</a>
                  <br>
                  <br>

                <table class="compact-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Localisation</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hotels as $hotel)
                            <tr>
                                <td>{{ $hotel['nom'] }}</td>
                                <td>{{ $hotel['categorie'] }}</td>
                                  <td>{{ $hotel['localisation'] }}</td>
                                <td><img src="{{ $hotel['photo'] }}" alt="Image de {{ $hotel['nom'] }}" style="max-width: 50px;"></td>
                                <td>
                                    <a href="{{ route('hotels.show', [$id, $hotel['id']]) }}" class="btn btn-info"><i class="fas fa-eye action-btn"></i></a>
                                    <a href="{{ route('hotels.edit', [$id, $hotel['id']]) }}" class="btn btn-warning"><i class="fas fa-edit action-btn"></i></a>
                                      <form action="{{ route('hotels.destroy', [$id, $hotel['id']]) }}"  method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <h2>Lieux</h2>
                  <a href="{{ route('villes.lieux.create', $id) }}" class="btn btn-primary">Ajouter un lieu</a>
                  <br>
                  <br>

                <table class="compact-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lieux as $lieu)
                            <tr>
                                <td>{{ $lieu['nom'] }}</td>
                                <td>{{ $lieu['categorie'] }}</td>
                                <td class="description-column">{{ $lieu['description'] }}</td>
                                <td><img src="{{ $lieu['photo'] }}" alt="Image de {{ $lieu['nom'] }}" style="max-width: 50px;"></td>
                                <td>
                                      <a href="{{ route('villes.lieux.show',[$id, $lieu['id']]) }}" class="btn btn-info"><i class="fas fa-eye action-btn"></i></a>
                                    <a href="{{ route('villes.lieux.edit', [$id,  $lieu['id']]) }}" class="btn btn-warning"><i class="fas fa-edit action-btn"></i></a>
                        <form action="{{ route('villes.lieux.destroy', [$id,  $lieu['id']]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt action-btn"></i></button>
                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <h2>Restaurants</h2>
              <a href="{{ route('restaurants.create', $id) }}" class="btn btn-primary">Ajouter un restaurant</a>

                  <br>
                  <br>
                <table class="compact-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Localisation</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurants as $restaurant)
                            <tr>
                                <td>{{ $restaurant['nom'] }}</td>
                                <td class="description-column">{{ $restaurant['description'] }}</td>
                                <td>{{ $restaurant['localisation'] }}</td>
                                <td><img src="{{ $restaurant['photo'] }}" alt="Image de {{ $restaurant['nom'] }}" style="max-width: 50px;"></td>
                                <td>  
                    <a href="{{ route('restaurants.show', [$id, $restaurant['id']]) }}" class="btn btn-info"><i class="fas fa-eye action-btn"></i></a>
                    <a href="{{ route('restaurants.edit', [$id, $restaurant['id']])}}" class="btn btn-warning"><i class="fas fa-edit action-btn"></i></a>
                    <form action="{{ route('restaurants.destroy', [$id,  $restaurant['id']]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt action-btn"></i></button>
                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</body>
</html>