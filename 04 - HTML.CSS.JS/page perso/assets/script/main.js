let taches = [
    "Faire du café",
    "Apprendre le JavaScript",
    "Apprendre le PHP"
];

const container_taches = document.getElementById("liste-de-taches");

function ajouterTache(tache) {
    taches.push(tache);
    afficherTaches();
}

function afficherTaches() {
    container_taches.innerHTML = "";
    taches.forEach((tache, index) => {
        const element = document.createElement("ul");
        element.textContent = tache;
        const btnSupprimer = document.createElement("button");
        btnSupprimer.textContent = "Supprimer";
        btnSupprimer.addEventListener("click", () => {
            taches.splice(index, 1);
            afficherTaches();
        });
        container_taches.appendChild(element);
        element.appendChild(btnSupprimer);  
    });
}

function buttonAjouterTache() {
    const button = document.getElementById("addTaskButton");
    const input = document.getElementById("tache");     
    button.addEventListener("click", (e) => {
        e.preventDefault();
        if(input.value.trim() !== "") {
            ajouterTache(input.value.trim());
            input.value = "";
        }
    });
}

buttonAjouterTache();
afficherTaches();

