<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Projek extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        require FCPATH . 'vendor/autoload.php';
        $this->load->model('Projek_model');
        
        $this->load->library('form_validation');
    }

public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'projek/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'projek/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'projek/index.html';
                    $config['first_url'] = base_url() . 'projek/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Projek_model->total_rows($q);
                $projek = $this->Projek_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'projek_data' => $projek,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Projek';

                $this->load->view('templates/header', $data);
                $this->load->view('projek/projek_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Projek_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_projek' => $row->id_projek,
		'nomor_projek' => $row->nomor_projek,
		'nama_projek' => $row->nama_projek,
		'proses_bisnis' => $row->proses_bisnis,
		'periode_projek' => $row->periode_projek,
		'jenis_projek' => $row->jenis_projek,
		'penguna_projek' => $row->penguna_projek,
		'tujuan_projek' => $row->tujuan_projek,
		'tanggal_lpj' => $row->tanggal_lpj,
		'target_projek' => $row->target_projek,
		'nilai_pengajuan' => $row->nilai_pengajuan,
		'status' => $row->status,
	    );


                $data['judul'] = 'Detail Projek';

                $this->load->view('templates/header', $data);
                $this->load->view('projek/projek_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('projek'));
                }
            }

            public function hapus_bulk()
            {
                cek_akses('d');
                
                foreach($_POST['data'] as $id)
                {
                    
$this->db->delete('projek', ['id_projek' => $id]);
                }
            }

            public function create() 
            {
                cek_akses('c');

                $data = array(
                'button' => 'Create',
                'action' => site_url('projek/create_action'),
	    'id_projek' => set_value('id_projek'),
	    'nomor_projek' => set_value('nomor_projek'),
	    'nama_projek' => set_value('nama_projek'),
	    'proses_bisnis' => set_value('proses_bisnis'),
	    'periode_projek' => set_value('periode_projek'),
	    'jenis_projek' => set_value('jenis_projek'),
	    'penguna_projek' => set_value('penguna_projek'),
	    'tujuan_projek' => set_value('tujuan_projek'),
	    'tanggal_lpj' => set_value('tanggal_lpj'),
	    'target_projek' => set_value('target_projek'),
	    'nilai_pengajuan' => set_value('nilai_pengajuan'),
	    'status' => set_value('status'),
	);

                $data['judul'] = 'Tambah Projek';
                $this->load->view('templates/header', $data);
                $this->load->view('projek/projek_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'nomor_projek' => $this->input->post('nomor_projek',TRUE),
		'nama_projek' => $this->input->post('nama_projek',TRUE),
		'proses_bisnis' => $this->input->post('proses_bisnis',TRUE),
		'periode_projek' => $this->input->post('periode_projek',TRUE),
		'jenis_projek' => $this->input->post('jenis_projek',TRUE),
		'penguna_projek' => $this->input->post('penguna_projek',TRUE),
		'tujuan_projek' => $this->input->post('tujuan_projek',TRUE),
		'tanggal_lpj' => $this->input->post('tanggal_lpj',TRUE),
		'target_projek' => $this->input->post('target_projek',TRUE),
		'nilai_pengajuan' => $this->input->post('nilai_pengajuan',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

                        $this->Projek_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('projek'));
                    }
                }

                public function update($id) 
                {
                    cek_akses('u');

                    $row = $this->Projek_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('projek/update_action'),
		'id_projek' => set_value('id_projek', $row->id_projek),
		'nomor_projek' => set_value('nomor_projek', $row->nomor_projek),
		'nama_projek' => set_value('nama_projek', $row->nama_projek),
		'proses_bisnis' => set_value('proses_bisnis', $row->proses_bisnis),
		'periode_projek' => set_value('periode_projek', $row->periode_projek),
		'jenis_projek' => set_value('jenis_projek', $row->jenis_projek),
		'penguna_projek' => set_value('penguna_projek', $row->penguna_projek),
		'tujuan_projek' => set_value('tujuan_projek', $row->tujuan_projek),
		'tanggal_lpj' => set_value('tanggal_lpj', $row->tanggal_lpj),
		'target_projek' => set_value('target_projek', $row->target_projek),
		'nilai_pengajuan' => set_value('nilai_pengajuan', $row->nilai_pengajuan),
		'status' => set_value('status', $row->status),
	    );

                        $data['judul'] = 'Ubah Projek';
$this->load->view('templates/header', $data);
                        $this->load->view('projek/projek_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('projek'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_projek', TRUE));
                            } else {
                                $data = array(
		'nomor_projek' => $this->input->post('nomor_projek',TRUE),
		'nama_projek' => $this->input->post('nama_projek',TRUE),
		'proses_bisnis' => $this->input->post('proses_bisnis',TRUE),
		'periode_projek' => $this->input->post('periode_projek',TRUE),
		'jenis_projek' => $this->input->post('jenis_projek',TRUE),
		'penguna_projek' => $this->input->post('penguna_projek',TRUE),
		'tujuan_projek' => $this->input->post('tujuan_projek',TRUE),
		'tanggal_lpj' => $this->input->post('tanggal_lpj',TRUE),
		'target_projek' => $this->input->post('target_projek',TRUE),
		'nilai_pengajuan' => $this->input->post('nilai_pengajuan',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

                                $this->Projek_model->update($this->input->post('id_projek', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('projek'));
                            }
                        }

                        public function delete($id) 
                        {
                            cek_akses('d');
                            $row = $this->Projek_model->get_by_id($id);

                            if ($row) {
                                $this->Projek_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('projek'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('projek'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nomor_projek', 'nomor projek', 'trim|required');
	$this->form_validation->set_rules('nama_projek', 'nama projek', 'trim|required');
	$this->form_validation->set_rules('proses_bisnis', 'proses bisnis', 'trim|required');
	$this->form_validation->set_rules('periode_projek', 'periode projek', 'trim|required');
	$this->form_validation->set_rules('jenis_projek', 'jenis projek', 'trim|required');
	$this->form_validation->set_rules('penguna_projek', 'penguna projek', 'trim|required');
	$this->form_validation->set_rules('tujuan_projek', 'tujuan projek', 'trim|required');
	$this->form_validation->set_rules('tanggal_lpj', 'tanggal lpj', 'trim|required');
	$this->form_validation->set_rules('target_projek', 'target projek', 'trim|required');
	$this->form_validation->set_rules('nilai_pengajuan', 'nilai pengajuan', 'trim|required|numeric');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_projek', 'id_projek', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "projek.xls";
                                $judul = "projek";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Projek");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Projek");
	xlsWriteLabel($tablehead, $kolomhead++, "Proses Bisnis");
	xlsWriteLabel($tablehead, $kolomhead++, "Periode Projek");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Projek");
	xlsWriteLabel($tablehead, $kolomhead++, "Penguna Projek");
	xlsWriteLabel($tablehead, $kolomhead++, "Tujuan Projek");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lpj");
	xlsWriteLabel($tablehead, $kolomhead++, "Target Projek");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Pengajuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Projek_model->get_all() as $data) {
                                    $kolombody = 0;

                                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_projek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_projek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->proses_bisnis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->periode_projek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_projek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->penguna_projek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tujuan_projek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lpj);
	    xlsWriteLabel($tablebody, $kolombody++, $data->target_projek);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai_pengajuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Projek.php */
                        /* Location: ./application/modules/C:\xampp\htdocs\CrudRAB_CI\application/modules//controllers/Projek.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-07-30 10:50:19 */
                        /* http://harviacode.com */