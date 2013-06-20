<?php
	include_once "config.php";

 

$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
 
#//retirando espaços
   $username=trim($username);
   $email=trim($email);
   $password=trim($password);
 
  $erro=0;
 
#//verificar se há email cadastrado no BD
   $s=mysql_query("SELECT * FROM utilizadores WHERE email='$email'")or die(mysql_error());
   $mnr=mysql_num_rows($s);
 
if($mnr!=0){ echo '<center><font color="#FF0000">E-mail já registado!</font>'; $erro++; }
 
#//se não encontrar @
   function validaEmail($email){
	if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(\.[[:lower:]]{2,3})(\.[[:lower:]]{2})?$/", $email)) {
		return true;
	}else{
	echo '<center><font color="#FF0000">E-mail incorreto!</font>';
   $erro++; }
}
   
 
 
#//verificar se campo nome foi setado
   if(empty($username)){
   echo '<center><font color="#FF0000">Digite um username!</font>';
   $erro++; }
 
 
if($erro==0){
#//inseri no banco de dados se tudo for OK
   $i=mysql_query("INSERT INTO utilizadores (username, email, password) VALUES ('$username','$email','$password')")or die(mysql_error());
   echo '<center> Registo efetuado com sucesso!<br><br>
   <p><a href="registar.php"><b>(Continuar...)</b></a></p>
   ';
}
?>