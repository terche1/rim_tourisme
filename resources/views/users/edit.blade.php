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
    <title>Mettre à jour l'utilisateur</title>
</head>
<body>

    <div class="container">
     <!-- Bouton de retour à la page utilisateurs -->
        <a href="{{ route('users.index') }}" class="btn btn-primary mb-3">Retour à la liste des utilisateurs</a>
        <h1>Mettre à jour l'utilisateur</h1>
        <form action="{{ route('users.update', $user['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="Nom" id="Nom" class="form-control" value="{{ $user['Nom'] }}" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="Prénom" id="Prénom" class="form-control" value="{{ $user['Prénom'] }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="Email" id="Email" class="form-control" value="{{ $user['Email'] }}" required>
            </div>
            <div class="form-group">
                <label for="pays">Pays</label>
                <input type="text" name="Pays" id="Pays" class="form-control" value="{{ $user['Pays'] }}" required>
            </div>
              <div class="form-group">
                <label for="pays">Password</label>
                <input type="text" name="password" id="password" class="form-control" value="{{ $user['password'] }}" required>
            </div>
            <div class="form-group">
                <label for="age">Âge</label>
                <input type="number" name="Âge" id="Âge" class="form-control" value="{{ $user['Âge'] }}" required>
            </div>
            <!-- Ajoutez ici les autres champs de l'utilisateur si nécessaire -->
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
