<?php
function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE,$username)

{
  $errors = array();
   //Test1: fichier correctement uploadé

     if (!isset($_FILES[$index]["name"]) OR $_FILES[$index]['error'] > 0){ 
      return FALSE;
    }

   //Test2: taille limite
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize){ 
      array_push( $errors,'sizeOfUp');
      return $errors;
      exit();
    }
   //Test3: extension


     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);

     if ($extensions !== FALSE AND !in_array($ext,$extensions)){ 
      array_push( $errors,'extUp');

      return $errors;
      exit();
    }


   //Déplacement
      $fileDestination = $destination.$username."/";
      $file = $fileDestination.$_FILES[$index]['name'];

     if (!file_exists($fileDestination)) {
      if (!mkdir($fileDestination, 0777, true)) {
        die('Echec lors de la création des répertoires...');
      }
    }

      if(!move_uploaded_file($_FILES[$index]['tmp_name'], $file)){ 
        array_push( $errors,'uploadProb');
        return $errors;
        exit();
    }

      return $file;

}

?>