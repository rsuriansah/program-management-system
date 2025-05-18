<?php

namespace App\Models;

use CodeIgniter\Model;

class PermohonanModel extends Model
{
    protected $table = 'permohonan';
    protected $primaryKey = 'id_permohonan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'nama_program',
        'lokasi_program',
        'penganjur',
        'tarikh_mula',
        'tarikh_tamat',
        'peruntukan',
        'nama_kelab',
        'nama_pemohon',
        'no_matrik',
        'jawatan',
        'fakulti',
        'no_telefon',
        'kertas_kerja',
        'perakuan',
        'id_pemohon',
        'status_id',
        'komen',
        'reviewed_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';

    public function getAllPermohonan()
    {
        return $this->select('permohonan.*, status.name AS status_name')
                    ->join('status', 'permohonan.status_id = status.id', 'left')
                    ->orderBy('permohonan.id_permohonan');
    }

    public function getPermohonanByUserId($id)
    {
        // $sql = "SELECT permohonan.*, status.name AS status_name
        //         FROM permohonan
        //         LEFT JOIN status ON permohonan.status_id = status.id
        //         WHERE permohonan.id_pemohon = ?";
        // return $this->db->query($sql, [$id])->getResultArray();
        return $this->select('permohonan.*, status.name AS status_name')
                    ->join('status', 'permohonan.status_id = status.id', 'left')
                    ->orderBy('permohonan.id_permohonan')
                    ->where('permohonan.id_pemohon', $id);
    }

    public function getPermohonanById($id)
    {
        $sql = "SELECT permohonan.*, status.name AS status_name
                FROM permohonan
                LEFT JOIN status ON permohonan.status_id = status.id
                WHERE permohonan.id_permohonan = ?";
        return $this->db->query($sql, [$id])->getRowArray();
    }

    public function getAllStatus()
    {
        return $this->db->table('status')->orderBy('id', 'ASC')->get()->getResultArray();
    }
    
    public function getStatusId()
    {
        return $this->db->table('status')->select('id')->get()->getRowArray();
    }

    public function addPermohonan($idPermohonan, $Nama_Program, $Lokasi, $Penganjur, $TarikhMula, $TarikhTamat, $Peruntukan, $Nama_Kelab, $Nama_Pemohon, $No_Matrik, $Jawatan, $Fakulti, $No_Telefon, $Kertas_Kerja, $Perakuan, $ID_Pemohon, $Status)
    {
        return $this->save([
            $this->primaryKey  => $idPermohonan,
            'nama_program'     => $Nama_Program,
            'lokasi_program'   => $Lokasi,
            'penganjur'        => $Penganjur,
            'tarikh_mula'      => $TarikhMula,
            'tarikh_tamat'     => $TarikhTamat,
            'peruntukan'       => $Peruntukan,
            'nama_kelab'       => $Nama_Kelab,
            'nama_pemohon'     => $Nama_Pemohon,
            'no_matrik'        => $No_Matrik,
            'jawatan'          => $Jawatan,
            'fakulti'          => $Fakulti,
            'no_telefon'       => $No_Telefon,
            'kertas_kerja'     => $Kertas_Kerja,
            'perakuan'         => $Perakuan,
            'id_pemohon'       => $ID_Pemohon,
            'status_id'        => $Status
        ]);
    }
}