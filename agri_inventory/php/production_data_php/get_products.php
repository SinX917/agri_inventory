<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../db_connection.php';

try {
    $stmt = $conn->query("SELECT * FROM products");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>