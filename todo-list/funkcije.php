<?php 

    $todos = json_decode( file_get_contents('todo.db'), true );

    function generisiNoviID(){
        global $todos;
        $max = 0;
        foreach( $todos as $todo ){
            if( $todo['id'] > $max ) $max = $todo['id'];
        }
        return $max+1;
    }

    // uzima id i trazi poklapanje, u slucaju da pronadje vraca indeks na kom je dati zapis
    function nadjiZadatak($id){
        global $todos;
        foreach( $todos as $key => $todo ){
            if( intval($todo['id']) == intval($id) ) return $key;
        }
        return false;
    }
?>