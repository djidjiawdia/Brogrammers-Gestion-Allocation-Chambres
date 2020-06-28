<div>
    <a class="btn btn-outline-primary btn-sm" href="<?= ROOT ?>/chambre/nouveau">
        <span><i class="fas fa-plus"></i></span>
        Ajouter
    </a>
</div>
<div class="mt-2 col-11 table-responsive">
    <table class="table text-center">
        <thead>
            <tr>
                <th>Numéro Chambre</th>
                <th>Type</th>
                <th>Bâtiment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <tr>
                <td colspan="4">Loading...</td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <p>Page :</p>
        <ol id="numbers"></ol>
    </div>
</div>

<script>
    let offset = 0;
    const limit = 5;
    $(document).ready(function(){
        const body = $('#tbody');
        $.ajax({
            url: '<?= ROOT ?>/chambre/showRoom',
            type: 'POST',
            data: {limit: limit, offset: offset},
            dataType: 'json',
            success: function(res){
                body.html(res.body);
                console.log(res);
            }
        });
    });
</script>

