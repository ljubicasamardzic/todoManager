<?php
        // Pretraga radi na principu tri kriterijuma, od kojih korisnik može izabrati nijedan, jedan, dva ili sva tri

        $todos = json_decode(file_get_contents('../todo.db'), true);
        $to_show = [];
    
        $tekst = $_GET['tekst'];
        $opis = $_GET['opis'];
        $zavrseno = $_GET['zavrseno'];
    
        if ($tekst == "" && $opis == "" && $zavrseno == "") {
            $to_show = $todos;
            echo(json_encode($to_show));
        } else if ($tekst == "" && $opis == "") {
            foreach ($todos as $todo) {
                if ($zavrseno == "svi") {
                    $to_show = $todos;
                } else if ($zavrseno == "zavrsen") {
                    if ($todo['zavrseno']) {
                        $to_show[] = $todo;
                    }
                } else if ($zavrseno == "nezavrsen") {
                    if (!$todo['zavrseno']) {
                        $to_show[] = $todo;
                    }
                } 
            }
            echo(json_encode($to_show));
        } else if ($tekst == "" && $zavrseno == "svi") {
            foreach ($todos as $todo) {
                if (stripos($todo['opis'], $opis) !== FALSE) {
                    $to_show[] = $todo;
                }
            }
            echo(json_encode($to_show));
        } else if ($opis == "" && $zavrseno == "svi") {
            foreach ($todos as $todo) {
                if (stripos($todo['tekst'], $tekst) !== FALSE) {
                    $to_show[] = $todo;
                }
            }
            echo(json_encode($to_show));
        } else if ($tekst == "") {
            foreach ($todos as $todo) {
                 if (stripos($todo['opis'], $opis) !== FALSE && $zavrseno == "svi") {
                    $to_show[] = $todo;
                } else if (stripos($todo['opis'], $opis) !== FALSE && $zavrseno == "zavrsen") {
                    if ($todo['zavrseno']) {
                        $to_show[] = $todo;
                    }
                } else if (stripos($todo['opis'], $opis) !== FALSE && $zavrseno == "nezavrsen") {
                    if (!$todo['zavrseno']) {
                        $to_show[] = $todo;
                    }
                } 
            }
            echo(json_encode($to_show));
        } else if ($opis == "") {
            foreach ($todos as $todo) {
                if (stripos($todo['tekst'], $tekst) !== FALSE && $zavrseno == "svi") {
                    $to_show[] = $todo;
                } else if (stripos($todo['tekst'], $tekst) !== FALSE && $zavrseno == "zavrsen") {
                    if ($todo['zavrseno']) {
                        $to_show[] = $todo;
                    }
                } else if (stripos($todo['tekst'], $tekst) !== FALSE && $zavrseno == "nezavrsen") {
                        if (!$todo['zavrseno']) {
                            $to_show[] = $todo;
                        }
                    }  
            }
            echo(json_encode($to_show));
        } else if ($zavrseno == "svi") {
            foreach ($todos as $todo) {
                if (stripos($todo['tekst'], $tekst) !== FALSE && stripos($todo['opis'], $opis) !== FALSE) {
                    $to_show[] = $todo;
                }
            }
            echo(json_encode($to_show));
        } else if ($zavrseno == "nezavrsen") {
                foreach ($todos as $todo) {
                    if (stripos($todo['tekst'], $tekst) !== FALSE && stripos($todo['opis'], $opis) !== FALSE) {
                        if (!$todo['zavrseno']) {
                           $to_show[] = $todo;
                        }
                    }
                }
                echo(json_encode($to_show));
        } else if ($zavrseno == "zavrsen") {
            foreach ($todos as $todo) {
                if (stripos($todo['tekst'], $tekst) !== FALSE && stripos($todo['opis'], $opis) !== FALSE) {
                    if ($todo['zavrseno']) {    
                        $to_show[] = $todo;
                    }
                }
            }
            echo(json_encode($to_show));
        }
?>
