<?php
require_once 'classes/usuario.php';
$u = new Usuario;


?>


<html lang="pt-br"> 

<head>
  <meta charset= "utf-8"/>
  <tittle>Projeto Login@joseph</tittle>    
  <link rel="stylesheet" href="CSS/estilo.css">

</head>
<body>
  <div id= "corpo-form-card">
  <h1>Cadastrar</h1>
    <form method= "POST">

  <input type= "text" name="nome" placeholder = "Nome Completo"  maxlength="30" >
  <input type= "text"  name="telefone" placeholder = "Telefone"  maxlength="30">
  <input type= "email"  name="email" placeholder = "Usuario" maxlength="40" >
  <input type= "password"  name="senha" placeholder= "Senha" maxlength="15">
  <input type= "password"  name="confsenha" placeholder = "Confirmar Senha" maxlength="15" >
  <input type= "submit" value = "Cadastrar">
  
</div>

<?php
//verificar se clicou no botão ou a exixtencia de uma variavel
if(isset($_POST['nome']))
{
  // codigo "addslashes" é para evitar a inserção de dados por terceiros
   $nome =  addslashes ($_POST['nome']);
   $telefone =  addslashes ($_POST['telefone']);
   $email =  addslashes ($_POST['email']);
   $senha =  addslashes ($_POST['senha']);
  $confirmarsenha =  addslashes ($_POST['confsenha']);
  // vericaremos se estar preenchido
  if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
  {
    // conexão com banco de dados
      $u->conectar("projeto_login","localhost", "root","");
      if($u->msgErro == "") //se esta tudo correto
      {

        if($senha == $confirmarsenha)
        {
          if($u->cadastrar($nome, $telefone, $email, $senha))
            {
              ?>
              <div id="msg-sucesso">
            cadastrado com sucesso! Acesse para entrar!
          <?php 
            }
         
          else
          {
            ?>
            <div class="msg-erro">
          Email já cadastrado!
          </div>
        <?php 
             
          } 
        }
        
       else
       {
          ?>
          <div class="msg-erro">
          senha e confirmar senha não correspondem!
          </div>
         <?php 
      

        }
      }
      else
      {
        ?>
    <div clas="msg-erro">
        <?php echo "Erro: " . $u->msgErro;?>
      </div>
      <?php
      }
  }else
  {

    ?>
    <div class="msg-erro">
    preencha todos os campos!
    </div>
   <?php 
  
  }
}
?>  
</body>
</html> 