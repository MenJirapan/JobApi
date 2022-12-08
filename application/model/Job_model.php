<?php
class Job_model extends CI_Model
{
    
    private $table = 'Table Name In Database';
    private $link = 'Path to Redirect'; 
    private $pk = 'Primary Key';

    public function get_show()
    {
        return $this->db->count_all($this->table);
    }


    public function get_page_show($limit, $start) 
    {
    	
        $this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by($this->pk, 'DESC');


        $this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();

    }
    

    public function search($key) 
    {

        $this->db->select('*');
        $this->db->from($this->table);

        if(!empty($key)) {
            $this->db->like('Fileds', $key);
            $this->db->or_like('Fileds', $key);
            $this->db->or_like('Fileds', $key);
        }

        $sql = $this->db->get();
        return $sql;
    }



    public function ApiData($job)
	{
        $AddRows = 0;
        $EditRows = 0;

        foreach($job as $key => $news) {
            foreach($news as $value) {

                $check = $this->db->select('*')->from($this->table)->where($this->pk, $value->id)->get()->row();

                if($check) {

                    $Updateing = array(
                                    'Fileds API'  => $value->fileds_table,
                                    'Fileds API'  => $value->fileds_table,
                            );

                    $this->db->where($this->pk, $value->id);
                    $this->db->update($this->table, $Updateing);
                    $EditRows++;

                } else {
                    
                    $Adding = array(
                                    'Fileds API Id' => $value->id,
                                    'Fileds API'    => $value->fileds_table,
                                    'Fileds API'    => $value->fileds_table,
                            );

                    $this->db->insert($this->table, $Adding);
                    $AddRows++;

                }

            }
        	
        }

        $this->session->set_flashdata(
        					'alert',
        					"<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Update Data Api success', 
                                    footer: 'Add data total ".$AddRows." Rows and Update data total ".$EditRows." Rows'
                                });
                            </script>
        				");
        return ['AddRows' => $AddRows, 'EditRows' => $EditRows];

    }
}
