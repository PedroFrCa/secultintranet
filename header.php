<header>
    <div id="banner">
        <img src="arquivos/banner.png" alt="Intranet SECULT">
    </div>
    <nav>
        <ul class="main-menu">
            <li class="main-menu-content"><a href="index.php">Inicio</a></li>
            <li class="has-dropdown main-menu-content"><a href="#">Institucional</a>
                <ul class="dropdown-box">
                    <li class="dropdown-content"><a href="modelos.php">Modelos</a></li>
                    <li class="dropdown-content"><a href="tutoriais.php">Tutoriais</a></li>
                    <li class="dropdown-content"><a href="ramais.php">Ramais</a></li>
                    <li class="dropdown-content"><a href="arquivos/documentos/secretarias.pdf" target="_blank">Secretarias</a></li>
                    <li class="dropdown-content"><a href="logomarcas.php">Logomarcas</a></li>
                    <li class="dropdown-content"><a href="arquivos/documentos/cadastro_organizacional.pdf" target="_blank">Cadastro Organizacional</a></li>
                    <li class="dropdown-content"><a href="arquivos/documentos/organograma.pdf" target="_blank">Organograma</a></li>
                    <li class="dropdown-content"><a href="equipe.php">Equipe</a></li>
                    <li class="dropdown-content"><a href="assinatura.php">Gerador de Assinaturas de Email</a></li>
                </ul>
            </li>
            <li class="main-menu-content has-dropdown"><a href="#">Sites</a>
                <ul class="dropdown-box">
<!-- geracao lista tutoriais -->
                    <?php 
                         // Create connection
                        $conn = new mysqli("localhost", "user", "user", "secultdb");

                        // Check connection
                        if ($conn->connect_error) {
                            die("A conexão com o banco de dados falhou: " .$conn->connect_error);
                        }

                        $sql = ("SELECT nome, addr FROM navbar_sites ORDER BY id");
                        $result = $conn->query($sql);

                        echo "\n";
                        if ($result = $conn->query($sql)) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                //escrita do codigo html da tabela
                                echo "<li class='dropdown-content'><a href='" . $row['addr'] . "' target='blank'>" . $row['nome'] . "</a></li>\n";
                                /*fecha a tabela apos termino de impressão das linhas*/
                            }

                        } else {
                            echo ""; //mensagem caso não haja aviso
                            
                        }
                        echo "\n"; //Para delimitar a parte gerada por php
                        $conn->close();
                    ?>
<!-- FIM geracao lista tutoriais -->
                    <!--
                    <li class="dropdown-content"><a href="http://www.salvador.ba.gov.br/" target="_blank">Salvador</a></li>
                    <li class="dropdown-content"><a href="http://www.dom.salvador.ba.gov.br/" target="_blank">Diario Oficial</a></li>
                    <li class="dropdown-content"><a href="http://www.servidor.salvador.ba.gov.br/" target="_blank">Portal do Servidor</a></li>
                    <li class="dropdown-content"><a href="http://portalesalvador.salvador.ba.gov.br/" target="_blank">Portal e-Salvador</a></li>
                    <li class="dropdown-content"><a href="http://prodeturssa.salvador.ba.gov.br/" target="_blank">Prodetur SSA</a></li>
                    <li class="dropdown-content"><a href="http://pelourinhodiaenoite.salvador.ba.gov.br/" target="_blank">Pelourinho Dia e Noite</a></li>
                    -->
                </ul>
            </li>
            <li class="main-menu-content has-dropdown"><a href="#">Sistemas PMS</a>
                <ul class="dropdown-box">
                    <li class="dropdown-content"><a href="https://www.esalvador.salvador.ba.gov.br/login" target="_blank">e-Salvador</a></li>
                    <li class="dropdown-content"><a href="https://webmail.salvador.ba.gov.br/" target="_blank">Webmail PMS</a></li>
                    <li class="dropdown-content"><a href="http://www.ocomon.salvador.ba.gov.br/" target="_blank">OcoMon</a></li>
                    <li class="dropdown-content"><a href="http://177.20.4.66:8080/webEProtocolo/servletlogin" target="_blank">e-Protocolo</a></li>
                    <li class="dropdown-content"><a href="http://www.sigm.salvador.ba.gov.br:8080/asi/apresentacao/IndexASI.html" target="_blank">SIGM</a></li>
                    <li class="dropdown-content"><a href="http://fpg.salvador.ba.gov.br/SIGP/open.do?action=open&sys=FPG" target="_blank">SIGP</a></li>
                    <li class="dropdown-content"><a href="http://sigef.sefaz.salvador.ba.gov.br/sigef/" target="_blank">SIGEF</a></li>
                    <li class="dropdown-content"><a href="https://sgf.sefaz.salvador.ba.gov.br/Sistema/Seguranca/login.asp" target="_blank">SGF</a></li>
                    <li class="dropdown-content"><a href="http://arquivohistorico.fgm.salvador.ba.gov.br/cgi-bin/wxis.exe?IsisScript=phl82.xis&cipar=phl82.cip&lang=por" target="_blank">PHL Arquivo Histórico</a></li>
                    <li class="dropdown-content"><a href="http://biblioteca.fgm.salvador.ba.gov.br/cgi-bin/wxis.exe?IsisScript=phl82.xis&cipar=phl82.cip&lang=por" target="_blank">PHL Biblioteca</a></li>
                </ul>
            </li>
            <li class="main-menu-content has-dropdown"><a href="#">Links Úteis</a>
                <ul class="dropdown-box">
                    <li class="dropdown-content"><a href="http://www.contrachequeonline.salvador.ba.gov.br/" target="_blank">Contra Cheque Online</a></li>
                    <li class="dropdown-content"><a href="http://impressao.salvador.ba.gov.br:9191/app?service=page/Home" target="_blank">Senhas Copias Impressão</a></li>
                    <li class="dropdown-content"><a href="https://banco.bradesco/html/classic/index.shtm" target="_blank">Bradesco</a></li>
                    <li class="dropdown-content"><a href="https://www.bancobrasil.com.br/pbb/caw.jsp" target="_blank">Branco Brasil</a></li>
                    <li class="dropdown-content"><a href="https://www.caixa.gov.br/Paginas/home-caixa.aspx" target="_blank">Caixa Econômica</a></li>
                    <li class="dropdown-content"><a href="http://loterias.caixa.gov.br/wps/portal/loterias/" target="_blank">Loterias</a></li>
                    <li class="dropdown-content"><a href="https://www.gov.br/receitafederal/pt-br" target="_blank">Receita Federal</a></li>
                    <li class="dropdown-content"><a href="https://www.sefaz.salvador.ba.gov.br/" target="_blank">Sefaz - SSA</a></li>
                    <li class="dropdown-content"><a href="http://www.sefaz.ba.gov.br/" target="_blank">Sefaz - BA</a></li>
                    <li class="dropdown-content"><a href="https://www.tst.jus.br/certidao1" target="_blank">TST</a></li>
                </ul>
            </li>
            <li class="main-menu-content has-dropdown"><a href="#">NTI</a>
                <ul class="dropdown-box">
                    <li class="dropdown-content"><a href="login.php">Editar Tabelas</a></li>
                    <li class="dropdown-content"><a href="https://172.25.48.7:9443/core/orionSplashScreen.do" target="_blank">EPO McAfee</a></li>
                    <li class="dropdown-content"><a href="http://secultintranet.salvador.ba.gov.br/nagvis/frontend/nagvis-js/index.php" target="_blank">Mapas</a></li>
                    <li class="dropdown-content"><a href="http://secultintranet.salvador.ba.gov.br/nagios" target="_blank">Monitoramento</a></li>
                    <li class="dropdown-content"><a href="http://secultintranet.salvador.ba.gov.br/ocsreports/" target="_blank">Inventário</a></li>
                    <li class="dropdown-content"><a href="suporte.php">Suporte</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>