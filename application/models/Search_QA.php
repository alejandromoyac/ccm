<?php
class Search_QA extends MY_Model
{
    protected $_table      = 'RESPONSES';
    protected $return_type = 'array';
    public function __construct()
    {
        parent::__construct();
    }

    public function search($keyword)
    {
        $this->db->like('RES_Q', $keyword);
        $query = $this->db->get('RESPONSES');
        return $query->result_array();
    }
}
