<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);

try {
    $stmt = $conn->prepare("UPDATE products SET
        type = :type,
        name = :name,
        variety = :variety,
        seasonality = :season,
        historical_price = :hprice,
        current_price = :cprice
        WHERE id = :id");
    
    $stmt->execute([
        ':id' => $data['id'],
        ':type' => $data['type'],
        ':name' => $data['name'],
        ':variety' => $data['variety'],
        ':season' => $data['seasonality'],
        ':hprice' => $data['historicalPrice'],
        ':cprice' => $data['currentPrice']
    ]);
    
    echo json_encode(['success' => true]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>