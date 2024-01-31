<!DOCTYPE html>
<html>
 
    <head>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="./includes/css/log.css" rel="stylesheet" />
        <title> Pagina de inicio </title>
 
    </head>
    <body>        
            <div>
                <h2 class="sesion">
                    INICIAR SESIÓN
                </h2>
            </div><br>
            <div class="contenido-derecha">
                <div align="center" height="10%" >
                    <div class="contenedor" align="center">
                            <form id="form1" method="post" action="./includes/php/valida.php">
                                <div id="datos" id="inp10"><br>
                                    Ingresa tu usuario:<br /><br>
                                    <input title="Ingresa tu Usuario" id="inp1"
                                    maxlength="30" name="usuario"
                                    placeholder="Solo letras y numeros" required/> <br><br />

                                    Ingresa tu contraseña:<br /><br>
                                    <input title="Ingresa tu Password" id="inp3"
                                    maxlength="10" name="password" type="password"
                                    placeholder="Teclee su contrase&ntilde;a" required/>
                                    <br />
                                    <br>
                                    <div style="float: center; width: 130px">
                                        <input type="submit" value="Enviar" name="Enviar"/>
                                        <input type="reset" value="Limpiar"/>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        
    </body>
</html>





