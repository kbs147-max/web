<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php
require_once('/classes/facebook/facebook.php');
require_once('/classes/facebook/User.php');
session_start();

if (isset($_POST['postAsMe'])) {
    $params = array("message" => $_POST['text'], "access_token" => $_SESSION['access_token']);
    Facebook::cURL('post', 'https://graph.facebook.com/me/feed/', $params);
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: http://localhost');
}
if (isset($_SESSION['code'])) {
    if (!isset($_SESSION['facebook'])) {
        $_SESSION['facebook'] = new Facebook();
        $facebook = $_SESSION['facebook'];
        $_SESSION['access_token'] = $facebook->get_access_token($_SESSION['code']);
        $user = $facebook->getUser($_SESSION['access_token']);
    } else {
        $facebook = $_SESSION['facebook'];
        $user = $facebook->getUser($_SESSION['access_token']);
    }


} else header('Location: /');

?>
<div>
    <nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom: 0">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/profile.php">Facebookapp</a>
            </div>
            <ul class="nav navbar-nav">
                <li style = "width: 200px" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $user->getFullName();?>
                        <span class="caret"></span></a>
                        <ul style = "width: 200px" class="dropdown-menu">
                            <li><?php $user->printPicture();?></li>
                            <li>&nbsp; Дата рождения: <?php echo $user->getBirthday();?></li>
                            <li>&nbsp; Пол: <?php echo $user->getGender();?></li>
                            <li><a href="<?php echo $user->getUserLink();?>">Ссылка на Facebook</a></li>
                        </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo '?logout=true'; ?>"> <span class="glyphicon glyphicon-log-out"></span>Выйти</a>
                </li>
            </ul>
        </div>
    </nav>
</div>




<?php
echo '<p class="h2 groupName" style="color: whitesmoke"> Запостить себе на стену';
echo '<form action ="" method = "post">';
echo '<div class = "center-block" style = "width: 700px; margin-bottom: 20px;">';
echo '<input type="text" class="form-control" name = "text" id="text">';
echo '<button type="submit" name = "postAsMe" class="btn btn-default">Submit</button></div></form>';
?>

</div>
</body>
<script src="jquery-3.2.0.min.js"></script>
<script src='html.js'></script>
<script src='bootstrap.min.js'></script>
</html>
