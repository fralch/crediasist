

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  
    var mapa;
    function initMap() {
        var obj= navigator.geolocation.getCurrentPosition(fn_ok, fn_mal);

        function fn_mal() {
            alert("algo salio mal");
        }
        function fn_ok(rta) {

            var posicion = {
                lat: rta.coords.latitude,
                lng: rta.coords.longitude
            }
            var opcionesMapa = {
                center: posicion,
                zoom: 16,
                
            }
            mapa= new google.maps.Map(document.getElementById('map'),opcionesMapa);
            
            var maker= new google.maps.Marker({
                position: posicion,
                map: mapa
            });
        }
    }

    var userAgent = navigator.userAgent;
    console.log(userAgent);
 }
 else{
    console.log("ingreso desde desktop");
 }




