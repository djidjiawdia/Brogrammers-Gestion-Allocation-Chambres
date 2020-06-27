<div class="d-flex justify-content-center align-items-center h-100">
    <form action="<?= ROOT ?>/chambre/addRoom" method="post" class="w-50" id="formAddRoom">
        <div class="alert" id="alert">
        </div>
        <div class="form-group mb-4">
            <label>Numero de chambre</label>
            <input class="form-control" type="text" name="num" id="num" placeholder="Exemple: 004-0019" readonly>
        </div>
        <div class="form-group mb-4">
            <label>Type</label>
            <div class="d-flex justify-content-around" id="type">
                <label for="indiv">
                    <input type="radio" name="type" id="indiv" value="individuel">
                    Individuel
                </label>
                <label for="duo">
                    <input type="radio" name="type" id="duo" value="duo">
                    A deux
                </label>
            </div>
            <small class="text-danger"></small>
        </div>
        <div class="form-group mb-4">
            <label for="batiment">Bâtiment</label>
            <select class="form-control" name="numBat" id="numBat">
                <option value="" disabled selected>Choisir un batiment</option>
                <?php foreach($batiments as $bat): ?>
                    <option value="<?= $bat->getNumBat() ?>"><?= $bat->getLibele() ?></option>
                <?php endforeach; ?>
            </select>
            <small class="text-danger"></small>
        </div>
        <input type="hidden" id="lastId" value="<?= $id ?>">
        <button type="submit" class="btn btn-primary btn-sm">Valider</button>
    </form>
</div>