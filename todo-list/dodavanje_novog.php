<?php 

    include 'funkcije.php';

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

    $data = file_get_contents('todo.db');
    $data_arr = json_decode($data, true);
    if($data == null){
        $data_arr = [];
    }

    // radimo dodavanje
    $data_arr[] = [ 'id' => generisiNoviID() , 'tekst' => $tekst, 'opis' => $opis, 'zavrseno' => false ];

    // cuvamo u fajl
    if( file_put_contents( 'todo.db', json_encode($data_arr) ) ){
        header('location: ./index.php?msg=1');
    }else{
        header('location: ./index.php?msg=0');
    }


?>