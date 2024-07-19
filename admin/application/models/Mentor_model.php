<?php
class Mentor_model extends Grocery_crud_model {
    
    // protected $primary_key = 'film_id';
    // protected $table_name = 'film';
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function get_list()
    {
         
         $this->db->select('users.id,users.username,users.email,users.active,users.sex,users.sex,users.first_name,users.   surname,users.age,users.about');
         $this->db->join('users_groups', 'users_groups.user_id = users.id');
          $this->db->where('users_groups.group_id',4);
         // $this->db->join("$related_table","$related_table.$related_field_name = {$this->table_name}.$field_name");
         $results = $this->db->get('users')->result();
         // print_r($this->db->last_query());
         return $results;
    }
}
?>