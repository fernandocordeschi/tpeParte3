<?php
require_once './app/models/modelConectDB.php';

class PropertyModel extends ModelConectDB {
   
    public function getAll() {
        
        $query = $this->db->prepare('SELECT * FROM propiedades');
        $query->execute();
        $properties = $query->fetchAll(PDO::FETCH_OBJ);

        return $properties;
    }

    public function getPropertiesForOwner($id_duenio) {
        
        $query=$this->db->prepare('SELECT * FROM propiedades WHERE duenio=?');
        $query->execute([$id_duenio]);
        $propertiesOwner= $query->fetchAll(PDO::FETCH_OBJ);
        
        return $propertiesOwner;
    }

    public function get($id) {
        
        $query = $this->db->prepare('SELECT * FROM propiedades WHERE id_propiedad = ?');
        $query->execute([$id]);        
        $property = $query->fetch(PDO::FETCH_OBJ);

        return $property; // Si no encuentra ningún registro en la base de datos con el ID proporcionado, fetch() devolverá false.
    }

    public function delete($id)
    {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('DELETE FROM propiedades WHERE id_propiedad = ?');
        $query->execute([$id]);

        
    }


    public function update($id_propiedad, $direccion, $estado_propiedad, $ambientes, $duenio)
    {
        // 2. Ejecuto la consulta Modificar registros de una tabla en 2 pasos apra evitar la inyeccion de datos          
        $query = $this->db->prepare('UPDATE propiedades SET  direccion = ?, estado_propiedad = ?, ambientes = ?,  duenio = ? WHERE id_propiedad = ?');//nombre de las cols de la db
        $query->execute([$direccion, $estado_propiedad, $ambientes, $duenio, $id_propiedad]);//variables donde guaarde lo que viene por post
    }

    public function add($direccion, $estado_propiedad, $ambientes, $duenio)
    {
        // 2. Ejecuto la consulta insertar registros de una tabla en 2 pasos apra evitar la inyeccion de datos          
        $query = $this->db->prepare('INSERT INTO propiedades (direccion, estado_propiedad, ambientes, duenio) VALUES (?, ?, ?, ?)');

        $query->execute([$direccion, $estado_propiedad, $ambientes, $duenio]);
        $id = $this->db->lastInsertId();

        return $id;
    }
}
