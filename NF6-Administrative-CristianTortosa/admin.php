<?php
$db = new mysqli('localhost','root');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'serie') or die(mysqli_error($db));
if (isset($_GET['error']) && $_GET['error'] != '') {
  echo '<div id="error">' . $_GET['error'] . '</div>';
  }
?>
<html>
 <head>
  <title>serie</title>
  <style type="text/css">
   th { background-color: #999;}
   .odd_row { background-color: #EEE; }
   .even_row { background-color: #FFF; }
  </style>
 </head>
 <body>
 <table style="width:100%;">
  <tr>
   <th colspan="2">Serie<a href="serie.php?action=add">[ADD]</a></th>
  </tr>
<?php
$query = 'SELECT * FROM serie';
$result = mysqli_query($db, $query) or die (mysqli_error($db));
$odd = true;
while ($row = mysqli_fetch_assoc($result)) {
    echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
    $odd = !$odd; 
    echo '<td style="width:75%;">'; 
    echo $row['nombre_serie'];
    echo '</td><td>';
    echo ' <a href="serie.php?action=edit&id=' . $row['id_serie'] . '"> [EDIT]</a>'; 
    echo ' <a href="delete.php?type=serie&id=' . $row['id_serie'] . '"> [DELETE]</a>';
    echo '</td></tr>';
}
?>
  <tr>
    <th colspan="2">Tipo deSerie <a href="tiposerie.php?action=add"> [ADD]</a></th>
  </tr>
<?php
$query = 'SELECT * FROM tiposerie';
$result = mysqli_query($db, $query) or die (mysqli_error($db));
$odd = true;
while ($row = mysqli_fetch_assoc($result)) {
    echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
    $odd = !$odd; 
    echo '<td style="width: 25%;">'; 
    echo $row['tiposerie_label'];
    echo '</td><td>';
    echo ' <a href="tiposerie.php?action=edit&id=' . $row['tiposerie_id'] .
        '"> [EDIT]</a>'; 
    echo ' <a href="delete.php?type=tiposerie&id=' . $row['tiposerie_id'] .
        '"> [DELETE]</a>';
    echo '</td></tr>';
}
?>
  </table>
 </body>
</html>