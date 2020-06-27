$(document).ready(function(){
    /** Menu Hamburger **/
    $(".btn-menu").on("click", function(){
        if($('.menu').css("display") == "none"){
            $('.menu').css("display", "flex");
            $(".btn-menu span").html('<i class="fas fa-times"></i>');
        }else{
            $('.menu').css("display", "none")
            $(".btn-menu span").html('<i class="fas fa-bars"></i>');
        }
    });

    /** Navigation **/
    const link = location.href.split('/')[4];
    if(link !== ""){
        $("ul li").each((i, el) => {
            el.classList.remove("active");
            if(el.children[0].href.split('/')[4] == link){
                el.classList.add("active");
            }
        })
    }
    // On change
    $("#numBat").on("change", function(){
        $("#num").val(generateNumChambre(parseInt($("#lastId").val())+1, $(this).val()));
    });

    // Focus Out
    $("#numBat").on("focusout", function(){checkRequired([$(this)])});

    // Form Ajouter une chambre
    $("#formAddRoom").on("submit", function(e){
        e.preventDefault();
        if(checkRequired([$("#numBat")]) && checkOption([$("#type")])){
            $.ajax({
                url: $(this).attr("action"),
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    if(res.type == "success"){
                        $("#formAddRoom")[0].reset();
                        $("#alert").addClass("alert-success");
                    }else{
                        $("#alert").addClass("alert-danger");
                    }
                    $("#alert").html(res.message);
                    $("#alert").show();
                }
            })
        }
    })

    
})

function generateNumChambre(id, val){
    let num = '';
    if(val <= 9){
        num = `00${val}`;
    }else if(val > 9 && val <= 99){
        num = `0${val}`;
    }else if(val > 99){
        num = `${val}`;
    }
    if(id <= 9){
        num += `-000${id}`;
    }else if(id > 9 && id <= 99){
        num += `-00${id}`;
    }else if(id > 99 && id <= 999){
        num += `-0${id}`;
    }else if(id > 999){
        num += `-${id}`;
    }
    return num;
}