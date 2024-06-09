<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 800px;
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
    </style>
</head>
<body>
    <div class="container">
    <a href="{{ route('users.index') }}" class="back-btn">Retour à la liste des utilisateurs</a>
        <h1>Détails de l'utilisateur</h1>
        <div class="detail">
            <label>Nom :</label>
            <p>{{ $user['Nom'] }}</p>
        </div>
        <div class="detail">
            <label>Prénom :</label>
            <p>{{ $user['Prénom'] }}</p>
        </div>
        <div class="detail">
            <label>Email :</label>
            <p>{{ $user['Email'] }}</p>
        </div>
        <div class="detail">
            <label>Pays :</label>
            <p>{{ $user['Pays'] }}</p>
        </div>
          <div class="detail">
            <label>Password :</label>
            <p>{{ $user['password'] }}</p>
        </div>
        <div class="detail">
            <label>Âge :</label>
            <p>{{ $user['Âge'] }}</p>
        </div>
        
    </div>
</body>
</html>
