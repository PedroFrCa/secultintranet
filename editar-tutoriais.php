<?php
    //Inicializando sessão
    session_start();
    //Verificando se a sessão tabela está iniciada
    if(((string)$_SESSION['tabela']) != 'tutoriais'){
        header('location: /login.php');
    }

    $tabela = $_SESSION["tabela"];

    $conn = new mysqli("localhost", "user", "user", "secultdb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " .$conn->connect_error);
    }

    $sql = "SHOW COLUMNS FROM $tabela";
    $result = $conn->query($sql);
    $column = array();
    while($row = mysqli_fetch_array($result)){
        array_push($column, $row['Field']);
    }
?>

<!DOCTYPE html>

<html>
<head>
        <title>Intranet SECULT | Editar Tabela</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link rel="sortcut icon" href="arquivos/favicon.ico" type="image/ico">
        <link href="include/secultintranet.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@500&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet"><script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <!-- Jquery, datatables, tabledit e funções -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="include/jquery.tabledit.js"></script>
        <script type="text/javascript" src="include/scripts.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <h1 class="section-title">Editar Tutoriais</h1>
            <div class="tabela-editavel">
                <table id="tabela" class="">
                    <!-- Passando o nome da tabela -->  
                    <thead>
                    <input class="tabledit-input" name="tabela" value="<?php echo $tabela ?>" type="hidden">
                        <tr>
                            <th>id</th>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Arquivo</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="btn-group">
                    <button class="add">Nova entrada</button>
                    <button class="cancel">Cancelar</button>
                </div>
                <div id="tutorial" display="block">
                    <label>Observação </label>
                    <text>Certifique-se de que o arquivo se encontra em: <br> secultintranet/arquivos/documentos/tutoriais</text>
                </div>
            </div>
            <div class="nova-linha"></div>
        </main>

        <script>
            gera_tabela_editavel(<?php echo ( "'$tabela', " .json_encode($column))?>);
            add_linha(<?php echo ("'$tabela'")?>);
            btn_cancela();
        </script>

        <!-- Page main content end -->
        <div id="footer"></div>
    </body>
</html>