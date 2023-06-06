<?php

class addOrder implements \SplSubject{
    
    private $observers;
    
    
    public function __construct() {
        $this->observers = new SplObjectStorage();
    }

    public function attach(\SplObserver $observer): void {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void {
        $this->observers->detach($observer);
    }

    public function notify(): void {
        foreach ($this->observers as $observer){
            $observer->update($this);
        }
    }
    public function addNewOrder($book_id, $user_email) {
        $connect = new mysqli('localhost','root','','onlineBook');
        
        $query   = $connect->prepare('insert into orders set book_id=? ,user_email=?');
        $query->bind_param('is', $book_id, $user_email);
        $query->execute();
        $this->notify();
    }
    
    public function return_newOrder_id() {
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from orders');
        $query->execute();
        $result = $query->get_result();
        $id=1;
        foreach($result as $value){
            $id = $value['order_id'];
        }
        
        return $id;
        
    }
    

}
