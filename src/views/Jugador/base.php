<html>
    <head>
    <link rel="stylesheet" href="/css/index.css">
    </head>
    <body>
        <script src="/js/jugador/index.js"></script>
        <br><br>
        <?php if (isset($_SESSION["mensajeError"])): ?>
            <div class="mensajes error">
                <?php echo $_SESSION["mensajeError"]; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION["mensajeExito"])): ?>
            <div class="mensajes ok">
                <?php echo $_SESSION["mensajeExito"]; ?>
            </div>            
        <?php endif; ?>      
    </body>
</html>