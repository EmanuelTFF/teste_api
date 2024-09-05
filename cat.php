<?php
require 'APIController.php';
$api = new APIController();

$catImage = $api->getRandomCatImage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagem Aleatória de Gato</title>
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
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 15px;
            display: inline-block;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            text-align: center;
        }

        h1 {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }

        p {
            color: #ffffff;
            font-size: 18px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Imagem Aleatória de Gato</h1>
        <?php if ($catImage && isset($catImage[0]['url'])): ?>
            <img src="<?php echo $catImage[0]['url']; ?>" alt="Gato fofo">
        <?php else: ?>
            <p>Não foi possível obter uma imagem de gato.</p>
        <?php endif; ?>
        <a href="index.php"><p>Volte para o início</p></a>
    </div>
</body>
</html>
