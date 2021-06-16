<?php

namespace Helpers;
use PDO;

// Datu paņemšana no pieprasījuma body
function getFormData($method) {

    // GET vai POST: Datu atgriešana
    if ($method === 'GET') {
        $data = $_GET;
    } else if ($method === 'POST') {
        $data = $_POST;

    } else {
        // PUT, PATCH или DELETE
        $data = array();
        //split string by a string
        $exploded = explode('&', file_get_contents('php://input'));

        foreach($exploded as $pair) {
            $item = explode('=', $pair);
            if (count($item) == 2) {
                // decodes url encoded string
                $data[urldecode($item[0])] = urldecode($item[1]);
            }
        }
    }

    // Deletes q parameter
    unset($data['q']);

    return $data;
}

// Saņemam visus datut par pieprasījumu
function getRequestData() {
    // Defining method
    $method = $_SERVER['REQUEST_METHOD'];

    // Разбираем url
    $url = (isset($_GET['q'])) ? $_GET['q'] : '';
    $url = trim($url, '/');
    $urlData = explode('/', $url);

    return array(
        'method' => $method,
        'formData' => getFormData($method),
        'urlData' => $urlData,
        'router' => $urlData[0]
    );

}

// Validating route
function isValidRouter($router) {
    return in_array($router, array(
        'auth',
        'billings',
        'customers',
        'users',
        'orderedProjects',
        'projectsInProgress',
        'workers',
        'finishedProjects'
    ));
}

// Checking if there exist billing with such id
function isExistsBillingById($pdo, $id) {
    return ifExistByIdInTable($pdo, $id, 'billings');
}

// Checking if there exist customer with such id
function isExistsCustomerById($pdo, $id) {
    return ifExistByIdInTable($pdo, $id, 'customers');
}

// Checking if there exist user with such id
function isExistsUserById($pdo, $id) {
    return ifExistByIdInTable($pdo, $id, 'users');
}

// Checking if there exist OrderedProject with such id
function isExistsOrderedProjectById($pdo, $id) {
    return ifExistByIdInTable($pdo, $id, 'orderedprojects');
}

// Checking if there exist OrderedProject with such id
function isExistsProjectInProgressById($pdo, $id) {
    return ifExistByIdInTable($pdo, $id, 'projectsinprogress');
}

// Checking if there exist OrderedProject with such id
function isExistWorkerById($pdo, $id) {
    return ifExistByIdInTable($pdo, $id, 'workers');
}

function ifExistByIdInTable($pdo, $id, $tableName) {
    $query = "select id from $tableName where id=:id";
    $data = $pdo->prepare($query);
    $data->bindParam(':id', $id, PDO::PARAM_INT);
    $data->execute();

    return count($data->fetchAll()) === 1;
}

// Displaying 400 error of http-request
function throwHttpError($code, $message) {
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(array(
        'code' => $code,
        'message' => $message
    ));
}

function HttpSuccess($message) {
    header('HTTP/1.1 200 OK');
    echo json_encode((object) array('message' => $message));
}

function connectToDB() {
    $host = "localhost";
    $user = "root";
    $password = "root";
    $db = "unitedconstuctiongroup";

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $options = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    return new PDO($dsn, $user, $password, $options);
}
