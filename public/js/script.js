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
    console.log(link);
    if(link !== ""){
        $("ul li").each((i, el) => {
            el.classList.remove("active");
            console.log(el.children[0].href.split('/')[4]);
            if(el.children[0].href.split('/')[4] == link){
                el.classList.add("active");
            }
        })
    }
})