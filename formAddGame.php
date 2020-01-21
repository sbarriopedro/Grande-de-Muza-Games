<?php include 'includes/header.html' ?>

</head>
<body>
    <section class="container"></section>
        <h1>Agregar un nuevo juego</h1>

        <form enctype="multipart/form-data" action="addGame.php" method="POST" class="well col-md-9 mx-auto">
            Nombre del Juego:
            <br>
            <input name="gameName" type="text" class="form-control" placeholder="Ingrese un nombre para el juego">
            <br>
            Descripción del Juego:
            <br>
            <textarea name="gameDesc" class="form-control" rows="3"></textarea>
            <br>
            Publicar juego?
            <br>
            <input type="radio" name="gamePublish" value="yes">Si
            <input type="radio" name="gamePublish" value="no">No
            <br>
            <br>
            Subir archivos del juego:
            <br>
            <input type="file" name="gameFile[]" id="files" multiple directory="" webkitdirectory="" moxdirectory="">
            <br>
            <br>
            <button class="btn btn-success">
                Agregar Juego
            </button>
            <a href="main.php" class="btn btn-danger">
                Volver a página principal
            </a>
        </form>    
</body>
</html>