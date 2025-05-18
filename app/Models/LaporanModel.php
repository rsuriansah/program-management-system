<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table            = 'laporan';
    protected $primaryKey       = 'id_laporan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_permohonan', 
        'gambar_program', 
        'laporan_program',
        'laporan_kewangan', 
        'created_at', 
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getLatestLaporan($id_permohonan)
    {
        return $this->where('id_permohonan', $id_permohonan)
                ->orderBy('created_at', 'DESC')
                ->first();
    }

    public function getAllLaporan()
    {
        return $this->select('laporan.*')
        ->join(
            '(SELECT id_permohonan, MAX(created_at) AS latest_created_at 
              FROM laporan 
              GROUP BY id_permohonan) AS latest',
            'laporan.id_permohonan = latest.id_permohonan 
             AND laporan.created_at = latest.latest_created_at',
            'inner'
        )
        ->orderBy('laporan.id_permohonan', 'ASC') // Optional: order by id_permohonan
        ->get()
        ->getResultArray();
    }
}