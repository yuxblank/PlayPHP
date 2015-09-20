<?php
require_once '../class/Database.php';
/**
 * Description of ProductRegistration
 *
 * @author yuri.blanc
 */
class CostumerLicenses {
    private $db;
    private $id;
    private $license_id;
    private $user_id;   
    private $order_id;
    private $transaction_id;
    private $product_id;
    private $date; 
    
    function __construct($id, $license_id, $user_id, $order_id, $transaction_id, $product_id, $date) {
        $this->id = $id;
        $this->license_id = $license_id;
        $this->user_id = $user_id;
        $this->order_id = $order_id; 
        $this->transaction_id = $transaction_id;
        $this->product_id = $product_id;
        $this->date = $date;
        $this->db = new Database();
    } 
    
    public function find($id=null, $user_id=null, $transaction_id=null) {
        if (isset($id)) {
            $query = "SELECT * FROM costumer_license WHERE id=:id";
            $this->db->query($query);
            $this->db->bindValue(":id", $id);
            return $this->db->fetchSingleObject(get_class($this));
        } else if (isset ($user_id)) {
            $query = "SELECT * FROM costumer_license WHERE user_id=:user_id";
            $this->db->query($query);
            $this->db->bindValue(":user_id", $user_id);
            return $this->db->fetchSingleObject(get_class($this));
        } else if (isset ($transaction_id)) {
            $query = "SELECT * FROM costumer_license WHERE transaction_id=:transaction_id";
            $this->db->query($query);
            $this->db->bindValue(":transaction_id", $transaction_id);
            return $this->db->fetchSingleObject(get_class($this));
        }
    }
    /**
     * 
     * @param CostumerLicenses $object
     */
    public function save ($object) {
        $this->db->query("INSERT INTO costumer_license VALUES (:license_id, :user_id, :order_id, :transaction_id,:product_id, :date)");
//        $this->db->bindValue(":user_id", $object->id);
//        $this->db->bindValue(":email", $object->email);
//        $this->db->bindValue(":order_id", $object->order_id);
//        $this->db->bindValue(":transaction_id", $object->transaction_id);
//        $this->db->bindValue(":date", new DateTime());
//        $object->date = new DateTime ('now');
        $this->db->save($object);
    }
    
        /**
     * Find order of user and return the order data if the user has a valid order and license for that product.
     * @param type $user
     * @param type $product
     */
    public function findOrder($user, $product) {
        // ------------- HikaShop implementation ------------ \\
        $this->db->changeDb(DB2_DRIVER, DB2_HOST, DB2_NAME, DB2_USER, DB2_PSW, DB2_OPTIONS);
        $statement = "SELECT * FROM jh23m_hikashop_order WHERE order_user_id = :user_id AND order_status = 'confirmed'";
        $this->db->query($statement);
        $this->db->bindValue(":user_id", $user->id);
        // TODO implementation
    }
    
}