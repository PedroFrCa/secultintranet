<!DOCTYPE html>

<html>
    <head>
        <title>Intranet SECULT | Ramais</title>
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
            <section id="ramais">
                <h1 class="section-title">SECULT - Lista de Ramais</h1>
                <p><a href="ramais_compacto.php" target="_blank">Versão compacta (para download e impressão)</a></p>
                <div class="searchbar-container">
                    <input type="search" spellcheck="false" id="ramais-searchbar" class="searchbar" placeholder="Pesquisar...">
                </div>

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

                <!-- exemplo
                <div id="container-local-tabela">
                    <div class="local"><text>Local_ou_andar</text></div>
                    <div class="container-tabela">
                        <div class="linha-tabela">
                            <div class="ramal-numero coluna-tabela">Numero_do_ramal</div>
                            <div class="ramal-nome coluna-tabela">Titulo_do_ramal</div>
                            <div class="ramal-pessoas coluna-tabela">Nome_dos_contatos_para_o_numero</div>
                        </div>
                    </div>
                </div> 
                -->

            </section>
        </main>
        <!-- Page main content end -->
        <div id="footer"></div>
        <!-- Script da barra de pesquisa-->
        <script>
            //colorindo linhas da tabela
            jQuery('.linha-tabela:visible:odd').css({'background-color': 'rgb(220, 220, 220)'});
            jQuery('.linha-tabela:visible:even').css({'background-color': 'var(--main-bg)'});

            const searchbar = document.getElementById("ramais-searchbar");
            var event = function(e) {
                //Pegando o que esta digitado na barra de pesquisa, capitalizando e removendo acentos
                const filter = e.target.value.toUpperCase().normalize("NFD").replace(/[\u0300-\u036f ]/g, "");
                
                //Pegando um vetor, o qual cada indice e uma linha da pagina
                const linha = document.getElementsByClassName('linha-tabela');

                for (i = 0; i < linha.length; i++) {

                    //Pegando os textos de cada coluna da linha i
                    const coluna_numero = linha[i].getElementsByClassName("coluna-tabela")[0].textContent.normalize("NFD").replace(/[\u0300-\u036f ]/g, "");
                    const coluna_nome = linha[i].getElementsByClassName("coluna-tabela")[1].textContent.normalize("NFD").replace(/[\u0300-\u036f ]/g, "");
                    const coluna_pessoas = linha[i].getElementsByClassName("coluna-tabela")[2].textContent.normalize("NFD").replace(/[\u0300-\u036f ]/g, "");
                    
                    //Comparando todas colunas da linha i com o filtro. Se alguma coluna e igual ao filtro, entra no if, mostrando o conteudo da linha. Caso contrario, entra no else, ocultando a linha i
                    if ((coluna_numero.toUpperCase().indexOf(filter) > -1) || (coluna_nome.toUpperCase().indexOf(filter) > -1) || (coluna_pessoas.toUpperCase().indexOf(filter) > -1)){
                        linha[i].style.display = "flex";
                    }
                    else {
                        linha[i].style.display = "none";
                    }
                }

                //codigo para esconder o container-local-tabela quando nao ha linhas visiveis
                $('.container-local-tabela').show();
                $('.container-local-tabela').each(function() {
                    if (!$(this).find('.linha-tabela:visible').length) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                })
                
                //codigo para colorir a tabela, a cada duas linhas
                jQuery('.linha-tabela:visible:odd').css({'background-color': 'rgb(220, 220, 220)'});
                jQuery('.linha-tabela:visible:even').css({'background-color': 'var(--main-bg)'});
            }

            searchbar.addEventListener("keyup", event, false);
            searchbar.addEventListener("search", event, false);
        </script>
    </body>
</html>