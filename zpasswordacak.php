<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generator Password </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>🔐 Generator Password </h2>
    <form method="POST">
        <label>Password awal:</label><br>
        <input type="text" name="password_awal" placeholder="Contoh: sigma123" required><br>
        <input type="submit" value="Generate Password ">
    </form>

    <?php
    function generateConsistentPassword($inputPassword) {
        $minLength = 8;
        $maxLength = 22;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';

        // Buat hash dari input password sebagai seed
        $seed = hexdec(substr(hash('sha256', $inputPassword), 0, 8));
        mt_srand($seed);

        // Tentukan panjang random antara 8 - 22, tapi tetap konsisten
        $finalLength = mt_rand($minLength, $maxLength);
        $generated = '';

        for ($i = 0; $i < $finalLength; $i++) {
            $generated .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $generated;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $input = htmlspecialchars($_POST["password_awal"]);
        $generated = generateConsistentPassword($input);
        echo "<div class='result'>
                <strong>Password Awal:</strong> $input <br>
                <strong>Password Konsisten:</strong> $generated
              </div>";
    }
    ?>
</div>

</body>
</html>
