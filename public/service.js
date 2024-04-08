document.addEventListener("DOMContentLoaded", function () {

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            if (this.value === 'all' && this.checked) {
                updateAll();
                checkboxes.forEach((cb) => {
                    if (cb.value !== 'all') {
                        cb.checked = false;
                    }
                });
            } else if (this.value !== 'all' && this.checked) {
                document.getElementById('services0').checked = false;
            }
            // Vérifie si la case "Tout afficher" est cochée, si oui, ne pas appeler updateDisplay()
            if (!(this.value === 'all' && this.checked)) {
                updateDisplay();
            }
        });
    });

    function updateDisplay() {
        checkboxes.forEach((checkbox) => {
            const value = checkbox.value;
            const className = value;
            const elements = document.querySelectorAll(`.${className}`);
            if (checkbox.checked) {
                elements.forEach((element) => {
                    element.classList.remove('hidden');
                });
            } else {
                elements.forEach((element) => {
                    element.classList.add('hidden');
                });
            }
        });
    }

    function updateAll() {
        checkboxes.forEach((checkbox) => {
            if (checkbox.value !== 'all') {
                const value = checkbox.value;
                const className = value;
                const elements = document.querySelectorAll(`.${className}`);
                elements.forEach((element) => {
                    element.classList.remove('hidden');
                });
            }
        });
    }

    // Sélection de l'élément de la barre de recherche
    const searchBar = document.getElementById('searchbar');

// Liste des libellés à filtrer
    const labels = document.querySelectorAll('span');

// Convertir la NodeList en tableau
    const labelsArray = Array.from(labels);

    // Sélection de toutes les divs contenant les éléments à filtrer
    const divsToFilter = document.querySelectorAll('.cinema, .loisir, .sport, .covoiturage, .autre, .competence ');


// Ajout d'un écouteur d'événements pour détecter les frappes dans la barre de recherche
    searchBar.addEventListener('input', function (event) {
        const searchTerm = event.target.value.toLowerCase(); // Convertir le terme de recherche en minuscules pour la recherche insensible à la casse

        // Filtrer les libellés qui contiennent le terme de recherche
        const filteredLabels = labelsArray.filter(label => label.textContent.toLowerCase().includes(searchTerm));

        console.log(filteredLabels); // Vous pouvez remplacer cette ligne par votre propre logique pour afficher les résultats de la recherche
        // Filtrer les divs en fonction des suites de caractères trouvées dans les spans
        divsToFilter.forEach(div => {
            const divLabels = div.querySelectorAll('span');
            const divLabelsArray = Array.from(divLabels);
            const divContainsSearchTerm = divLabelsArray.some(label => filteredLabels.includes(label));

            // Vérifier si la div contient une balise name avec les valeurs "cinema", "loisir" ou "sport"
            const divName = div.getAttribute('name');

            // Masquer les divs qui ne correspondent pas aux critères
            if (!divContainsSearchTerm) {
                div.style.display = 'none';
            } else {
                div.style.display = 'block';
            }
        });
    });

});
