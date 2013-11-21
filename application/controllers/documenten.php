<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Documenten_Controller extends CI_Controller
{
    
    function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}
   /* function index()
    {
        date_default_timezone_set("Europe/Brussels");
       
        
        //Check if logged on
        $blnLoggedOn = checkLogin();
        if($blnLoggedOn == true)
        {
            createPageStart("HomeCare", array());
            $this -> load -> model("MenuItems_Model", "objMenuItems");
            $arrMainMenuItems = $this -> objMenuItems -> getMainMenuItems();
            $this -> load -> model("Documenten_Model", "objModel");
            //Loading the model so the page contents can be created and given to the view
            $this -> view -> assign("strContents", $this -> objModel -> getPageData($arrMainMenuItems, $blnLoggedOn));
        }
        else
        {
            $this -> load -> model("NoEntry_Model", "objError");
            $this -> view -> assign("strContents", $this -> objError -> getPageData());
        }
        $this -> view -> display("index_view");
    }*/
    
}
?>
