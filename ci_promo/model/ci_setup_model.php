<?php

class Promo_setup_model extends CI_Model {
	function __construct() {
	   parent::__construct();
	}
	
	// get source codes
	public function get_promos() {
    	$sql = "SELECT
               		`code`, `name`, `conditions`, `site_db` 
				FROM
                	`leisurenet`.`promo_source_codes`
                ";
		return $this->db->query($sql)->result_array();
	}

	// get promo count
	public function get_promo_count($site_db) {
		$sql = "SELECT
					COUNT(*)
				FROM
					`".$site_db."`.`promos`
				WHERE 
					(`code` <> '' AND `code` IS NOT NULL)
				";

		return $this->db->query($sql)->row_array();
	}

	// get promo condition names 
	public function get_promo_condition_names($site_db) {
		$sql = "SELECT
					*
				FROM
					`".$site_db."`.`promo_condition_names`
				";

		return $this->db->query($sql)->row_array();
	}
	
	// get promo conditioins
	public function get_promo_conditions($site_db, $promo_id) {
		$sql = "SELECT
					`pc`.`id`,`pc`.`condition_id`,`pc`.`condition_value`
				FROM 
					`".$site_db."`.`promo_condition_names` `pcn`
				JOIN
					`".$site_db."`.`promo_conditions` `pc`
				ON
					`pc`.`condition_id`=`pcn`.`id`
				WHERE
					`promo_id` = '".$promo_id."'
				";

		return $this->db->query($sql)->row_array();
	}	
	
	// add source code to promo table
	public function put_promo($site_db, $name, $code) {
		
		$sql = "INSERT INTO
					`".$site_db."`.`promos`(`name`, `active`, `code`, `start_datetime`, `end_datetime`) 
				VALUES
					('$name', 1, '$code', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')
				";

		$this->cicart->query($sql);
		
		return $this->db->insert_id();
	}
	
	// add promo conditions
	public function put_promo_conditions($site_db, $promo_id, $data) {
		
		foreach ($data as $key => $value) {
			
			$sql = "INSERT INTO
						`".$site_db."`.`promo_conditions` (`promo_id`, `condition_id`, `condition_value`)
					VALUES
						('$promo_id', $key, '$value')
					";
			$this->db->query($sql);
		}
		
	}

}
?>