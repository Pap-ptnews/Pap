<?php include 'confere.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>PTNews | Videos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

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
  <div class="span8">
  <div class="well" >
  	<h1>Videos</h1>
	</div>
  	<br/><br/>
  	 <ul class="media-list">
  	 	<?php
			$pag = (isset($_GET['pag'])) ? strip_tags((int)$_GET['pag']) : '1';
			$maximo = '6';
			$inicio = ($pag * $maximo) - $maximo;
			
			$seleciona_videos = mysql_query("SELECT * FROM videos ORDER BY id_video DESC LIMIT $inicio, $maximo") or die (mysql_error());
			if(mysql_num_rows($seleciona_videos) == 0){
					echo 'Não foram encontrados vídeos no banco de dados!';
			}else{
				while($linhaVideos = mysql_fetch_array($seleciona_videos)){
			?>
							
            <li class="media">
                <a class="pull-left" href="single_video.php?v=<?php echo $linhaVideos['id_video'];?>">
                  <img href="single_video.php?v=<?php echo $linhaVideos['id_video'];?>" class="media-object" src="<?php echo $linhaVideos['thumb'];?>" width="120" height="120">
                </a>
                <div class="media-body">
                  <h4 class="media-heading"><?php echo $linhaVideos['titulo_video'];?></h4>
                  <p><?php echo $linhaVideos['descricao_video'];?></p>
               </div>
              </li>
              <?php }}?>
              
              <hr>
              
            
            </ul>
  	
  	
  	<div class="pagination">
<?php
	$noticias = mysql_query("SELECT * FROM videos")or die(mysql_error());
	$totalRegistros = mysql_num_rows($noticias);
	$paginas = ceil($totalRegistros/$maximo);
	$links = '6';
?>		
  <ul>
    <li><?php echo '<a href="videos.php?pag=1"> <<</a>';?></li>
                    <?php
							for($i = $pag-$links; $i <= $pag-1; $i++){
					if($i <= 0){
					}else{
						echo '<li><a href="videos.php?pag='.$i.'">'.$i.'</a></li>';
					}
				}
				for($i = $pag+1; $i <= $pag+$links; $i++){
					if($i>$paginas){
					}else{
						echo '<li><a href="videos.php?pag='.$i.'">'.$i.'</a></li>';
					}
				}
					?>	
    <li><?php echo '<a href="videos.php?pag='.$paginas.'"> >> </a>';?></li>
 </ul>
</div>
  	</div>
  
  <div class="span2">
  <div class="well" >
  	<h3>Categorias</h3>	
	</div>
  	
  	
  	
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
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
    
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

  </body>
</html>
</div> <!--Fim Container -->
    
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