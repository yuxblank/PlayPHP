<?php
require "../class/Database.php";
require '../model/Customer.php';
require '../model/CustomerLicenses.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registration
 *
 * @author yuri.blanc
 */
class Registration {
    private $result;
     function request () {
         $email = filter_input(INPUT_POST,'email');
         $product_id = filter_input(INPUT_POST,'prouduct_id');
         $machine_code = filter_input(INPUT_POST,'machine_code');
         
    	// check incoming data
    	if ($email && $product_id) {
    		// if $source, than the request does not come from webpages
                    $customer = new Customer();
                    $customer->getCustomer($email);
                    $this->checkValidity($customer, $product_id);
    	}
        else {
            $this->result = "USER NOT FOUND";
        }

    }
    
    function checkValidity($customer, $product_id) {  
        $license = new CostumerLicenses();
        $license->findOrder($user, $product_id); 
        if ($license) {
           $response = $this->process($machine_code);
        }
    }
    
    private function process($machine_code) {
        $key = "ABABABA";
        return $key;
    }
}
