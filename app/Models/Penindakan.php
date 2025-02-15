<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Penindakan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penindakan';
    protected $primaryKey = 'no_sbp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_sbp',
        'tanggal_sbp',
        'tanggal_laporan',
        'lokasi_penindakan',
        'pelaku',
        'uraian_bhp',
        'jumlah',
        'kemasan',
        'perkiraan_nilai_barang',
        'potensi_kurang_bayar',
        'jenis_barang',
        'no_print',
        'tanggal_print',
        'nama_jenis_sarkut',
        'pengemudi',
        'no_polisi',
        'bangunan',
        'nama_pemilik',
        'no_ktp',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'alamat',
        'waktu_awal_penindakan',
        'waktu_akhir_penindakan',
        'jenis_pelanggaran',
        'pasal',
        'petugas_1',
        'petugas_2',
        'ttd_petugas_1',
        'ttd_petugas_2',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_sbp' => 'datetime',
        'tanggal_laporan' => 'datetime',
        'tanggal_print' => 'datetime',
        'tanggal_lahir' => 'datetime',
        'waktu_awal_penindakan' => 'datetime',
        'waktu_akhir_penindakan' => 'datetime',
        'status' => 'string',
        'perkiraan_nilai_barang' => 'decimal:2',
        'potensi_kurang_bayar' => 'decimal:2'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'reference_id', 'no_sbp')->where('module', 'penindakan');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            try {
            Log::info('Mulai proses penghapusan dokumen terkait penindakan', [
                'no_sbp' => $model->no_sbp
            ]);

            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";
            
            $old_no_sbp = $model->no_sbp;
            $model->no_sbp = $old_no_sbp . $suffix;
            $model->save();

            $dokumen = $model->dokumen()->withTrashed()->get();
            foreach ($dokumen as $doc) {
                try {
                $fullPath = storage_path('app/public/' . $doc->file_path);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                    Log::info('File fisik berhasil dihapus', ['path' => $fullPath]);
                }
                
                $doc->forceDelete();
                Log::info('Record dokumen berhasil dihapus', ['id' => $doc->id]);
                } catch (\Exception $e) {
                Log::error('Gagal menghapus dokumen', [
                    'id' => $doc->id,
                    'error' => $e->getMessage()
                ]);
                }
            }

            $storage_path = storage_path('app/public/dokumen/penindakan/' . $old_no_sbp);
            if (is_dir($storage_path)) {
                array_map('unlink', glob("$storage_path/*.*"));
                rmdir($storage_path);
                Log::info('Direktori storage berhasil dihapus', ['path' => $storage_path]);
            }

            } catch (\Exception $e) {
            Log::error('Error saat proses penghapusan dokumen', [
                'no_sbp' => $model->no_sbp,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
            }
        });
    }
}