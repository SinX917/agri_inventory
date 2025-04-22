<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../db_connection.php';

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    echo json_encode(['success' => true]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>