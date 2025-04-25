<?php
$capitals = array(
    "usa" => "Washington D.C.",
    "england" => "London",
    "japan" => "Tokyo",
    "chile" => "Santiago de Chile",
    "spain" => "Madrid",
    "brazil" => "Sao Paulo",
    "argentina" => "Buenos Aires",
    "peru" => "Lima",
    "bolivia" => "La Paz",
    "mexico" => "Ciudad de Mexico",
    "south korea" => "Seoul",
    "india" => "New Delhi",
    "china" => "Beijing",
    "russia" => "Moscow",
    "germany" => "Berlin",
    "canada" => "Toronto",
);

$country = $_POST["country"];
$capital = $capitals[strtolower($country)];
$title_case_country = $country == "usa" ? "USA" : ucwords($country);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IACC - Dev</title>
</head>

<body>
    <header>
        <a href="../index.php"><button type="button">Back to index</button></a>
    </header>
    <form action="countries.php" method="post">
        <label>Enter a country's name</label><br>
        <label>Options:</label>
        <ul>
            <?php foreach (array_keys($capitals) as $key): ?>
                <li><?= $key == "usa" ? "USA" : ucwords($key); ?></li>
            <?php endforeach; ?>
        </ul>
        <input type="text" name="country">
        <br>
        <input type="submit" value="Enter">
        <br>
    </form>
    <?php if (isset($_POST["country"])): ?>
        <p><?= "{$title_case_country}'s capital is {$capital}.<br>"; ?></p>
    <?php endif; ?>
</body>

</html>