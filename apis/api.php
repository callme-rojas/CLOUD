<?php
header("Content-Type: application/json");

include_once 'db.php';
include_once 'class_relojes.php';

$db = new Database();
$db = $database->getConnection();

$relojes = new Relojes($db);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id !== null) {
            $relojes->id = $id;
            $result = $relojes->readOne();
        } else {
            $result = $relojes->readAll();
        }
        echo json_encode($result);
        break;


    case 'PUT':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id !== null) {
            $data = json_decode(file_get_contents("php://input"));

            $relojes->id = $id;
            $relojes->nombre = $data->nombre;
            $relojes->marca = $data->marca;
            $relojes->precio = $data->precio;
            $relojes->material = $data->material;

            if ($relojes->update()) {
                echo json_encode(array("message" => "Los datos han sido actualizados."));
            } else {
                echo json_encode(array("message" => "No se han actualizado los datos."));
            }
        } else {
            echo json_encode(array("message" => "ID de Relojes no especificado."));
        }
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id !== null) {
            $relojes->id = $id;
            if ($relojes->delete()) {
                echo json_encode(array("message" => "Datos eliminados."));
            } else {
                echo json_encode(array("message" => "Fallo al eliminar datos."));
            }
        } else {
            echo json_encode(array("message" => "ID de Relojes no especificado."));
        }
        break;

        case 'POST':
            // Crear una nueva Relojes
            $data = json_decode(file_get_contents("php://input"));
                
            $relojes->nombre = $data->nombre;
            $relojes->marca = $data->marca;
            $relojes->precio = $data->precio;
            $relojes->material = $data->material;
           
            if ($relojes->create()) {
                echo json_encode(array("message" => "Nuevos datos creados correctamente."));
            } else {
                echo json_encode(array("message" => "Fallo al crear nuevos datos."));
            }
            break;               

    default:
        echo json_encode(array("message" => "El metodo es invalido."));
        break;
}
?>
