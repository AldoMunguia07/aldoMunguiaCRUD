<?php

    require_once "dao/dao.php";

    class PlayerModel
    {
        private $conn = null;

        public function __construct()
        {
            $this->conn = Conection::getConn();
            $sqlCreateTable = "CREATE TABLE IF NOT EXISTS jugadores
            ( id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
            jugador STRING NOT NULL,
            equipo STRING NOT NULL,
            posicion STRING NOT NULL,
            edad INTEGER NOT NULL,
            dorsal INTEGER NOT NULL );";

            $this->conn->exec($sqlCreateTable);
        }

        function getPlayers()
        {
            $sqlstr = "SELECT * FROM jugadores;";
            $arrPlayers = array();
            $cursor = $this->conn->query($sqlstr, PDO::FETCH_ASSOC);
            $arrPlayers = $cursor->fetchAll();

            return $arrPlayers;
        }

        function getById($id)
        {
            $sqlstr = "SELECT * FROM jugadores WHERE id = :id;";
            $sqlCommand = $this->conn->prepare($sqlstr);
            $sqlCommand->bindParam(':id', $id, SQLITE3_INTEGER);
            $sqlCommand->execute();
            $player = $sqlCommand->fetch(PDO::FETCH_ASSOC);

            return $player;
        }

        function insertPlayer($jugador, $equipo, $posicion, $edad, $dorsal)
        {
            $insSql = 'INSERT INTO jugadores (jugador, equipo, posicion, edad, dorsal)'
            . 'values (:jugador, :equipo, :posicion, :edad, :dorsal)';

            $sqlCommand = $this->conn->prepare($insSql);
            $sqlCommand->bindParam(':jugador', $jugador, SQLITE3_TEXT);
            $sqlCommand->bindParam(':equipo', $equipo, SQLITE3_TEXT);
            $sqlCommand->bindParam(':posicion', $posicion, SQLITE3_TEXT);
            $sqlCommand->bindParam(':edad', $edad, SQLITE3_INTEGER);
            $sqlCommand->bindParam(':dorsal', $dorsal, SQLITE3_INTEGER);
            $result = $sqlCommand->execute();

            return $result;
        }

        function updatePlayer($id, $jugador, $equipo, $posicion, $edad, $dorsal)
        {
            $updSql = 'UPDATE jugadores SET jugador=:jugador, equipo=:equipo, posicion=:posicion, edad=:edad, dorsal=:dorsal WHERE id=:id';

            $sqlCommand = $this->conn->prepare($updSql);
            $sqlCommand->bindParam(':id', $id, SQLITE3_INTEGER);
            $sqlCommand->bindParam(':jugador', $jugador, SQLITE3_TEXT);
            $sqlCommand->bindParam(':equipo', $equipo, SQLITE3_TEXT);
            $sqlCommand->bindParam(':posicion', $posicion, SQLITE3_TEXT);
            $sqlCommand->bindParam(':edad', $edad, SQLITE3_INTEGER);
            $sqlCommand->bindParam(':dorsal', $dorsal, SQLITE3_INTEGER);
            $result = $sqlCommand->execute();

            return $result;

        }

        function deletePlayer($id)
        {
            $delSql = 'DELETE FROM jugadores WHERE id=:id';

            $sqlCommand = $this->conn->prepare($delSql);
            $sqlCommand->bindParam(':id', $id, SQLITE3_INTEGER);
            $result = $sqlCommand->execute();

            return $result;
        }
    }

?>