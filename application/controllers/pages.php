<?php

class Pages extends CI_Controller
{
    /**
     * Método que devuelve el contenido de una página situada
     * en views/pages, cuyo nombre recibirá como parámetro.
     *
     * En caso de no recibir nada, home será la página devuelta
     * por defecto.
     *
     * @param string $page
     */
    public function view($page = 'home')
    {
        if(!file_exists(APPPATH.'/views/pages/'.$page.'.php')) // si la página existe
        {
            // show_404(); // la página no se ha encontrado
        }

        $data['title'] = ucfirst($page); // se devuelve el título de la página recibido como parámetro al array de variables que maneja la vista

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}