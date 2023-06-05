<?php


interface OrderInterface {
    public function process ();
}

class Order {
    protected OrderInterface $order;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->order = $orderInterface;
    }
    
    public function process ()
    {
        return $this->order->process();
    }
}

class Html implements OrderInterface {
    public function process ()
    {
        //login for user
    }
}

$oder = new Order(new Html);
$oder->process();
