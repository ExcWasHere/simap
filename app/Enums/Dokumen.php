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
    case LK = "LK";
    case SPTP = "SPTP";
    case SPDP = "SPDP";
    case TAP_SITA = "TAP SITA";
    case P2I = "P2I";
    case KEP_BDN = "KEP-BDN";
    case KEP_BMN = "KEP-BMN";
    case KEP_UR = "KEP-UR";
    case SCTK = "SCTK";

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}