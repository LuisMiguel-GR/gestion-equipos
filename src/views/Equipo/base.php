<html>
    <body>
        <script src="/js/equipo/index.js"></script>
        <br><br>
        <?php if (isset($_SESSION["mensajeError"])): ?>
            <div class="mensajes">
                <?php echo $_SESSION["mensajeError"]; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION["mensajeExito"])): ?>
            <div class="mensajes">
                <?php echo $_SESSION["mensajeExito"]; ?>
            </div>            
        <?php endif; ?>      
    </body>
</html>