<?php
class Test_crud_model extends Grocery_crud_model {
    
    // protected $primary_key = 'film_id';
    // protected $table_name = 'film';
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    // function get_list($id = null, $order_by = null){
    //     print('hellow');
    //      $result = $this->db->select('*')
    //             ->from('users')
    //             ->join('users_groups', 'users_groups.user_id = users.id')
    //             ->where('users_groups.group_id',1)
    //             ->get();
    //     $result = $this->db->get('users');
    //     // print_r($result->result_array());
    //     return $result->result_array();
    // }

    function get_list()
    {
        // list($field_name, $related_table, $related_field_name) = $this->join;
        // $select = "{$this->table_name}.*,$related_table.*";
        
        //  if(!empty($this->relation))
        //  {
        //       foreach($this->relation as $relation)
        //       {
        //            list($field_name , $related_table , $related_field_title) = $relation;
        //            $unique_join_name = $this->_unique_join_name($field_name);
        //            $unique_field_name = $this->_unique_field_name($field_name);
                  
        //             if(strstr($related_field_title,'{'))
        //             {
        //                 $select .= ", CONCAT('".str_replace(array('{','}'),array("',COALESCE({$unique_join_name}.",", ''),'"),str_replace("'","\'",$related_field_title))."') as $unique_field_name";
        //             }
        //             else
        //             {  
        //                 $select .= ", $unique_join_name.$related_field_title as $unique_field_name";
        //             }
                      
        //            if($this->field_exists($related_field_title))
        //            {
        //                 $select .= ", {$this->table_name}.$related_field_title as '{$this->table_name}.$related_field_title'";
        //            }
        //       }
        //   }
         
        $this->db->select('users.id,users.username,users.email,users.active,users.sex,users.prefered_gender,users.first_name,users.   surname,users.age,users.about');
        $this->db->join('users_groups', 'users_groups.user_id = users.id');
        $this->db->where('users_groups.group_id',3);
         // $this->db->join("$related_table","$related_table.$related_field_name = {$this->table_name}.$field_name");
        $results = $this->db->get('users')->result();
         // print_r($this->db->last_query());
         return $results;
    }
}
?>