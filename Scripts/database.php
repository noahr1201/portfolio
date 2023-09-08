<?php
$host = "localhost";
$dbname = "089526_Noah";
$username = "089526";
$password = "Noahvanree";
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $conn = new PDO($dsn, $username, $password);
    echo "Connected to $dbname at $host successfully.";
} catch (PDOException $pe) {
    echo "Could not connect to the database $dbname :" . $pe->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['name'];
    $email = $_POST['email'];
    $bedrijf = $_POST['bedrijf'];
    $telefoon = $_POST['telefoon'];
    $bericht = $_POST['bericht'];
    $stmt = $conn->prepare("INSERT INTO Contact (naam, email, bedrijf, telefoon, bericht) VALUES (:naam, :email, :bedrijf, :telefoon, :bericht)");
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':bedrijf', $bedrijf);
    $stmt->bindParam(':telefoon', $telefoon);
    $stmt->bindParam(':bericht', $bericht);
    $stmt->execute();
}

$stmt = $conn->query("SELECT * FROM Contact");
?> 

<body>
    <h1>Verzonden!</h1>
    <ul>
        <p>Naam: <?php echo $naam ?></p>
        <p>Email: <?php echo $email ?></p>
        <p>Bedrijf: <?php echo $bedrijf ?></p>
        <p>Telefoon: <?php echo $telefoon ?></p>
        <p>Bericht: <?php echo $bericht ?></p>
    </ul>
    <h3>Bedankt voor uw bericht, ik zal zo snel mogelijk contact met u opnemen.</h3>
    <br>
    <h3>Met vriendelijke groet,</h3>
    <h3>Noah van Ree</h3>
    <br>
    <a href="../index.html">Terug naar de website</a>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        h1 {
            color: #000000;
            font-size: 50px;
            text-align: center;
        }

        p {
            color: red;
            font-size: 20px;
            text-align: center;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: #ffffff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        </style>
</body>