<?php

namespace App\Models;

use Exception;
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
        // Data SBP (Surat Bukti Penindakan)
        'no_sbp',
        'tanggal_sbp',
        'tanggal_laporan',
        'no_print',
        'tanggal_print',

        // Informasi Barang
        'jenis_barang',
        'uraian_bhp',
        'jumlah',
        'kemasan',
        'perkiraan_nilai_barang',
        'potensi_kurang_bayar',

        // Lokasi dan Waktu Penindakan
        'lokasi_penindakan',
        'waktu_awal_penindakan',
        'waktu_akhir_penindakan',

        // Informasi Sarana Pengangkut
        'nama_jenis_sarkut',
        'pengemudi',
        'no_polisi',
        'bangunan',

        // Data Pelaku
        'pelaku',
        'nama_pemilik',
        'no_ktp',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'alamat',

        // Informasi Pelanggaran
        'jenis_pelanggaran',
        'pasal',

        // Data Petugas
        'petugas_1',
        'petugas_2',

        // Tanda Tangan
        'ttd_pelaku',
        'ttd_petugas_1',
        'ttd_petugas_2',

        // System Fields
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
        static::deleting(fn($model) => self::hapus_dokumen_terkait($model));
    }

    private static function hapus_dokumen_terkait($model)
    {
        try {
            Log::info('Menghapus dokumen terkait penindakan', ['no_sbp' => $model->no_sbp]);
            $model->update(['no_sbp' => $model->no_sbp . "_deleted_" . now()->format('YmdHis') . "_" . str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT)]);
            $model->dokumen()->withTrashed()->each(fn($doc) => self::hapus_berkas_dokumen($doc));
            self::hapus_direktori("dokumen/penindakan/{$model->no_sbp}");
        } catch (Exception $e) {
            Log::error('Error saat menghapus dokumen', ['no_sbp' => $model->no_sbp, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            throw $e;
        }
    }

    private static function hapus_berkas_dokumen($docs)
    {
        try {
            if ($docs->file_path && Storage::disk('public')->exists($docs->file_path)) {
                Storage::disk('public')->delete($docs->file_path);
                Log::info('File berhasil dihapus', ['path' => $docs->file_path]);
            }
            $docs->forceDelete();
            Log::info('Record dokumen berhasil dihapus', ['id' => $docs->id]);
        } catch (Exception $e) {
            Log::error('Gagal menghapus dokumen', [ 'id' => $docs->id, 'error' => $e->getMessage()]);
        }
    }

    private static function hapus_direktori($path)
    {
        if (Storage::disk('public')->exists($path) && empty(Storage::disk('public')->files($path))) {
            Storage::disk('public')->deleteDirectory($path);
            Log::info('Direktori berhasil dihapus', ['path' => $path]);
        }
    }
}