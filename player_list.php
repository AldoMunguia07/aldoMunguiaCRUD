<?php
    require_once "lib/crud_controller.php";

    $players = load_data();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores</title>
</head>
<body>
    <h1>Lista de jugadores</h1>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Jugador</th>
                <th>Equipo</th>
                <th>Posicion</th>
                <th>Edad</th>
                <th>Dorsal</th>
                <th> <a href="player_form.php?mode=INS">Nuevo</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($players as $player)
                {

            ?>
            <tr>
                <td><?php echo $player["id"]; ?></td>
                <td> <a href="player_form.php?mode=DSP&id=<?php echo $player["id"];?>"><?php echo $player["jugador"]; ?></a></td>
                <td><?php echo $player["equipo"]; ?></td>
                <td><?php echo $player["posicion"]; ?></td>
                <td><?php echo $player["edad"]; ?></td>
                <td><?php echo $player["dorsal"]; ?></td>
                <td>
                    <a href="player_form.php?mode=UPD&id=<?php echo $player["id"];?>"> Editar </a>
                    <a href="player_form.php?mode=DEL&id=<?php echo $player["id"];?>"> Eliminar </a>

                </td>
            </tr>
            <?php 
                } 
            ?>
        </tbody>
    </table>
</body>
</html>