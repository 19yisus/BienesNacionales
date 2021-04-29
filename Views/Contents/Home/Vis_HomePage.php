<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="<?php echo constant("URL");?>Views/Js/prefixfree.js"></script>
    <link  rel="stylesheet"  type="text/css" href="<?php echo constant("URL");?>Views/Assets/HomePage.css">
    <title>Bienes Nacionales</title>
</head>
<body>
    
    <header>
        <Section class="logo">
            <img src="<?php echo constant("URL");?>Views/Img/HomePage/logo.jpg">
            <h1>Departamento De Bienes Nacionales</h1>
        </Section>
        <nav class="navegacion">
            <ul class="menu">
                <li><a href="<?php echo constant("URL");?>Home/Vis_HomePage">Inicio</a></li>
                <li><a href="<?php echo constant("URL");?>Home/Vis_Nosotros">Nosotros</a></li>
                <li><a href="<?php echo constant("URL");?>Home/Vis_Index">Sistema</a></li>
            </ul>        
        </nav>
    </header>
    <div class="contenido">
       <div class="slider">
            <ul>
                <li><img src="<?php echo constant("URL");?>Views/Img/HomePage/1.jpg"></li>
                <li><img src="<?php echo constant("URL");?>Views/Img/HomePage/2.jpeg"></li>
                <li><img src="<?php echo constant("URL");?>Views/Img/HomePage/4.jpg"></li>
                <li><img src="<?php echo constant("URL");?>Views/Img/HomePage/3.jpg"></li>

            </ul>
        </div>
        <hr>
        <section class="categorias">
            <div>
                <p>
                    <strong>LA UNIVERSIDAD POLITECNICA TERRITORIAL DEL ESTADO PORTUGUESA UPTP</strong>
                    garantiza la formación integrl del Estudiante. Formenta en forma pertinente la Investigación,
                    Extensión, Producción y Postgrado. También promueve la interacción permanente entre la Universidad
                     y las comunidades, a través de programas de asistencia técnica, asesorias, actividades culturales y deportivas.
                </p>

                <p>    
                    Vincular la Universidad econ el sector socio productivo, articulando esfuerzos y recursos en la solvencia 
                    de problemas y necesidades comunes. Revisar permanentemente el curriculo, para adaptarlo a los requimientos de la región.
                    Promover la actualización en forma permanente y continua de todo el personal. Consolidar la imagen institucional, como Primera
                    Casa de Estudios Universitarios del Estadi Postuguesa.
                </p>
            </div>
        </section>
    </div>
</body>
</html>