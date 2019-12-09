<?php
$db = new mysqli('localhost','root');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'serie') or die(mysqli_error($db));
if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            tiposerie_label
        FROM
            tiposerie
        WHERE
        tiposerie_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $tiposerie_label = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Tipo Serie</title>
 </head>
 <body>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=tiposerie"
   method="post">
   <table>
    <tr>
     <td>Tipo Serie nombre</td>
     <td><input type="text" name="tiposerie_label"
      value="<?php echo $tiposerie_label; ?>"/></td>
    </tr>
     
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="tiposerie_id">';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>