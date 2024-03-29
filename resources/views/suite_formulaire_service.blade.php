<?php
// Récupérer le type de service sélectionné
$selectedService = Request::get('service');

// Générer le contenu du formulaire en fonction du type de service
switch ($selectedService) {
    case '1':
?>
<div class="flex flex-col">
    <input type="hidden" name="typeService" value="2">
    <label for="cinemaField">Nom du Film :</label>
    <input class="formInput w-64" type="text" id="inputNom" name="nom">

    <label for="cinemaDate">Date de projection :</label>
    <input class="formInput w-36" type="date" id="inputDate" name="date">

    <label for="cinemaTime">Heure de projection :</label>
    <input class="formInput w-28" type="time" id="inputHeure" name="heure">

    <label for="cinemaLocation">Lieu de projection :</label>
    <input class="formInput w-64" type="text" id="inputLieu" name="lieu">

    <div class="flex flex-row">
        <div>
            <label for="prix">Prix du billet :</label>
            <div class="flex flex-row items-center">
                <input class="formInput w-20" type="number" id="inputPrix" name="prix">
                <p>€</p>
            </div>
        </div>
        <div class="flex flex-col ml-5">
            <label for="nbPersonneMax">Nombre de place disponible</label>
            <input class="formInput w-20" type="number" id="inputNbPersonne" name="nbPersonneMax">
        </div>
    </div>

    <label for="description">Description :</label>
    <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
</div>
<?php
        break;
    case '2':
?>
<input type="hidden" name="typeService" value="4">
<input type="hidden" name="covoiturageNom" id="inputNom" value="nom">
<input type="hidden" name="lieu" value="null">
<div class="flex flex-col">
    <label for="covoiturageDepart">Lieu de départ :</label>
    <input class="formInput w-64" type="text" id="inputLieuDepart" name="lieuDepart">

    <label for="covoiturageArrivee">Lieu d'arrivée :</label>
    <input class="formInput w-64" type="text" id="inputLieuArrivee" name="lieuArrivee">

    <label for="covoiturageDate">Date de départ :</label>
    <input class="formInput w-36" type="date" id="inputDate" name="date">

    <label for="covoiturageTime">Heure de départ :</label>
    <input class="formInput w-28" type="time" id="inputHeure" name="heure">

    <div class="flex flex-row">
        <div>
            <label for="prix">Prix du billet :</label>
            <div class="flex flex-row items-center">
                <input class="formInput w-20" type="number" id="inputPrix" name="prix">
                <p>€</p>
            </div>
        </div>
        <div class="flex flex-col ml-5">
            <label for="nbPersonneMax">Nombre de place disponible</label>
            <input class="formInput w-20" type="number" id="inputNbPersonne" name="nbPersonneMax">
        </div>
    </div>
    <label for="description">Description :</label>
    <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
</div>

<?php
        break;

    case '3':
?>
<div class="flex flex-col">
    <input type="hidden" name="typeService" value="7">

    <label for="competenceName">Matière :</label>
    <input class="formInput w-64" type="text" id="inputNom" name="nom">

    <label for="competenceNiveau">Niveau :</label>
    <select class="formInput w-64" id="inputNiveau" name="niveau">
        <option value="1">Débutant</option>
        <option value="2">Novice</option>
        <option value="3">Avancé</option>
        <option value="4">Expérimenté</option>
        <option value="5">Expert</option>
    </select>
    <label for="competenceLocation">Lieu de l'échange :</label>
    <input class="formInput w-64" type="text" id="inputLieu" name="lieu">

    <div class="flex flex-row">
        <div>
            <label for="prix">Prix de l'échange :</label>
            <div class="flex flex-row items-center">
                <input class="formInput w-20" type="number" id="inputPrix" name="prix">
                <p>€</p>
            </div>
        </div>
        <div class="flex flex-col ml-5">
            <label for="nbPersonneMax">Nombre de place disponible</label>
            <input class="formInput w-20" type="number" id="inputNbPersonne" name="nbPersonneMax">
        </div>
    </div>

    <label for="description">Description :</label>
    <textarea class="formInput w-96" id="inputDescription" name="description"
        placeholder="Veillez à être le plus précis possible, en indiquant le lieu et l'heure si concerné par exemple"></textarea>

    <?php
        break;

    case '4':
        ?>
    <div class="flex flex-col">
        <input type="hidden" name="typeService" value="1">

        <label for="sportName">Nom de l'évènement :</label>
        <input class="formInput w-64" type="text" id="inputNom" name="nom">

        <label for="sportDate">Date de l'évènement :</label>
        <input class="formInput w-36" type="date" id="inputDate" name="date">

        <label for="sportTime">Heure de l'évènement :</label>
        <input class="formInput w-28" type="time" id="inputHeure" name="heure">

        <label for="sportLocation">Lieu de l'évènement :</label>
        <input class="formInput w-64" type="text" id="inputLieu" name="lieu">

        <div class="flex flex-row">
            <div>
                <label for="prix">Prix de l'évènement :</label>
                <div class="flex flex-row items-center">
                    <input class="formInput w-20" type="number" id="inputPrix" name="prix">
                    <p>€</p>
                </div>
            </div>
            <div class="flex flex-col ml-5">
                <label for="nbPersonneMax">Nombre de place disponible</label>
                <input class="formInput w-20" type="number" id="inputNbPersonne" name="nbPersonneMax">
            </div>
        </div>

        <label for="description">Description :</label>
        <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
    </div>
    <?php
        break;

        case '5':
        ?>
    <div class="flex flex-col">
        <input type="hidden" name="typeService" value="5">

        <label for="loisirName">Nom de l'activité :</label>
        <input class="formInput w-64" type="text" id="inputNom" name="nom">

        <label for="loisirDate">Date de l'activité :</label>
        <input class="formInput w-36" type="date" id="inputDate" name="date">

        <label for="loisirTime">Heure de l'activité :</label>
        <input class="formInput w-28" type="time" id="inputHeure" name="heure">

        <label for="loisirLocation">Lieu de l'activité :</label>
        <input class="formInput w-64" type="text" id="inputLieu" name="lieu">

        <div class="flex flex-row">
            <div>
                <label for="prix">Prix de l'activité :</label>
                <div class="flex flex-row items-center">
                    <input class="formInput w-20" type="number" id="inputPrix" name="prix">
                    <p>€</p>
                </div>
            </div>
            <div class="flex flex-col ml-5">
                <label for="nbPersonneMax">Nombre de place disponible</label>
                <input class="formInput w-20" type="number" id="inputNbPersonne" name="nbPersonneMax">
            </div>
        </div>

        <label for="description">Description :</label>
        <textarea class="formInput w-96" id="inputDescription" name="description"></textarea>
    </div>
    <?php
        break;

    case '6':
        ?>
    <div class="flex flex-col">
        <input type="hidden" name="typeService" value="3">

        <label for="autreName">Nom du service :</label>
        <input class="formInput w-64" type="text" id="inputNom" name="nom">

        <label for="autreDate">Date du service :</label>
        <input class="formInput w-36" type="date" id="inputDate" name="date">

        <label for="autreTime">Heure du service :</label>
        <input class="formInput w-28" type="time" id="inputHeure" name="heure">

        <label for="autreLocation">Lieu du service :</label>
        <input class="formInput w-64" type="text" id="inputLieu" name="lieu">

        <div class="flex flex-row">
            <div>
                <label for="prix">Prix du service :</label>
                <div class="flex flex-row items-center">
                    <input class="formInput w-20" type="number" id="inputPrix" name="prix">
                    <p>€</p>
                </div>
            </div>
            <div class="flex flex-col ml-5">
                <label for="nbPersonneMax">Nombre de place disponible</label>
                <input class="formInput w-20" type="number" id="inputNbPersonne" name="nbPersonneMax">
            </div>
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
