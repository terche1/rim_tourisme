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
            max-width: 900px;
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
            background-color: #ffc107;
            color: #212529;
            border: 1px solid #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: 1px solid #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-info {
            background-color: #6c757d;
            color: #fff;
            border: 1px solid #6c757d;
        }

        .btn-info:hover {
            background-color: #5a6268;
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
    <title>Liste des Utilisateurs</title>
</head>
<body>
    <div class="container">
      <a href="{{ route('home') }}" class="btn btn-primary mb-3">Home</a>
       <div class="search-container">
            <input type="text" id="searchInput" placeholder="Rechercher une ville...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>
        <h1>Liste des Utilisateurs</h1>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Pays</th>
                      <th>Password</th>
                    <th>Âge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['Nom'] }}</td>
                        <td>{{ $user['Prénom'] }}</td>
                        <td>{{ $user['Email'] }}</td>
                        <td>{{ $user['Pays'] }}</td>
                          <td>{{ $user['password'] }}</td>
                        <td>{{ $user['Âge'] }}</td>
                        <td>
                            <a href="{{ route('users.show', $user['userId']) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('users.edit', $user['userId']) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('users.destroy', $user['userId']) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('searchInput');
            input.addEventListener('input', function () {
                const searchText = input.value.toLowerCase();
                const rows = document.querySelectorAll('.table tbody tr');

                rows.forEach(row => {
                    const nom = row.cells[0].innerText.toLowerCase();
                    const prenom = row.cells[1].innerText.toLowerCase();
                    const email = row.cells[2].innerText.toLowerCase();
                    const pays = row.cells[3].innerText.toLowerCase();
                    const age = row.cells[4].innerText.toLowerCase();

                    if (nom.includes(searchText) || prenom.includes(searchText) || email.includes(searchText) || pays.includes(searchText) || age.includes(searchText)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
