<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="UTF-8">
</head>

<body>

    <style>
        div {
            border-radius: 5px;
        }

        #encabezado {
            z-index: 1;
            position: fixed;
            background-color: lightSkyBlue;
            width: 97%;
            height: 60px;
            border: 2px dotted lightblue;
            font-family: Times;
            margin-top: -20px;
            margin-bottom: 10px;
        }

        .izquierda {
            float: left;
            background-color: lightblue;
            width: 20%;
            height: 350px;
            margin-top: 55px;
            margin-bottom: 10px;
            border: 2px groove white;
        }

        .derecha {
            float: right;
            background-color: rgb(240, 240, 240);
            width: 78%;
            height: 350px;
            margin-top: 55px;
            margin-bottom: 10px;
            border: 2px groove white;
        }

        #pie {
            margin-top: 20px;
            margin-bottom: 10px;
            clear: both;
            background-color: rgb(235, 235, 235);
            width: 100%;
            height: 60px;
            border: 2px groove white;
            font-family: Times;
        }

        #email {
            float: right;
            text-decoration: none;
            color: white;
            margin: 10px;
        }

        #email:hover {
            font-weight: bold;
            color: gray;
        }

        #name {
            float: left;
            font-weight: bold;
            color: rgb(230, 230, 230);
            font-size: 1.5em;
            margin: 22px 10px 10px 10px;
        }

        #name:hover {
            color: white;
        }

        .content {
            margin: 10px;
        }

        h4 {
            color: lightSkyBlue;
        }

        #direccion {
            text-align: center;
            color: lightSkyBlue;
        }

        span:hover {
            color: gray;
            font-weight: bold;
        }

        ol {
            list-style: none;
            margin: 20px 0 0 -20px;
            color: rgb(230, 230, 230);
            font-size: 1em;
        }

        a {
            text-decoration: none;
            color: rgb(230, 230, 230);
        }

        a:active {
            color: darkred;
        }

        #margen-top {
            margin-top: 12px;
        }
    </style>

    <div id="encabezado">
        <p id="name">Carlos Garces Alvarez</p>
        {{-- <a href="eduard.alvarez@hotmail.com" target="_blank">
            <p id="email">eduard.alvarez@hotmail.com</p>
        </a> --}}
    </div>
    <div class="izquierda">
        <div class="info">
            <ol class="">
                {{-- <li id="margen-top"><a href=""><span>Acerca de mí</span></a></li> --}}
                <li id="margen-top"><a href=""><span>Empresa</span></a></li>
                <li id="margen-top"><a href=""><span>Estudios</span></a></li>
                <li id="margen-top"><a href=""><span>Proyectos</span></a></li>
                <li id="margen-top"><a href=""><span>Contacto</span></a></li>
                <li id="margen-top"><a href=""><span>Social Media</span></a></li>
            </ol>
        </div>
    </div>
    <div class="derecha">
        <div class="content">
            <h4>Objetivo</h4>
            <p>Posicionarme como Ingeniero de sistemas.</p>
            <h4>Experiencia</h4>
            <p>Desarrollador Junior, Empresa de Software (2012 - 2013)</p>
            <ul>
                <li>Diseñé e implemente funcionalidades para usuarios finales para Producto Líder</li>
                <li>Escribí bibliotecas JavaScript y Ruby de terceros</li>
            </ul>
            <h4>Habilidades</h4>
            <p>Lenguajes: <span>JavaScript</span>, <span>Python</span>, <span>Ruby</span> </p>
        </div>
    </div>
    <div id="pie">
        <p id="direccion">Calle 10 B SUR # 52 B 34, <span>Medellín</span> 12345-6789 | Tel: <span>(555) 555-5555</span>
        </p>
    </div>
</body>

</html>
