<?php 

    include './funkcije.php';

    if( isset($_GET['id']) && $_GET['id'] != "" ){
        $id = $_GET['id'];
    }else{
        exit("Greska 0 - morate unijeti id...");
    }
    
    if( nadjiZadatak($id) !== FALSE ){
        $index = nadjiZadatak($id);
    }else{
        exit("Ne postoji zadatak sa predatim ID-jem...");
    }

    unset( $todos[$index] );

    if( file_put_contents( 'todo.db', json_encode($todos) ) ){
        header('location: ./index.php?msg=3_1');
    }else{
        header('location: ./index.php?msg=3_0');
    }
?>