<!DOCTYPE html>

<html>
    <head>
        <title>Intranet SECULT | Suporte</title>
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
            <section id="suporte">
                <h1 class="section-title">Suporte</h1>
                <div class="grade-suporte">
                    <?php 
                         // Create connection
                        $conn = new mysqli("localhost", "user", "user", "secultdb");

                        // Check connection
                        if ($conn->connect_error) {
                            die("A conexão com o banco de dados falhou: " .$conn->connect_error);
                        }

                        echo "\n";
                        $tipos = $conn->query("SELECT DISTINCT tipo FROM suporte");
                        while ($tipo_atual = $tipos->fetch_assoc()) {
                            echo "<div class='lista-suporte'>\n";
                            echo "<h2 class='suporte-tipo'>" . $tipo_atual["tipo"] . "</h2>\n";
                            
                            $tipo_string = $tipo_atual["tipo"];
                            $sql = ("SELECT servico, endereco, nome_arquivo_logo FROM suporte WHERE tipo='$tipo_string' ORDER BY id");
                            $result = $conn->query($sql);
                            
                            if ($result) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    //escrita do código html da tabela
                                    echo "<a class='topico-suporte' href='" . $row['endereco'] . "' target='_blank'>\n";
                                    echo "  <img class='logo-suporte' src='arquivos/suporte/" . $row['nome_arquivo_logo'] . "'>\n";
                                    echo "  <div class='servico-suporte'>" . $row['servico'] . "</div>\n";
                                    echo "</a>\n";
                                    /*fecha a tabela apos termino de impressão das linhas*/
                                }
            
                            }

                            echo "</div>\n";
                        }

                            echo "\n";
                        $conn->close();
                    ?>
                </div>
            </section>
        </main>
        <!-- Page main content end -->
        <div id="footer"></div>
    </body>
</html>