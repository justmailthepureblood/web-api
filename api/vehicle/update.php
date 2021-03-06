<?php
namespace TeamAlpha\Web;

// Require classes
require $_SERVER['DOCUMENT_ROOT'] . '/api/utils/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/api/utils/http.php';

// Declare use on objects to be used
use Exception;
use PDOException;

// Set default response headers
Http::SetDefaultHeaders('POST');

// Check if request method is correct
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Http::ReturnError(405, array('message' => 'Request method is not allowed.'));
    return;
}

// Extract request body
$input = json_decode(file_get_contents("php://input"));

if (is_null($input)) {
    Http::ReturnError(400, array('message' => 'Vehicle details are empty.'));
} else {
    try {
        // Create Db object
        $db = new Db('SELECT * FROM `vehicle` WHERE id = :id LIMIT 1');

        // Bind parameters
        $db->bindParam(':id', property_exists($input, 'id') ? $input->id : 0);

        // Execute
        if ($db->execute() === 0) {
            Http::ReturnError(404, array('message' => 'Vehicle not found.'));
        } else {
            // Create Db object
            $db = new Db('UPDATE `vehicle` SET driverid = :driverid, plateno = :plateno, type = :type, make = :make, model = :model, color = :color, photo = :photo, datemodified = :datemodified WHERE id = :id');

            // Bind parameters            
            $db->bindParam(':id', property_exists($input, 'id') ? $input->id : 0);
            $db->bindParam(':driverid', property_exists($input, 'driverid') ? $input->driverid : null);
            $db->bindParam(':plateno', property_exists($input, 'plateno') ? $input->plateno : null);
            $db->bindParam(':type', property_exists($input, 'type') ? $input->type : null);
            $db->bindParam(':make', property_exists($input, 'make') ? $input->make : null);
            $db->bindParam(':model', property_exists($input, 'model') ? $input->model : null);
            $db->bindParam(':color', property_exists($input, 'color') ? $input->color : null);
            $db->bindParam(':photo', property_exists($input, 'photo') ? $input->photo : null);
            $db->bindParam(':datemodified', date('Y-m-d H:i:s'));

            // Execute
            $db->execute();

            // Commit transaction
            $db->commit();

            // Reply with successful response
            Http::ReturnSuccess(array('message' => 'Vehicle updated.', 'id' => $input->id));
        }
    } catch (PDOException $pe) {
        Db::ReturnDbError($pe);
    } catch (Exception $e) {
        Http::ReturnError(500, array('message' => 'Server error: ' . $e->getMessage() . '.'));
    }
}
