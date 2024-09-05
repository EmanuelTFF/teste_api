<?php
require 'APIController.php';
$api = new APIController();

$cryptoPrice = null;
$cryptoName = '';
$conversionRate = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cryptoName = $_POST['crypto'];
    $cryptoPrice = $api->getCryptoPrice($cryptoName);
    
    // Obter a taxa de conversão de USD para BRL
    $conversionData = $api->getConversionRate();
    if ($conversionData && isset($conversionData['rates']['BRL'])) {
        $conversionRate = $conversionData['rates']['BRL'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Preço de Criptomoeda</title>
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
        }

        select, input[type="submit"] {
            padding: 10px;
            border: 2px solid #ffffff;
            border-radius: 8px;
            width: 250px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 16px;
            margin: 10px;
        }

        input[type="submit"] {
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
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

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        select {
            background: linear-gradient(180deg, #000000, #1a1a1a);
        }

        select.selected {
            background-color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Consultar Preço de Criptomoeda</h1>
        <form method="post">
            <select name="crypto" id="cryptoSelect" onchange="handleSelectChange()" required>
                <option value="">Escolha uma criptomoeda</option>
                <option value="bitcoin">Bitcoin</option>
                <option value="ethereum">Ethereum</option>
                <option value="litecoin">Litecoin</option>
                <!-- Adicione outras criptomoedas conforme necessário -->
            </select>
            <input type="submit" value="Consultar">
        </form>
        <?php if ($cryptoPrice): ?>
            <h2>Preço Atual de <?php echo htmlspecialchars($cryptoName); ?>:</h2>
            <?php if (isset($cryptoPrice[$cryptoName]['usd'])): ?>
                <p>USD: $<?php echo $cryptoPrice[$cryptoName]['usd']; ?></p>
                <p>BRL: R$<?php echo number_format($cryptoPrice[$cryptoName]['usd'] * $conversionRate, 2, ',', '.'); ?></p>
            <?php else: ?>
                <p>Não foi possível obter o preço da criptomoeda.</p>
            <?php endif; ?>
        <?php endif; ?>
        <a href="index.php"><p>Volte para o início</p></a>
    </div>

    <script>
        function handleSelectChange() {
            var select = document.getElementById('cryptoSelect');
            if (select.value) {
                select.classList.add('selected');
            } else {
                select.classList.remove('selected');
            }
        }
    </script>
</body>
</html>
