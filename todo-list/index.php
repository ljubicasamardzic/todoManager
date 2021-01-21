<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DO APP PHP</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome-free-5.15.1-web/css/all.css">
</head>
<body>
    
    <div class="container">
        <h2 class="text-center mt-3" >
            <i class="fa fa-list-alt"></i> 
            TO-DO lista
        </h2>
        <div class="row">
            <div class="col-4 offset-4">
                <button class="btn btn-success btn-block mt-3 btn-sm" data-toggle="modal" data-target="#modal_dodavanje"> 
                    <i class="fa fa-plus"></i> 
                    Dodaj novi zadatak 
                </button>
            </div>
        </div>

        <?php 
            include './poruke.php';
        ?>

        <form action="./index.php" method="GET">
            <input type="hidden" name="pretraga" value="1">
            <div class="row">
                <div class="col-3">
                    <?php isset($_GET['tekst']) ? $pretraga_tekst = $_GET['tekst'] : $pretraga_tekst = ""; ?>
                    <input type="text" name="tekst" value="<?=$pretraga_tekst?>" id="pretraga_tekst" class="form-control" placeholder="Tekst...">
                </div>
                <div class="col-3">
                    <?php isset($_GET['opis']) ? $pretraga_opis = $_GET['opis'] : $pretraga_opis = ""; ?>
                    <input type="text" name="opis" value="<?=$pretraga_opis?>" id="pretraga_opis" class="form-control" placeholder="Opis...">
                </div>
                <div class="col-3">
                    <select name="zavrseno" id="pretraga_zavrsen" class="form-control">
                        <option value="">- svi zadaci -</option>
                        <?php ( isset($_GET['zavrseno']) && $_GET['zavrseno'] == 1 ) ? $sel1 = "selected" : $sel1 = ""; ?>
                        <option value="1" <?=$sel1?> >samo zavrseni</option>
                        <?php ( isset($_GET['zavrseno']) && $_GET['zavrseno'] == 0 ) ? $sel2 = "selected" : $sel2 = ""; ?>
                        <option value="0" <?=$sel2?> >samo nezavrseni</option>
                    </select>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary btn-block">Pretraga</button>
                </div>
                <div class="col-1">
                    <a href="./index.php" class="btn btn-primary btn-warning"> <i class="fa fa-times"></i> </a>
                </div>
            </div>
        </form>

        <div class="row mt-3">
            <div class="col-12 table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tekst</th>
                            <th>Opis</th>
                            <!-- <th>Zavrseno</th> -->
                            <th>Izmjena</th>
                            <th>Brisanje</th>
                        </tr>
                    </thead>
                    <tbody id="tabela_svih_body" >
                        <?php 
                            $todos = json_decode( file_get_contents('todo.db'), true );
                            
                            if( !isset($_GET['pretraga']) ){
                                $to_show = $todos;
                            }else{
                                // radi se pretraga
                                if(isset($_GET['tekst']) && $_GET['tekst'] != ""){
                                    foreach($todos as $todo){
                                        if( stripos($todo['tekst'], $_GET['tekst']) !== FALSE ){
                                            $to_show[] = $todo;
                                        }
                                    }
                                }
                                if(isset($_GET['opis']) && $_GET['opis'] != ""){
                                    foreach($todos as $todo){
                                        if( stripos($todo['opis'], $_GET['opis']) !== FALSE ){
                                            $to_show[] = $todo;
                                        }
                                    }
                                }
                                if(isset($_GET['zavrseno']) && $_GET['zavrseno'] != ""){
                                    foreach($todos as $todo){
                                        if( $_GET['zavrseno'] == 1 ){
                                            if($todo['zavrseno']){
                                                $to_show[] = $todo;
                                            } 
                                        }else if($_GET['zavrseno'] == 0){
                                            if(!$todo['zavrseno']){
                                                $to_show[] = $todo;
                                            } 
                                        }
                                    }
                                }
                            }

                            foreach( $to_show as $todo ){
                                $id_temp = $todo['id'];
                                $zavrsen_temp = $todo['zavrseno'];

                                if($zavrsen_temp) $red_pozadina = " style=\" background-color:#d4edda; \" ";
                                else $red_pozadina = "";

                                $link_izmjena = "<a href=\"./izmjena.php?id=$id_temp\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-edit\"></i></a>";
                                $link_brisanje = "<a href=\"./brisanje.php?id=$id_temp\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-times\"></i></a>";
                                echo "<tr $red_pozadina >";
                                echo "  <td>$id_temp</td>";
                                echo "  <td>".$todo['tekst']."</td>";
                                echo "  <td>".$todo['opis']."</td>";
                                // echo "  <td></td>";
                                echo "  <td>$link_izmjena</td>";
                                echo "  <td>$link_brisanje</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <h6> Broj zadataka: <?=count($to_show)?> </h6>
            </div>
        </div>
    </div>

    <?php 
        include './modali/dodaj.php';
        include './modali/izmjena.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="./app.js"></script>
</body>
</html>