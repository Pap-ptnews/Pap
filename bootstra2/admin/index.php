<?php
	include_once "confere.php";

$id = $_SESSION['UsuarioID']; // Session do membro

$sql = mysql_query("SELECT * FROM utilizadores WHERE id_utilizador='$id'");
$sqlM = mysql_fetch_assoc($sql);
$membro = $sqlM['nivel']; // Isto pega o nivel do membro

if($membro >= 2){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>PTNews | Area Admin</title>
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
    
      <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>   
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
     <script src="js/bootstrap-dropdown.js"></script>
  </head>

  <body>

   <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php"><img src="../img/logotipo1.png"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
            	<li><a href="../index.php"><i class="icon-search"> </i>Visitar Site</a></li>
              <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Notícias<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="ad_noticias.php" ><i class="icon-pencil"> </i>&nbsp Inserir</a></li>
            <li><a href="list_noticias.php" ><i class="icon-eye-open"> </i>&nbsp Editar/Listar</a></li>
            </ul>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Videos<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="ad_videos.php" ><i class="icon-pencil"> </i>&nbsp Inserir</a></li>
            <li><a href="list_videos.php" ><i class="icon-eye-open"> </i>&nbsp Editar/Listar</a></li>
            </ul>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Comentários<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#dropdown1" ><i class="icon-thumbs-up"> </i>&nbsp Aprovar/Eliminar</a></li>
            <li><a href="#dropdown2" ><i class="icon-eye-open"> </i>&nbsp Listar</a></li>
            </ul>
              
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
                        echo '<li><a href="../user.php?user='.$_SESSION["UsuarioID"].'" ><i class="icon-user"> </i>&nbspPerfil</a></li>';
                        echo '<li><a href="../logout.php" ><i class="icon-off"> </i>&nbspSair</a></li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
            } 
				
				
				?>
            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    

    <div class="container">
    	<script language="JavaScript" src="http://freehostedscripts.net/date.php"></script>

<hr>
      
		<div id="footer"> 
			<ul class="nav nav-pills navbar-inverse">
  				<li><a href="../index.php"><i class="icon-home"></i> Home</a></li>
  				<li><a href="../noticias.php"><i class="icon-list-alt"></i> Noticias</a></li>
  				<li><a href="../videos.php"><i class="icon-film"></i> Video</a></li>
  				<li><a href="../radio.php"><i class="icon-music"></i> Radio</a></li>
  				<?php
  				if (isset($_SESSION["UsuarioID"])) {
     if ($_SESSION["UsuarioNivel"] >= "2") {
           echo "<li><a href=\"index.php\"><i class=\" icon-wrench\"></i> Administrar Site</a></li>";
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
    
    
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php
}
else {
echo "<script>alert('Não tens acesso a esta area...');</script> <meta http-equiv='refresh' content='0; url=../noticias.php'>";
}
?>