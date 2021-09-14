<?php




class orderControl extends BaseController{
    public function info()
    {
        $this->view("order", "info");
    }
    public function order(){
        $res = array();
        $Account = $this->input('Account');
        $FullName = $this->input('FullName');
        $Phone = $this->input('Phone');
        $Address = $this->input('Address');
        $City = $this->input('City');
        $Province = $this->input('Province');
        $Total = $this->input('Total');
        $Cd = $this->input('Cd');

        $orderModel = $this->model('orderModel');
        $r = $orderModel->order($FullName, $Phone, $Address, $City, $Province, $Total, $Cd, $Account);
        if($r == true){
            $res['status'] = true;
        } else {
            $res['status'] = false;
        }
        echo json_encode($res);
    }
}