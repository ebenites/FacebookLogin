<?php
@session_start();
if(!isset($_SESSION['user'])){
    die('No conectado');
}

$user = $_SESSION['user'];
?>

<table border="1">
    <tr>
        <td rowspan="2"><img src="<?=$user->getPicture()->getUrl()?>"></td>
        <td><b><?=$user->getName()?></b></td>
    </tr>
    <tr>
        <td><?=$user->getProperty("email")?></td>
    </tr>
</table>
