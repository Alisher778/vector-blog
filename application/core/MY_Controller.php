<?php

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $global_data['settings'] = $this->settings_model->get_settings();

        //set language
        $this->config->set_item('language', $global_data['settings']->site_lang);
        $this->lang->load("messages", $global_data['settings']->site_lang);


        //get your data
        $global_data['popular_posts'] = $this->post_model->get_popular_posts();
        $global_data['random_slider_posts'] = $this->post_model->get_random_slider_posts();
        $global_data['categories'] = $this->category_model->get_categories();
        $global_data['tags'] = $this->tag_model->get_tags();
        $global_data['footer_random_posts'] = $this->post_model->get_footer_random_posts();
        $global_data['pages'] = $this->page_model->get_pages();
        $global_data['header_pages'] = $this->page_model->get_header_pages();
        $global_data['footer_pages'] = $this->page_model->get_footer_pages();
        $global_data['ads'] = $this->ad_model->get_ads();

        //get site primary font
        $this->config->load('fonts');
        $global_data['primary_font'] = $global_data['settings']->primary_font;
        if ($global_data['primary_font'] == 'montserrat') {
            $global_data['primary_font_family'] = 'font-family: "Montserrat", Helvetica, Arial, sans-serif;';
            $global_data['primary_font_url'] = "";
        } else {
            $global_data['primary_font_family'] = $this->config->item($global_data['primary_font'] . '_font_family');
            $global_data['primary_font_url'] = $this->config->item($global_data['primary_font'] . '_font_url');
        }

        //get site secondary font
        $global_data['secondary_font'] = $global_data['settings']->secondary_font;
        if ($global_data['secondary_font'] == 'verdana') {
            $global_data['secondary_font_family'] = 'font-family: Verdana, Helvetica, Arial, sans-serif;';
            $global_data['secondary_font_url'] = "";
        } else {
            $global_data['secondary_font_family'] = $this->config->item($global_data['secondary_font'] . '_font_family');
            $global_data['secondary_font_url'] = $this->config->item($global_data['secondary_font'] . '_font_url');
        }


        //Send the data into the current view
        //http://ellislab.com/codeigniter/user-guide/libraries/loader.html
        $this->load->vars($global_data);

    }
}