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
    			
    		} ?>
        </p>
    </div>
    <div class="col-md-5">
    	<p class="lead">
    		
    	</p>
    </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading"></h2>
        <p class="lead"></p>
    </div>
    <div class="col-md-5">
    </div>
</div>

