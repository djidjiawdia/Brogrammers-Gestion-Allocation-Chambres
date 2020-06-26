<?php
    // print_r($data)
?> 
<div>
    <a class="btn btn-outline-primary btn-sm" href="<?= ROOT ?>/etudiant/nouveau">
        <span><i class="fas fa-plus"></i></span>
        Ajouter
    </a>
</div>
<div>
    <form class="d-flex justify-content-end mt-2" action="" method="post">
        <div class="row align-items-center">
            <div class="col-8 d-flex justify-content-end">
                <input type="text" name="mat" id="mat" class="form-control mb-2 mr-2" placeholder="Matricule">
                <input type="text" name="mat" id="mat" class="form-control mb-2 mr-2" placeholder="Num chambre">
                <select name="type" id="type"  class="form-control mb-2 mr-2">
                    <option value="" selected disabled>Type</option>
                    <option value="1">Non Boursier</option>
                    <option value="2">Boursier</option>
                    <option value="3">Logier</option>
                </select>
            </div>
            <div class="col-4 row">
                <button type="submit" class="btn btn-primary btn-sm mb-2 mr-2">Chercher</button>
                <button class="btn btn-danger btn-sm mb-2 mr-2">Effacer</button>
            </div>
        </div>
    </form>
</div>
<div class="col-11">
    <div class="table-responsive" id="scrollZone">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Bourse</th>
                    <th>Chambre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        let offset = 0;
        const tbody = $("#tbody");
        $.ajax({
            url: '<?= ROOT ?>/etudiant/showAll',
            type: 'POST',
            data: {limit: 2, offset: offset},
            beforeSend: function(){
                tbody.html('<tr><td colspan="8">Loading...</td></tr>')
            },
            success: function(res){
                tbody.html('')
                tbody.html(res);
                offset += 2;
            }
        });
        
        const scrollZone = $('#scrollZone')
        scrollZone.scroll(() => {
            const st = scrollZone[0].scrollTop;
            const sh = scrollZone[0].scrollHeight;
            const ch = scrollZone[0].clientHeight;


            if(Math.ceil(sh-st)-1 <= ch){
                $.ajax({
                    url: '<?= ROOT ?>/etudiant/showAll',
                    type: 'POST',
                    data: {limit: 2, offset: offset},
                    success: function(res){
                        tbody.append(res);
                        offset += 2;
                    }
                });
            }
        })
    });
    
</script>