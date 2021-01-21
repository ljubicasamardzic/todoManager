<div class="row mt-3">
    <?php
        if( isset($_GET['msg']) && $_GET['msg'] == 1 ){
            echo "<div class=\"col-12 alert alert-success text-center\" >";
            echo "  Uspjesno dodavanje zadatka!";
            echo "</div>";

        }else if( isset($_GET['msg']) && $_GET['msg'] == 0 ){
            echo "<div class=\"col-12 alert alert-danger text-center\" >";
            echo "  Greska pri dodavanju zadatka!";
            echo "</div>";
        }else if( isset($_GET['msg']) && $_GET['msg'] == '2_1' ){
            echo "<div class=\"col-12 alert alert-success text-center\" >";
            echo "  Uspjesna izmjena zadatka!";
            echo "</div>";
        }else if( isset($_GET['msg']) && $_GET['msg'] == '2_0' ){
            echo "<div class=\"col-12 alert alert-danger text-center\" >";
            echo "  Greska pri izmjeni zadatka!";
            echo "</div>";
        }
        else if( isset($_GET['msg']) && $_GET['msg'] == '3_1' ){
            echo "<div class=\"col-12 alert alert-success text-center\" >";
            echo "  Uspjesno brisanje zadatka!";
            echo "</div>";
        }else if( isset($_GET['msg']) && $_GET['msg'] == '3_0' ){
            echo "<div class=\"col-12 alert alert-danger text-center\" >";
            echo "  Greska pri brisanju zadatka!";
            echo "</div>";
        }
    ?>
</div>