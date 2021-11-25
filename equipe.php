<!DOCTYPE html>

<html>
    <head>
        <title>Intranet SECULT | Equipe</title>
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
        <main id="equipe-main">
            <h1 class="section-title">Equipe</h1>
            <section id="equipe">
<!-- entradas (geradas por php) -->
            <?php 
                // Create connection
                $conn = new mysqli("localhost", "user", "user", "secultdb");

                // Check connection
                if ($conn->connect_error) {
                    die("A conexão com o banco de dados falhou: " .$conn->connect_error);
                }

                $sql = ("SELECT posicao, nome FROM equipe ORDER BY id");
                $result = $conn->query($sql);

                echo "\n";
                if ($result = $conn->query($sql)) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        //escrita do codigo html da tabela
                        echo "<div class='funcao-nome'>\n";
                        echo "  <p class='equipe-funcao'>" . $row['posicao'] . "</p>";
                        echo "  <p class='equipe-nome'>" . $row['nome'] . "</p>";
                        echo "</div>\n";
                        /*fecha a tabela apos termino de impressão das linhas*/
                    }

                } else {
                    echo ""; //mensagem caso não haja aviso
                    
                }
                echo "\n"; //Para delimitar a parte gerada por php
                $conn->close();
            ?>
<!-- FIM entradas (geradas por php) -->

                <!-- exemplo
                <div class="funcao-nome">
                    <p class="equipe-funcao">FUNCAO</p>
                    <p class="equipe-nome">NOME</p>
                </div> -->

            </section>
        </main>
        <!-- Page main content end -->
        <div id="footer"></div>
    </body>
</html>