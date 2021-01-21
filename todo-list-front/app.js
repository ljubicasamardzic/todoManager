var zadaci = [];
var api_route = "http://localhost/akademija-generacija-5-main/todo-list/api";

function citajZadatke() {
    return $.ajax({
        type: "GET",
        url: api_route + "/get_tasks.php",
        success: (result) => {
            zadaci = JSON.parse(result);
        }
    });
}

function prikaziZadatke() {
    let tabela_body = $('#tabela_svih_body');
    let tabela = [];

        zadaci.forEach((zadatak, i) => {
            let zavrseno_chk = '';
            let klasa_zavrseno = '';
            if (zadatak.zavrseno) {
                zavrseno_chk = 'checked';
                klasa_zavrseno = 'zavrseno';
            }
            let chk_box = `<input type="checkbox" onchange="zavrsiZadatak(${i})" ${zavrseno_chk} />`;
            let dugme_brisanje = `<button class="btn btn-sm btn-danger " onclick="ukloniZadatak(${zadatak.id})" ><i class="fa fa-times"></i></button>`;
            let dugme_izmjena = `<button class="btn btn-sm btn-primary " onclick="izmijeniZadatak(${i})" ><i class="fa fa-edit"></i></button>`;
            tabela.push(`<tr id="red_${i}" class="${klasa_zavrseno}" > <td>${zadatak.id}</td><td>${zadatak.tekst}</td><td>${zadatak.opis}</td> <td>${chk_box}</td> <td>${dugme_brisanje}</td><td>${dugme_izmjena}</td> </tr>`);
        });
        tabela_body.html(tabela.join(''));
    
        prikaziBrojZadataka();
    
}

function prikaziBrojZadataka() {
    let broj_zadataka = zadaci.length;
    if (broj_zadataka === 0) {
        $('#broj_zadataka').html(`<h6>Nema zadataka za tražene parametre.</h6>`);
    } else {
        $('#broj_zadataka').html(`<h6>Broj zadataka: ` + broj_zadataka + `</h6>`);
    }
}

function generisiNoviID() {
    let max = 0;
    for (let i = 0; i < zadaci.length; i++) {
        if (zadaci[i].id > max) max = zadaci[i].id;
    }
    return max + 1;
}

function zavrsiZadatak(index) {
    zadaci[index].zavrseno = !(zadaci[index].zavrseno);
    $.ajax({
        type: "POST",
        url: api_route + '/complete_task.php',
        data: {
            index: index,
            status: (zadaci[index].zavrseno)
        },
        success: (response) => {
            $('#red_' + index).toggleClass('zavrseno');
        }
    });
}

function ukloniZadatak(index) {
    if (confirm("Da li ste sigurni?")) {
        $.ajax({
            type: "POST",
            url: api_route + '/delete_task.php',
            data: {
                id: index
            },
            success: (res) => {
                citajZadatke().then(() => {
                    prikaziZadatke();
                });
            },
            error: (res) => alert(res)
        });
    }
}

function izmijeniZadatak(index) {
    let zadatak = zadaci[index];

    // note to self - do not mix ids and indexes; 
    // id - an identification for an item; index - its identifying position within an array UGH
    document.getElementById('izmjena_tekst').value = zadatak.tekst;
    document.getElementById('izmjena_opis').value = zadatak.opis;
    document.getElementById('id_izmjena').value = zadatak.id;
    $("#modal_izmjena").modal('show');
}

function isprazniPolja(tip) {
    if (tip == 'izmjena') {
        document.getElementById('izmjena_tekst').value = "";
        document.getElementById('izmjena_opis').value = "";
        document.getElementById('index_izmjena').value = -1;
    } else if (tip == 'dodavanje') {
        document.getElementById('novi_zadatak_tekst').value = "";
        document.getElementById('novi_zadatak_opis').value = "";
    }
}
    citajZadatke().then(() => {
        prikaziZadatke();
});

// dodavanje event listener-a
document.getElementById('dodaj_novi_forma').addEventListener('submit', function (e) {
    e.preventDefault();
    let novi_tekst = document.getElementById('novi_zadatak_tekst').value;
    let novi_opis = document.getElementById('novi_zadatak_opis').value;
    let novi_zadatak = {
        id: generisiNoviID(),
        tekst: novi_tekst,
        opis: novi_opis,
        zavrseno: false
    };
    zadaci.push(novi_zadatak);

    $.ajax({
        type: "POST",
        url: api_route + '/add_task.php',
        data: novi_zadatak,
        success: (result) => {
            if (result == "OK") {
                prikaziZadatke();
                $("#modal_dodavanje").modal('hide');
                isprazniPolja('dodavanje');
                prikaziPoruku('dodavanje-usp');
            } else {
                alert(result);
            }
        },
        error: (res) => {
            prikaziPoruku('dodavanje-gre');
        }
    });
});

function prikaziPoruku(poruka) {
    if (poruka == 'izmjena-usp') {
        $('#poruka-izmjena-usp').css('display', 'block');
        setTimeout(() => {
            $('#poruka-izmjena-usp').fadeOut('fast');
        }, 1000);

    } else if (poruka == 'dodavanje-usp') {
        $('#poruka-dodavanje-usp').css('display', 'block');
        setTimeout(() => {
            $('#poruka-dodavanje-usp').fadeOut('fast');
        }, 1000);

    } else if (poruka == 'izmjena-gre') {
        $('#poruka-izmjena-gre').css('display', 'block');
        setTimeout(() => {
            $('#poruka-izmjena-gre').fadeOut('fast');
        }, 1000);

    } else if (poruka == 'dodavanje-gre') {
        $('#poruka-dodavanje-gre').css('display', 'block');
        setTimeout(() => {
            $('#poruka-dodavanje-gre').fadeOut('fast');
        }, 1000);
    }
}

document.getElementById('izmjena_zadatka_forma').addEventListener('submit', function (e) {
    e.preventDefault();

    let index = document.getElementById('id_izmjena').value;
    let novi_tekst = document.getElementById('izmjena_tekst').value;
    let novi_opis = document.getElementById('izmjena_opis').value;

    $.ajax({
        type: "POST",
        url: api_route + '/edit_task.php',
        data: {
            id: index,
            tekst: novi_tekst,
            opis: novi_opis
        },
        success: (response) => {
            $("#modal_izmjena").modal('hide');
            isprazniPolja('izmjena');

            citajZadatke().then(() => {
                prikaziZadatke();
            prikaziPoruku('izmjena-usp');
            });
        }, 
        error: () => {
            prikaziPoruku('izmjena-gre');
        }
    });
});

document.getElementById('pretraga_forma').addEventListener('submit', function (e) {
    e.preventDefault();

    let pretraga_tekst = document.getElementById('pretraga_tekst').value;
    let pretraga_opis = document.getElementById('pretraga_opis').value;
    let pretraga_zavrsen = document.getElementById('pretraga_zavrsen').value;

    $.ajax({
        type: "GET",
        url: api_route + '/search_tasks.php',
        data: {
            tekst: pretraga_tekst,
            opis: pretraga_opis,
            zavrseno: pretraga_zavrsen
        },
        success: (response) => {
            zadaci = JSON.parse(response);
            prikaziZadatke();
        }

    });
});

document.getElementById('otkazi-pretragu').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('pretraga_tekst').value = "";
    document.getElementById('pretraga_opis').value = "";
    document.getElementById('pretraga_zavrsen').value = "svi";
    citajZadatke().then(() => {
        prikaziZadatke();
    });
});
