<?php

class News_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database(); // carga la librería de la base de datos, haciendo disponible la variable $this->db
    }

    /**
     * Obtiene las noticias de la base de datos en función
     * de su slug. En caso de no recibir ninguno, devolverá
     * las noticias al completo.
     *
     * @param bool $slug
     * @return mixed
     */
    public function get_news($slug = false) // no hace falta analizar el parámetro ya que la clase Active Record lo hace por nosotros
    {
        if($slug == false) // si no se recibe slug
        {
            $query = $this->db->get('news');

            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug)); // si se recibe slug se tiene en cuenta en la consulta

        return $query->row_array();
    }

    public function set_news()
    {
        $this->load->helper('url'); // obtiene el helper que contiene la función utilizada para generar el slug

        $slug = url_title($this->input->post('title'), 'dash', true); // genera el slug a partir de la función url_title

        $data = array
        (
            'title' => $this->input->post('title'), // la variable input es creada por defecto, y en este caso obtiene la variable title del array post ya limpiada
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }
}