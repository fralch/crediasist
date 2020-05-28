function reloj(){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    str_segundo = segundo.toString().length;
    str_minuto = minuto.toString().length;
    str_hora = hora.toString().length;

    if (str_segundo !=2 ) {
        segundo = "0"+segundo;
    }
    if (str_minuto !=2 ) {
        minuto = "0"+minuto;
    }
    if (str_hora !=2 ) {
        hora = "0"+hora;
    }





    horaImprimible = "<strong style='color:#244B98;'>"+hora + ":" + minuto +"</strong>"+ ":" + segundo
    document.getElementById("reloj").innerHTML = "<p>"+ horaImprimible +"</p>"

    setTimeout("reloj()",1000)
} 
window.onload = reloj();