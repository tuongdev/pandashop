<?php
class ProductController
{
    function index()
    {
        $productRepository = new ProductRepository();
        $conds = [];
        $sorts = [];
        $category_id = $_GET['category_id'] ?? null;
        if ($category_id) {
            $conds = [
                'category_id' => [
                    'type' => '=',
                    'val' => $category_id
                ]
            ];
        }
        //SELECT * FROM product WHERE category_id = 3;

        $price_range = $_GET['price-range'] ?? null;
        if ($price_range) {
            $tmp = explode('-', $price_range);
            $start = $tmp[0];
            $end = $tmp[1];
            $conds = [
                'sale_price' => [
                    'type' => 'BETWEEN',
                    'val' => "$start AND $end"
                ]
            ];

            if ($end == 'greater') {
                $conds = [
                    'sale_price' => [
                        'type' => '>=',
                        'val' => $start
                    ]
                ];
            }
        }
        //SELECT * FROM product WHERE sale_price >= 1000000;



        $sort = $_GET['sort'] ?? null;
        if ($sort) {
            $tmp = explode('-', $sort);
            $column = $tmp[0];

            $map = ['created' => 'created_date', 'price' => 'sale_price', 'alpha' => 'name'];
            $real_column = $map[$column];
            $sort_type = $tmp[1];
            $sorts = [
                $real_column => $sort_type,//asc, desc
            ];
        }
        $search = $_GET["search"] ?? null;
        if ($search) {
            $conds = [
                "name" => [
                    "type" => "LIKE",
                    "val" => "'%$search%'"
                ] 
            ];//SELECT * ..... WHERE name LIKE '%$search%'
        }

        $page = $_GET['page'] ?? 1;
        $item_per_page = ITEM_PER_PAGE;
        $products = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
        // phân trang
        $allProducts = $productRepository->getBy($conds, $sorts);
        $total = count($allProducts);
        $page_number = ceil($total/$item_per_page); // hàm ceil làm tròn lên
        // lấy danh sách category
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();

        require 'view/product/index.php';
    }
    function ajaxSearch() {
        $pattern = $_GET["pattern"];
        $productRepository = new ProductRepository();
        $products = $productRepository->getByPattern($pattern);
        require "view/product/ajaxSearch.php";
    }
    function show() {
        $id = $_GET['id'];
        $productRepository = new ProductRepository();
        $product = $productRepository->find($id);
        $conds = [
            "category_id" => [
                'type' => '=',
                'val' => $product->getCategoryId()
            ],
            'id' => [
                'type' => '!=',
                'val' => $product->getId()
            ]
        ];
        $category_id = $product->getCategoryId();
        $sorts = [];
        $page = 1;
        $item_per_page = 8;
        $relatedProducts = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
        //SELECT * FROM product WHERE category_id = 4 AND id != 3
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();
        require 'view/product/show.php';
    }
    function addComment() {
        $data = [];
        $data['email'] = $_POST['email'];
        $data['fullname'] = $_POST['fullname'];
        $data['star'] = $_POST['rating'];
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['description'] = $_POST['description'];
        $data['product_id'] = $_POST['product_id'];
        $commentRepository = new CommentRepository();
        $commentRepository->save($data);
        $productRepository = new ProductRepository();
        $product = $productRepository->find($_POST['product_id']);
        require 'view/product/commentList.php';
    }
}
