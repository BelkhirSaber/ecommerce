<?php 

namespace Controller;

use Controller\Controller;
use Model\Product;


class ProductsController extends Controller {

  // -- show page

  public function index() {

    // $product = new Product();

    // $pdo = new \PDO('mysql:host=localhost;dbname=b3s_store', 'root', '');

    // $stmt = $pdo->prepare('SELECT * FROM t_b3s_product');
    // $stmt->execute();
    // var_dump($stmt->fetchAll(\PDO::FETCH_ASSOC));

    $this->view('admin.product.add', [],'admin');

  }

}