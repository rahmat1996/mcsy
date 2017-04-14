<?php

defined('BASEPATH') or exit('No direct script allowed!');

/**
 * Author by Rahmat1996
 */
class Monitoring extends MY_Controller {

    public $data = array(
        'title' => 'Daily Monitoring',
        'main_view' => 'monitoring/monitoring',
    );

    function __construct() {
        parent::__construct();
        $this->load->model('Model_monitoring', 'monitoring');
    }

    public function index() {
        $bulan = date('m');
        $tahun = date('Y');
        if ($this->input->post('ambildata') == 'yes') {
            $this->data['month'] = $this->input->post('month');
            $this->data['year'] = $this->input->post('year');
            $this->data['rowdata'] = $this->monitoring->get_data();
        } else {
            $this->data['month'] = $bulan;
            $this->data['year'] = $tahun;
            $this->data['rowdata'] = $this->monitoring->get_data();
        }
        $this->load->view('template', $this->data);
    }

    public function add() {
        $this->data['title'] = 'Add Monitoring';
        $this->data['main_view'] = 'monitoring/form_monitoring';
        $this->data['data_cctv'] = $this->monitoring->get_cctv();
        $this->data['result'] = '';
        $this->data['edit'] = 0;
        $this->load->view('template', $this->data);
    }

    public function edit($id) {
        $this->data['title'] = 'Edit Monitoring';
        $this->data['main_view'] = 'monitoring/form_monitoring';
        $this->data['data_cctv'] = $this->monitoring->get_cctv();
        $this->data['result'] = $this->monitoring->get_edit($id);
        $this->data['edit'] = 1;
        $this->load->view('template', $this->data);
    }

    public function save() {
        if ($this->input->post('is_edit') == 0) {
            $insert = $this->monitoring->insert_data();
            if ($insert == 1) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> One data have been inserted.
</div>');
                redirect('monitoring');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Fail!</strong> One data have not been inserted.
</div>');
                redirect('monitoring');
            }
        } else {
            $update = $this->monitoring->update_data();
            if ($update == 1) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> One data have been updated.
</div>');
                redirect('monitoring');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Fail!</strong> One data have not been updated.
</div>');
                redirect('monitoring');
            }
        }
    }

    public function delete($id) {
        $delete = $this->monitoring->delete_data($id);
        if ($delete == 1) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> One data have been deleted.
</div>');
            redirect('monitoring');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Fail!</strong> One data have not been deleted.
</div>');
            redirect('monitoring');
        }
    }

    public function export_to_excel() {
        // Abjad Excel (Alternatif!)
        $abjad = array(
            1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J', //10
            11 => 'K', 12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O', 16 => 'P', 17 => 'Q', 18 => 'R', 19 => 'S', 20 => 'T', // 20
            21 => 'U', 22 => 'V', 23 => 'W', 24 => 'X', 25 => 'Y', 26 => 'Z', 27 => 'AA', 28 => 'AB', 29 => 'AC', 30 => 'AD', //30
            31 => 'AE', 32 => 'AF', 33 => 'AG', 34 => 'AH', 35 => 'AI', 36 => 'AJ', 37 => 'AK', 38 => 'AL', 39 => 'AM', 40 => 'AN', 41 => 'AO'
        );

        $this->load->library("PHPExcel");
        $this->load->library("PHPExcel/IOFactory");
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $jumhari = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $gethari = array();
        for ($t = 1; $t <= $jumhari; $t++) {
            $tgl = $year . '-' . $month . '-' . ($t < 10 ? '0' . $t : $t);
            array_push($gethari, $tgl);
        }
        //membuat objek
        $objPHPExcel = new PHPExcel();
        // Deskripsi file
        $objPHPExcel->getProperties()->setCreator('IT Infrastruktur')->setTitle('REPORT CCTV')->setDescription('This is report of cctv on Labtech Penta Ltd');
        //Sheet yang akan diolah
        $objPHPExcel->setActiveSheetIndex();
        $sheet = $objPHPExcel->getActiveSheet();
        //Set Title
        $sheet->setTitle('REPORT ' . $month . '-' . $year);
        $sheet->getDefaultColumnDimension()->setWidth(4);
        // Border
        $objPHPExcel->getDefaultStyle()->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getDefaultStyle()->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getDefaultStyle()->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getDefaultStyle()->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        // End Border
        // Atur width column
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        // End
        // Set Heading data

        $styleHeader = array(
            'font' => array(
                'bold' => true
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            )
        );
        // row 1
        $sheet->mergeCells($abjad[1] . '1:' . $abjad[6 + $jumhari] . '1');
        $sheet->SetCellValue('A1', "DATA REPORT CCTV $month - $year");
        $sheet->getStyle('A1')->applyFromArray($styleHeader);
        // row 2
        $sheet->SetCellValue('A2', 'No');
        $sheet->getStyle('A2')->applyFromArray($styleHeader);
        $sheet->SetCellValue('B2', 'IP Address');
        $sheet->getStyle('B2')->applyFromArray($styleHeader);
        $sheet->SetCellValue('C2', 'Model');
        $sheet->getStyle('C2')->applyFromArray($styleHeader);
        $sheet->SetCellValue('D2', 'Location');
        $sheet->getStyle('D2')->applyFromArray($styleHeader);
        $sheet->SetCellValue('E2', 'Type');
        $sheet->getStyle('E2')->applyFromArray($styleHeader);
        $sheet->SetCellValue('F2', 'Recorder');
        $sheet->getStyle('F2')->applyFromArray($styleHeader);
        for ($i = 1; $i <= $jumhari; $i++) {
            $sheet->SetCellValue($abjad[6 + $i] . '2', $i);
            $sheet->getStyle($abjad[6 + $i] . '2')->applyFromArray($styleHeader);
        }

        // Data CCTV
        $row = 3;
        $col = 0;
        $data = $this->monitoring->get_data();
        foreach ($data as $k => $cctv) {
            $sheet->setCellValueByColumnAndRow($col, $row + $k, $k + 1);
            $sheet->setCellValueByColumnAndRow($col + 1, $row + $k, $cctv->ip);
            $sheet->setCellValueByColumnAndRow($col + 2, $row + $k, $cctv->nm_model);
            $sheet->setCellValueByColumnAndRow($col + 3, $row + $k, $cctv->location);
            $sheet->setCellValueByColumnAndRow($col + 4, $row + $k, $cctv->nm_type);
            $sheet->setCellValueByColumnAndRow($col + 5, $row + $k, $cctv->nm_recorder);
            foreach ($gethari as $i => $hvalue) {
                $ada = false;
                $libur = false;
                $weekday = date('w', strtotime($hvalue));
                foreach ($cctv->monitoring as $y => $mvalue) {
                    if ($mvalue->date_monitoring == $hvalue) {
                        $ada = true;
                        break;
                    }
                }
                foreach ($cctv->holiday as $e => $lvalue) {
                    if ($lvalue->date_holiday == $hvalue) {
                        $libur = true;
                        break;
                    }
                }
                if ($ada) {
                    $sheet->SetCellValue($abjad[7 + $i] . ($row + $k), $mvalue->remark);
                    if ($mvalue->status == 'M') {
                        $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000'); // fill color merah
                        $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getAlignment()->setWrapText(true);
                    } elseif ($mvalue->status == 'K') {
                        $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00'); // fill color kuning
                        $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getAlignment()->setWrapText(true);
                    } else {
                        $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF008000'); // fill color hijau
                        $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getAlignment()->setWrapText(true);
                    }
                } elseif ($libur) {
                    $sheet->SetCellValue($abjad[7 + $i] . ($row + $k), $lvalue->nm_holiday);
                    $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0'); // fill color abu-abu
                    $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getAlignment()->setWrapText(true);
                } elseif ($weekday == 0 or $weekday == 6) {
                    $sheet->SetCellValue($abjad[7 + $i] . ($row + $k), '');
                    $sheet->getStyle($abjad[7 + $i] . ($row + $k))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFC0CB'); // fill color pink
                }
            }
        }

        //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //Header
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        //Nama File
        $nm_file = 'Report CCTV ' . $month . ' - ' . $year . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $nm_file . '"');

        //Download
        $objWriter->save("php://output");
    }

}
