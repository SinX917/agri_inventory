<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../db_connection.php';

$searchTerm = $_GET['term'] ?? '';

try {
    $stmt = $conn->prepare("SELECT * FROM products 
        WHERE name LIKE :term 
        OR type LIKE :term 
        OR variety LIKE :term 
        OR id LIKE :term");
    $searchParam = "%$searchTerm%";
    $stmt->bindParam(':term', $searchParam);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>