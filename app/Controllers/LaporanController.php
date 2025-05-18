<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermohonanModel;
use App\Models\FakultiModel;
use App\Models\LaporanModel;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanController extends BaseController
{
    protected $helpers = ['form'];
    
    public function __construct()
    {
        $this->permohonanModel = new PermohonanModel();
        $this->fakultiModel = new FakultiModel();
        $this->laporanModel = new LaporanModel();
    }

    public function index()
    {   
        if (auth()->user()->inGroup('superadmin', 'admin')) {
            $permohonan = $this->permohonanModel->getAllPermohonan()->paginate(10, 'permohonan');
            $pager = $this->permohonanModel->pager;
        } else {
            $permohonan = $this->permohonanModel->getPermohonanByUserId(user_id())->paginate(10, 'permohonan');
            $pager = $this->permohonanModel->pager;
        }

        $report = $this->laporanModel->getAllLaporan();

        $data = [
            'pretitle' => 'Laporan',
            'title' => 'Senarai Laporan',
            'ctx' => 'laporan',
            'report' => $report,
            'pager' => $pager,
            'application' => $permohonan,
            'empty' => empty($permohonan)
         ];
   
         return view('laporan/index', $data);
    }

    public function uploadLaporan()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'id_permohonan' => 'required|integer',
            'gambar_program' => 'required',
            'laporan_program' => 'uploaded[laporan_program]|max_size[laporan_program,10240]|mime_in[laporan_program,application/pdf]',
            'laporan_kewangan' => 'uploaded[laporan_kewangan]|max_size[laporan_kewangan,10240]|mime_in[laporan_kewangan,application/pdf]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $id_permohonan = $this->request->getPost('id_permohonan');

        $application = $this->permohonanModel->find($id_permohonan);

        if (!$application) {
            return redirect()->back()->with('error', 'Permohonan tidak wujud.');
        }

        $gambarProgram = $this->request->getPost('gambar_program');
        $laporanProgram = $this->request->getFile('laporan_program');
        $laporanKewangan = $this->request->getFile('laporan_kewangan');

        if ($laporanProgram->isValid() && $laporanKewangan->isValid()) {
            $namaLaporanProgram = 'laporan_program.pdf';
            $laporanProgram->move('uploads/laporan/' . $id_permohonan . '/', $namaLaporanProgram, true);
        
            $namaLaporanKewangan = 'laporan_kewangan.pdf';
            $laporanKewangan->move('uploads/laporan/' . $id_permohonan . '/', $namaLaporanKewangan, true);
        } else {
            $errors = [];
            if (!$laporanProgram->isValid()) {
                $errors[] = $laporanProgram->getErrorString();
            }
            if (!$laporanKewangan->isValid()) {
                $errors[] = $laporanKewangan->getErrorString();
            }
        
            return redirect()->back()->withInput()->with('errors', implode(', ', $errors));
        }        

        $data = [
            'id_permohonan' => $id_permohonan,
            'gambar_program' => $gambarProgram,
            'laporan_program' => $namaLaporanProgram,
            'laporan_kewangan' => $namaLaporanKewangan,
        ];

        $this->laporanModel->save($data);

        return redirect()->back()->with('success', 'Dokumen laporan berjaya dimuat naik.');
    }
}