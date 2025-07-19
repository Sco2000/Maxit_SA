<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .custom-input {
            background-color: #2d2d2d;
            border: 1px solid #404040;
            transition: all 0.3s ease;
        }
        
        .custom-input:focus {
            border-color: #4ade80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }
        
        .custom-button {
            background-color: #4ade80;
            transition: all 0.3s ease;
        }
        
        .custom-button:hover {
            background-color: #22c55e;
            transform: translateY(-1px);
        }
        
        .card {
            background-color: #2d2d2d;
            border: 1px solid #404040;
            border-radius: 8px;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
  <?php echo $containForLayout;?>
 
</body>
</html>