<?php 

    $todos = json_decode( file_get_contents('../todo.db'), true );
    // var_dump($_POST);

    if( isset($_POST['index']) && is_numeric($_POST['index']) ){
        $index = $_POST['index'];
    }else{
        exit("Greska 1 - nepravilan index");
    }
    if( isset($_POST['status']) ){
        $status = $_POST['status'];
    }else{
        exit("Greska 2 - nepravilan status");
    }
    
    if($status == "true") $status = true;
    else $status = false;
    
    $todos[$index]['zavrseno'] = $status;

    if( file_put_contents( '../todo.db', json_encode($todos) ) ){
        exit("OK");
    }else{
        exit("Greska pri upisu...");
    }
?>