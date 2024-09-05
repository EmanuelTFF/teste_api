<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Países</title>
    <style>
  body {
    margin: 0;
    padding: 0;
    background: linear-gradient(180deg, #000000, #1a1a1a);
    color: #ffffff;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            display: inline-block;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            margin-top: 50px;
        }
        h1 {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }
        input[type="text"] {
            padding: 10px;
            border: 2px solid #ffffff;
            border-radius: 8px;
            width: 250px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        p {
            color: #ffffff;
            font-size: 18px;
        }
        .info-header {
            color: #ffffff;
            font-size: 24px;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Consulta de Capital de Países</h1>
        <form action="country.php" method="post">
            <input type="text" name="country" placeholder="Digite o nome do país" required>
            <input type="submit" value="Buscar">
        </form>

        <?php
        require 'APIController.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['country'])) {
                $countryName = htmlspecialchars(trim($_POST['country']));
                $api = new APIController();
                $countryInfo = $api->getCountryInfo($countryName);

                if ($countryInfo && isset($countryInfo[0]['capital'])) {
                    echo "<h2>Informações sobre $countryName:</h2>";
                    echo "<p>A capital de $countryName é " . $countryInfo[0]['capital'][0] . ".</p>";
                } else {
                    echo "<h2>Informações sobre $countryName:</h2>";
                    echo "<p>Não foi possível obter informações sobre $countryName. Verifique se o nome do país está correto e tente novamente.</p>";
                }
            } else {
                echo "<p>Por favor, insira o nome do país ( em inglês ).</p>";
            }
        }
        ?>
        <a href="index.php"><p>Volte para o inicio</p></a>
    </div>
</body>
</html>
