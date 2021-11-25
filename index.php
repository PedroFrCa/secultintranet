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
            $(document).ready(function(){
                $("#header").load("header.php"); 
                $("#footer").load("footer.html");
            });
        </script>
    </head>
    <body>
        <div id="header"></div>
        <!-- Page main content start -->
        <main id="index-main">
            <div id="avisos-acesso-rapido">
                <section id="avisos">
                    <h1 class="section-title">Mural de Avisos</h1>
                    <div id="container-avisos">
<!-- avisos (gerado por php) -->
                    <?php 
                             // Create connection
                            $conn = new mysqli("localhost", "user", "user", "secultdb");

                            // Check connection
                            if ($conn->connect_error) {
                                die("A conexão com o banco de dados falhou: " .$conn->connect_error);
                            }

                            $sql = ("SELECT aviso FROM avisos WHERE visivel=1");
                            $result = $conn->query($sql);

                            echo "\n";
                            if ($result = $conn->query($sql)) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    //escrita do codigo html da tabela
                                    echo "<hr>\n";
                                    echo "<p class='aviso'>\n   " . nl2br($row['aviso']) ."\n</p>\n";
                                    /*fecha a tabela apos termino de impressão das linhas*/
                                }
            
                            } else {
                                echo ""; //mensagem caso não haja aviso
                                
                            }
                            echo "\n"; //Para delimitar a parte gerada por php
                            $conn->close();
                        ?>
<!-- FIM avisos (gerado por php) -->
                    </div>
                </section>
                <!-- <section id="acesso-rapido">
                    <h1 class="section-title">Acesso Rápido</h1>
                        <div id="acesso-rapido-btns">
                            <a href="https://webmail.salvador.ba.gov.br/" target="_blank"><button type="button" class="btn-acesso-rapido">Webmail</button></a>
                            <a href="http://www.ocomon.salvador.ba.gov.br/" target="_blank"><button type="button" class="btn-acesso-rapido">OcoMon</button></a>
                            <a href="http://www.contrachequeonline.salvador.ba.gov.br/" target="_blank"><button type="button" class="btn-acesso-rapido">Contra-Cheque</button></a>
                            <a href="modelos.html" target="_blank"><button type="button" class="btn-acesso-rapido">Modelos</button></a>
                            <a href="http://www.bradesco.com.br/" target="_blank"><button type="button" class="btn-acesso-rapido">Bradesco</button></a>
                            <a href="ramais.html" target="_blank"><button type="button" class="btn-acesso-rapido">Ramais SECULT</button></a>
                            <a href="arquivos/documentos/organograma.pdf" target="_blank"><button type="button" class="btn-acesso-rapido">Organograma</button></a>
                        </div>
                </section> -->
            </div>
            <div id="aniversariantes-datas-especiais">
                <section id="aniversariantes">
                    <h1 class="section-title">Aniversariantes do mês</h1>
                    <div id="aniversariante-container" class="container-tabela">

<!-- tabela de aniversariantes (gerado por php) -->
                        <?php 
                             // Create connection
                            $conn = new mysqli("localhost", "user", "user", "secultdb");

                            // Check connection
                            if ($conn->connect_error) {
                                die("A conexão com o banco de dados falhou: " .$conn->connect_error);
                            }

                            $mes_atual = date("m");

                            $sql = ("SELECT dia,mes,setor,nome FROM aniversariantes WHERE mes=$mes_atual ORDER BY dia");
                            $result = $conn->query($sql);

                            echo "\n";
                            if ($result = $conn->query($sql)) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    //escrita do código html da tabela
                                    echo "<div class='aniversariante linha-tabela'>\n";
                                    echo "  <div class='aniversariante-nome'>" . $row['nome'] ."</div>\n"; 
                                    echo "  <div class='aniversariante-setor'>" .$row['setor'] ."</div>\n";
                                    echo "  <div class='aniversariante-data'>" .$row['dia'] ."/" . $row['mes'] . "</div>\n";
                                    echo "</div>\n"; 
                                    /*fecha a tabela apos termino de impressão das linhas*/
                                }
            
                            } else {
                                echo ""; //mensagem caso não haja aniversariante
                                
                            }
                            echo "\n";
                            $conn->close();
                        ?>
<!-- Fim tabela de aniversariantes (gerado por php) -->

                    </div>
                </section>
                <section id="datas-especiais">
                    <h1 class="section-title">Datas especiais</h1>
                    <div id="datas-especiais-container" class="container-tabela">

<!-- tabela de datas (gerado por php) -->
                        <?php 
                             // Create connection
                            $conn = new mysqli("localhost", "user", "user", "secultdb");

                            // Check connection
                            if ($conn->connect_error) {
                                die("A conexão com o banco de dados falhou: " .$conn->connect_error);
                            }

                            $mes_atual = date("m");

                            $sql = ("SELECT dia,mes,descricao FROM datasespeciais WHERE mes=$mes_atual ORDER BY dia");
                            $result = $conn->query($sql);
                            
                            echo "\n";
                            if ($result = $conn->query($sql)) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    //escrita do código html da tabela
                                    echo "<div class='data-especial linha-tabela'>\n";
                                    echo "  <div class='data-especial-data'>" .$row['dia'] ."/" . $row['mes'] . "</div>\n";
                                    echo "  <div class='data-especial-descricao'>" . $row['descricao'] ."</div>\n";
                                    echo "</div>\n"; 
                                    /*fecha a tabela apos termino de impressão das linhas*/
                                }
            
                            } else {
                                echo ""; //mensagem caso não haja data
                                
                            }
                            echo "\n"; //Para delimitar a parte gerada por php
                            $conn->close();
                        ?>
<!-- Fim tabela de datas (gerado por php) -->

                    </div>
                </section>
            </div>
        </main>
        <!-- Page main content end -->
        <div id="footer"></div>
        <script>
            //codigo para esconder o secao avisos quando nao ha avisos visiveis
            $('#avisos-acesso-rapido').show();
                $('#avisos').each(function() {
                    if (!$(this).find('.aviso:visible').length) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                })
        </script>
    </body>
</html>