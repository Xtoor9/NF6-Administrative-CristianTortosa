<?php
$db = new mysqli('localhost','root');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'serie') or die(mysqli_error($db));
?>
<style type="text/css">

#error { background-color: #600; border: 1px solid #FF0; color: #FFF;
text-align: center; margin: 10px; padding: 10px; }

</style>

<?php
if (isset($_GET['error']) && $_GET['error'] != '') {
echo '<div id="error">' . $_GET['error'] . '</div>';
}


if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            id_serie, nombre_serie, tipo_serie, ano_serie, episodios_serie, coste_serie
        FROM
            serie
        WHERE
        id_serie = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    
    $row = mysqli_fetch_assoc($result);
    extract($row);

    $nombre_serie =  $row['nombre_serie'];
    $ano_serie = $row['ano_serie'];
    $episodios_serie = $row['episodios_serie'];
    $tipo_serie = $row['tipo_serie'];
    $coste_serie = $row['coste_serie'];
} else {
    //set values to blank
    $nombre_serie = '';
    $ano_serie = date('Y');
    $episodios_serie = '';
    $tipo_serie = '';
    $coste_serie = '';
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Serie</title>
 </head>
 <body>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=serie"
   method="post">
   <table>
    <tr>
     <td>nombre serie</td>
     <td><input type="text" name="nombre_serie"
      value="<?php echo $nombre_serie; ?>"/></td>
    </tr>
     <tr>
     <td>episodios serie</td>
     <td><input type="text" name="episodios_serie"
      value="<?php echo $episodios_serie; ?>"/></td>
    </tr><tr>
     <td>tipo serie</td>
     <td><select name="tipo_serie">

<?php
// select the movie type information
$query = 'SELECT
        tiposerie_id, tiposerie_label
    FROM
        tiposerie
    ORDER BY
        tiposerie_label';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
// populate the select options with the results
while ($row = mysqli_fetch_assoc($result)) {
    //foreach ($row as $value) {
        if ($row['tiposerie_id'] == $tipo_serie) {
            echo '<option value="' . $row['tiposerie_id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['tiposerie_id'] .
            '">';
        }
        echo $row['tiposerie_label'] . '</option>';
   // }
}
?>
      </select></td>
    </tr><tr>
     <td>Coste serie</td>
     <td><select name="coste_serie">



<?php
// select the movie type information
$query = 'SELECT
        tiposerie_id, tiposerie_label
    FROM
        tiposerie
    ORDER BY
    tiposerie_label';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
// populate the select options with the results    


while ($row = mysqli_fetch_assoc($result)) {
    var_dump($row);
    //foreach ($row as $value) {
        if ($row['tiposerie_id'] == $tiposerie_id) {
            echo '<option value="' . $row['tiposerie_id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['tiposerie_id'] . '">';
        }
        echo $row['tiposerie_label'] . '</option>';
   // }
}
?>
      </select></td>
    </tr><tr>
     <td>Año serie</td>
     <td><select name="ano_serie">

    
<?php
// populate the select options with years
for ($yr = date("Y"); $yr >= 1970; $yr--) {
    if ($yr == $ano_serie) {
        echo '<option value="' . $yr . '" selected="selected">' . $yr .
            '</option>';
    } else {
        echo '<option value="' . $yr . '">' . $yr . '</option>';
    }
}
?>
      </select></td>
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="id_serie" />';
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