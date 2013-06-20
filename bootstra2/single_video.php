<?php include 'confere.php';?>


<!DOCTYPE html>
<html lang="en">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>PTNews | Videos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

     <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php"><img src="img/logotipo2.png"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="noticias.php">Noticias</a></li>
              <li class="active"><a href="videos.php">Videos</a></li>
              <li><a href="#contact">Radio</a></li>
              <li><a href="#contact">Contacto</a></li>
            </ul>
            <?php
				 if(isset($_SESSION['UsuarioNome'])) {
                        echo '<div class="nav-collapse collapse">';
                        echo '<div  class="navbar-form pull-right" >';
                        echo '<ul class="nav">';
                        echo '<li class="dropdown">';
                        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">';
                        echo $_SESSION['UsuarioNome'];
                        echo '<b class="caret"></b></a>';
                        echo '<ul class="dropdown-menu">';
                        echo '<li><a href="user.php?user='.$_SESSION["UsuarioID"].'" ><i class="icon-user"> </i>&nbspPerfil</a></li>';
                        echo '<li><a href="logout.php" ><i class="icon-off"> </i>&nbspSair</a></li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
            } 
				 else {
					echo '<form action="login_funcao.php" method="post" class="navbar-form pull-right">
  				<input type="text" name="username" id="username" class="input-medium" placeholder="Utilizador">
  				<input type="password" name="password" id="password" class="input-small" placeholder="Senha">
  				<button type="submit" name="submit" id="submit" value="Login" class="btn">Entrar</button>    
          <a href="registar.php" title="registar">Regista-te !</a>
				</form>';

       	
				 }
				?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


    <div class="container">
    
    <div class="row-fluid">
  <div class="span6">
  	
  <?php
  					
					$idVideo = $_GET['v'];
					$seleciona_videos = mysql_query("SELECT * FROM videos WHERE id_video = '$idVideo'");
					$query_video = mysql_fetch_array($seleciona_videos);
					if(strlen($query_video['codigo']) == 11){
						
						echo '<h1>'.$query_video['titulo_video'].'</h1>';
						echo '<br/>';
						echo '<iframe width="640" height="360" src="http://www.youtube.com/embed/'.$query_video['codigo'].'" frameborder="0" allowfullscreen></iframe>';
						echo '<br/>';
						echo '<p>'.$query_video['descricao_video'].'</p>';
						
					}else{
						echo '<h1>'.$query_video['titulo_video'].'</h1>';
						echo '<br/>';
						echo '<iframe src="http://player.vimeo.com/video/'.$query_video['codigo'].'?title=0&amp;byline=0&amp;portrait=0" width="640" height="360" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
						echo '<br/>';
						echo '<p>'.$query_video['descricao_video'].'</p>';
					}
					
				?>
		
	
	<br>
	<hr>
	<p>Postado por <h5><?php echo $query_video['autor'];?></h5></p>
	<p>Postado em <h5><?php echo $query_video['data'];?></h5></p>
	<hr>	
	
		
 <br><br>
 <h3> Comentários </h3>
 <br/>
  <ul class="media-list">
            <li class="media">
                <a class="pull-left" href="#">
                  <img class="media-object" src="img/avatar.jpg" width="64" height="64">
                </a>
                <div class="media-body">
                  <h4 class="media-heading">Media heading</h4>
                  <p>Cras sit amet nibh libero, in gravida nulla.</p>
               </div>
              </li>
              
              <hr>
             <?php
  				if (isset($_SESSION["UsuarioID"])) {
  					echo '<form action="" method="post" enctype="multipart/form-data">';
					echo '<h3>Comentar</h3>';
					echo '<br />';
					echo '<label>';
					echo '<span>Nome<span><br/>';
					echo '<input class="input-large" type="text" value="" readonly="readonly" name="name" maxlength="59" rows="5"/>';
					echo '</label>';
					echo '<label>';
					echo '<span>Comentário<span><br/>';
					echo '<textarea name="comentario" rows="4" cols="50"></textarea>';
					echo '</label>';
					echo ' <br />';
					echo '<input type="hidden" name="acao" value="enviar"/>';
					echo '<button class="btn btn-inverse btn-large" type="submit">Comentar</button>';
					echo ' </form>';
     } else {
      echo '<h4>Para comentar tem de ter feito login, faça-o <a href="login.php">aqui!</a></h4>';
	  echo '<h4>Se não tem conta registe-se <a href="login.php">aqui!</a></h4>';   
}
?>  	 	
  	 	
 
  </div>
  <div class="span1"></div>
  <div class="span4">
  	<h3>Videos Recentes</h3>
  	<br/><br/>
  	<?php 
											
	$pag = (isset($_GET['pag'])) ? strip_tags((int)$_GET['pag']) : '1';
	$maximo = '6';
	$inicio = ($pag * $maximo) - $maximo;
											
	$query_videos = mysql_query("SELECT * FROM videos ORDER BY id_video DESC LIMIT $inicio, $maximo") or die (mysql_error());
										
	if(mysql_num_rows($query_videos) == 0){
		echo 'Não foram encontrados videos no banco de dados!';
	}else{
	while($query = mysql_fetch_array($query_videos)){
?>
  	
  	
        <ul class="media-list">
            <li class="media">
                <a class="pull-left" href="single_video.php?v=<?php echo $query['id_video'];?>">
                  <img class="media-object" src="<?php echo $query['thumb'];?>" width="64" height="64" alt"">
                </a>
                <div class="media-body">
                  <h4 class="media-heading"><?php echo $query['titulo_video'];?></h4>
                  
               </div>
               <hr>
              </li>
            <?php }}?>
            </ul>
            </div>
   

</div>
<hr>
      
		<div id="footer"> 
			<ul class="nav nav-pills navbar-inverse">
  				<li><a href="index.php"><i class="icon-home"></i> Home</a></li>
  				<li><a href="noticias.php"><i class="icon-list-alt"></i> Noticias</a></li>
  				<li><a href="videos.php"><i class="icon-film"></i> Video</a></li>
  				<li><a href="radio.php"><i class="icon-music"></i> Radio</a></li>
  					<?php
  				if (isset($_SESSION["UsuarioID"])) {
     if ($_SESSION["UsuarioNivel"] >= "2") {
           echo "<li><a href=\"admin/index.php\"><i class=\" icon-wrench\"></i> Administrar Site</a></li>";
     } else {
         
     }
} else {
         
}
?>
			</ul>
		<p> © Samuel Costa 2013</p>
		</div>
    
    </div> <!-- Container END -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>   
    
    
     <!-- latest jQuery, Boostrap JS and hover dropdown plugin -->
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/latest/js/bootstrap.min.js"></script>
  <script src="js/twitter-bootstrap-hover-dropdown.js"></script>

  <script>
    // very simple to use!
    $(document).ready(function() {
      $('.js-activated').dropdownHover().dropdown();
    });
  </script>
    
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>