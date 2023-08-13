<?php

class MY_Form_validation extends CI_Form_validation
{

    public function __construct($rules = array())
    {
        $this->CI =& get_instance();
        parent::__construct($rules);
    }

    public function is_unique_update($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return $this->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0;
    }
	
}