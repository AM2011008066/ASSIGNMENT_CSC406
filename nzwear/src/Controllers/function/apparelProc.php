<?php
//get all products
function getAllApparel($db)
{
$sql = 'Select a.name, a.color, a.price, c.name as category from apparel a ';
$sql .='Inner Join category c on a.category_id = c.id';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get product by id
function getApparel($db, $apparelId)
{
$sql = 'Select a.name, a.color, a.price, c.name as category from apparel a ';
$sql .= 'Inner Join category c on a.category_id = c.id ';
$sql .= 'Where a.id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $apparelId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new product
function createApparel($db, $form_data) {
    $sql = 'Insert into apparel (name, color, price, category_id, supplier) ';
    $sql .= 'values (:name, :color, :price, :category_id, :supplier)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':color', $form_data['color']);
    $stmt->bindParam(':price', ($form_data['price']));
    $stmt->bindParam(':category_id', ($form_data['category_id']));
    $stmt->bindParam(':supplier', $form_data['supplier']);
    $stmt->execute();
    return $db->lastInsertID();//insert last number.. continue
}

//delete product by id
function deleteApparel($db,$apparelId) {
    $sql = ' Delete from apparel where id = :id';
    $stmt = $db->prepare($sql);
    $id = (int)$apparelId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
//update product by id
    function updateApparel($db,$form_dat,$apparelId) {
     $sql = 'UPDATE apparel SET name = :name , color = :color , price = :price , category_id = :category_id, supplier = :supplier';
     $sql .=' WHERE id = :id';
     $stmt = $db->prepare ($sql);
     $id = (int)$apparelId;
  
     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
     $stmt->bindParam(':name', $form_dat['name']);
     $stmt->bindParam(':color', $form_dat['color']);
     $stmt->bindParam(':price', ($form_dat['price']));
     $stmt->bindParam(':category_id', ($form_dat['category_id']));
     $stmt->bindParam(':supplier', ($form_dat['supplier']));
     $stmt->execute();
     

}