<html lang="pt-br"> 

<head>
  <meta charset= "utf-8"/>
  <tittle>Projeto Login @joseph</tittle>
  <link rel="stylesheet" href="CSS/estilo.css">
<style>
*{
margin: 0 ;
}
 @media(max-width: 1200px){
  section{ 
  width: 1000px ;
  } 
}


</style>
</head>
<body>
  <div id= "corpo-form">
  <h1>Entrar</h1>
  <form method= "POST" action= "processa.php">
   
  <input type= "email" placeholder = "Usuario"  name="email">
  <input type= "password" placeholder= "Senha" name="senha">
  <input type= "submit" value = "Acessar">
  <a href="cadastrar.php"> Ainda não é inscrito? <strong >Cadastri-se</a></strong>
</div>
   </form>
</body>
</html>