<?php include_once("../../model/SalaDeAula.php");
$s = new SalaDeAula();
session_start();
if (!isset($_SESSION["id_usuario"])){
    header("location:../LandingPage/LandingPage.html");
}
?>

<!--Serve para comunicar aos navegadores que aquele documento está escrito em código HTML -->
<!DOCTYPE HTML>
<!--Este elemento é seguido pelo atributo lang, que informa ao navegador em qual idioma aquela página estará escrita -->
<html lang="pt-br">
    <!-- No head ficam os metadados do código, informações úteis tanto sobre a página quanto sobre o conteúdo inserido nela. -->
    <head>
        <!--define o encode da paǵina -->
        <meta charset="UTF-8">
         <!-- define que os elementos podem se adaptar para diferentes dispositivos -->
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> 
           </head>

        <!-- Titulo da pagina -->
               <title>prototipo da plataforma</title>
        
        <!-- Cabeçalho da pagina -->
       
       
    </head>
   <!-- O corpo do documento-->     
<body >
  
    <!-- Serve para criar divisoes em um documento-->
   

 <main>  
 <div class="row row-cols-1 row-cols-md-1 g-2">
    
  <div class="card " > 
    <article class="card" style="width: 100;" > 
     
<header class="card-body navbar navbar-expand-lg navbar-light bg-light">
<nav class = "navbar navbar-expand-lg navbar-light bg-light" style="width: 100%;">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <h2> L E </h2>
            </li>
            <li class="nav-item">
                <h2 style="color: rgba(255,255,255,0)"> i </h2>
            </li>
            <li class="nav-item">
                <img src="../../assets/simbolo-wifi.png" style="width: 40px; height: 40px;">
            </li>
            <li class="nav-item">
                <h2 style="color: rgba(255,255,255,0)"> i </h2>
            </li>
            <li class="nav-item">
                <h2> O N </h2>
            </li>

            
            <!-- <li class="nav-item">
                <h5 style="color: rgba(255,255,255,0)"> iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii </h5>
            </li> -->

            <div class="colum d-flex justify-items-right justify-content-right">
                <li class="nav-item">
                    <a class="nav-link" href="../../view/Salas/VisualizarSalas.php"> Tela Inicial </a>
                </li>
                <li class="nav-item">
                    <p class="nav-link" href="#"> &#8729; </p>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../view/Salas/CriarSala.php"> Criar Sala </a>
                </li>
                <li class="nav-item">
                <p class="nav-link" href="#"> &#8729; </p>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../view/Salas/IngressarSala.php"> Entrar em uma Sala </a>
                </li>
                <li class="nav-item">
                    <p class="nav-link" href="#"> &#8729; </p>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../CadastroLogin/PagUsuario.php"> Minha conta</a>
                </li>
            </div>
        </ul>
    </div>
</nav>  
</header>
<div class="container-md">
<br>
<br>
<br>

<?php
$s->CarregarTurmas($_SESSION['id_usuario']);
?>
</div>
</article>
  </div> 
  
    </div>   
</main>

</body>    

</div>
</html>

