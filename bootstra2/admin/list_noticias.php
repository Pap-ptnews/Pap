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
    
    <div class="row-fluid">
        <div class="span12">
            <h2>Gestão de Notícias</h2> <br/>
            
             <?php
			 if (isset($_GET['not']) && $_GET['not']!=""){
			 
			 			 $deletar_sql = "DELETE FROM noticias WHERE id_noticia = '".$_GET['not']."'";
			$deletar_post = mysql_query($deletar_sql) or die (mysql_error());
				if($deletar_post>=1){
					echo "<div class='alert alert-info'>";
					echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
					echo "Notícia Eliminada com sucesso!";
					echo "</div>";
				}else {
					echo "<div class='alert'>";
					echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
					echo " Não foi possível eliminar a notícia!";
					echo "</div>";
				}
			 
			 }
			 $haNoticias = false;
			 
			 $pag = (isset($_GET['pag'])) ? strip_tags((int)$_GET['pag']) : '1';
					$maximo = '15';
					$inicio = ($pag * $maximo) - $maximo;
											
								$query_listar_noticias = mysql_query("SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT $inicio, $maximo ") or die (mysql_error());
										
								if(mysql_num_rows($query_listar_noticias) > 0){
									$haNoticias = true;
								}
			 

				
				?>
                
                <br/>
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
				  <th>Título</th>
				  <th>Imagem</th>
				  <th>Notícia</th>
				  <th>Data</th>
				  <th>Autor</th>
				  <th>Editar</th>
				  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  if (!$haNoticias) {
				  echo 'Não foram encontradas notícias na base de dados!';
			  }
			else{
									while($listarNoticias = mysql_fetch_array($query_listar_noticias)){
		?>
                <tr class="info">
                  <td><?php echo $listarNoticias['id_noticia'];?></td>
                  <td><?php echo substr($listarNoticias['titulo'],0,50);?></td>
                  <td><?php echo substr($listarNoticias['imagem'],0,30);?></td>
                  <td><?php echo substr($listarNoticias['noticia'],0,100);?></td>
                  <td><?php echo $listarNoticias['data'];?></td>
                  <td><?php echo $listarNoticias['autor'];?></td>
                  <td><a href="edit_noticia.php?edit=<?php echo $listarNoticias['id_noticia'];?>"><i class="icon-pencil"></i> </a></td>
                  <td><a href="list_noticias.php?not=<?php echo $listarNoticias['id_noticia'];?>"><i class="icon-trash"></i></a></td>
                </tr>
                <?php } }?>
              </tbody>
            </table>
            
           
      
            <?php
				$noticias = mysql_query("SELECT * FROM noticias")or die(mysql_error());
				$totalRegistros = mysql_num_rows($noticias);
				$paginas = ceil($totalRegistros/$maximo);
				$links = '4';
				?>				
						<ul class='pager'>
						
							<li class='first-page'><?php echo '<a href="list_noticias.php?pag=1"> << </a>';?></li>
							
							<?php
							for($i = $pag-$links; $i <= $pag-1; $i++){
					if($i <= 0){
					}else{
						echo '<li><a href="list_noticias.php?pag='.$i.'">'.$i.'</a></li>';
					}
				}
				for($i = $pag+1; $i <= $pag+$links; $i++){
					if($i>$paginas){
					}else{
						echo '<li><a href="list_noticias.php?pag='.$i.'">'.$i.'</a></li>';
					}
				}
					?>	
							<li class='last-page'><?php echo '<a href="list_noticias.php?pag='.$paginas.'"> >> </a>';?></li>
						</ul>
						<!-- ENDS pagination -->
  
  
  
        </div>
  
    </div>
        

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