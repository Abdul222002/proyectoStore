<?php

class Order {

    private $id;
    private $user_Id;
    private $total;
    private $status;
    private $order_date;
    
    public function __construct($id, $user_Id, $order_date, $status, $total) {
        $this->id = $id;
        $this->user_Id = $user_Id;
        $this->total = $total;
        $this->status = $status;
        $this->order_date = $order_date;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUser_Id() {
        return $this->user_Id;
    }
    
    public function getTotal() {
        return $this->total;
    }
    
    public function getStatus() {
        return $this->status;
    }

    public function getOrder_Date() {
        return $this->order_date;
    }


}

?>