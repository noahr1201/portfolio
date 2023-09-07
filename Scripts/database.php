<?php
$host = "localhost";
$dbname = "Noah";
$username = "89526";
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
        Naam: <li><?php echo $_POST["name"]; ?></li>
        Email: <li><?php echo $_POST["email"]; ?></li>
        Adres: <li><?php echo $_POST["adres"]; ?></li>
        Huisnummer: <li><?php echo $_POST["huisnummer"]; ?></li>
        Postcode: <li><?php echo $_POST["postcode"]; ?></li>
        Provincie: <li><?php echo $_POST["provincie"]; ?></li>
        Bericht: <li><?php echo $_POST["bericht"]; ?></li>
    </ul>
    <p>Bedankt voor uw bericht, we zullen zo snel mogelijk contact met u opnemen.</p>
</body>