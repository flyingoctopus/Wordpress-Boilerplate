<?php
	/**
	 * WPBlocks
	 *
	 * Admin class for adding, editing and deleting blocks
	 *
	 * @package WPBlocks
	 * @author Keir Whitaker <http://keirwhitaker.com>
	 * @copyright (c)2010 Keir Whitaker
	 */
	Class WPBlocks 
	{
		/**
		 * db class variable
		 *
		 * @var object
		 */
		protected $db;
		
		/**
		 * data class variable
		 *
		 * @var array
		 */
		protected $data;
	
		/**
		 * Instantiate the class vars on construct
		 *
		 * @author Keir Whitaker
		 */
		public function __construct() {
			global $wpdb;

			$this->db =& $wpdb;
			$this->data = array();
		}

		/**
		 * If an action is set using $_GET action it else default it
		 *
		 * @return void
		 * @author Keir Whitaker
		 */
		public function do_action() {
			
			if(isset($_GET['action'])) {
				$action = $_GET['action'];
				if (method_exists($this, $action)) {
					$this->$action();
				} else {
					$this->index();
				};
			} else {
				$this->index();
			};	
		}

		/**
		 * Display the index (list) view
		 *
		 * @return view template
		 * @author Keir Whitaker
		 */		
		public function index() {
			$this->data['blocks'] = $this->db->get_results("SELECT * FROM {$this->db->prefix}wpb_content");	
			$this->display("index");
		}
		
		/**
		 * Display the dashboard view (NOT IMPLEMENTED)
		 *
		 * @return view template
		 * @author Keir Whitaker
		 */
		public function dashboard() {
			$this->data['blocks'] = $this->db->get_results("SELECT * FROM {$this->db->prefix}wpb_content");	
			$this->display("dashboard");
		}

		/**
		 * Adds a block of content to the db
		 *
		 * @return view template
		 * @author Keir Whitaker
		 */
		public function block_add() {
			
			if(isset($_POST['wpb_hidden'])) {
				$this->data = $_POST;
				
				// If we have valid data insert the data into the database
				if(trim($this->data['name']) !='' && trim($this->data['content']) !='') {
					
					// Create an array of the post data	
					$block_data = array();
					$block_data['name'] = sanitize_title_with_dashes(trim($_POST['name'])); // Function in /wp-includes/formatting.php
					$block_data['content'] = trim($_POST['content']);
					
					$block_data['html_prepend'] = trim($_POST['html_prepend']);
					$block_data['html_append'] = trim($_POST['html_append']);
					
					$block_data['active'] = trim($_POST['active']);				
					$block_data['created_at'] = date('Y-m-d H:i:s')	;	
					$block_data['updated_at'] = date('Y-m-d H:i:s');
					
					// Add the block to the db
					$this->db->insert( $this->db->prefix.'wpb_content', $block_data);
					
					// Update the internal data array with the block data for use in the template
					$this->data = $block_data;
					
					// Retrieve the new block id
					$this->data['new_block_id'] = $this->db->insert_id;
					
					// Display the flash message in the template
					$this->data['message'] = "Block {$block_data['name']} Updated";
					
				} else {
					$this->data['error'] = "Please enter 'name and content' to save the block";
				};
			}
			
			// Always display the add_edit form
			$this->display("add_edit");
		}
	
		/**
		 * Edit a block of content and save it to the db
		 *
		 * @return void
		 * @author Keir Whitaker
		 */
		public function block_edit() {
			if(!isset($_GET['block_id'])) {
				// If we do not have a block_id in $_GET default the view to the index
				$this->index();
			} else {
				// Only get_row if it is the first page load, we will ust $_POST data after the first refresh
				if(isset($_POST['wpb_hidden'])) {
					
					// We have $_POST data so it's a postback, set the internal data var to the $_POST vars
					$this->data = $_POST;

					// If we have a POST variable then let's check to see if we have valid data, if not just reshow it					
					if(trim($this->data['name']) !='' && trim($this->data['content']) !='') {

						// Create an array of the post data	
						$block_data = array();
						$block_data['name'] = sanitize_title_with_dashes($_POST['name']);
						$block_data['content'] = trim($_POST['content']);
						
						$block_data['html_prepend'] = trim($_POST['html_prepend']);
						$block_data['html_append'] = trim($_POST['html_append']);
						
						$block_data['active'] = trim($_POST['active']);				
						$block_data['updated_at'] = date('Y-m-d H:i:s');
				
						// Update the database
						// TODO: Investigate the prepare method in WP DB class
						$this->db->update( $this->db->prefix.'wpb_content', $block_data, array( 'ID' => $_GET['block_id'] ) );

						// Update the internal data array with the block data for use in the template
						$this->data = $block_data;
						
						// Display the flash message in the template
						$this->data['message'] = "Block {$block_data['name']} Updated";

					} else {
						// We have invalid data so just set the data var to the $_POST vars to redisplay it
						$this->data = $_POST;
						$this->data['error'] = "Please enter 'name and content' to save the block";
					};
				} else {	
					// We have no $_POST vars so it's the first page load, grab the row data
					$block_id = $_GET['block_id'];
					$this->data = (array)$this->db->get_row("SELECT * FROM {$this->db->prefix}wpb_content WHERE id = {$block_id}");
					
					// Only carry on if we have a valid data array otherwise
					if(!count($this->data) == 1) header('location: '.$_SERVER['REQUEST_URI'].'?page=wpb-admin');

				};

				// Always display the add_edit form
				$this->display("add_edit");

			};
		}
		
		/**
		 * Deletes a block from the database
		 *
		 * @return void
		 * @author Keir Whitaker
		 */
		public function block_delete() {
			if(isset($_GET['block_id'])) {
				$id = $_GET['block_id'];
				$this->db->query("DELETE FROM {$this->db->prefix}wpb_content WHERE ID = {$id}");
			};
			$this->index();
		}
	
		/**
		 * Displays the given $template
		 *
		 * @param string $template 
		 * @return void
		 * @author Keir Whitaker
		 */
		private function display($template) {
			
			$file_path = WP_PLUGIN_DIR.'/wp-blocks/templates/'.$template.'.php';
			if(file_exists($file_path)) {
				$data = $this->data;
				include($file_path);	
			};
			
		}
		/**
		 * Sets the value of the active dropdown (need to make this generic)
		 *
		 * @return none (html string echo'd to browser)
		 * @author Keir Whitaker
		 **/
		public static function active_dropdown_options($_POST) {
			$options = array(0 => 'No', 1 => 'Yes');
			$active = 1;

			if(isset($_POST['active'])) {
				$active = $_POST['active'];
			};
			
			$html = '<select name="active" id="active">';
			foreach ($options as $key => $val) {
				if ($key == $active) {
					$html .= '<option value="'.$key.'" selected="selected">'.$val.'</option>';
				} else {
					$html .= '<option value="'.$key.'">'.$val.'</option>';
				};
			}
			$html .= '</select>';

			echo $html;
		}

	} // END Class
?>