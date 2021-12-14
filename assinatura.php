<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Alexandre Shyjada & Andre Luiz Ribeiro & Pedro Freitas de Carvalho - NTI 2021" name="creators">
    <link rel="sortcut icon" href="arquivos/favicon.ico" type="image/ico">
    <link rel="stylesheet" href="include/secultintranet.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <title>Intranet SECULT | Assinatura</title>
    <script src="include/html2canvas.js"></script>
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
    <main>
      <section id="assinatura">
        <h1 class="section-title">Gerar Assinatura de Email</h2>
        <h2 class="subtitle">
          Preencha com os seus dados e a assinatura será gerada
        </h2>
        <div id="container-formulario-previa">
          <div id="container-formulario">
            <form id="formulario">
              <div class="inputGroup">
                <label>Nome</label>
                <input
                  id="name" 
                  name="name" 
                  type="text" 
                  placeholder="Seu nome"
                />
              </div>
              
              <div class="inputGroup">
                <label>Cargo ou Setor</label>
                <input
                  id="position" 
                  name="position" 
                  type="text" 
                  class="Seu Cargo ou setor"
                  placeholder="Seu cargo ou setor"
                />
              </div>
    
              <div class="inputGroup">
                <label>Telefone</label>
                <input
                  id="phone"
                  name="phone"
                  type="text" 
                  placeholder="Telefone"
                  value="+55 (71) 3202-"
                />
              </div>
    
              <div class="inputGroup">
                <label>Órgão</label>
                <input
                  id="company" 
                  name="company" 
                  type="text" 
                  placeholder="Nome do órgão"
                  value="Secretaria de Cultura e Turismo"
                />
              </div>
    
              <div class="inputGroup">
                <label>Endereço</label>
                <input
                  id="adress" 
                  name="adress" 
                  type="text" 
                  placeholder="Endereço"
                  list="enderecos"
                />
                <datalist id="enderecos">
                  <option>Rua da Argentina, 341 - Comércio - CEP 40015-130</option>
                  <option>Rua Belgica com Praça Visconde de Cairu - CEP 40015-520</option>
                  <option>Rua Chile, Praça Municipal - Elevador Lacerda - Térreo</option>
                  <option>Praça Ramos de Queiroz, sn - Pelourinho - CEP: 40026-055</option>
                  <option>Avenida Beira Mar - Stella Maris - CEP 41600-677</option>
                </datalist>
              </div>
    
              <button type="submit" class="btnForm">
                Mostrar prévia
              </button>

            </form>
          </div>
          <div class="container-previa">
            <div id="assinaturaIMG"></div>
            <div id="tutorial" class="escondido">
              <label>Observação</label>
              <text>Após pressionar o botão abaixo para salvar a imagem, siga o passo-a-passo em <a href="tutoriais.php" target="_blank">tutoriais</a> para alterar sua assinatura webmail.</text>
            </div>
            <div id="btnDownload" class="btnDownload"></div>
          </div>
        </div>
      </section>
    </main>
    <div id="footer"></div>
    <script>
      //Codigo para insercao dos dados na imagem de assinatura, e geracao de botao de download
      const Form = {
          formulario: document.getElementById('formulario'),
          name: document.getElementById('name'),
          position: document.getElementById('position'),
          phone: document.getElementById('phone'),
          company: document.getElementById('company'),
          adress: document.getElementById('adress'),
        }
  
        Form.formulario.addEventListener('submit', function(e){
          e.preventDefault();
  
          const asinatura = document.getElementById('assinaturaIMG')
          asinatura.innerHTML = `
            <div class="infoAssinatura">
              <span class="nomeFuncionario">${Form.name.value}</span>
              <span class="cargoFuncionario">${Form.position.value}</span>
              <span class="telefoneOrgao">${Form.phone.value}</span>
              <span class="nomeOrgao">${Form.company.value}</span>
              <span class="enderecoOrgao">${Form.adress.value}</span>
            </div>
            <div class="assinaturaEmail">
              <img src="arquivos/assinatura-email.png" alt="bgAssinatura"/>
            </div>
          `
      
          document.getElementById('btnDownload')
          btnDownload.innerHTML = `
            <button type="button" class="btnForm btnDownload">
              Salvar como imagem
            </button>
          `

          document.getElementById("tutorial").style.display = "block";
        })
  
        const btnDownload = document.getElementById('btnDownload')
        btnDownload.addEventListener('click', function(e){
          e.preventDefault();
  
          const container = document.getElementById("assinaturaIMG");
          html2canvas(container, {backgroundColor: "rgba(0,0,0,0)", removeContainer: true}).then(function(canvas) {
                  var link = document.createElement("a");
                  document.body.appendChild(link);
                  link.download = "assinatura.png";
                  link.href = canvas.toDataURL("image/png");
                  link.target = '_blank';
                  link.click();
          });
        })
    </script> 
  </body>



</html>