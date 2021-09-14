<?php

class productControl extends BaseController
{

    /**
     * 
     * get all product
     */
    public function getAllProduct(){
        $productModel = $this->model('productModel');
        $allProduct = $productModel->GetAllForDisplay();
        $data = [];
        foreach ($allProduct as $val) {
            if($val->quantity <= 0) continue;
            $row = '<div class="product col pb-2 pl-0 pr-0" show="show">';
            $row.='<div class="border-hover d-flex align-items-end flex-column m-1 h-100">';
            $row.='<div class="hovereffect">';
            $row.='<a href="'.BASEURL.'/product/infoProduct/'.$val->id.'">';
            $row.='<img id="img" class="img-fluid img_p" src="'.BASEURL.'/public/assets/img/product.png" ';
            $row.='id_p="'.$val->id.'">';
            $row.='</a></div>';
            $row.='<div class="mt-auto"><p class="m-2"><a class="name-product" href="';
            $row.=BASEURL.'/product/infoProduct/'.$val->id.'">';
            $row.=$val->name;
            $row.='</a></p><p class="price-product m-2" price="'.$val->price.'">';
            $row.=$this->formatPrice($val->price);
            $row.=' ₫</p></div></div></div>';
            $data[] = $row;
        }

        echo json_encode($data);
    }
    public function getTrendingProduct(){
        $productModel = $this->model('productModel');
        $allProduct = $productModel->getTrending();
        $data = [];
        foreach ($allProduct as $val) {
            if($val->quantity <= 0) continue;
            $row = '<div class="product col pb-2 pl-0 pr-0" show="show">';
            $row.='<div class="border-hover d-flex align-items-end flex-column m-1 h-100">';
            $row.='<div class="hovereffect">';
            $row.='<a href="'.BASEURL.'/product/infoProduct/'.$val->id.'">';
            $row.='<img id="img" class="img-fluid img_p" src="'.BASEURL.'/public/assets/img/product.png" ';
            $row.='id_p="'.$val->id.'">';
            $row.='</a></div>';
            $row.='<div class="mt-auto"><p class="m-2"><a class="name-product" href="';
            $row.=BASEURL.'/product/infoProduct/'.$val->id.'">';
            $row.=$val->name;
            $row.='</a></p><p class="price-product m-2" price="'.$val->price.'">';
            $row.=$this->formatPrice($val->price);
            $row.=' ₫</p></div></div></div>';
            $data[] = $row;
        }
        echo json_encode($data);
    }
    public function infoProduct($id){
        $productModel = $this->model('productModel');
        $Product = $productModel->getOne($id);
        $this->view("product", "infoProduct", array($Product));
    }
    public function getByType($id){
        $productModel = $this->model('productModel');
        $tpModel = $this->model('typeProductModel');
        $name = $tpModel->get($id)->name;
        $ProductsByType = $productModel->getByType($id);
        $data = [];
        $data[] = $name;
        foreach ($ProductsByType as $val) {
            $row = '<div class="product col pb-2 pl-0 pr-0" show="show">';
            $row.='<div class="border-hover d-flex align-items-end flex-column m-1 h-100">';
            $row.='<div class="hovereffect">';
            $row.='<a href="'.BASEURL.'/product/infoProduct/'.$val->id.'">';
            $row.='<img id="img" class="img-fluid img_p" src="'.BASEURL.'/public/assets/img/product.png" ';
            $row.='id_p="'.$val->id.'">';
            $row.='</a></div>';
            $row.='<div class="mt-auto"><p class="m-2"><a class="name-product" href="';
            $row.=BASEURL.'/product/infoProduct/'.$val->id.'">';
            $row.=$val->name;
            $row.='</a></p><p class="price-product m-2" price="'.$val->price.'">';
            $row.=$this->formatPrice($val->price);
            $row.=' ₫</p></div></div></div>';
            $data[] = $row;
        }
        $this->view("product", "getByType", $data);
    }
    public function addCart(){
        $response = array();
        $productModel = $this->model('productModel');
        $acc = $this->input('account');
        $id_p = $this->input('id_p');
        $quan = $this->input('quan');

        $response['status'] = false;
        if($productModel->addCart($acc, $id_p, $quan)){
            $response['status'] = true;
        }

        echo json_encode($response);
    }
    public function getImageProduct(){
        $response = array();
        $productModel = $this->model('productModel');
        $response['id'] = $this->input('id');
        $response['img'] = $productModel->get($this->input('id'))->img;
        echo json_encode($response);
    }
}
