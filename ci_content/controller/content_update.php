<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Content_update extends CI_Controller {
    
        function __construct() {
            parent::__construct();
            $this->load->model('content_update_model');
        }
		
		function content_swap() {
									
			$this->data['info'] = $this->content_update_model->get_content($date);
			
			if ($this -> data['info'] != NULL) {
			
				// set reset date 1 week from run date
				//
				//$reset_date = strtotime($reset_date . '+1 week'));
								
				foreach ($this -> data['info'] as $content) {
						
					// update categories / pages content	
					if ($content['type'] == 'promo_img') {
							
						// create restore data
						$this->content_update_model->create_category_data($content['site_db'], $content['rundate'], $content['id']);
						
						// get image
						$image = $this->content_update_model->get_category_image($content['site_db'], $content['id']);
						
						// update original data
						$this->content_update_model->update_category_data($content['site_db'], $content['id'], $image['image']);
							
						// update with promo content
						$this->content_update_model->update_category_content($content['site_db'], $content['id'], $content['image']);
								
						} elseif ($content['type'] == 'reset_img') {
	 					
						// reset original image
						$this->content_update_model->update_category_content($content['site_db'], $content['id'], $content['image']);
	 				
						} elseif ($content['type'] == 'promo_html') {
						
						// create restore html data
						$this->content_update_model->create_page_data($content['site_db'], $content['rundate'], $content['id']);
						
						// get html content
						$html = $this->content_update_model->get_page_content($content['site_db'], $content['id']);
						
						// save original html content
						$this->content_update_model->update_page_data($content['site_db'], $content['id'], $html['content']);
						
						// update with promo html content
						$this->content_update_model->update_page_content($content['site_db'], $content['id'], $content['content']);	
	 						
						} elseif ($content['type'] == 'reset_html') {
	 					
						// resset original html content
						$this->content_update_model->update_page_content($content['site_db'], $content['id'], $content['content']);
					}									
				}
				// update as complete
				$this->content_update_model->update_content_complete();		
			}
        }
  	}
?>