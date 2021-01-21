<?php 

    include './funkcije.php';

    if( isset($_GET['id']) && $_GET['id'] != "" ){
        $id = $_GET['id'];
    }else{
        exit("Greska 1 - nepravilno predat id...");
    }

    if( nadjiZadatak($id) !== FALSE ){
        $index = nadjiZadatak($id);
        $zadatak = $todos[$index];
    }else{
        exit("Ne postoji zadatak sa predatim ID-jem...");
    }

    $tekst = $zadatak['tekst'];
    $opis = $zadatak['opis'];
    $zavrsen = $zadatak['zavrseno'];

    if($zavrsen) $checked = "checked";
    else $checked = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izmjena zadatka</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome-free-5.15.1-web/css/all.css">
</head>
<body>
    
    <div class="container">

        <form action="izmjena_postojeceg.php" method="POST">
            <div class="row mt-5">
                <div class="col-6 offset-3">
                    <input type="text" class="form-control" value="<?php echo $tekst; ?>" name="tekst" >
                    <input type="hidden" value="<?=$id?>" name="id" >

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6 offset-3">
                    <textarea class="form-control" name="opis" rows="5"><?=$opis?></textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6 offset-3">
                    <label>
                        <input type="checkbox" name="zavrseno" <?=$checked?> >
                        zadatak zavrsen
                    </label>
                </div>
                
            </div>
            <div class="row mt-3">
                <div class="col-6 offset-3">
                    <button class="btn btn-success btn-block" >Izmjena</button>
                </div>
            </div>
        </form>    

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./app.js"></script>
</body>
</html>