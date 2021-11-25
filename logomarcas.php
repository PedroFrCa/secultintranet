<!DOCTYPE html>

<html>
    <head>
        <title>Intranet SECULT | Logomarcas</title>
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
            <section id="logomarcas">
                <h1 class="section-title">Logomarcas</h1>
                <h2 class="subtitle">Clique com o botão direito do mouse e selecione "Salvar imagem como..."</h2>
                <div id="logomarcas-container">
<!-- geracao lista logomarcas -->
                <?php 
                     // Create connection
                    $conn = new mysqli("localhost", "user", "user", "secultdb");

                    // Check connection
                    if ($conn->connect_error) {
                        die("A conexão com o banco de dados falhou: " .$conn->connect_error);
                    }

                    $sql = ("SELECT nome, nome_arquivo FROM logomarcas ORDER BY id");
                    $result = $conn->query($sql);

                    echo "\n";
                    if ($result = $conn->query($sql)) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            //escrita do codigo html da tabela
                            echo "<img class='logomarca' src='arquivos/logomarcas/" . $row['nome_arquivo'] . "'alt='" . $row['nome'] . "'>\n";
                            /*fecha a tabela apos termino de impressão das linhas*/
                        }

                    } else {
                        echo ""; //mensagem caso não haja aviso
                        
                    }
                    echo "\n"; //Para delimitar a parte gerada por php
                    $conn->close();
                ?>
<!-- FIM geracao lista logomarcas -->
                </div>
            </section>
        </main>
        <!-- Page main content end -->
        <div id="footer"></div>
    </body>
</html>