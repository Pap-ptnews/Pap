<?php include 'confere.php';?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>PTNews | Perfil</title>
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
              <li><a href="videos.php">Videos</a></li>
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
                        echo '<li><a href="user.php?user='.$_SESSION["UsuarioID"].'" ><i class="icon-user"> </i>&nbsp Perfil</a></li>';
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
  	 <form action="" method="post" enctype="multipart/form-data">
  	 	<div class="well" >
  	 	<h1>Dados do Utilizador</h1>
		</div>
  	 	<br />
  	 	<?php
  	 	
  	 	$id = $_SESSION["UsuarioID"];
		$selecionaUtilizadores = mysql_query("SELECT * FROM utilizadores WHERE id_utilizador = '$id'") or die (mysql_error());
		$query = mysql_fetch_array($selecionaUtilizadores);
		
			if(isset($_POST['acao']) && $_POST['acao']=='enviar'){

			
		
			
			$email = $_POST['email'];
			$password = $_POST['password'];
		
				$editar_user = mysql_query("UPDATE utilizadores SET email = '$email', password = '$password' WHERE id_utilizador = '$id'") or die(mysql_error());
							
		if($editar_user){
					echo "<div class='alert alert-success'>";
					echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
					echo "Dados Alterados com sucesso!";
					echo "</div>";	
		}else{
			echo "<div class='alert alert-error'>";
					echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
					echo "Falha ao alterar dados!";
					echo "</div>";		
		}
	}
		
?>
  	 	<label>
            	<h5>Username</h5>
                <input class="input-large" type="text" value="<?php echo $_SESSION["UsuarioNome"]; ?>" readonly="readonly" name="username" maxlength="59" rows="5"/>
            </label>
              
            <label>
            	<h5>Email</h5>
                <input class="input-large" type="text"  name="email" value="<?php echo $query["email"]; ?>" maxlength="59" rows="5"/>
            </label>
              
            <label>
            	<h5>Password</h5>
                <input class="input-large" type="password" name="password" value="<?php echo $query["password"]; ?>" maxlength="59" rows="5"/>
            </label>
          <br />  
            <input type="hidden" name="acao" value="enviar"/>
            <button class="btn btn-inverse btn-large" type="submit">Editar</button> 
  	 	
  	 	 </form>
  	
  	
  	
  	
  </div> <!--Fim Span 6 -->
  
  </div> <!--Fim Row-Fluid -->

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
    
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>