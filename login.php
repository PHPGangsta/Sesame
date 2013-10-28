<?
require 'init.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] == 'user1' && $_POST['password'] == 'pwd1') {
        $statement = $pdo->prepare("UPDATE Sesam SET LoggedInUserId = :loggedInUserId WHERE SesamRandomCode = :sesamRandomCode");
        $statement->execute(array(':loggedInUserId' => 1, ':sesamRandomCode' => $_GET['code']));

        echo 'You can close this browser now, you will be logged in in the other browser.';
        exit;
    } else {
        echo 'Password wrong';
    }
}
?>

<form action="login.php?code=<?=$_GET['code'] ?>" method="POST">
    <input type="text" name="username" value="user1">
    <input type="password" name="password" value="pwd1">
    <input type="submit" name="submit" value="Login">
</form>
