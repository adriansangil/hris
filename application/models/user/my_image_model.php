<?php
class My_image_model extends CI_Model {

	function do_upload($employee_id){

		$config['upload_path'] = realpath(APPPATH. '../images/uploads');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '800';
		$config['max_height']  = '800';
		$config['overwrite'] = 'true';
		$config['file_name'] = 'employee-pic-'.$employee_id;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->session->set_flashdata('msg2', 'danger');
			$this->session->set_flashdata('msgpass', 'Upload Failed!');
			redirect(base_url().'index.php/my_profile');
		}

		else
		{
			$data = $this->upload->data();

			$data2 = array(
				'display_picture' => $data['file_name']
				);

			$this->db->update('employee_information',$data2, "employee_id = $employee_id");

			redirect(base_url().'index.php/my_profile','refresh');
		}
	}
}