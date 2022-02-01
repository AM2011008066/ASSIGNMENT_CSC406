<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include productsProc.php file
include __DIR__ . '/function/apparelProc.php';

//read table products
$app->get('/apparel', function (Request $request, Response $response, array
$arg){
 return $this->response->withJson(array('data' => 'success'), 200);
});

// read all data from table products
$app->get('/allapparel',function (Request $request, Response $response, 
array $arg) {
 $data = getAllApparel($this->db);
if (is_null($data)) {
 return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404);
}
return $this->response->withJson(array('data' => $data), 200);
});

//request table products by condition (product id)
$app->get('/apparel/[{id}]', function ($request, $response, $args){
 
 $apparelId = $args['id'];
 if (!is_numeric($apparelId)) {
 return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);
 }
 $data = getApparel($this->db,$apparelId);
 if (empty($data)) {
 return $this->response->withJson(array('error' => 'no data'), 500);
}
 return $this->response->withJson(array('data' => $data), 200);
});


$app->post('/apparel/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createApparel($this->db, $form_data);
    if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200);
    }
);

//delete row
$app->delete('/apparel/del/[{id}]', function ($request, $response, $args){
 
    $apparelId = $args['id'];
   if (!is_numeric($apparelId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);}

   $data = deleteApparel($this->db,$apparelId);
   if (empty($data)) {
   return $this->response->withJson(array($apparelId=> 'is successfully deleted'), 202);};
   });

//put table products
   $app->put('/apparel/put/[{id}]', function ($request, $response, $args){
    $apparelId = $args['id'];
    
   if (!is_numeric($apparelId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
   }
    $form_dat=$request->getParsedBody();
    
   $data=updateApparel($this->db,$form_dat,$apparelId);

   if ($data <=0)

   return $this->response->withJson(array('data' => 'successfully updated'), 200);
});




