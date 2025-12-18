alert("Message Debug");
let prenom = "Jean";
let age = 25;

console.log("Bonjour " + prenom + ", vous avez " + age + " ans.");

let nombreA = 10;
let nombreB = 5;


let addition = nombreA + nombreB;
console.log("Addition: " + nombreA + " + " + nombreB + " = " + addition);


let multiplication = nombreA * nombreB;
console.log("Multiplication: " + nombreA + " × " + nombreB + " = " + multiplication);

function saluer() {
    let monNombre = 42;
    console.log("Bonjour le monde du JavaScript !");
    console.log("Mon nombre : " + monNombre);
}

saluer();

function présenter(nom, ville) {
    console.log("Je m'appelle " + nom + " et j'habite à " + ville + ".");
}

console.log("\n--- Fonction présenter ---");
présenter("Marie", "Paris");
présenter("Pierre", "Lyon");
présenter("Sophie", "Marseille");

console.log("\n--- Tableaux de fruits ---");
let fruits = ["Pomme", "Banane", "Cerise"];

console.log("Deuxième fruit : " + fruits[1]);

fruits.push("Kiwi");
console.log("Fruit ajouté : " + fruits[3]);

console.log("\nTous les fruits du tableau :");
for (let i = 0; i < fruits.length; i++) {
    console.log(fruits[i]);
}

console.log("\n--- Boucle while (1 à 5) ---");
let compteur = 1;
while (compteur <= 5) {
    console.log(compteur);
    compteur++;
}


console.log("\n--- Boucle for (1 à 50) ---");
for (let i = 1; i <= 50; i++) {
    console.log(i);
}

console.log("\n--- Nombres impairs de 1 à 10 ---");
for (let i = 1; i <= 10; i++) {
    if (i % 2 !== 0) {
        console.log(i);
    }
}

console.log("\n--- Manipulation du DOM ---");

let subtitle = document.getElementById("subtitle");
subtitle.innerHTML = "Page modifiée !";

let mainTitle = document.getElementById("main-title");
mainTitle.innerHTML = "Bienvenue sur ma page !";

let copyright = document.getElementById("copyright");
copyright.innerHTML = "© 2025 - Site web";

console.log("Fin de la manipulation du DOM !");
