<?php
$db = new mysqli('localhost','root');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'serie') or die(mysqli_error($db));


if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
    case 'serie':
        echo 'Are you sure you want to delete this serie?<br/>';
        break;
    case 'tiposerie':
        echo 'Are you sure you want to delete this configuration?<br/>';
        break;
    } 
    echo '<a href="' . $_SERVER['REQUEST_URI'] . '&do=1">yes</a> '; 
    echo 'or <a href="admin.php">no</a>';
} else {
    switch ($_GET['type']) {
    case 'tiposerie':
        $query = 'UPDATE tiposerie SET
                tiposerie_label = 0 
            WHERE
            tiposerie_id = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $query = 'DELETE FROM tiposerie
            WHERE
                tiposerie_id = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<p style="text-align: center;">Your person has been deleted.
<a href="admin.php">Return to Index</a></p>
<?php
        break;
    case 'serie':
        $query = 'DELETE FROM serie 
            WHERE
                id_serie = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<p style="text-align: center;">Your car has been deleted.
<a href="admin.php">Return to Index</a></p>
<?php
        break;
    }
}
?>