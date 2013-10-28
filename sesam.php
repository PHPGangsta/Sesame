<?
require 'init.php';

if (isset($_SESSION['code'])) {
    $randomString = $_SESSION['code'];

    $query = $pdo->prepare("SELECT LoggedInUserId FROM Sesam WHERE SesamRandomCode = :sesamRandomCode");
    $query->execute(array(':sesamRandomCode' => $randomString));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result['LoggedInUserId'] !== null) { ?>
        Logged in UserId <?=$result['LoggedInUserId'] ?><br/>
        <a href="logout.php">Logout now</a>
    <?  exit;
    }
} else {
    $randomString = rand(100000000, 999999999);
    $_SESSION['code'] = $randomString;

    $query = $pdo->prepare("INSERT INTO Sesam (SesamId, SesamRandomCode) VALUES (NULL, '".$randomString."')");
    $result = $query->execute();
}

// https://github.com/shostelet/phpqrcode
QRcode::png('http://sesam.localhost/login.php?code='.$randomString, 'filename.png', QR_ECLEVEL_H, 4); // creates code image and outputs it directly into browser
?>

<meta http-equiv="refresh" content="5">
Scan this QR-Code with your smartphone and login on that page. You will be logged in
here after successful login on the smartphone.<br/>
<br/>
<img src="filename.png">
