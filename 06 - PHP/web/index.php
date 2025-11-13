<?php 
declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // ----------Exercice 1-----------
        echo "Hello PHP"; 
    // ----------Exercice 2-----------
        $nom = "Boi";
        $birth = 1994;
        $date = 2025;
        $age = $date - $birth;
        echo "Bonjour ". $nom . ", tu as :".$age;
    // ----------Exercice 3-----------
        $age = 31;
        if($age > 18) {
            echo "Vous êtes majeur !";
        }else{
            echo "Vous êtes mineur !";
        }
        echo $age >= 18 ? "Vous êtes majeur !" : "Vous êtes mineur !";
        $a = 20;
        $b = 12;
        if ($a > $b) {
            echo "a est plus grand que b";
        } elseif ($a < $b) {
            echo "b est plus grand que a";
        } elseif ($a == 10 && $b == 5) {
            echo "a vaut 10 et b vaut 5";
        } else {
            echo "je ne sais pas";
        }
    // ----------Exercice 3 BIS -------------
        $couleur = "orange";

        if ($couleur === "vert") {
            echo "Go !!!!!";
        } elseif ($couleur === "orange") {
            echo "Attention...";
        } elseif ($couleur === "rouge") {
            echo "STOP !!!!!";
        } else {
            echo "Je ne connais pas la couleur !";
        }

        switch ($couleur) {
            case "vert":
                echo "GO !!!";
                break;

            case "orange":
                echo "Attention...";
                break;

            case "rouge":
                echo "STOP !!!!";
                break;

            default:
                echo "Je ne connais pas la couleur !";
                break;
        }
    //----------Exercices 4---------------------
    $nombre = 0;

    for ($nombre; $nombre < 10; $nombre++) {
        echo $nombre . "<br>";
    }

    $nombre = 5;

    while ($nombre >= 0) {
        echo $nombre . "<br>";
        $nombre--;
    }
    //------------ Exercices 4 BIS------------------
    $table = 5;

    for ($multiple = 0; $multiple < 10; $multiple++) {
        echo $multiple * $table . "<br>";
    }
    // ------ Exercices 5 ---------------------------
    $fruits = ["Pomme", "Banane", "Orange"];

    echo "Second élément du tableau : " . $fruits[1] . "<br>";
    echo "Taille du tableau : " . sizeof($fruits);
    
    $fruits = ["Pomme", "Banane", "Orange", "Cerise", "Ananas", "Poire", "etc..."];

    echo "Liste des fruits<br>";

    foreach ($fruits as $fruit) {
        echo $fruit . "<br>";
    }

    // -------- Exercices 6 ------------
    function AfficherPersonne() {
        $prenom = "Julian";
        $age = 31;

        echo "Bonjour " . $prenom . " tu as : " . $age . " ans !";
    }

    AfficherPersonne();
    

    function AfficherPersonne1(string $prenom, int $age){
        echo "Bonjour " . $prenom . " tu as : " . $age . " ans !";
    }

    AfficherPersonne1("Julian", 31);
    // -------- Exercices 7 ---------
    function Multiplier(int $x, int $y): int {
        return $x * $y;
    }

    $resultat = Multiplier(5, 10);

    echo "Résultat de la variable qui stocke une fonction de retour : " . $resultat;
    ?>
</body>
</html>