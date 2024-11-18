<?php
require_once './app/models/modelConectDB.php';

class OwnerModel extends ModelConectDB
{

    public function getAll($orderBy = false)
    {

        $sql = 'SELECT * FROM duenios';

        if ($orderBy) {
            switch ($orderBy) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre_duenio';
                    break;
                case 'id':
                    $sql .= ' ORDER BY id_duenio ASC';
                    break;

                case 'idDESC':
                    $sql .= ' ORDER BY id_duenio DESC';
                    break;
            }
        }
        $query = $this->db->prepare($sql);
        $query->execute();
        $owners = $query->fetchAll(PDO::FETCH_OBJ);

        return $owners;
    }

    public function get($id)
    {

        $query = $this->db->prepare('SELECT * FROM duenios WHERE id_duenio = ?');
        $query->execute([$id]);
        $owner = $query->fetch(PDO::FETCH_OBJ);

        return $owner;
    }

    public function delete($id)
    {

        $query = $this->db->prepare('DELETE FROM duenios WHERE id_duenio = ?');
        $query->execute([$id]);
    }

    public function updateOwner($id, $name, $lastName, $email)
    {

        $query = $this->db->prepare('UPDATE duenios SET  nombre_duenio = ?, apellido_duenio = ?, email_duenio = ? WHERE id_duenio = ?');
        $query->execute([$name, $lastName, $email, $id]);
    }

    public function add($name, $lastName, $email)
    {

        $query = $this->db->prepare('INSERT INTO duenios (nombre_duenio, apellido_duenio, email_duenio) VALUES (?, ?, ?)');
        $query->execute([$name, $lastName, $email]);
        $id = $this->db->lastInsertId();

        return $id;
    }

    public function HasProperties($id)
    {

        $query = $this->db->prepare('SELECT * FROM propiedades WHERE duenio = ?');
        $query->execute([$id]);
        $properties = $query->fetchAll(PDO::FETCH_OBJ);

        if (count($properties) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
