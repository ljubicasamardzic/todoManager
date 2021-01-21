<?php
    $todos = json_decode( file_get_contents('../todo.db'), true );

    function nadjiZadatak($id){
        global $todos;
        foreach( $todos as $key => $todo ){
            if( intval($todo['id']) == intval($id) ) return $key;
        }
        return false;
    }

    if( isset($_POST['id']) && $_POST['id'] != "" ){
        $id = $_POST['id'];
    }else{
        exit("Greska 0 - id nije stigao pravilno...");
    }

    if ( nadjiZadatak($id) !== FALSE ){
        $index = nadjiZadatak($id);
    }else{
        exit("Ne postoji zadatak sa predatim ID-jem...");
    }

    unset($todos[$index]);

    $array = json_encode(array_values($todos));

    if( file_put_contents( '../todo.db', $array )){
        exit("Uspjesno obrisana stavka");
    }else{
        exit("Greska pri brisanju...");
    }

    ?>
