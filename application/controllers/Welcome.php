<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->helper('captcha');

        $values = array(
            'word' => '',   //Generate alternate word by default. You can also set your word.
            'word_length' => 8,  // To set length of captcha word.
            'img_path' => './captcha/',   // Create  folder "images" in root directory, and give path.
            'img_url' => base_url() .'captcha/',  // To store captcha images in "images" folder.

            // Font path is used font library, which will stored  in system/fonts/texb.ttf.
            'font_path' => base_url() . 'system/fonts/texb.ttf',
            'img_width' => '150',   //Set image width.
            'img_height' => 50,   // Set image height.
            'expiration' => 3600   // This will automatically expire images in given time.
        );
        // "create_captcha" is function of "captcha helper", this will set array in helper library.
        $data = create_captcha($values); 

       
 
        print '<pre>';
        print_r($data);
        print '</pre>';

        $cat = array(
            'captcha_time'  => $data['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $data['word']
        );

        $query = $this->db->insert_string('captcha', $cat);
        $this->db->query($query);

        echo 'Submit the word you see below:';
        echo $data['image'];
        echo '<input type="text" name="captcha" value="" />';
    }
}
