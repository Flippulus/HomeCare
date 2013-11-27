<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Documenten extends CI_Controller
{
  
    public function file_upload_demo()
    {
        try
        {
            if($this->input->post("submit")){        
                $this->load->library("application/uploader");
                $this->uploader->do_upload();
            }
            return $this->view();
        }
        
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
}
?>
