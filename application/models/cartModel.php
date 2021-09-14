<?php




class cartModel{
    private $db;

    public function __construct() {
        $this->db = new database;
    }

    public function getCartInfo($acc){
        $this->db->Query("select cd.id_product id, cd.quantity quan from (mp_cart_detail cd
            join mp_cart c on cd.id_cart = c.id) join mp_user u on u.id = c.id_user where
            u.account=?", array($acc));
        return $this->db->fetchAll();
    }
    public function getIdCart($account){
        $this->db->Query("select c.id id from mp_user u join mp_cart c 
            on u.id=c.id_user where u.account=?",array($account));
        return $this->db->fetch();
    }
    public function updateCartDetail($id_c, $id_p, $quan){
        $this->db->Query("update mp_cart_detail set quantity=? where id_cart=? and id_product=?",
            array($quan, $id_c, $id_p));
        return $this->db->rowCount();
    }
    public function removeCartDetail($id_c, $id_p){
        $this->db->Query("delete from mp_cart_detail where id_cart=? and id_product=?",
            array($id_c, $id_p));
        return $this->db->rowCount();
    }
    public function removeAllCartDetail($id_c){
        $this->db->Query("delete from mp_cart_detail where id_cart=?",
            array($id_c));
        return $this->db->rowCount();
    }
}