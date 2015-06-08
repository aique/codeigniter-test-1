<?php

class News extends CI_Controller
{
    public function __construct() // los controladores pueden tener constructor
    {
        parent::__construct(); // la primera llamada debe ser al constructor de la clase padre

        $this->load->model('news_model'); // los modelos se crean en este punto
    }

    /**
     * Petición que devuelve el listado completo de noticias.
     */
    public function index()
    {
        $data['news'] = $this->news_model->get_news(); // se llama al método del modelo instanciado en el constructor que devuelve todas las noticias

        $data['title'] = 'Noticias';

        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Petición que devuelve una noticia en concreto en función
     * del slug recibido como parámetro.
     *
     * @param $slug
     */
    public function view($slug)
    {
        $data['news_item'] = $this->news_model->get_news($slug);

        if(empty($data['news_item'])) // si no se ha encontrado la noticia
        {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Petición que muestra un formulario, o lo tramita, con
     * el objetivo de almacenar una nueva noticia en la base
     * de datos.
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required'); // reglas para la validación del formulario
        $this->form_validation->set_rules('text', 'text', 'required');

        if($this->form_validation->run() == false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->news_model->set_news();
            $this->load->view('news/success'); // modo en el que se llevan a cabo las redirecciones
        }
    }

    /**
     * Petición que muestra el resultado existoso tras haber
     * almacenado una nueva noticia en la base de datos.
     */
    public function success()
    {
        $data['title'] = 'Noticia creada';

        $this->load->view('templates/header', $data);
        $this->load->view('news/success');
        $this->load->view('templates/footer');
    }
}