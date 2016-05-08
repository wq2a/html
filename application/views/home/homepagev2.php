<?php $this->load->view('home/homev2');?>

<h1>V2.0.2</h1>

<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading">Lottery<span class="text-muted">
       
    	</span>
        </h2>
        <p class="lead">
        <?php foreach ($kj->result() as $item) {
    			
  				echo '<em class="smallRedball">'.$item->red1.'</em>';
  				echo '<em class="smallRedball">'.$item->red2.'</em>';
  				echo '<em class="smallRedball">'.$item->red3.'</em>';
  				echo '<em class="smallRedball">'.$item->red4.'</em>';
  				echo '<em class="smallRedball">'.$item->red5.'</em>';
  				echo '<em class="smallRedball">'.$item->red6.'</em>';
  				echo '<em class="smallBlueball">'.$item->blue.'</em>';
          
    		}
        ?>
        </p>
    </div>
    <div class="col-md-5">
    	<p class="lead">
    		
    	</p>
    </div>
</div>

<hr class="featurette-divider">



<!--   
<div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading"></h2>
        <p class="lead"></p>
    </div>
    <div class="col-md-5">
    </div>
</div>

<hr class="featurette-divider">

<ul id="messages"></ul>
<form>
<input id="m"/><button>Send</button>
</form>

<hr class="featurette-divider">


<div id="map" style="height:500px;width:100%;"></div>
<script>
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      $('#messages').append(position.coords.latitude).append(',').append(position.coords.longitude);
    },function() {
      //handleLocationError(true, infoWindow, map.getCenter());
    });
}
</script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjrtyjShN-EvEizM_UT2-52Hj_WXrcD2o&signed_in=true&callback=initMap" async defer>
</script>
<script>
      var socket = io('http://192.168.149.63:3000');
      $('form').submit(function(){
        socket.emit('chat message', $('#m').val());
        $('#m').val('');
        return false;
      });
      socket.on('chat message', function(msg){
        $('#messages').append($('<li>').text(msg));
      });
</script>-->