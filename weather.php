<?php
require 'APIController.php';
$api = new APIController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = $_POST['city'];
    $weather = $api->getWeather($city);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Clima</title>
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
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 300px;
        }
        h1 {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
            margin-bottom: 20px;
        }
        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type="text"] {
            padding: 10px;
            border: 2px solid #ffffff;
            border-radius: 8px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 16px;
            margin-bottom: 10px;
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
            margin-bottom: 20px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .result {
            text-align: center;
        }
        p {
            color: #ffffff;
            font-size: 18px;
            margin: 10px 0;
        }
        .info-header {
            color: #ffffff;
            font-size: 24px;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
            margin-bottom: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Consultar Clima</h1>
        <form method="post">
            <input type="text" name="city" placeholder="Digite o nome da cidade" required>
            <input type="submit" value="Consultar">
        </form>
        <?php if (isset($weather)): ?>
            <div class="result">
                <h2 class="info-header">Temperatura em <?php echo htmlspecialchars($city); ?>:</h2>
                <?php if ($weather && isset($weather['main']['temp'])): ?>
                    <p><?php echo $weather['main']['temp']; ?>°C</p>
                <?php else: ?>
                    <p>Não foi possível obter a temperatura.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <a href="index.php"><p>Voltar para o início</p></a>
    </div>
</body>
</html>
