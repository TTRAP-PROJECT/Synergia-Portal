<?php
// Récupérer le type de service sélectionné
$selectedService = Request::get('service');

// Générer le contenu du formulaire en fonction du type de service
switch ($selectedService) {
    case '':
        break;

    case 'Cinéma':
?>
<div class="flex flex-col">
    <label for="cinemaField">Nom du Film :</label>
    <input class="formInput w-64" type="text" id="inputNom" name="cinemaField">

    <label for="cinemaDate">Date de projection :</label>
    <input class="formInput w-36" type="date" id="inputDate" name="cinemaDate">

    <label for="cinemaTime">Heure de projection :</label>
    <input class="formInput w-28" type="time" id="inputHeure" name="cinemaTime">

    <label for="cinemaLocation">Lieu de projection :</label>
    <input class="formInput w-64" type="text" id="inputLieu" name="cinemaLocation">

    <label for="prix">Prix du billet :</label>
    <div class="flex flex-row items-center">
        <input class="formInput w-20" type="number" id="inputPrix" name="prix">
        <p>€</p>
    </div>

    <label for="description">Description :</label>
    <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
</div>
<?php
        break;
    case 'Covoiturage':
?>
<input type="hidden" name="covoiturageNom" id="inputNom" value="Covoiturage">
<div class="flex flex-col">
    <label for="covoiturageDepart">Lieu de départ :</label>
    <input class="formInput w-64" type="text" id="inputLieuDepart" name="covoiturageDepart">

    <label for="covoiturageArrivee">Lieu d'arrivée :</label>
    <input class="formInput w-64" type="text" id="inputLieuArrivee" name="covoiturageArrivee">

    <label for="covoiturageDate">Date de départ :</label>
    <input class="formInput w-36" type="date" id="inputDate" name="covoiturageDate">

    <label for="covoiturageTime">Heure de départ :</label>
    <input class="formInput w-28" type="time" id="inputHeure" name="covoiturageTime">

    <label for="prix">Prix par passager :</label>
    <div class="flex flex-row items-center">
        <input class="formInput w-20" type="number" id="inputPrix" name="prix">
        <p>€</p>
    </div>
    <label for="description">Description :</label>
    <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
</div>

<?php
        break;

    case 'Échange de compétence':
?>
<div class="flex flex-col">
    <label for="competenceName">Matière :</label>
    <input class="formInput w-64" type="text" id="inputNom" name="competenceName">

    <label for="competenceNiveau">Niveau :</label>
    <input class="formInput w-64" type="text" id="inputNiveau" name="competenceNiveau">
    
    <label for="competenceLocation">Lieu de l'échange :</label>
    <input class="formInput w-64" type="text" id="inputLieu" name="competenceLocation">

    <label for="prix">Prix de l'échange :</label>
    <div class="flex flex-row items-center">
        <input class="formInput w-20" type="number" id="inputPrix" name="prix">
        <p>€</p>
    </div>

    <label for="description">Description :</label>
    <textarea class="formInput w-96" id="inputDescription" name="description"
        placeholder="Veillez à être le plus précis possible, en indiquant le lieu et l'heure si concerné par exemple"></textarea>

    <?php
        break;

    case 'Evènement sportif':
        ?>
    <div class="flex flex-col">
        <label for="sportName">Nom de l'évènement :</label>
        <input class="formInput w-64" type="text" id="inputNom" name="sportName">

        <label for="sportDate">Date de l'évènement :</label>
        <input class="formInput w-36" type="date" id="inputDate" name="sportDate">

        <label for="sportTime">Heure de l'évènement :</label>
        <input class="formInput w-28" type="time" id="inputHeure" name="sportTime">

        <label for="sportLocation">Lieu de l'évènement :</label>
        <input class="formInput w-64" type="text" id="inputLieu" name="sportLocation">

        <label for="prix">Prix de l'évènement :</label>
        <div class="flex flex-row items-center">
            <input class="formInput w-20" type="number" id="inputPrix" name="prix">
            <p>€</p>
        </div>

        <label for="description">Description :</label>
        <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
    </div>
    <?php
        break;

        case 'Loisir':
        ?>
    <div class="flex flex-col">
        <label for="loisirName">Nom de l'activité :</label>
        <input class="formInput w-64" type="text" id="inputNom" name="loisirName">

        <label for="loisirDate">Date de l'activité :</label>
        <input class="formInput w-36" type="date" id="inputDate" name="loisirDate">

        <label for="loisirTime">Heure de l'activité :</label>
        <input class="formInput w-28" type="time" id="inputHeure" name="loisirTime">

        <label for="loisirLocation">Lieu de l'activité :</label>
        <input class="formInput w-64" type="text" id="inputLieu" name="loisirLocation">

        <label for="prix">Prix de l'activité :</label>
        <div class="flex flex-row items-center">
            <input class="formInput w-20" type="number" id="inputPrix" name="prix">
            <p>€</p>
        </div>

        <label for="description">Description :</label>
        <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
    </div>
    <?php
        break;

    case 'Autre':
        ?>
    <div class="flex flex-col">
        <label for="autreName">Nom du service :</label>
        <input class="formInput w-64" type="text" id="inputNom" name="autreName">

        <label for="autreDate">Date du service :</label>
        <input class="formInput w-36" type="date" id="inputDate" name="autreDate">

        <label for="autreTime">Heure du service :</label>
        <input class="formInput w-28" type="time" id="inputHeure" name="autreTime">

        <label for="autreLocation">Lieu du service :</label>
        <input class="formInput w-64" type="text" id="inputLieu" name="autreLocation">

        <label for="prix">Prix du service :</label>
        <div class="flex flex-row items-center">
            <input class="formInput w-20" type="number" id="inputPrix" name="prix">
            <p>€</p>
        </div>

        <label for="description">Description :</label>
        <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
    </div>
    <?php
        break;
    default:
        echo 'Erreur : type de service inconnu';
        break;
}
