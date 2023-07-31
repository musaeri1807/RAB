<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Projek_rincian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Projek_rincian_model');
        
        $this->load->library('form_validation');
    }

public function index()
        {
            
            // var_dump($data['projek']=$this->db->get('projek')->result_array());
            // die();

            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'projek_rincian/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'projek_rincian/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'projek_rincian/index.html';
                    $config['first_url'] = base_url() . 'projek_rincian/index.html';
                }
                $data['projek']=$this->db->get('projek')->result_array();
                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Projek_rincian_model->total_rows($q);
                $projek_rincian = $this->Projek_rincian_model->get_limit_data($config['per_page'], $start, $q);
               
                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'projek_rincian_data' => $projek_rincian,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Projek Rincian';

                $this->load->view('templates/header', $data);
                $this->load->view('projek_rincian/projek_rincian_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Projek_rincian_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_rincian' => $row->id_rincian,
		'id_projek' => $row->id_projek,
		'item' => $row->item,
		'biaya' => $row->biaya,
		'keterangan' => $row->keterangan,
		'status' => $row->status,
		'persetujuan' => $row->persetujuan,
	    );


                $data['judul'] = 'Detail Projek Rincian';

                $this->load->view('templates/header', $data);
                $this->load->view('projek_rincian/projek_rincian_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('projek_rincian'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                    
$this->db->delete('projek_rincian', ['id_projek_rincian' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('projek_rincian/create_action'),
                'id_rincian' => set_value('id_rincian'),
                'id_projek' => set_value('id_projek'),
                'item' => set_value('item'),
                'biaya' => set_value('biaya'),
                'keterangan' => set_value('keterangan'),
                'status' => set_value('status'),
                'persetujuan' => set_value('persetujuan'),
            );

                $data['judul'] = 'Tambah Projek Rincian';
                $data['nprojek']=$this->db->get('projek')->result_array();
                $this->load->view('templates/header', $data);
                $this->load->view('projek_rincian/projek_rincian_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
                        'id_projek' => $this->input->post('id_projek',TRUE),
                        'item' => $this->input->post('item',TRUE),
                        'biaya' => $this->input->post('biaya',TRUE),
                        'keterangan' => $this->input->post('keterangan',TRUE),
                        'status' => $this->input->post('status',TRUE),
                        'persetujuan' => $this->input->post('persetujuan',TRUE),
                        );

                        $this->Projek_rincian_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('projek_rincian'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Projek_rincian_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('projek_rincian/update_action'),
                        'id_rincian' => set_value('id_rincian', $row->id_rincian),
                        'id_projek' => set_value('id_projek', $row->id_projek),
                        'item' => set_value('item', $row->item),
                        'biaya' => set_value('biaya', $row->biaya),
                        'keterangan' => set_value('keterangan', $row->keterangan),
                        'status' => set_value('status', $row->status),
                        'persetujuan' => set_value('persetujuan', $row->persetujuan),
                        );

                        $data['judul'] = 'Ubah Projek Rincian';
                        $this->load->view('templates/header', $data);
                        $this->load->view('projek_rincian/projek_rincian_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('projek_rincian'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_rincian', TRUE));
                            } else {
                                $data = array(
                            'id_projek' => $this->input->post('id_projek',TRUE),
                            'item' => $this->input->post('item',TRUE),
                            'biaya' => $this->input->post('biaya',TRUE),
                            'keterangan' => $this->input->post('keterangan',TRUE),
                            'status' => $this->input->post('status',TRUE),
                            'persetujuan' => $this->input->post('persetujuan',TRUE),
                            );

                                $this->Projek_rincian_model->update($this->input->post('id_rincian', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('projek_rincian'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            $row = $this->Projek_rincian_model->get_by_id($id);

                            if ($row) {
                                $this->Projek_rincian_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('projek_rincian'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('projek_rincian'));
                                }
                            }

                            public function _rules() 
                            {
                            $this->form_validation->set_rules('id_projek', 'id projek', 'trim|required');
                            $this->form_validation->set_rules('item', 'item', 'trim|required');
                            $this->form_validation->set_rules('biaya', 'biaya', 'trim|required');
                            $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
                            $this->form_validation->set_rules('status', 'status', 'trim|required');
                            $this->form_validation->set_rules('persetujuan', 'persetujuan', 'trim|required');

                            $this->form_validation->set_rules('id_rincian', 'id_rincian', 'trim');
                            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

                            public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "projek_rincian.xls";
                                $judul = "projek_rincian";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Projek");
	xlsWriteLabel($tablehead, $kolomhead++, "Item");
	xlsWriteLabel($tablehead, $kolomhead++, "Biaya");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Persetujuan");

	foreach ($this->Projek_rincian_model->get_all() as $data) {
                                    $kolombody = 0;

                                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_projek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->item);
	    xlsWriteLabel($tablebody, $kolombody++, $data->biaya);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->persetujuan);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Projek_rincian.php */
                        /* Location: ./application/modules/C:\xampp\htdocs\CrudRAB_CI\application/modules//controllers/Projek_rincian.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-07-30 10:55:00 */
                        /* http://harviacode.com */