<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Jabatan_model');
        
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
            {
                $data['judul'] = 'Jabatan';

                $this->load->view('templates/header', $data);
                $this->load->view('jabatan/jabatan_list', $data);
                $this->load->view('templates/footer', $data);
            } 

            public function json() {
                header('Content-Type: application/json');
                echo $this->Jabatan_model->json();
            }

    public function read($id) 
        {
            $row = $this->Jabatan_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_jabatan' => $row->id_jabatan,
		'nama_jabatan' => $row->nama_jabatan,
	    );


                $data['judul'] = 'Detail Jabatan';

                $this->load->view('templates/header', $data);
                $this->load->view('jabatan/jabatan_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('jabatan'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                    
$this->db->delete('jabatan', ['id_jabatan' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('jabatan/create_action'),
	    'id_jabatan' => set_value('id_jabatan'),
	    'nama_jabatan' => set_value('nama_jabatan'),
	);

                $data['judul'] = 'Tambah Jabatan';
                $this->load->view('templates/header', $data);
                $this->load->view('jabatan/jabatan_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
	    );

                        $this->Jabatan_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('jabatan'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Jabatan_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('jabatan/update_action'),
		'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
		'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
	    );

                        $data['judul'] = 'Ubah Jabatan';
$this->load->view('templates/header', $data);
                        $this->load->view('jabatan/jabatan_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('jabatan'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_jabatan', TRUE));
                            } else {
                                $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
	    );

                                $this->Jabatan_model->update($this->input->post('id_jabatan', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('jabatan'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            $row = $this->Jabatan_model->get_by_id($id);

                            if ($row) {
                                $this->Jabatan_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('jabatan'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('jabatan'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'trim|required');

	$this->form_validation->set_rules('id_jabatan', 'id_jabatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "jabatan.xls";
                                $judul = "jabatan";
                                $tablehead = 0;
                                $tablebody = 1;
                                $nourut = 1;
                                //penulisan header
                                header("Pragma: public");
                                header("Expires: 0");
                                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                                header("Content-Type: application/force-download");
                                header("Content-Type: application/octet-stream");
                                header("Content-Type: application/download");
                                header("Content-Disposition: attachment;filename=" . $namaFile . "");
                                header("Content-Transfer-Encoding: binary ");

                                xlsBOF();

                                $kolomhead = 0;
                                xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jabatan");

	foreach ($this->Jabatan_model->get_all() as $data) {
                                    $kolombody = 0;

                                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jabatan);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Jabatan.php */
                        /* Location: ./application/modules/C:\xampp\htdocs\CrudRAB_CI\application/modules//controllers/Jabatan.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-07-26 23:51:09 */
                        /* http://harviacode.com */