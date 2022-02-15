<?php 
class HomeController {
    function index() {
        $productRepository = new ProductRepository();
        $conds = [];
        $sorts = ["featured"=>"DESC"];
        $page = 1;
        $item_per_page = 4;
        // lấy 4 sản phẩm nổi bật
        $featuredProducts = $productRepository->getBy($conds,$sorts,$page,$item_per_page);
        // lấy 4 sản phẩm mới nhất
        $sorts = ['created_date'=>'desc'];
        $latestProducts = $productRepository->getBy($conds,$sorts,$page,$item_per_page);
        // lấy tát cả danh mục
        $item_per_page = 8;
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();
        $categoryProducts = [];
        foreach ($categories as $category ) {
            $conds = ['category_id' => ['type' =>'=','val' => $category->getId()]];
        
        $products = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
        $categoryProducts[$category->getName()] = $products;
    }
        require 'view/home/index.php';
    }
}
