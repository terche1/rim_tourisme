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
  
</head>
<body>
    <div class="container">
        <a href="{{ route('villes.show', $villeId) }}" class="back-btn">Retour à la liste des lieux</a>
        <h1>Détails du Lieu</h1>
          <div class="detail">
            <label>Nom :</label>
            <p>{{ $lieu['nom'] }}</p>
        </div>
        <div class="detail">
            <label>Categorie :</label>
            <p>{{ $lieu['categorie'] }}</p>
        </div>
        <div class="detail">
            <label>Description :</label>
            <p>{{ $lieu['description'] }}</p>
        </div>
        <div class="detail">
            <label>Image :</label>
            <p><img src="{{ $lieu['photo'] }}"></p>
        </div>
         <div class="sous-collections">
          <div>
                <h2>Liste des Likes</h2>
                
                  <br>

                <table class="compact-table">
                    <thead>
                        <tr>
                            <th>ID utilisateur </th>
                            <th>Date et Heure</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($likes as $like)
                            <tr>
                                <td>{{ $like['userId'] }}</td>
                                <td>{{ $like['timestamp'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt action-btn"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          
            <div>
                <h2>Liste des Commentaires</h2>
                  <a href="#" class="btn btn-primary">Ajouter un commentaire</a>
                  <br>
                  <br>

                <table class="compact-table">
                    <thead>
                        <tr>
                            <th>ID utilisateur </th>
                            <th>Commentaire</th>
                            <th>Date et Heure</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment['userId'] }}</td>
                                <td>{{ $comment['comment'] }}</td>
                                <td>{{ $comment['timestamp'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt action-btn"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          
        </div>
    </div>
</body>
</html>