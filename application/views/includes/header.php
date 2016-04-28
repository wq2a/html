<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" pageEncoding="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>nest</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>public/image/hqico.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/mystyle.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrap/css/offcanvas.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrap/js/offcanvas.js"></script>
</head>

<script>
function search()
{
	var itemname = document.getElementById('itemname').value;
	if(itemname!='')
	{
		var url = '<?php echo base_url() ?>index.php/purchased/searchitems/'+((itemname=='')?'null':itemname);
		window.location.href = url;
	}
}
function jump(url)
{
	window.location.href = url;
}
</script>
<body>
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
    	
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <div id="logo"><h1>Ho~<a href="<?php echo base_url(); ?>">nest</a></h1></div>
       </div>
       
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($navigation=='Home'?'class="active"':'')?> ><a href="<?php echo base_url()?>">首 页</a></li>
            <!--
            <li <php echo ($navigation=='Stock'?'class="active"':'')?>><a href="<php echo base_url().'index.php/stock'; ?>">股 票</a></li>
            <li <php echo ($navigation=='Lottery'?'class="active"':'')?>><a href="<php echo base_url().'index.php/lottery'; ?>">彩 票</a></li>
            -->
            <?php 	if($is_logged_in){
            			//echo 	'<li '.($navigation=='Sale'?'class="active"':'').'><a href="'.base_url().'index.php/sale">销 售</a></li>'.
                    echo '<li '.($navigation=='Product'?'class="active"':'').'><a href="'.base_url().'index.php/product">商 品</a></li>'.
            			 		'<li '.($navigation=='Purchased'?'class="active"':'').'><a href="'.base_url().'index.php/purchased">采 购</a></li>'.
            			 		'<li '.($navigation=='System'?'class="active"':'').'><a href="'.base_url().'index.php/system">系 统</a></li>'.
            			 		'<li '.($navigation=='Logout'?'class="active"':'').'><a href="'.base_url().'index.php/logout">退 出</a></li>';
            		}else{
            			echo 	'<li '.($navigation=='Login'?'class="active"':'').'><a href="'.base_url().'index.php/login">登 陆</a></li>';
            		}
            ?>
          	</ul>
            <ul class="nav navbar-nav navbar-right">
            <?php   if($is_logged_in){
                        if($this->cart->total_items()>0){
                          echo '<li '.($navigation=='Cart'?'class="active"':'').'><a href="'.base_url().'index.php/cart">购物车
                          <span id="carttag" class="badge" style="background-color:#c00000;">'.$this->cart->total_items().'</span></a></li>';
                        }else{
                          echo '<li '.($navigation=='Cart'?'class="active"':'').'><a href="'.base_url().'index.php/cart">购物车
                          <span id="carttag" class="badge" style="background-color:#c00000;"></span></a></li>';
                        }
                }
            ?>
            </ul>
            <!--
          	<div class="input-group col-md-2  navbar-right" style="margin-top:8px;">
      			   <input name="q" id="itemname" type="text" class="form-control" placeholder="商品名称..." data-autocomplete-disabled="false">
      			   <span class="input-group-btn">
        			 <button class="btn btn-default" type="button" onclick="search()">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      			   </span>
    		    </div>--><!-- /input-group -->
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
</nav>
<div class="container">

   
