<?php

/**
 * Clase que limpia la entrada de datos previa inserción en base de datos o realización de operaciones con éstos.
 */
class InputCleaner{

    public function __construct(){
        
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
      }

}

?>