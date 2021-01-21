<?php 
    var_dump($_POST);

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
        exit("Greska 0 - morate unijeti id...");
    }
    if( isset($_POST['tekst']) && $_POST['tekst'] != "" ){
        $tekst = $_POST['tekst'];
    }else{
        exit("Greska 1 - morate unijeti tekst...");
    }
    if( isset($_POST['opis']) && $_POST['opis'] != "" ){
        $opis = $_POST['opis'];
    }else{
        exit("Greska 2 - morate unijeti opis...");
    }

    if( nadjiZadatak($id) !== FALSE ){
        $index = nadjiZadatak($id);
    }else{
        exit("Ne postoji zadatak sa predatim ID-jem...");
    }

    $todos[$index]['tekst'] = $tekst;
    $todos[$index]['opis'] = $opis;
    $todos[$index]['zavrsen'] = $zavrsen;

    if( file_put_contents( '../todo.db', json_encode($todos) )){
        exit("Uspjesno obrisana stavka");
    }else{
        exit("Greska pri brisanju...");
    }
