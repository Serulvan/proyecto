$(document).ready(function(){
    $(".chbox").change(alternar_chbox);
});

function alternar_chbox(){
    if($(this).is(":checked")){
        console.log(true);
    }else{
        console.log(false);
    }
}