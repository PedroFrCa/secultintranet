<?php

function db_isallowed($user, $pass, $tabela) {
    // Create connection
    $conn = new mysqli("localhost", "user", "user", "secultdb");

    // Checa se a conexão foi estabelecida
    if ($conn->connect_error) {
        $_SESSION["error"]= ("A conexão com o banco de dados falhou.");
        return 0;
    }

    $sql = ("SELECT name, password, $tabela FROM users WHERE name='$user' AND $tabela=1");
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        if (password_verify($row["password"], $pass))
            return 1;
        else
            $_SESSION["error"] = "Senha incorreta";
    }
    else
        $_SESSION["error"] = ("Dados incorretos, ou a conta não possui permissão de edição para essa tabela");
    return 0;
}

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Intranet SECULT</title>
        <link rel="sortcut icon" href="arquivos/favicon.ico" type="image/ico">
        <link href="include/secultintranet.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@500&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <!-- JQuery para funcao load -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script> 
        //Funcao para carregamento de cabecalho e rodape a partir dos arquivos
            $(function(){
              $("#header").load("header.php"); 
              $("#footer").load("footer.html");
            });
        </script>
    </head>

    <body>
        <div id="header"></div>
        <!-- Page main content start -->
        <main>
        <?php
            //inicializa o $_SESSION, caso não tenha sido inicializado ainda na página
            if(!isset($_SESSION)){
                session_start();
                $_SESSION["tabela"] = false;
                $_SESSION["error"] = "";
            }
            //verifica se o formulario foi enviado, e pega os valores de usuario e senha, caso tenha sido
            if(isset($_POST["submit"])) {
                $user = $_POST["user"];
                $pass = $_POST["pass"];
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                $tabela = $_POST["tabela"];
                //testa se o usuario existe e tem permissao de edicao da tabela
                if(db_isallowed($user, $hashed_password, $tabela)) {
                    //inicializa a sessao e mostra a pagina protegida
                    $_SESSION["tabela"] = $tabela;
                    echo $_SESSION["tabela"];
                    header("location: editar-$tabela.php");
                }
                //mostra a mensagem de erro
                else {
                    ?><style>
                        .alerta {display: flex};
                    </style>
                <?php
                }
            }
            //caso a secao nao tenha sido estabelecida ainda, mostra o formulario
            if (!$_SESSION["tabela"]) {
                ?>
                <section id="login-section">
                    <h1 class="section-title">Login</h1>
                    <div class='alerta'>
                        <p><?=$_SESSION["error"]?></p>
                    </div>
                    <form id="formulario" method="POST" action="login.php">
                        <div class="inputGroup selector">
                            <label>Tabela</label>
                            <select name="tabela">
                                <option value="aniversariantes">Aniversariantes</option>
                                <option value="avisos">Avisos</option>
                                <option value="datasespeciais">Datas Especiais</option>
                                <option value="equipe">Equipe</option>
                                <option value="logomarcas">Logomarcas</option>
                                <option value="modelos">Modelos</option>
                                <option value="navbar_sites">Menu Sites</option>
                                <option value="ramais">Ramais</option>
                                <option value="suporte">Suporte</option>
                                <option value="users">Usuários</option>
                            </select>
                        </div>
                        <div class="inputGroup">
                            <label>Usuário</label>
                            <input type="text" name="user">
                        </div>
                        <div class="inputGroup">
                            <label>Senha</label>
                            <input type="password" name="pass">
                        </div>
                        <button id="btn" type="submit" class="btnForm" name="submit">Acessar</button>
                    </form>
                </section>
                <?php
            }  
        ?>
        </main>
        <!-- Page main content end -->
        <div id="footer"></div>
    </body>
</html>
