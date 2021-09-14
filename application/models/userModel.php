<?php

class userModel{

    private $account, $password, $fullName, $email, $phone, $address, $city, $province;
    private $db;

    public function __construct(){
        $this->db = new database;
    }
    /**
     * 
     * set data for modal
     */
    public function setData($Account, $Password, $FullName, $Email, $Phone, $Address, $City, $Province){
        $this->account = $Account;
        $this->password = $Password;
        $this->fullName = $FullName;
        $this->email = $Email;
        $this->phone = $Phone;
        $this->address = $Address;
        $this->city = $City;
        $this->province = $Province;
    }
    /**
     * 
     * create user
     */
    //return true or false
    public function signup(){
        return $this->db->Query("CALL createUser(?,?,?,?,?,?,?,?)", $this->toArray());
    }
    /**
     * 
     * check acount exit
     */
    //return rows selected
    public function checkAccount(){
        $this->db->Query("select * from view_user where account=?", array($this->account));
        return $this->db->rowCount();
    }
    /**
     * 
     * check account valid
     */
    //return rows selected
    public function checkActive(){
        $this->db->Query("select * from view_user where status='ACTIVE' and account=?", array($this->account));
        return $this->db->rowCount();
    }
    /**
     * 
     * check phone unique
     */
    //return rows selected
    public function checkPhone(){
        $this->db->Query("select * from view_user where phone=?", array($this->phone));
        return $this->db->rowCount();
    }
    /**
     * 
     * check password
     */
    //return rows selected
    public function checkPassword(){
        $this->db->Query("select * from view_user where account=? and password=?", array($this->account, $this->password));
        return $this->db->rowCount();
    }
    /**
     * 
     * update last date access
     */
    public function updateLastAccess(){
        $this->db->Query("update mp_customer set 
                        date_last_access=SYSDATE() 
                        where id_user=?", 
            array($this->getIdUser($this->account)));
        return $this->db->rowCount();
    }
    /**
     * 
     * set data model by account
     */
    public function getUser($Account){
        $this->db->Query("select * from view_user where account=?", array($Account));
        $obj = $this->db->fetch();
        
        $this->account = $obj->account;
        $this->password = $obj->password;
        $this->fullName = $obj->fullName;
        $this->email = $obj->email;
        $this->phone = $obj->phone;
        $this->address = $obj->address;
        $this->city = $obj->city;
        $this->province = $obj->province;
    }
    public function getProfile($Account){
        $this->db->Query("select * from view_user where account=?", array($Account));
        return $this->db->fetch();
    }
    /**
     * 
     * get id user by account
     */
    public function getIdUser($Account){
        $this->db->Query("select * from view_user where account=?", array($Account));
        $obj = $this->db->fetch();
        return $obj->id;
    }
    /**
     * 
     * update user
     */
    //return rows update
    public function updateUser(){
        $this->db->Query("update mp_customer set full_name=?, email=?, address=?, city=?, province=? where id_user=?",
            array($this->fullName, $this->email, $this->address, $this->city, $this->province, $this->getIdUser($this->account)));
        return $this->db->rowCount();
    }
    /**
     * 
     * update password
     */
    //return rows update
    public function updatePassword($newPassword){
        $this->db->Query("update mp_user set password=? where account=?",
            array($newPassword, $this->account));
        return $this->db->rowCount();
    }
    /**
     * 
     * get avtar
     */
    public function getImg($Account){
        $this->db->Query("select img from mp_user where account=?",
            array($Account));
        return $this->db->fetch();
    }
    /**
     * 
     * set avatar
     */
    public function setImg($img){
        $this->db->Query("update mp_user set img=? where account=?",
            array($img, $this->account));
        return $this->db->rowCount();
    }
    /**
     * 
     * disable account
     */
    public function deleteAccount(){
        $this->db->Query("update mp_customer set status='DISABLE' where id_user=?", 
            array($this->getIdUser($this->account)));
        return $this->db->rowCount();
    }
    /**
     * 
     * active account
     */
    public function activeAccount(){
        $this->db->Query("update mp_customer set status='ACTIVE' where id_user=?", 
            array($this->getIdUser($this->account)));
        return $this->db->rowCount();
    }
    /**
     * 
     * return all user type array[obj, obj, ...]
     */
    public function getAll(){
        $this->db->Query("select * from view_user");
        return $this->db->fetchAll();
    }
    /**
     * 
     * return data to array
     */
    public function toArray(){
        return array(
            $this->account,
            $this->password,
            $this->fullName,
            $this->email,
            $this->phone,
            $this->address,
            $this->city,
            $this->province
        );
    }

    public function getOrder($id){
        $this->db->Query("select o.id, o.full_name, o.phone, o.shipping_fee, o.total_price, o.status, 
        CONCAT(o.address,', ',o.province,', ',o.city) address, u.account, o.date_created, o.date_modify 
        FROM mp_order o left join mp_user u on o.id_user=u.id where u.id = ?", array($id));
        return $this->db->fetchAll();
    }
}

?>