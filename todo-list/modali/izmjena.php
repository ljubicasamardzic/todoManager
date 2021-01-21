<!-- Modal izmjena -->
<div class="modal fade" id="modal_izmjena" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Izmjena zadatka</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="izmijeni.php" method="POST" id="izmjena_zadatka_forma">
                <input type="hidden" id="index_izmjena">
                <input type="text" class="form-control" name="tekst" id="izmjena_tekst" placeholder="Unesite tekst novog..." >
                <br>
                <textarea rows="5" class="form-control" name="opis" id="izmjena_opis" placeholder="Unesite opis..."></textarea>
                <br>
                <button class="btn btn-success btn-block">Potvrdi</button>
            </form>
        </div>
        <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
    </div>
    </div>
</div>