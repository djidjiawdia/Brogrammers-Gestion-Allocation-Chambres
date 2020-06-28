<div class="d-flex justify-content-center align-items-center h-100">
    <form action="<?= ROOT ?>/etudiant/addStud" method="post" class="w-50" id="formAddStud">
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Maricule de l'étudiant</label>
                <input class="form-control" type="text" name="mat" id="mat" placeholder="2020 DI DJ 0001" readonly>
            </div>
            <div class="form-group col-sm-6">
                <label>Prénom</label>
                <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Djiadji">
            </div>
            <div class="form-group col-sm-6">
                <label>Nom</label>
                <input class="form-control" type="text" name="nom" id="nom" placeholder="Diaw">
            </div>
            <div class="form-group col-sm-6">
                <label>Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="djidji@gmail.com">
            </div>
            <div class="form-group col-sm-6">
                <label>Téléphone</label>
                <input class="form-control" type="text" name="tel" id="tel" placeholder="777000001">
            </div>
            <div class="form-group col-sm-6">
                <label>Type</label>
                <div class="d-flex justify-content-around" id="type">
                    <label for="boursier">
                        <input type="radio" name="type" id="boursier" value="boursier">
                        Boursier
                    </label>
                    <label for="non_boursier">
                        <input type="radio" name="type" id="non_boursier" value="non_boursier">
                        Non Boursier
                    </label>
                </div>
            </div>
        </div>
        <div class="row" id="content"></div>
        
        <input type="hidden" id="lastId" value="<?= $id ?>">
        <button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
    </form>
</div>

<script>
    $("input[name=type]").on("click", function(){
        $("#content").empty();
        if($(this).val() == "boursier"){
            $("#content").append(generateChoice("Pension", "Complète", "Demi Bourse", "pension", "complete", "demi"));
            $("#content").append(generateChoice("Staut", "Logier", "Non Logier", "statut", "logier", "non_logier"));
            $("input[name=statut]").on("click", function(){
                if($(this).val() == "logier"){
                    const input = `
                        <div id="numc" class="form-group col-sm-6">
                            <label>Numéro Chambre</label>
                            <select class="form-control" name="numBat" id="numBat">
                                <option value="" disabled selected>Choisir un numero</option>
                                <?php foreach($chambre as $c): ?>
                                    <option value="<?= $c->getId() ?>"><?= $c->getNum() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    `;
                    $("#content").append(input);        
                }else{
                    if($("#numc").length > 0){
                        $("#numc").remove();
                    }
                }
            })
        }else{
            const input = `
                <div class="form-group col-sm-6">
                    <label>Adresse</label>
                    <input class="form-control" type="text" name="adresse" id="adresse" placeholder="HLM Maristes">
                </div>
            `;
            $("#content").html(input);
        }
    })
</script>
