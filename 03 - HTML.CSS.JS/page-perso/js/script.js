/**
 * Exercices 1 - Assignation des variables avec un log dans la console
 */


let prenom = "Jack";
let age = 30;

console.log("[Technique de base] Bonjour "+ prenom +" ! Tu as " + age + "ans aujourd'hui !");
console.log(`[Technique avancé] Bonjour ${prenom} ! Tu as ${age} ans aujourd'hui !`);

/**
 * Exercices 2 - Assignation des variables dans un calcul avec un log dans la console
 */

let termeA = 10;
let termeB = 50;

let addition =  termeA + termeB;
let soustraction = termeA - termeB;
let multiplication = termeA * termeB;
let division = termeA / termeB;
let modulo = termeA % termeB;

console.log("[CALCULETTE] Résultat de l'addition de termeA et termeB : " + addition);
console.log("[CALCULETTE] Résultat de la soustraction de termeA et termeB : " + soustraction);
console.log("[CALCULETTE] Résultat de la multiplication de termeA et termeB : " + multiplication);
console.log("[CALCULETTE] Résultat de la division de termeA par termeB : " + division);
console.log("[CALCULETTE] Résultat du modulo de termeA par termeB : " + modulo);

/**
 *  * Exercices 3 - Verification de Température
 */

let temperature = 20;

// Condition if
if(temperature >=25){
    console.log("[IF TEMPERATURE] Il fait chaud !");
}else{
    console.log("[IF TEMPERATURE] Il fait pas chaud !");
}

// Condition switch
switch(temperature){
    case 30:
        console.log("[Switch] Température à 30 degrés");
        break;
    case 20:
        console.log("[Switch] Température à 20 degrés");
        break;
    case 10:
        console.log("[Switch] Température à 10 degrés");
        break;
    case 5:
        console.log("[Switch] Température à 5 degrés");
        break;
    default:
        
}

/**
 *  * Exercices 4 - Boucle / Mise en place
 */

let nombreWhile = 0;
// While
while(nombreWhile <5){
    console.log(`[Fonction While]Le nombre de la boucle while qui commence par 0 est : ${nombreWhile}`);
    nombreWhile++;
}
const nombreFor = 10;
// For
for (let i = 0; i < nombreFor; i++) {
    console.log(`[Fonction For] Le nombre de la boucle for entre 0 et ${nombreFor} est : ${i}`);
}

/**
 *  * Exercices 5 - Boucle / Condition
 */

// Conditional For
for (let i = 0; i < 30; i++) {
    if(i%2){
        console.log(`[Fonction For - Condition] Le nombre de la boucle conditionnal entre 0 et 30 est : ${i}`);
    }
}

/**
 *  * Exercices 6 - Fonction dans parametre
 */
let version = 1.25;

// Fonction ECMA
function versionSalutation(){
    console.log(`[Fonction ECMA - Base] Bonjour le monde du JavaScript ${version}!`);
}
versionSalutation();

// Fonction moderne
const versionModerneSalutation = () =>{
    console.log(`[Fonction moderne - Base] Bonjour le monde du JavaScript ${version}!`);
};
versionModerneSalutation();

/**
 *  * Exercices 7 - Fonction avec parametre
 */
// Fonction ECMA
function presentationECMA(nom,ville){
    console.log(`[Fonction ECMA - Param] Je m'appelle ${nom} et j'habite à ${ville}.`)
}
presentationECMA("John","Toulouse");
// Fonction moderne
const presentationModerne = (nom,ville)=>{
    console.log(`[Fonction fleché - Param]Je m'appelle ${nom} et j'habite à ${ville}.`)
}
presentationModerne("Jochua","Carcassonne");

/**
 *  * Exercices 8 - Tableau - accés
 */

let fruits = ["Pomme","Fraise","Poire"];

console.log(`[Tab] J'adore les ${fruits[1]}`);
fruits.push("Kiwi");
console.log(`[Tab] ${fruits[3]} est rajoutés`);

/**
 *  * Exercices 9 - Tableau - Boucle et map
 */

let saladeDeFruitsForEach = ["Pommes","Fraises","Poires","Cerises","Ananas"];

// For
for (let i = 0; i < saladeDeFruitsForEach.length; i++) {
    console.log(`[Tab] Trouve dans la salade , les ${saladeDeFruitsForEach[i]}`);
};

// Foreach
saladeDeFruitsForEach.forEach(fruit => {
    console.log(`[Tab] Mange les ${fruit}`);
});

//Map
saladeDeFruitsForEach.map((fruit) => 
    console.log(`[Tab] Refait une salade avec les ${fruit}`)
);

/**
 *  * Manipulation du DOM
 */
let manipulationDOM = document.getElementById("title-perso");

manipulationDOM.innerHTML = "Julian - Ma page perso";
