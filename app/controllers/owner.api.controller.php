<?php
require_once './app/models/owner.model.php';
require_once './app/views/json.view.php';


class OwnerApiController
{
    // ATRIBUTOS PRIVADOS
    private $model;
    private $view;

    // CONSTRUCTOR
    public function __construct()  {
        $this->model = new OwnerModel();
        $this->view = new  JSONview();
    }

    // MÉTODOS O FUNCIONES DE LA CLASE  
    public function getAll($req, $res) {
        

        $orderBy = false;
        if (isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        // obtengo los dueños de la DB 
        $owners = $this->model->getAll($orderBy);
        
        // si no obtengo nada de la base de datos
        if(!($owners)){
            return $this->view->response('no se encontro ningun recurso', 404);
        }

        // mando todos los dueños a la vista
        else{
        return $this->view->response($owners);
        }
    }

    public function get($req, $res) {
        
        $id = $req->params->id;
        $owner = $this->model->get($id);

        if ($owner) { 

            return $this->view->response($owner,200);
        }
        else{
            return $this->view->response('Error: No se encontró dueño', 404);
        }
    }

    // public function deleteOwner($id)
    // {

    //     // obtengo un dueño de la DB 
    //     $owner = $this->model->get($id);

    //     // chequear si existe lo que se quiere borrar 
    //     if (!$owner) { //no existe ,retorna null
    //         return $this->view->showError("No Existe el dueño con el id:. $id .");
    //     } else if ($this->model->HasProperties($id)) { //buscar si el dueño tiene propiedades
    //         return $this->view->showError("No es posible eliminar el dueño si  tiene propiedades");
    //     }

    //     // no se puede borrar un duenio que tenga propiedades: ebido a una restricción de clave foránea en la db:eliminar una fila de la tabla duenio que está siendo referenciada en la tabla propiedad. La restricción de clave foránea impide la eliminación o actualización de un registro de la tabla duenio porque existen propiedades en la tabla propiedad que dependen de ese registro (id_owner)
    //     $this->model->delete($id);
    //     header('Location: ' . BASE_URL . 'owners'); /* PARA REDIRIJIR AL HOME UNA VEZ ELIMINADO EL DUEÑO */
    //     exit();
    // }

    public function updateOwner($req, $res) {

        $id = $req->params->id;
        $errors = [];
        $owner = $this->model->get($id);
        
        if (empty($req->body->name) || empty($req->body->last_name) || empty($req->body->email)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $name = $req->body->name;
        $lastName = $req->body->lastname;
        $email = $req->body->email;

        
        if (!isset($name) || is_null($name) ) {
            $errors[] = "El campo Nombre es requerido";
        }

        
        if (!isset($lastName) || is_null($lastName) ) {
            $errors[] = "No se completo el apellido";
        }

        
        if (!isset($email) || is_null($email)) {
            $errors[] = "El campo Email es requerido";
        }
        

        if (count($errors) > 0) {
            $errosString = implode(", ", $errors); 
            return $this->view->response($errosString, 400);
        } 
        
        else {   

            $id = $this->model->updateOwner($id,$name, $lastName, $email);
            
            if(!$id){
                return $this->view->response("Error al insertar dueño", 500);
            }

            else{
                return $this->view->response($id,200); 
            }
            exit();
        }
    }


    public function created($req, $res) {

        $errors = [];        

          // valido los datos
          if (empty($req->body->name) || empty($req->body->last_name) || empty($req->body->email)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $name = $req->body->name;
        $lastName = $req->body->lastname;
        $email = $req->body->email;

        
        if (!isset($name) || is_null($name) ) {
            $errors[] = "El campo Nombre es requerido";
        }

        
        if (!isset($lastName) || is_null($lastName) ) {
            $errors[] = "No se completo el apellido";
        }

        
        if (!isset($email) || is_null($email)) {
            $errors[] = "El campo Email es requerido";
        }
        

        if (count($errors) > 0) {
            $errosString = implode(", ", $errors); 
            return $this->view->response($errosString, 400);
        } 
        
        else {   

            $id = $this->model->add($name, $lastName, $email);
            
            if(!$id){
                return $this->view->response("Error al insertar dueño", 500);
            }

            else{
                return $this->view->response($id,201); 
            }
            exit();
        }
    }
}
