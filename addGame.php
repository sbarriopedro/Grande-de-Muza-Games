<?php
require 'classes/Connection.php';
require 'classes/Game.php';
$Game = new Game();
$check = $Game->addGame();

include 'includes/header.html';
?>

<body>
<section class="container">
        <h1>Alta de juego</h1>
        <div class="card bg-light">
            <?php
            if ( $check ){
            ?>
            <div class="alert alert-success">
                Se ha agregado el juego
                <?= $Game->getGameName() ?>
                con el id: <?= $Game->getGameID() ?>
                correctamente.
                <br>
                <a href="main.php" class="button button-success">Volver a página principal</a>
                <?php
                }else{
                ?>
                <div class="alert alert-danger">
                    No se ha agregado el juego nuevo:
                    <?= $Game->getGameName(); ?>
                    <?php

                    }
                    ?>
                    <br>
                    <a href="main.php" class="btn btn-secondary">
                        Volver a página principal
                    </a>
                </div>
            </div>
    </section>

</body>
</html>