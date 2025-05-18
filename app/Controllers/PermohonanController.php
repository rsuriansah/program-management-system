<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

use App\Models\PenggunaModel;
use App\Models\PermohonanModel;
use App\Models\FakultiModel;

class PermohonanController extends BaseController
{
    protected $helpers = ['form'];
    protected PermohonanModel $permohonanModel;

    protected $permohonanValidationRules = [
        'nama_program' => [
            'rules' => [
                'required',
                'max_length[255]',
                'min_length[3]',
            ],
            'errors' => [
                'required'    => 'Nama program wajib diisi.',
                'max_length'  => 'Nama program terlalu panjang.',
                'min_length'  => 'Nama program terlalu pendek.',
            ],
        ],
        'lokasi_program' => [
            'rules' => [
                'required',
            ],
            'errors' => [
                'required'    => 'Lokasi program wajib diisi.',
            ],
        ],
        'tarikh_mula' => [
            'rules' => [
                'required',
                'valid_date',
            ],
            'errors' => [
                'required'    => 'Tarikh mula program wajib diisi.',
                'valid_date'  => 'Tarikh mula program tidak sah.',
            ],
        ],
        'tarikh_tamat' => [
            'rules' => [
                'required',
                'valid_date',
            ],
            'errors' => [
                'required'   => 'Tarikh tamat program wajib diisi.',
                'valid_date' => 'Tarikh tamat program tidak sah.',
            ],
        ],
        'peruntukan' => [
            'rules' => [
                'required',
                'integer',
                'greater_than[0]',
            ],
            'errors' => [
                'required'     => 'Jumlah peruntukan wajib diisi.',
                'integer'      => 'Jumlah peruntukan tidak sah.',
                'greater_than' => 'Jumlah peruntukan mestilah melebihi RM0.',
            ],
        ],
        'nama_kelab' => [
            'rules' => [
                'required',
            ],
            'errors' => [
                'required' => 'Nama kelab/pasukan/persatuan wajib diisi.',
            ],
        ],
        'jawatan' => [
            'rules' => [
                'required',
            ],
            'errors' => [
                'required' => 'Jawatan wajib diisi.',
            ],
        ],
        'fakulti' => [
            'rules' => [
                'required',
            ],
            'errors' => [
                'required' => 'Fakulti wajib dipilih.',
            ],
        ],
        'kertas_kerja' => [
            'rules' => [
                'uploaded[kertas_kerja]',
                'mime_in[kertas_kerja,application/pdf]',
                'max_size[kertas_kerja,10240]',
            ],
            'errors' => [
                'uploaded' => 'Kertas kerja wajib dimuat naik.',
                'mime_in'  => 'Fail bukan dalam format PDF.',
                'max_size' => 'Saiz fail terlalu besar.',
            ],
        ],
        'perakuan' => [
            'rules' => [
                'required',
            ],
            'errors' => [
                'required' => 'Perakuan mestilah ditanda.',
            ],
        ],
    ];

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->permohonanModel = new PermohonanModel();
        $this->fakultiModel = new FakultiModel();
    }

    public function saveDraft()
    {
        $session = session();
        $userId = user_id();

        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not authenticated.']);
        }

        if ($this->request->getMethod() === 'POST') {
            // Save form data as tempdata specific to the user with a 2-hour expiration
            $tempdata = $this->request->getPost();
            $key = 'draft_application_' . $userId;
            $session->setTempdata($key, $tempdata, 43200);

        } elseif ($this->request->getMethod() === 'GET') {
            // Retrieve tempdata specific to the user if available
            $key = 'draft_application_' . $userId;
            $draftData = $session->getTempdata($key);

            return $this->response->setJSON(['draft' => $draftData]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Invalid request method.']);
    }
    
    // lihat data permohonan
    public function index()
    {
        $currentPage = $this->request->getVar('page_permohonan') ? $this->request->getVar('page_permohonan') : 1; 
        $status = $this->permohonanModel->getAllStatus();
        
        $perPage = 10;
        
        // Check if the user is admin or superadmin
        if (auth()->user()->inGroup('superadmin', 'admin'))
        {
            // Admin or superadmin: Get all applications
            $result = $this->permohonanModel->getAllPermohonan()->paginate($perPage, 'permohonan');
            $pager = $this->permohonanModel->pager;
        }
        else 
        {
            $result = $this->permohonanModel->getPermohonanByUserId(user_id())->paginate($perPage, 'permohonan');
            $pager = $this->permohonanModel->pager;
        }
        
        $data = [
            'ctx' => 'permohonan',
            'pretitle' => 'Permohonan',
            'title' => 'Senarai Permohonan',
            'status' => $status,
            'application' => $result,
            'pager' => $pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'empty' => empty($result)
        ];
        
        return view('permohonan/data-permohonan', $data);
    }

    // lihat data permohonan
    public function detail($id)
    {
        // ambil data dari table 'status'
        $status = $this->permohonanModel->getAllStatus();

        $result = $this->permohonanModel->getPermohonanById($id);

        if (!$result) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Permohonan tidak wujud.');
        }
        
        if (!auth()->user()->inGroup('superadmin', 'admin') && $result['id_pemohon'] !== (string)user_id()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tiada akses ke halaman ini.');
        }
        
        $data = [
            'ctx' => 'permohonan',
            'pretitle' => 'Permohonan',
            'title' => 'Butiran Permohonan',
            'value' => $result,
            'status_name' => $status,
        ];
        
        return view('permohonan/detail-permohonan', $data);
    }

    // borang permohonan
    public function formAddPermohonan()
    {
        $fakulti = $this->fakultiModel->getAllFakulti();

        $data = [
            'ctx' => 'permohonan',
            'fakulti' => $fakulti,
            'pretitle' => 'Permohonan',
            'title' => 'Permohonan Baru'
        ];

        return view('permohonan/tambah-permohonan', $data);
    }

    // tambah permohonan
    public function addPermohonan()
    {
        if (!$this->validate($this->permohonanValidationRules)) {
            session()->setFlashdata('error_message', 'Sila pastikan semua maklumat diisi sebelum menghantar permohonan.');
            $fakulti = $this->fakultiModel->getAllFakulti();

            $data = [
                'ctx' => 'permohonan',
                'fakulti' => $fakulti,
                'pretitle' => 'Permohonan',
                'title' => 'Permohonan Baru',
                'oldInput' => $this->request->getVar()
            ];
            return view('permohonan/tambah-permohonan', $data);
        }

        $Nama_Program  = $this->request->getVar('nama_program');
        $Lokasi        = $this->request->getVar('lokasi_program');
        $Penganjur     = $this->request->getVar('penganjur');
        $TarikhMula    = $this->request->getVar('tarikh_mula');
        $TarikhTamat   = $this->request->getVar('tarikh_tamat');
        $Peruntukan    = $this->request->getVar('peruntukan');
        $Nama_Kelab    = $this->request->getVar('nama_kelab');
        $Nama_Pemohon  = $this->request->getVar('nama_pemohon');
        $No_Matrik     = $this->request->getVar('no_matrik');
        $Jawatan       = $this->request->getVar('jawatan');
        $Fakulti       = $this->request->getVar('fakulti');
        $No_Telefon    = $this->request->getVar('no_telefon');
        $Kertas_Kerja  = $this->request->getFile('kertas_kerja');
        $Perakuan      = $this->request->getVar('perakuan');
        $ID_Pemohon    = auth()->user()->id;
        $Status        = '1';

        if ($Kertas_Kerja->isValid()) {
            $namaKertasKerja = date('Ymd') . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', $Nama_Program) . '.pdf';
            $Kertas_Kerja->move(WRITEPATH . 'uploads/permohonan', $namaKertasKerja, true);
        } else {
            return redirect()->back()->withInput()->with('errors', $Kertas_Kerja->getErrorString());
        }

        $result = $this->permohonanModel->addPermohonan(
            NULL, $Nama_Program, $Lokasi, $Penganjur, $TarikhMula, $TarikhTamat, $Peruntukan, $Nama_Kelab, $Nama_Pemohon, $No_Matrik, $Jawatan, 
            $Fakulti, $No_Telefon, $namaKertasKerja, $Perakuan, $ID_Pemohon, $Status
        );

        if ($result) {
            session()->setFlashdata([
                'msg' => 'Permohonan berjaya dihantar.',
                'error' => false
            ]);
            return redirect()->to('/application');
        }

        session()->setFlashdata([
            'msg' => 'Permohonan gagal dihantar.',
            'error' => true
        ]);

        return redirect()->to('/application');
    }

    public function updateStatus()
    {
        $status_id = $this->request->getPost('status_id');
        $id_permohonan = $this->request->getPost('id_permohonan');
        $status_id = $this->request->getPost('status_id');
        $komen = $this->request->getPost('komen');
        $reviewedDate = $this->request->getPost('reviewed_at');

        $data = [
            'status_id'   => $status_id,
            'komen'       => $komen,
            'reviewed_at' => $reviewedDate,
        ];

        $updated = $this->permohonanModel->update(['id_permohonan' => $id_permohonan], $data);

        if ($updated) {
            return redirect()->back()->with('success', 'Status permohonan dikemaskini.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengemaskini status permohonan.');
        }
    }

    // edit permohonan
    public function update()
    {
        $ID_Permohonan = $this->request->getPost('id_permohonan');
        $Nama_Program = $this->request->getPost('nama_program');
        $TarikhMula = $this->request->getPost('tarikh_mula');
        $TarikhTamat = $this->request->getPost('tarikh_tamat');
        $Lokasi = $this->request->getPost('lokasi_program');
        $No_Telefon = $this->request->getPost('no_telefon');
        $TarikhKemaskini = $this->request->getPost('updated_at');

        $data = [
            'nama_program'   => $Nama_Program,
            'tarikh_mula'    => $TarikhMula,
            'tarikh_tamat'   => $TarikhTamat,
            'lokasi_program' => $Lokasi,
            'no_telefon'     => $No_Telefon,
            'updated_at'     => $TarikhKemaskini,
        ];

        $updated = $this->permohonanModel->update(['id_permohonan' => $ID_Permohonan], $data);

        if ($updated) {
        } else {
            return redirect()->back()->with('error', 'Gagal mengemaskini permohonan.');
        }
    }

    // batal permohonan
    public function delete($id)
    {
        // cari data permohonan & kertas kerja
        $permohonan = $this->permohonanModel->find($id);
        $kertas_kerja = WRITEPATH . 'uploads/permohonan/' . $permohonan['kertas_kerja'];

        // delete fail kertas kerja
        unlink($kertas_kerja);

        $result = $this->permohonanModel->delete($id);

        if ($result) {
            session()->setFlashdata([
                'msg' => 'Permohonan dibatalkan.',
                'error' => false
            ]);
            return redirect()->to('/application');
        }

        session()->setFlashdata([
            'msg' => 'Gagal membatal permohonan.',
            'error' => true
        ]);
        return redirect()->to('/application');
    }
}