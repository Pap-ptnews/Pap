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
     
       <!-- TinyMCE -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,preview,media,searchreplace,contextmenu,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,cleanup,code,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

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
            <form action="" method="post" enctype="multipart/form-data">
                   <h2>Gestão de Videos</h2>  <br/> 
                   <?php 
				   if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
		$url = strip_tags(trim($_POST['url']));
		
		if(substr_count($url, 'youtube') == 1){
			$idVid = substr($url, 31, 11);
			$titulo = $_POST['titulo'];
			$img = $_POST['imagem'];
			$descricao = $_POST['descricao'];
			$data = $_POST['data'];
			$autor = $_POST['autor'];
		}elseif(substr_count($url, 'vimeo') == 1){
			$idVid = substr($url, 17);
			$titulo = $_POST['titulo'];
			$img = $_POST['imagem'];
			$descricao = $_POST['descricao'];
			$data = $_POST['data'];
			$autor = $_POST['autor'];
		}
		
		$cadastra_video = mysql_query("INSERT INTO videos(titulo_video, thumb, descricao_video, codigo) VALUES('$titulo','$img','$descricao','$idVid')");
		if($cadastra_video){
			echo "<div class='alert alert-success'>";
			echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
			echo "Vídeo Inserido com sucesso!";
			echo "</div>";
		}else{
			echo "<div class='alert alert-info'>";
			echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
			echo "Falha ao inserir vídeo!";
			echo "</div>";		
		}
	}	
	?>
                   
            <label>
            	<h5>Url do Video</h5>
                <input class="input-xxlarge" type="text" placeholder="Url do Video" name="url" maxlength="59" rows="5"/>
            </label>
            <br/>       
        	<label>
            	<h5>Título</h5>
                <input class="input-xxlarge" type="text" placeholder="Título do Video" name="titulo" maxlength="59" rows="5"/>
            </label>
            
            	<br/>
            
            <label>
            	<h5>Imagem</h5>
            	<input class="input-xxlarge" type="text" placeholder="URL da Imagem" name="imagem"/>
            </label>
            
            	<br/>
            
            <label>
            	<h5>Descrição</h5>
                <textarea name="descricao" rows="4" cols="50"></textarea>
            </label>
                
            	<br/>
            
            <h5>Data</h5>
                <input class="input-medium" type="text" name="data" value="<?php echo date('d/m/Y');?>"/>
               <br/>
               
            <h5>Autor</h5>
            	<input class="input-medium" type="text" name="autor" value="Admin"/> 
               <br/>
               <br/>
             
            
            <input type="hidden" name="acao" value="enviar"/>
            <button class="btn btn-large" type="submit">Regista</button>
            
            </form>
  
  
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
    
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php
}
else {
echo "<script>alert('Não tens acesso a esta area...');</script> <meta http-equiv='refresh' content='0; url=../noticias.php'>";
}
?>