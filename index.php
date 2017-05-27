<?
require 'init.php';

if (isset($_SESSION['code'])) {
    $randomString = $_SESSION['code'];

    $query = $pdo->prepare("SELECT LoggedInUserId FROM Sesame WHERE SesameRandomCode = :sesameRandomCode");
    $query->execute(array(':sesameRandomCode' => $randomString));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result['LoggedInUserId'] !== null) { ?>
        Logged in UserId <?=$result['LoggedInUserId'] ?><br/>
        <a href="logout.php">Logout now</a>
    <?  exit;
    }
} else {
    $randomString = rand(100000000, 999999999);
    $_SESSION['code'] = $randomString;

    $query = $pdo->prepare("INSERT INTO Sesame (SesameId, SesameRandomCode) VALUES (NULL, '".$randomString."')");
    $result = $query->execute();
}

// https://github.com/shostelet/phpqrcode
QRcode::png('https://sesame.phpgangsta.de/login.php?code='.$randomString, 'temp/filename.png', QR_ECLEVEL_H, 4);
?>

<meta http-equiv="refresh" content="5">
Scan this QR-Code with your smartphone and login on that page. You will be logged in
here after successful login on the smartphone.<br/>
<br/>
<img src="temp/filename.png"><br/>
<br/>
If you want to try it in your browser, open this URL:
<a href="https://sesame.phpgangsta.de/login.php?code=<?=$randomString ?>" target="_blank">https://sesame.phpgangsta.de/login.php?code=<?=$randomString ?></a>
