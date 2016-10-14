<?php
 $_GET['DATO']="VOLVI DE LA URL DEL USUARIO";
 //if( !isset($_SESSION['ID_USUARIO']) )
 //    header("Location: /");
if(isset($_POST['BUSQUEDA_PROYECTO'] ))
{      echo "LO QUE TENGO DE BUSQUEDA ES ".$_POST['BUSQUEDA_PROYECTO'];
}
session_start();
session_unset();
session_destroy();
?>