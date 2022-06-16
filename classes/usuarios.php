<?php
//para ter a coneção com o PDO necessitamos de alguns parametros.
class Usuario
{
    private $pdo;
    public $msgErro = ""; //obserção nessa variavel ela poder ser que estava dando o erro 


    public function conectar($nome,$host, $usuario, $senha) // essa função fará conexão com o banco de da dados fazer envio para o banco

    {
      global $pdo;
      try //caso dê algum erro na conexão, o try irá capturar o erro e mostrará na tela
      {
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
      }
      catch(PDOException $e)
      {
        $msgErro = $e->getMessage();
      }
      

    }

    public function cadastrar($nome, $telefone, $email, $senha) 
    {
    
        global $pdo;
        //verificar se o email já está cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
    
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount() > 0) //o rowCounte conta a quantidades de linha que vinheram no banco de dados
        {
          return false;// já cadastrado
        }
        else
        {
          //caso não esteja cadastrado, será feito o cadastro

            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s",md5 ($senha));
                $sql->execute();
                return true; // ja foi cadastrado
        }


    }


    public function logar( $email, $senha)  //verifi se o usuario está cadastrado ou não 
    {
        global $pdo;
//verificar se o email já está cadastrado, se sim
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0)
        {
          //se estiver cadastrado, fazer o login
          $dado = $sql->fetch();//fetch pega tudo que esta dentro do banco de dados e transforma em um array
          session_start();//startando a sessão 
          $_SESSION['id_usuario'] = $dado['id_usuario'];
          return true; // cadastrado com sucesso
        }
        else
        {
          return false;//não cadastrado
        }
    }

}



?>