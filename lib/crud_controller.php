<?php

    require_once "dao/player.model.php";
    
    function load_data()
    {
        $playerModel = new PlayerModel();

        return $playerModel->getPlayers();
    }

    function form_load()
    {
        $dataView = array(
            "id" => 0,
            "jugador" => "",
            "equipo" => "",
            "posicion" => "",
            "edad" => "",
            "dorsal" => "",
            "mode" => 'INS',
            "titulo" => "Default",
            "readonly" => ""
        );

        if(isset($_GET["id"]))
        {
            $dataView["id"] = intval($_GET["id"]);
        }


        if(isset($_GET["mode"]))
        {
            $dataView["mode"] = $_GET["mode"];
            
            if($dataView["mode"] != 'INS')
            {
                $playerModel = new PlayerModel();
                $playertmp = $playerModel->getById($dataView["id"]);
                $dataView["jugador"] = $playertmp["jugador"];
                $dataView["equipo"] = $playertmp["equipo"];
                $dataView["posicion"] = $playertmp["posicion"];
                $dataView["edad"] = $playertmp["edad"];
                $dataView["dorsal"] = $playertmp["dorsal"];
            }

            switch($dataView["mode"])
            {
                case 'INS': 
                    $dataView["titulo"] = "Nuevo jugador";
                    break;
                case 'UPD':
                    $dataView["titulo"] = sprintf("Actualizando jugador %s (%d)", $dataView["jugador"], $dataView["id"]);
                    break;
                case 'DEL':
                    $dataView["titulo"] = sprintf("Eliminando jugador %s (%s)", $dataView["jugador"], $dataView["id"]);
                    break;
                case 'DSP':
                    $dataView["titulo"] = sprintf("Detalle del jugador %s (%d)", $dataView["jugador"], $dataView["id"]);
                    $dataView["readonly"] = "readonly";
                    break;
            }
        }

        return $dataView;
    }

    function click()
    {
        $mode = $_POST["mode"];
        $id = $_POST["txtCodigo"];
        $jugador = $_POST["txtJugador"];
        $equipo = $_POST["txtEquipo"];
        $posicion = $_POST["txtPosicion"];
        $edad = $_POST["txtEdad"];
        $dorsal = $_POST["txtDorsal"];

        $model = new PlayerModel();

        switch ($mode)
        {
            case 'INS':
                $model->insertPlayer($jugador, $equipo, $posicion, $edad, $dorsal);
                return true;
            case 'UPD':
                $model->updatePlayer($id, $jugador, $equipo, $posicion, $edad, $dorsal);
                return true;
            case 'DEL':
                $model->deletePlayer($id);
                return true;
                
        }

        return false;
    }

?>