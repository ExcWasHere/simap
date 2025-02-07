<?php

namespace App\Enums;

enum Dokumen: string
{
    /**
     * Intelijen
     */
    case ST_I = "ST-I";
    case LPTI = "LPTI";
    case LPPI = "LPPI";
    case LKAI = "LKAI";
    case NHI = "NHI";
    case NI = "NI";

    /**
     * Monitoring
     */
    case KEP_BDN = "KEP-BDN";
    case KEP_BMN = "KEP-BMN";
    case KEP_UR = "KEP-UR";
    case SCTK = "SCTK";

    /**
     * Penindakan
     */
    case PRIN = "PRIN";
    case ST = "ST";
    case BA_PEMERIKSAAN = "BA-Pemeriksaan";
    case BA_PENEGAHAN = "BA-Penegahan";
    case BAST = "BAST";
    case BA_DOKUMENTASI = "BA-Dokumentasi";
    case BA_PENCACAHAN = "BA-Pencacahan";
    case BA_PENYEGELAN = "BA-Penyegelan";
    case SBP = "SBP";
    case LPHP = "LPHP";
    case LP = "LP/LP1";
    case LPP = "LPP";
    case LPF = "LPF";
    case SPLIT = "SPLIT";
    case LHP = "LHP";
    case LRP = "LRP";

    /**
     * Penyidikan
     */
    case LK = "LK";
    case SPTP = "SPTP";
    case SPDP = "SPDP";
    case TAP_SITA = "TAP SITA";
    case P2I = "P2I";

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}