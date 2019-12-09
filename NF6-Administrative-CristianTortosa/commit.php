<?php
$db = new mysqli('localhost','root');
if($db->connect_errno){
    echo "error";
}
mysqli_select_db($db,'serie') or die(mysqli_error($db));
?>
<html>
 <head>
  <title>Commit</title>
 </head>
 <body>
<?php
switch ($_GET['action']) {
case 'add':
    switch ($_GET['type']) {
    
        case 'serie':
            $error = array();
     
                    if(empty($_POST['nombre_serie'])){
                        $error[] = urlencode('Introduce el nombre del coche.');
                    }
                    if(is_numeric($_POST['nombre_serie'])){
                        $error[] = urlencode('El nombre del coche no puede ser un numero.');
                    }
                    $nombre = $_POST['nombre_serie'];
                    $minombre = $nombre;
                    $findme = '<';
                    $pos = strpos($minombre, $findme);
                    if($pos !== false){
                        $error[] = urlencode('El nombre del coche no puede contener el signo < !!.');
                    }
                    $minombre = $nombre;
                    $findme = '>';
                    $pos = strpos($minombre, $findme);
                    if($pos !== false){
                        $error[] = urlencode('El nombre del coche no puede contener el signo > !!.');
                    }
    
                    if(empty($_POST['episodios_serie'])){
                        $error[] = urlencode('Introduce la marca del coche.');
                    }
                    if(!is_numeric($_POST['episodios_serie'])){
                        $error[] = urlencode('La marca del coche no puede ser un numero.');
                    }
                    $nombre = $_POST['episodios_serie'];
                    $minombre = $nombre;
                    $findme = '<';
                    $pos = strpos($minombre, $findme);
                    if($pos != false){
                        $error[] = urlencode('La marca del coche no puede contener el signo < !!.');
                    }
                    $minombre = $nombre;
                    $findme = '>';
                    $pos = strpos($minombre, $findme);
                    if($pos != false){
                        $error[] = urlencode('La marca del coche no puede contener el signo > !!.');
                    }
    
                    if(empty($error)){
                        
                            $query = "INSERT INTO
                            serie
                                (nombre_serie ,tipo_serie ,ano_serie ,episodios_serie , coste_serie)
                            VALUES
                                ('" . $_POST['nombre_serie'] . "',
                                 " . $_POST['tipo_serie'] . ",
                                 " . $_POST['ano_serie'] . ",
                                 '" . $_POST['episodios_serie'] . "',
                                 " . $_POST['coste_serie'] .");";
                        
                    }else{
                        header('Location: serie.php?action=add&id='.$_POST['serie_id'].'&error='.join($error, urlencode('<br/>')));
                    }
            
                     if(empty($error)){
                        if (isset($query)) {
                            $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        }
                    }else{
                        header('Location: serie.php?action=add&id='.$_POST['serie_id'].'&error='.join($error, urlencode('<br/>')));
                    }
            break;



        
    case 'tiposerie':
        $error = array();
            if(empty($_POST['tiposerie_label'])){
                $error[] = urlencode('Introduce el nombre del coche.');
            }
            if(is_numeric($_POST['tiposerie_label'])){
                $error[] = urlencode('El nombre del coche no puede ser un numero.');
            }
            $nombre = $_POST['tiposerie_label'];
            $minombre = $nombre;
            $findme = '<';
            $pos = strpos($minombre, $findme);
            if($pos !== false){
                $error[] = urlencode('El nombre del coche no puede contener el signo < !!.');
            }
            $minombre = $nombre;
            $findme = '>';
            $pos = strpos($minombre, $findme);
            if($pos !== false){
                $error[] = urlencode('El nombre del coche no puede contener el signo > !!.');
            }
            if(empty($error)){
                if (isset($query)) {
                    $query = "INSERT INTO
                tiposerie
                    (tiposerie_label)
                VALUES
                    ('" . $_POST['tiposerie_label'] . "');";
                }
            }else{
                header('Location: tiposerie.php?action=add&id='.$_POST['tiposerie_id'].'&error='.join($error, urlencode('<br/>')));
            }

            if(empty($error)){
                if (isset($query)) {
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                }
            }else{
                header('Location: tiposerie.php?action=add&id='.$_POST['tiposerie_id'].'&error='.join($error, urlencode('<br/>')));
            }
            break;














   
case 'edit':
    switch ($_GET['type']) {
    case 'serie':
        $query = "UPDATE serie SET
                nombre_serie = '" . $_POST['nombre_serie'] . "',
                ano_serie = " . $_POST['ano_serie'] . ",
                episodios_serie = '" . $_POST['episodios_serie'] . "',
                tipo_serie = " . $_POST['tipo_serie'] . ",
                coste_serie = " . $_POST['coste_serie']."
            WHERE
                id_serie = " . $_POST['id_serie'] . ";";
        break;
    case 'tiposerie':
            $query = "UPDATE tiposerie SET
            tiposerie_label = '" . $_POST['tiposerie_label'] . "'
        WHERE
            tiposerie_id = " . $_POST['tiposerie_id'] . ";";
    break;
    }
    break;
}
}


   echo "<a href='admin.php'>Volver</a>";

?>
  
 </body>
</html>