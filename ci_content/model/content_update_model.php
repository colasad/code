<?php

class Content_update_model extends CI_Model {
	function __construct() {
	   parent::__construct();
	}
	
	// get promo content
    //  
 	public function get_content() {
        $sql = "SELECT
                `id`, `type`, `rundate`, `content`, `image`, `site_db`
                FROM
                `content_updates`
                WHERE
                `iscomplete` < 1
                AND
                `rundate` = '".date('Y-m-d')."'
                ORDER BY
                `site_db` ASC
                ";
        return $this->db->query($sql)->result_array();
    }
    
  	// create reset data
    //
    public function create_category_data($site_db, $date, $id) {
        $sql = "INSERT INTO
                `content_updates`
                (id, type, rundate, site_db, iscomplete)
                VALUES
                ('$id', 'reset_img', '$date', '$site_db', 1)
                ";
        $this->db->query($sql);
	}

	// get image
    //
    public function get_category_image($site_db, $id) {
        $sql = "SELECT
                `image`
                FROM
                `".$site_db."`.`categories`
                WHERE
                `id` = '".$id."'
                ";
        return $this->db->query($sql)->row_array();
       
    }

    // update reset data with original data
    //
    public function update_category_data($site_db, $id, $category_img) {
        $sql = "UPDATE
                `content_updates`
                SET
                `image` = '".$category_img."'
                WHERE           
                `content_updates`.`id` = '".$id."'
                AND
                `type` = 'reset_img'
                ";
        $this->db->query($sql);
        
    }
 	
 	// update with promo data
    //
    public function update_category_content($site_db, $id, $img) {
        $sql = "UPDATE
                `".$site_db."`.`categories`
                SET
                `image` = '".$img."'
                WHERE
                `id` = '".$id."'
                ";
        $this->db->query($sql);
    }
	
	// create html reset data for pages
    //
	public function create_page_data($sitedb, $date, $id) {
		$sql = "INSERT INTO
				`content_updates`
        		(id, type, rundate, site_db, iscomplete)
                VALUES
                ('$id', 'reset_html', '$date', '$sitedb', 1)
                ";
        $this->db->query($sql);
 	}

    // get original html content
    //
    public function get_page_content($site_db, $id) {
        $sql = "SELECT
                `content`
                FROM
                `".$site_db."`.`pages`
                WHERE
                `id` = '".$id."'
                ";
        return $this->db->query($sql)->row_array();
    }

	// update reset data with original html
    //
    public function update_page_data($site_db, $id, $pages_html) {
        $sql = "UPDATE
                `content_updates`
                SET
                `content` = '".addslashes($pages_html)."'
                WHERE           
                `content_updates`.`id` = '".$id."'
                AND
                `type` = 'reset_html'
                ";
        $this->db->query($sql);
        
    }
	// update html with promo content
    //
    public function update_page_content($site_db, $id, $html) {
        $sql = "UPDATE
                `".$site_db."`.`pages`
                SET
                `content` = '".addslashes($html)."'
                WHERE
                `id` = '".$id."'
                ";
        $this->db->query($sql);
    }
	
	// flag updates on completion
    //
    public function update_content_complete() {
        $sql = "UPDATE
                `content_updates`
                SET
                `iscomplete` = 1
                WHERE   
                `rundate` = '".date('Y-m-d')."'
                ";
        $this->db->query($sql);
    }
	
}
/* End of model */ 