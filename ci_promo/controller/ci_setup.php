<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Promo_setup extends Leisurenet_Controller {
        function __construct() {
            parent::__construct();
            $this->load->model('promo_setup_model');
        }
		
		public function index() {
			$this->load->view('general/header', $this->data);
			$this->load->view('general/footer', $this->data);
		}
		
		public function cron ($method = 'setup_source_codes') {
			//THIS METHOD CAN ONLY BE RUN FROM CLI - OTHERWISE WE RETURN THE ERROR MESSAGE
			if ($this->input->is_cli_request() != 1) {
				header ("Content-type: text/text");
				echo 'HEY, THIS NEEDS TO BE RUN FROM CLI.';
				echo PHP_EOL;
				exit();
			}

			//IF WE DON'T SEE THIS METHOD IN THE CLASS, EXIT INSTEAD OF FAILING
			if (!method_exists($this, $method)) {
				header ("Content-type: text/text");
				echo 'SORRY, THE REQUESTED METHOD DOES NOT EXIST.';
				echo PHP_EOL;
				exit();
			}

			$this->load->model('cron_model', 'cron_model');

			$log_id = $this->cron_model->startlog('setup source codes', $method, date('Y-m-d H:i:s'), -1);

			//CALL METHOD
			$result = $this->$method();

			$this->cron_model->endlog(date('Y-m-d H:i:s'), $result['success'], $result['message'], $log_id);
			//PRINTS AN EXTRA CARRIAGE RETURN IF THIS IS AN ACTUAL CLI AND NOT A CRON JOB
			echo PHP_EOL;
		}
		
		function setup_source_codes() {
							
			$this->data['info'] = $this->promo_setup_model->get_promos();

			if ($this -> data['info'] != NULL) {
							
				foreach ($this -> data['info'] as $promo) {
						
					// put promo source codes and get id
					$id = $this->promo_setup_model->put_promo($promo['site_db'], $promo['name'], $promo['code']);
										
					// put promo conditions
					$this->promo_setup_model->put_promo_conditions($promo['site_db'], $id, json_decode($promo['conditions'], TRUE));
				}							
												
			}
			
            $this->load->model('cron_model', 'cron_model');
       
			return $result;

		}
		           
	}
?>