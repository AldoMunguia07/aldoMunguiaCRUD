<?php

    require_once "lib/crud_controller.php";
    $data = form_load();

    if(isset($_POST["btnAceptar"]))
    {
        if(click())
        {
            $script = "alert('¡Acción realizada con éxito!'); window.location.assign('player_list.php')";
            echo '<script>'. $script .'</script>';
            die();
        }
    }
    

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["titulo"];?></title>
</head>
<body>
    <h1>Trabajando con <?php echo $data["titulo"];?></h1>
    <form action="player_form.php" method="post">
        <label for="txtCodigo">Código</label>
        <input type="text" name="dmyCodigo" id="dmyCodigo" value="<?php echo $data["id"]; ?>" placeholder="Código" <?php echo $data["readonly"]; ?> required>
        <input type="hidden" name="mode" value="<?php echo $data["mode"]; ?>">
        <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $data["id"]; ?>">
        <br>
        <label for="txtJugador">Jugador</label>
        <input type="text" name="txtJugador" id="txtJugador" value="<?php echo $data["jugador"]; ?>" placeholder="Jugador"  <?php echo $data["readonly"]; ?> required>
        <br>
        <label for="txtEquipo">Equipo</label>
        <input type="text" name="txtEquipo" id="txtEquipo" value="<?php echo $data["equipo"]; ?>" placeholder="Equipo"  <?php echo $data["readonly"]; ?> required>
        <br>
        <label for="txtPosicion">Posición</label>
        <Select name="txtPosicion" id="txtPosicion"  <?php echo $data["readonly"]; ?> required>
            <option value="POR" <?php echo ($data["posicion"]) == "POR"?"selected":""?>>Portero</option>
            <option value="DEF" <?php echo ($data["posicion"]) == "DEF"?"selected":"" ?>>Defensa</option>
            <option value="VOL" <?php echo ($data["posicion"]) == "VOL"?"selected":"" ?>>Volante</option>
            <option value="DEL" <?php echo ($data["posicion"]) == "DEL"?"selected":"" ?>>Delantero</option>
        </Select>
        <br>
        <label for="txtEdad">Edad</label>
        <input type="number" name="txtEdad" id="txtEdad" value="<?php echo $data["edad"]; ?>" placeholder="Edad"  <?php echo $data["readonly"]; ?> required>
        <br>
        <label for="txtDorsal">Dorsal</label>
        <input type="number" name="txtDorsal" id="txtDorsal" value="<?php echo $data["dorsal"]; ?>" placeholder="Dorsal"  <?php echo $data["readonly"]; ?> required>
        <br>

        <?php
            if($data["mode"] != 'DSP')
            {
        ?>
        <button type="summit" id="btnAceptar" name="btnAceptar">Aceptar</button>
        <?php
            }
        ?>
        <button id="btnCancelar">Cancelar</button>

    </form>
    <script>
        document.addEventListener("DOMContentLoaded", (e)=>{
            var btnCancelar = document.getElementById("btnCancelar");
            btnCancelar.addEventListener("click", (e)=>{
                e.preventDefault();
                e.stopPropagation();
                window.location.assign("player_list.php");
            });
        });
    </script>
</body>
</html>