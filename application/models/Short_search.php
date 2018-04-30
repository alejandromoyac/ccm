<?php
class Short_search extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search($keyword)
    {
        $this->db->like('VID_NAME', $keyword);
        $query = $this->db->get('SIMP_VIDS');
        return $query->result_array();
    }
    public function select_vid($vid_id)
    {
        $query = $this->db->get_where('SIMP_VIDS', array('VID_ID' => $vid_id));
        return $query->result_array();
    }
}
