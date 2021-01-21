<?php 

    include './funkcije.php';

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
    if( isset($_POST['zavrseno']) ){
        $zavrsen = true;
    }else{
        $zavrsen = false;
    }

    if( nadjiZadatak($id) !== FALSE ){
        $index = nadjiZadatak($id);
    }else{
        exit("Ne postoji zadatak sa predatim ID-jem...");
    }

    $todos[$index]['tekst'] = $tekst;
    $todos[$index]['opis'] = $opis;
    $todos[$index]['zavrseno'] = $zavrsen;

    if( file_put_contents( 'todo.db', json_encode($todos) ) ){
        header('location: ./index.php?msg=2_1');
    }else{
        header('location: ./index.php?msg=2_0');
    }
?>