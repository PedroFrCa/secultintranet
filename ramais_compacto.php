<!DOCTYPE html>

<html>
    <head>
        <title>Intranet SECULT | Ramais</title>
        <link rel="sortcut icon" href="arquivos/favicon.ico" type="image/ico">
        <link href="include/printing-styles.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@500&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <!-- JQuery para funcao load -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>

    <body>
        <!-- Page main content start -->
        <main>
            <section id="ramais-compacto">
                <h1 class="section-title">SECULT - Lista de Ramais</h1>
<!-- tabelas geradas por php -->
                <?php
                     // Create connection
                    $conn = new mysqli("localhost", "user", "user", "secultdb");

                    // Check connection
                    if ($conn->connect_error) {
                        die("A conexão com o banco de dados falhou: " .$conn->connect_error);
                    }

                    echo "\n";
                    $locais = $conn->query("SELECT DISTINCT local_ramal FROM ramais");
                    while ($local = $locais->fetch_assoc()) {
                        echo "<div class='container-local-tabela'>\n";
                        echo "<div class='local'>" . $local["local_ramal"] . "</div>\n";
                        echo "<div class='container-tabela'>\n";
                        
                        $local_string = $local["local_ramal"];
                        $sql = ("SELECT numero, nome, pessoas, local_ramal, negrito FROM ramais WHERE local_ramal='$local_string' ORDER BY id");
                        $result = $conn->query($sql);
                        
                        
                        if ($result) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                //escrita do código html da tabela
                                if ($row['negrito'] == 1) {
                                    echo "<b><div class='linha-tabela'>\n";
                                    echo "  <div class='ramal-numero coluna-tabela'>" . $row['numero'] . "</div>\n";
                                    echo "  <div class='ramal-nome coluna-tabela'>" . $row['nome'] . "</div>\n";
                                    echo "  <div class='ramal-pessoas coluna-tabela'>" . $row['pessoas'] . "</div>\n";
                                    echo "</div></b>\n"; 
                                }
                                else {
                                    echo "<div class='linha-tabela'>\n";
                                    echo "  <div class='ramal-numero coluna-tabela'>" . $row['numero'] . "</div>\n";
                                    echo "  <div class='ramal-nome coluna-tabela'>" . $row['nome'] . "</div>\n";
                                    echo "  <div class='ramal-pessoas coluna-tabela'>" . $row['pessoas'] . "</div>\n";
                                    echo "</div>\n"; 
                                }
                                /*fecha a tabela apos termino de impressão das linhas*/
                            }
        
                        }

                        echo "</div>\n</div>\n";
                    }

                        echo "\n";
                    $conn->close();
                ?>
<!-- FIM tabelas geradas por php -->
            </section>
            <div id="tutorial">
                <p>Para imprimir ou fazer download do documento pressione o botão abaixo ou Ctrl+P</p>
                <p>Escolha a impressora ou selecione Salvar como PDF</p>
                <button id="print-btn" onclick="window.print()">Imprimir</button>
            </div>
        </main>
        <!-- Page main content end -->
        <script>
            //colorindo linhas da tabela
            jQuery('.linha-tabela:visible:odd').css({'background-color': 'rgb(230, 230, 230)'});
            jQuery('.linha-tabela:visible:even').css({'background-color': 'var(--main-bg)'});
        </script>
    </body>
</html>