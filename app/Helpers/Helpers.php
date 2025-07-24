<?php

use App\Models\Po;
use Carbon\Carbon;
use App\Models\Lpu;
use App\Models\Fkko;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\SpkUpvc;
use App\Models\Complain;
use App\Models\Prospeks;
use App\Models\SuratTugas;
use App\Models\BeritaAcara;
use App\Models\SpkMaterial;
use App\Models\HistoryUsers;
use App\Models\SpkFiberbeam;
use App\Models\LaporanSurvey;
use App\Models\ReturInternal;
use App\Models\ReturEksternal;
use App\Models\ProjectExternal;
use App\Models\PermintaanSurvey;
use App\Models\PengeluaranBarang;
use App\Models\DaftarPerlengkapan;
use App\Models\TandaTerimaTagihan;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\{GoodReceive, Journal};
use Illuminate\Support\Facades\Storage;
use App\Models\{Edp, EdpPtk, LaporanPerjalanan};
use App\Models\{PenerimaanBarang, SuratJalanRetur, BuktiPengeluaranBank, BuktiMasukBank, Piutang, Penjualan, Karyawan, MemoUmum, PengajuanMcu, LaporanHasilMcu, AccountBank, DaftarAsset};

function spatie_check_has_permission($user_id = 0, $permission = '')
{
    try {
        $user   = User::findOrFail($user_id);
        $result = $user->hasPermissionTo($permission);
        return $result;
    } catch(Exception $e) {
        return false;
    }
}

function spatie_add_role($user_id = 0, $role_id = 0)
{
    try {
        $user   = User::findOrFail($user_id);
        $result = $user->syncRoles($role_id);
        return true;
    } catch(Exception $e) {
        return false;
    }
}

function spatie_give_permissions_to_role($role_id = 0, $perms = [])
{
    try {
        $role_info = Role::findOrFail($role_id);
        $check     = $role_info->syncPermissions($perms);
        return true;
    } catch(Exception $e) {
        return false;
    }
}

function flush_result_message()
{
    \Session::forget('success');
    \Session::forget('danger');
    \Session::forget('info');
    \Session::forget('warning');
}

function beauty_date($date = '')
{
    if($date == '' || $date == '1970-01-01') {
        return '-';
    } else {
        return date("j M Y H:i", strtotime($date));
    }
}

function beauty_datetime($date = '')
{
    return date("j M Y - H:i", strtotime($date));
}

function beauty_time($date = '')
{
    return date("H:i", strtotime($date));
}

function mysql_date($date = '')
{
    return date("Y-m-d", strtotime($date));
}

function mysql_fullDate($date = '')
{
    if($date == '' || $date == null) {
        $new_date = '';
    } else {
        $new_date = date("Y-m-d H:i:s", strtotime($date));
    }
    return $new_date;
}

function formatDate($date = null, $format = 'Y-m-d h:i:s')
{
    if($date) {
        $dateformat = new DateTime($date);
        $newDate    = $dateformat->format($format);
    } else {
        $newDate = null;
    }
    return $newDate;
}

function mysql_time($time = '')
{
    return date("H:i:s", strtotime($time));
}

function indonesia_date($date = '')
{
    return date("d-m-Y", strtotime($date));
}

function english_date($date = '')
{
    return date("Y-m-d", strtotime($date));
}

function thousand_rupiah($input = 0)
{
    $input_float = (float) $input;
    return "Rp " . number_format($input_float, 0, ",", ".");
    //return "Rp " . number_format($input, 0, ",", ".");
}

function thousand_separator($input = 0)
{
    $input = (float) $input;
    return number_format($input, 0, ",", ".");
}

function thousand_separator2($input = 0)
{
    return number_format($input, 4, ",", ".");
}
function thousand_separator_using_comma($input = 0)
{
    $input = (float) $input;
    return number_format($input, 0, ".", ",");
}

function decimal($input = 0)
{
    if(is_numeric($input)) {
        return number_format($input, 2, ",", ".");
    } else {
        return $input;
    }
}
function decimalPr($input = 0)
{
    if(is_numeric($input)) {
        return number_format($input, 3, ",", ".");
    } else {
        return $input;
    }
}
function koma_banyak($input = 0)
{
    if(is_numeric($input)) {
        return number_format($input, 3, ",", ".");
    } else {
        return $input;
    }
}

function floattostr($val)
{
    return str_replace(',', '.', $val);
}

function bcsum(array $numbers): string
{
    $total = "0";
    foreach($numbers as $number) {
        $total = bcadd($total, $number, 2);
    }
    return $total;
}

function terbilang($x = 0)
{
    $x     = abs($x);
    $angka = [
        "",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas",
    ];
    $temp  = "";
    if($x < 12) {
        $temp = " " . $angka[$x];
    } elseif($x < 20) {
        $temp = terbilang($x - 10) . " belas ";
    } elseif($x < 100) {
        $temp = terbilang($x / 10) . " puluh " . terbilang($x % 10);
    } elseif($x < 200) {
        $temp = " seratus " . terbilang($x - 100);
    } elseif($x < 1000) {
        $temp = terbilang($x / 100) . " ratus " . terbilang($x % 100);
    } elseif($x < 2000) {
        $temp = " seribu " . terbilang($x - 1000);
    } elseif($x < 1000000) {
        $temp = terbilang($x / 1000) . " ribu " . terbilang($x % 1000);
    } elseif($x < 1000000000) {
        $temp = terbilang($x / 1000000) . " juta " . terbilang($x % 1000000);
    } elseif($x < 1000000000000) {
        $temp = terbilang($x / 1000000000) . " milyar " . terbilang(fmod($x, 1000000000));
    } elseif($x < 1000000000000000) {
        $temp = terbilang($x / 1000000000000) . " trilyun " . terbilang(fmod($x, 1000000000000));
    }
    return trim($temp) . ' rupiah';
}

function integerToRoman($integer)
{
    // Convert the integer into an integer (just to make sure)
    $integer = intval($integer);
    $result  = '';
    // Create a lookup array that contains all of the Roman numerals.
    $lookup = [
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1,
    ];
    foreach($lookup as $roman => $value) {
        // Determine the number of matches
        $matches = intval($integer / $value);
        // Add the same number of characters to the string
        $result .= str_repeat($roman, $matches);
        // Set the integer to be the remainder of the integer and the value
        $integer = $integer % $value;
    }
    // The Roman numeral should be built, return it
    return $result;
}

function no_penawaran()
{
    $current_year      = date('Y');
    $roman_month       = integerToRoman(date('m'));
    $last_penawaran    = Prospeks::latest('id_prospek')->first();
    $last_penawaran_no = isset($last_penawaran) ? $last_penawaran->id_prospek + 1 : 1;
    $user_id           = Auth::id();
    $user_info         = User::find($user_id);
    $kode_sales        = ($user_info != null ? $user_info->kode_sales : '');
    if(strlen($last_penawaran_no) == 1) {
        $last_penawaran_no = '00' . $last_penawaran_no;
    } else {
        if(strlen($last_penawaran_no) == 2) {
            $last_penawaran_no = '0' . $last_penawaran_no;
        }
    }
    $no_penawaran = $last_penawaran_no . '/IP/' . $kode_sales . '/' . $roman_month . '/' . $current_year;
    return $no_penawaran;
}

function noPenawaran($id)
{
    $current_year = date('Y');
    $current_month = date('m');
    $roman_month = integerToRoman($current_month);
    $client = \App\Models\Client::find($id);
    if ($client) {
        $user_info = User::find($client->id_user);
        $kode_sales = ($user_info != null ? $user_info->kode_sales : '');
        $last_penawaran = Prospeks::orderBy('id_prospek', 'DESC')->first();
        if ($last_penawaran) {
            $last_year = substr($last_penawaran->no_penawaran, -4);
            if ($last_year == $current_year) {
                $last_penawaran_no = intval(substr($last_penawaran->no_penawaran, 0, 4));
                $new_penawaran_no = $last_penawaran_no + 1;
            } else {
                $new_penawaran_no = 1;
            }
        } else {
            $new_penawaran_no = 1;
        }
        $no = str_pad($new_penawaran_no, 4, '0', STR_PAD_LEFT);
        $no_penawaran = $no . '/IP-' . $kode_sales . '/PEN/' . $roman_month . '/' . $current_year;
        return $no_penawaran;
    }
    return "Klien tidak ditemukan.";
}

function noPenawaranIIP($id)
{
    $current_year = date('Y');
    $current_month = date('m');
    $roman_month = integerToRoman($current_month);
    $client = \App\Models\Client::find($id);
    if ($client) {
        $user_info = User::find($client->id_user);
        $kode_sales = ($user_info != null ? $user_info->kode_sales : '');
        $last_penawaran = Prospeks::orderBy('id_prospek', 'DESC')->first();
        if ($last_penawaran) {
            $last_year = substr($last_penawaran->no_penawaran, -4);
            if ($last_year == $current_year) {
                $last_penawaran_no = intval(substr($last_penawaran->no_penawaran, 0, 4));
                $new_penawaran_no = $last_penawaran_no + 1;
            } else {
                $new_penawaran_no = 1;
            }
        } else {
            $new_penawaran_no = 1;
        }
        $no = str_pad($new_penawaran_no, 4, '0', STR_PAD_LEFT);
        $no_penawaran = $no . '/IIP-' . $kode_sales . '/PEN/' . $roman_month . '/' . $current_year;
        return $no_penawaran;
    }
    return "Klien tidak ditemukan.";
}

function noPenawaranECI($id)
{
    $current_year = date('Y');
    $current_month = date('m');
    $roman_month = integerToRoman($current_month);
    $client = \App\Models\Client::find($id);
    if ($client) {
        $user_info = User::find($client->id_user);
        $kode_sales = ($user_info != null ? $user_info->kode_sales : '');
        $last_penawaran = Prospeks::orderBy('id_prospek', 'DESC')->first();
        if ($last_penawaran) {
            $last_year = substr($last_penawaran->no_penawaran, -4);
            if ($last_year == $current_year) {
                $last_penawaran_no = intval(substr($last_penawaran->no_penawaran, 0, 4));
                $new_penawaran_no = $last_penawaran_no + 1;
            } else {
                $new_penawaran_no = 1;
            }
        } else {
            $new_penawaran_no = 1;
        }
        $no = str_pad($new_penawaran_no, 4, '0', STR_PAD_LEFT);
        $no_penawaran = $no . '/ECI-' . $kode_sales . '/PEN/' . $roman_month . '/' . $current_year;
        return $no_penawaran;
    }
    return "Klien tidak ditemukan.";
}


function lastNoPenawaran(){
    $last_penawaran    = Prospeks::orderBy('last_no_penawaran','DESC')->first()->last_no_penawaran;
    $new_penawaran_no = isset($last_penawaran) ? $last_penawaran + 1 : 1;

    return $new_penawaran_no;
}

function nomorPO()
{
    $dataCount = Fkko::all()->count() + 1;
    $no        = str_pad($dataCount, 2, '0', STR_PAD_LEFT);
    $unique    = $no . '/PO-CRB/OMI/' . integerToRoman(date('m')) . '/' . formatDate(now(), 'Y') . '-PJ195C';
    return $unique;
}

function cleanData($a)
{
    if(is_numeric($a)) {
        $a = preg_replace('/[^0-9,]/s', '', $a);
    }
    return $a;
}

function nomorSO()
{
    $dataCount = Fkko::all()->count() + 1;
    $no        = str_pad($dataCount, 2, '0', STR_PAD_LEFT);
    $unique    = $no . '/PO-CRB/OMI/' . integerToRoman(date('m')) . '/' . formatDate(now(), 'Y') . '-PJ195C';
    return $unique;
}

function nomorSuratJalan()
{
    $dataCount = \App\Models\SuratJalan::all()->count() + 1;
    $unique    = formatDate(now(), 'm') . formatDate(now(), 'd') . str_pad($dataCount, 5, '0', STR_PAD_LEFT);
    return $unique;
}

function nomorInvoice()
{
    $dataCount = So::all()->count() + 1;
    $no        = str_pad($dataCount, 2, '0', STR_PAD_LEFT);
    $unique    = $no . '/INVOICE/OMI/' . integerToRoman(date('m')) . '/' . formatDate(now(), 'Y') . '-PJ195C';
    return $unique;
}

// function nomorNew($key)
// {
//     if($key == 'FKKO') {
//         $dataCount = Fkko::all()->count() + 1;
//     } elseif($key == 'PO') {
//         $dataCount = Po::latest()->first();
//         if($dataCount){
//             $number_array=explode('-', $dataCount->nomorPO);
//             $dataCount = (int)$number_array[0] + 1;
//         }
//         else{
//             $dataCount = 1;
//         }
//     } else {
//         $dataCount = Complain::all()->count() + 1;
//     }
//     $no     = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
//     $unique = $no . '-' . $key . '-' . formatDate(now(), 'Y');
//     return $unique;
// }
//NO FKKO,PO,Complain Mengawal Dari 1
//TGR
function nomorNew($key)
{
    if ($key == 'FKKO-IP' || $key == 'FKKO-ECI' || $key == 'FKKO-IIP') {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Fkko::whereYear('created_at', $currentYear)->count() + 1;
        } else {
            $dataCount = Fkko::whereYear('created_at', $currentYear)->count() + 1;
        }
    }
    elseif ($key == 'PO-IP' || $key == 'PO-ECI' || $key == 'PO-IIP') {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Po::whereYear('created_at', $currentYear)->latest()->first();
            if ($dataCount) {
                $number_array = explode('-', $dataCount->nomorPO);
                $dataCount = (int)$number_array[0] + 1;
            } else {
                $dataCount = 1;
            }
        } else {
            $dataCount = Po::latest()->first();
            if ($dataCount) {
                $number_array = explode('-', $dataCount->nomorPO);
                $dataCount = (int)$number_array[0] + 1;
            } else {
                $dataCount = 1;
            }
        }
    } else {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Complain::whereYear('created_at', $currentYear)->count() + 1;
            if ($currentYear > 2025) {
                $dataCount = 1;
            }
        } else {
            $dataCount = Complain::all()->count() + 1;
        }
    }

    $no     = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique = $no . '-' . $key . '-' . formatDate(now(), 'Y');
    return $unique;
}
function nomorNewEci($key)
{
    if ($key == 'FKKO-IP' || $key == 'FKKO-ECI' || $key == 'FKKO-IIP') {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Fkko::whereYear('created_at', $currentYear)->count() + 1;
        } else {
            $dataCount = Fkko::whereYear('created_at', $currentYear)->count() + 1;
        }
    }
    elseif ($key == 'PO-IP' || $key == 'PO-ECI' || $key == 'PO-IIP') {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Po::whereYear('created_at', $currentYear)->latest()->first();
            if ($dataCount) {
                $number_array = explode('-', $dataCount->nomorPO);
                $dataCount = (int)$number_array[0] + 1;
            } else {
                $dataCount = 1;
            }
        } else {
            $dataCount = Po::latest()->first();
            if ($dataCount) {
                $number_array = explode('-', $dataCount->nomorPO);
                $dataCount = (int)$number_array[0] + 1;
            } else {
                $dataCount = 1;
            }
        }
    } else {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Complain::whereYear('created_at', $currentYear)->count() + 1;
            if ($currentYear > 2025) {
                $dataCount = 1;
            }
        } else {
            $dataCount = Complain::all()->count() + 1;
        }
    }

    $no     = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique = $no . '-' . $key . '-' . formatDate(now(), 'Y');
    return $unique;
}
function nomorNewIip($key)
{
    if ($key == 'FKKO-IP' || $key == 'FKKO-ECI' || $key == 'FKKO-IIP') {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Fkko::whereYear('created_at', $currentYear)->count() + 1;
        } else {
            $dataCount = Fkko::whereYear('created_at', $currentYear)->count() + 1;
        }
    }
    elseif ($key == 'PO-IP' || $key == 'PO-ECI' || $key == 'PO-IIP') {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Po::whereYear('created_at', $currentYear)->latest()->first();
            if ($dataCount) {
                $number_array = explode('-', $dataCount->nomorPO);
                $dataCount = (int)$number_array[0] + 1;
            } else {
                $dataCount = 1;
            }
        } else {
            $dataCount = Po::latest()->first();
            if ($dataCount) {
                $number_array = explode('-', $dataCount->nomorPO);
                $dataCount = (int)$number_array[0] + 1;
            } else {
                $dataCount = 1;
            }
        }
    } else {
        $currentYear = date('Y');
        if ($currentYear >= 2025) {
            $dataCount = Complain::whereYear('created_at', $currentYear)->count() + 1;
            if ($currentYear > 2025) {
                $dataCount = 1;
            }
        } else {
            $dataCount = Complain::all()->count() + 1;
        }
    }

    $no     = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique = $no . '-' . $key . '-' . formatDate(now(), 'Y');
    return $unique;
}
//TGR

function nomorDocument($key, $rev = 0)
{
    if($key = 'pelanggan') {
        return 'INTEC-RC-MKT-MKT/01-01';
    } elseif($key = 'followup') {
        return 'INTEC-RC-MKT/MKT/01-02';
    } elseif($key = 'fpp') {
        return 'INTEC-RC-MKT-MKT/02-01';
    } elseif($key = 'penawaranHarga') {
        return 'INTEC-RC-MKT-MKT/02-04';
    } elseif($key = 'fkko') {
        return 'INTEC-RC-MKT-MKT/03-01';
    } elseif($key = 'so') {
        return 'INTEC-RC-MKT-MKT/04-01';
    } elseif($key = 'complain') {
        return 'INTEC-RC-MKT-MKT/06-01';
    } elseif($key = 'kepuasanPelanggan') {
        return 'INTEC-RC-MKT-MKT/05-01';
    } elseif($key = 'schedulePengiriman') {
        return 'INTEC-RC-MKT-EXP/01-01 Rev ' . $rev;
    } elseif($key = 'suratJalan') {
        return 'INTEC-RC-MKT-EXP/01-02';
    } elseif($key = 'p3b') {
        return 'INTEC-RC-MKT-EXP/01-03';
    } elseif($key = 'laporanPerjalanan') {
        return 'INTEC-RC-MKT-EXP/01-05 Rev' . $rev;
    } else {
        return null;
    }
}

/**
 * https://gist.github.com/DrMabuse23/8316782
 **/
function truncate($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true)
{
    if($considerHtml) {
        if(strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
        $totalLength = strlen($ending);
        $openTag     = [];
        $truncate    = '';
        foreach($lines as $lineMatch) {
            if(!empty($lineMatch[1])) {
                if(preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is',
                    $lineMatch[1])) {
                } elseif(preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $lineMatch[1], $tagMatch)) {
                    $pos = array_search($tagMatch[1], $openTag);
                    if($pos !== false) {
                        unset($openTag[$pos]);
                    }
                } elseif(preg_match('/^<\s*([^\s>!]+).*?>$/s', $lineMatch[1], $tagMatch)) {
                    array_unshift($openTag, strtolower($tagMatch[1]));
                }
                $truncate .= $lineMatch[1];
            }
            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ',
                $lineMatch[2]));
            if($totalLength + $content_length > $length) {
                $left            = $length - $totalLength;
                $entities_length = 0;
                if(preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $lineMatch[2], $entities,
                    PREG_OFFSET_CAPTURE)) {
                    foreach($entities[0] as $entity) {
                        if($entity[1] + 1 - $entities_length <= $left) {
                            $left--;
                            $entities_length += strlen($entity[0]);
                        } else {
                            break;
                        }
                    }
                }
                $truncate .= substr($lineMatch[2], 0, $left + $entities_length);
                break;
            } else {
                $truncate    .= $lineMatch[2];
                $totalLength += $content_length;
            }
            if($totalLength >= $length) {
                break;
            }
        }
    } else {
        if(strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = substr($text, 0, $length - strlen($ending));
        }
    }
    if(!$exact) {
        $spacepos = strrpos($truncate, ' ');
        if(isset($spacepos)) {
            $truncate = substr($truncate, 0, $spacepos);
        }
    }
    $truncate .= $ending;
    if($considerHtml) {
        foreach($openTag as $tag) {
            $truncate .= '</' . $tag . '>';
        }
    }
    return $truncate;
}

/**
 * function upload
 **/
function doUpload($key, $path = 'public', $oldFile = null, $multiple = false, $initial = null)
{
    try {
        $file = request()->file($key);
        if($multiple == true) {
            $file = $key;
        }
        $fileType = $file->getClientOriginalExtension();
        $fileName = sprintf('%s%s-%s%s.%s', $initial, auth()->id(), rand(11111, 99999), now()->timestamp, $fileType);
        if($oldFile) {
            removeFile($oldFile, $path);
        }
        $file->storeAs($path, $fileName);
        return $fileName;
    } catch(\Exception $ex) {
        return redirect()->back()->withErrors(['danger' => $ex->getMessage()]);
    }
}

function removeFile($fileName, $storage = 'public')
{
    if(Storage::exists($storage)) {
        Storage::delete(sprintf('%s/%s', $storage, $fileName));
    }
}

function metadataFile($fileName, $type, $storage = 'public')
{
    if(Storage::exists($storage . $fileName)) {
        if($type == 'size') {
            if($fileName) {
                return formatSizeUnit(Storage::$type(sprintf('%s/%s', $storage, $fileName)));
            }
        }
        return Storage::$type(sprintf('%s/%s', $storage, $fileName));
    } else {
        return '';
    }
}

function formatSizeUnit($bytes)
{
    if($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}

/**
 * send Notification
 * $to send to user id only
 * $type
 * $subject as title Notification
 * $body is content Notification
 * $referenceText if usage link or reference can use with full html
 */
function sendNotifications($userId, $type, $subject, $body, $referenceText = null)
{
    return \App\Models\Notification::send($userId, $type, $subject, $body, $referenceText = null);
}

function nextStepFkko($sequence = 0, $status = null)
{
    $result = '';
    if($status == Fkko::STATUS_WAITING) {
        $result = 'FKKO Baru, Manager Marketing';
    } elseif($status == null || $status == Fkko::STATUS_CANCEL) {
        $result = 'Cancel';
    } else {
        if($sequence == 0) {
            $result = '1. FKKO Baru Dibuat';
        } else {
            if($sequence == 1) {
                $result = '1. Approval PPIC';
            } elseif($sequence == 2) {
                $result = '2. Approval Produksi';
            } elseif($sequence == 3) {
                $result = '3. Approval PPIC ke-2';
            } elseif($sequence == 4) {
                $result = '4. Approval Marketing';
            } elseif($sequence == 5) {
                $result = '5. Approval Ekspedisi';
            } elseif($sequence == 6) {
                $result = '6. Approval Marketing ke-2';
            } elseif($sequence == 7) {
                $result = '7. Approval Sales';
            } elseif($sequence == 8) {
                $result = '8. Approval Manager Marketing';;
            }  elseif($sequence == 9) {
                $result = 'Selesai';
            }  else {
                $result = 'Batal';
            }
        }
    }
    return $result;
}

function nextStepFkkoJasa($sequence = 0, $status = null)
{
    $result = '';
    if($status == Fkko::STATUS_WAITING) {
        $result = 'FKKO Jasa Baru, Manager Marketing';
    } elseif($status == null || $status == Fkko::STATUS_CANCEL) {
        $result = 'Cancel';
    } else {
        if($sequence == 0) {
            $result = '1. FKKO Jasa Baru Dibuat';
        } else {
            if($sequence == 1) {
                $result = '1. Approval Proyek';
            } elseif($sequence == 2) {
                $result = '2. Approval Marketing(Dewi)';
            } elseif($sequence == 3) {
                $result = '3. Approval Sales';
            } elseif($sequence == 4) {
                $result = '4. Approval Manager Marketing';
            }  elseif($sequence == 5) {
                $result = 'Selesai';
            }  else {
                $result = 'Batal';
            }
        }
    }
    return $result;
}

// function hp_to_wa($nohp = '')
// {
//     // kadang ada penulisan no hp 0811 239 345
//     $nohp = str_replace(" ", "", $nohp);
//     // kadang ada penulisan no hp (0274) 778787
//     $nohp = str_replace("(", "", $nohp);
//     // kadang ada penulisan no hp (0274) 778787
//     $nohp = str_replace(")", "", $nohp);
//     // kadang ada penulisan no hp 0811.239.345
//     $nohp = str_replace(".", "", $nohp);
//     // cek apakah no hp mengandung karakter + dan 0-9
//     if(!preg_match('/[^+0-9]/', trim($nohp))) {
//         // cek apakah no hp karakter 1-3 adalah +62
//         if(substr(trim($nohp), 0, 3) == '+62') {
//             $hp = trim($nohp);
//         } // cek apakah no hp karakter 1 adalah 0
//         elseif(substr(trim($nohp), 0, 1) == '0') {
//             $hp = '62' . substr(trim($nohp), 1);
//         }
//     }
//     //print $hp;
//     return $hp;
// }
function hp_to_wa($nohp = '')
{
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace(" ", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace("(", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")", "", $nohp);
    // kadang ada penulisan no hp 0811.239.345
    $nohp = str_replace(".", "", $nohp);
    // cek apakah no hp mengandung karakter + dan 0-9
    if(!preg_match('/[^+0-9]/', trim($nohp))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if(substr(trim($nohp), 0, 3) == '+62') {
            $nohp = trim($nohp);
        } // cek apakah no hp karakter 1 adalah 0
        elseif(substr(trim($nohp), 0, 1) == '0') {
            $nohp = '62' . substr(trim($nohp), 1);
        }
    }
    //print $hp;
    return $nohp;
}

// NO Laporan Perjalanan Mengawal Dari 1
function no_laporan_perjalanan()
{
    $current_year = date('Y');
    $current_month = date('m');
    $no_perjalanan = '';
    $last_perjalanan = LaporanPerjalanan::where('no_laporan_perjalanan', 'like', '%' . $current_year . '%')->orderBy('created_at', 'desc')->first();
    if($last_perjalanan){
        $last_number = explode('-', $last_perjalanan->no_laporan_perjalanan)[0];
        $last_year = substr($last_perjalanan->no_laporan_perjalanan, -4);
        if ($last_year == $current_year) {
            $new_number = $last_number + 1;
            $no_perjalanan = str_pad($new_number, 4, '0', STR_PAD_LEFT) . '-' . $current_month . '-' . $current_year;
            $isDuplicate = LaporanPerjalanan::where('no_laporan_perjalanan', $no_perjalanan)->exists();
            if($isDuplicate){
            }
        } elseif ($current_year > $last_year && $current_year >= 2024) {
            $no_perjalanan = '0001-' . $current_month . '-' . $current_year;
        }
    } else {
        $no_perjalanan = '0001-' . $current_month . '-' . $current_year;
    }
    return $no_perjalanan;
}


// function no_surat_jalan_retur()
// {
//     $current_year       = date('Y');
//     $current_month      = date('m');
//     $last_surat_jalan    = SuratJalanRetur::whereMonth('tanggal_surat_jalan', $current_month)->count() + 1;
//     $last_surat_jalan_no = $last_surat_jalan;
//     if(strlen($last_surat_jalan_no) == 1) {
//         $last_surat_jalan_no = '000' . $last_surat_jalan_no;
//     } elseif(strlen($last_surat_jalan_no) == 2) {
//         $last_surat_jalan_no = '00' . $last_surat_jalan_no;
//     } elseif(strlen($last_surat_jalan_no) == 3) {
//         $last_surat_jalan_no = '0' . $last_surat_jalan_no;
//     }
//     $unique    = $last_surat_jalan_no . '/IP-RE/' . $current_month . '/' . $current_year;
//     return $unique;
// }

//Surat Jalan Retur Nomor tambah +1
function no_surat_jalan_retur()
{
    $current_year = date('Y');
    $current_month = date('m');
    $last_surat_jalan = SuratJalanRetur::whereMonth('tanggal_surat_jalan', $current_month)
        ->whereYear('tanggal_surat_jalan', $current_year)
        ->max('no_surat_jalan_retur');
    $last_surat_jalan_no = $last_surat_jalan ? (int)explode('/', $last_surat_jalan)[0] : 0;
    $last_surat_jalan_no++;
    $last_surat_jalan_no_formatted = str_pad($last_surat_jalan_no, 4, '0', STR_PAD_LEFT);
    $unique = $last_surat_jalan_no_formatted . '/IP-RE/' . $current_month . '/' . $current_year;
    return $unique;
}

// function no_edp()
// {
//     $dataCount = Edp::all()->count() + 1;
//     $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
//     $unique    = $no . '/IP/EDP/' . getRomawi(date('m')) . '/' . date('Y');
//     return $unique;
// }
//No EDP Dari 1
function no_edp()
{
    $currentYear = date('Y');
    $previousYear = $currentYear - 1;
    $dataCountPreviousYear = Edp::whereYear('created_at', $previousYear)->count();
    $dataCountCurrentYear = Edp::whereYear('created_at', $currentYear)->count() - 32;
    if (date('m') == 1) {
        $dataCountPreviousYear = 0;
    }
    $dataCount = $dataCountPreviousYear + $dataCountCurrentYear;
    $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
    $unique    = $no . '/IP/EDP/' . getRomawi(date('m')) . '/' . $currentYear;
    return $unique;
}

function nip_karyawan()
{
    $dataCount = Karyawan::all()->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = 'IP' . Carbon::now()->format('y') . date('m') . $no;
    return $unique;
}



function memo_umum($department)
{
    $year = Carbon::now()->format('Y');
    $dataCount = MemoUmum::where('kode_department', $department)
                          ->whereRaw('YEAR(created_at) = ?', [$year])
                          ->count() + 1;
    $no = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique = 'MU.' . $no . '/' . $department . '/' . date('m') . '/' . Carbon::now()->format('y');
    return $unique;
}

function bukti_jurnal($type, $tr_date)
{
    $carbonDate = Carbon::parse($tr_date);
    $current_year = $carbonDate->format('Y');
    $current_month = $carbonDate->format('m');

    $last_journal = Journal::where('type_bukti', $type)
        ->whereYear('tr_date', $current_year)
        ->whereMonth('tr_date', $current_month)
        ->count() + 1;
    $last_journal_no = str_pad($last_journal, 4, '0', STR_PAD_LEFT);
    $unique = $type . '/' .
                $current_month . '/' .
                $current_year . '/' .
                $last_journal_no;
    return $unique;
}

function no_mcu()
{
    $dataCount = PengajuanMcu::count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = 'MCU.' . $no . '/' . date('m') . '/'. Carbon::now()->format('y') ;
    return $unique;
}

function no_hasil_mcu() {
    $dataCount = LaporanHasilMcu::count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = 'HasilMCU.' . $no . '/' . date('m') . '/'. Carbon::now()->format('y') ;
    return $unique;
}

function no_complain()
{
    $current_year     = date('Y');
    $current_month    = date('m');
    $last_complain    = Complain::latest('id_complain')->first();
    $last_complain_no = isset($last_complain) ? $last_complain->id_complain + 1 : 1;
    if(strlen($last_complain_no) == 1) {
        $last_complain_no = '000' . $last_complain_no;
    } elseif(strlen($last_complain_no) == 2) {
        $last_complain_no = '00' . $last_complain_no;
    } elseif(strlen($last_complain_no) == 3) {
        $last_complain_no = '0' . $last_complain_no;
    }
    $no_edp = $last_complain_no . '-' . $current_month . '-' . $current_year;
    return $no_edp;
}

function no_revisi_edp()
{
    $current_year  = date('Y');
    $current_month = date('m');
    $last_edp      = Edp::latest('id_edp')->first();
    $last_edp_no   = isset($last_edp) ? $last_edp->id_edp + 1 : 1;
    if(strlen($last_edp_no) == 1) {
        $last_edp_no = 'Rev-' . $last_edp_no . '000' . $last_edp_no;
    } elseif(strlen($last_edp_no) == 2) {
        $last_edp_no = 'Rev-' . $last_edp_no . '00' . $last_edp_no;
    } elseif(strlen($last_edp_no) == 3) {
        $last_edp_no = 'Rev-' . $last_edp_no . '0' . $last_edp_no;
    }
    $no_edp = $last_edp_no . '-' . $current_month . '-' . $current_year;
    return $no_edp;
}

// function no_urut_edp_ptk()
// {
//     $dataCount = EdpPtk::all()->count() + 1;
//     $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
//     $unique    = $no . '/IP/PTK/' . getRomawi(date('m')) . '/' . date('Y');
//     return $unique;
// }
//No PTK Dari 1
function no_urut_edp_ptk()
{
    $currentYear = date('Y');
    $previousYear = $currentYear - 1;
    $dataCountPreviousYear = EdpPtk::whereYear('created_at', $previousYear)->count();
    $dataCountCurrentYear = EdpPtk::whereYear('created_at', $currentYear)->count() - 35;
    if (date('m') == 1) {
        $dataCountPreviousYear = 0;
    }
    $dataCount = $dataCountPreviousYear + $dataCountCurrentYear;
    $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
    $unique    = $no . '/IP/PTK/' . getRomawi(date('m')) . '/' . $currentYear;
    return $unique;
}

// function no_urut_permintaan_survey()
// {
//     $dataCount = PermintaanSurvey::all()->count() + 1;
//     $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
//     $unique    = $no . '/IP/PTS/' . getRomawi(date('m')) . '/' . date('Y');
//     return $unique;
// }
//No Permintaan Survey Dari 1
function no_urut_permintaan_survey()
{
    $currentYear = date('Y');
    $previousYear = $currentYear - 1;
    $dataCountPreviousYear = PermintaanSurvey::whereYear('created_at', $previousYear)->count();
    $dataCountCurrentYear = PermintaanSurvey::whereYear('created_at', $currentYear)->count() - 106;
    if (date('m') == 1) {
        $dataCountPreviousYear = 0;
    }
    $dataCount = $dataCountPreviousYear + $dataCountCurrentYear;
    $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
    $unique    = $no . '/IP/PTS/' . getRomawi(date('m')) . '/' . $currentYear;
    return $unique;
}

function no_project_external()
{
    $currentYear = date('Y');
    $previousYear = $currentYear - 1;
    $dataCountPreviousYear = ProjectExternal::whereYear('created_at', $previousYear)->where('no_pje', 'NOT LIKE', '%Rev%')->count();
    $dataCountCurrentYear = ProjectExternal::whereYear('created_at', $currentYear)->where('no_pje', 'NOT LIKE', '%Rev%')->count() -84;
    if (date('m') == 1) {
        $dataCountPreviousYear = 0;
    }
    $dataCount = $dataCountPreviousYear + $dataCountCurrentYear;
    $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
    $unique    = $no . '/IP/PJE/' . getRomawi(date('m')) . '/' . $currentYear;
    return $unique;
}

function no_laporan_survey()
{
    $currentYear = date('Y');
    $previousYear = $currentYear - 1;
    $dataCountPreviousYear = LaporanSurvey::whereYear('created_at', $previousYear)->count();
    $dataCountCurrentYear = LaporanSurvey::whereYear('created_at', $currentYear)->count() - 77;
    if (date('m') == 1) {
        $dataCountPreviousYear = 0;
    }
    $dataCount = $dataCountPreviousYear + $dataCountCurrentYear;
    $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
    $unique    = $no . '/IP/LS/' . getRomawi(date('m')) . '/' . $currentYear;
    return $unique;
}


// function no_project_surat_tugas()
// {
//     $dataCount = SuratTugas::all()->count() + 1;
//     $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
//     $unique    = $no . '/IP/STG/' . getRomawi(date('m')) . '/' . date('Y');
//     return $unique;
// }
//No surat Tugas Dari 1
function no_project_surat_tugas()
{
    $currentYear = date('Y');
    $currentMonth = date('m');
    if ($currentYear == $currentYear) {
        $dataCount = SuratTugas::whereYear('created_at', $currentYear)->count() + 1;
    } else {
        $dataCount = SuratTugas::all()->count() + 1;
    }
    $no = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
    $unique = $no . '/IP/STG/' . getRomawi(date('m')) . '/' . $currentYear;
    return $unique;
}

// function no_berita_acara()
// {
//     $dataCount = BeritaAcara::all()->count() + 1;
//     $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
//     $unique    = $no . '/IP/BA/' . getRomawi(date('m')) . '/' . date('Y');
//     return $unique;
// }
//No Berit Acara Dari 1
function no_berita_acara()
{
    $currentYear = date('Y');
    $previousYear = $currentYear - 1;
    $dataCountPreviousYear = BeritaAcara::whereYear('created_at', $previousYear)->count();
    $dataCountCurrentYear = BeritaAcara::whereYear('created_at', $currentYear)->count() - 34;
    if (date('m') == 1) {
        $dataCountPreviousYear = 0;
    }
    $dataCount = $dataCountPreviousYear + $dataCountCurrentYear;
    $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
    $unique    = $no . '/IP/BA/' . getRomawi(date('m')) . '/' . $currentYear;
    return $unique;
}

function no_antrian($data)
{
    $dataCount = Pesanan::where('kategori', $data)->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = $data . '-' . date('Y') . '-' . date('m') . '-' . $no;
    return $unique;
}

// function nomor_tanda_terima_tagihan($jenis_barang, $jenis_invoice, $tanggal_terima)
// {
//     $dataCount = TandaTerimaTagihan::where('jenis_barang', $jenis_barang)->count() + 1;
//     $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
//     $unique    = $jenis_barang . '.' . $no . '/IP/TT/' . $jenis_invoice . '/' . $tanggal_terima . '/'. date('Y');
//     return $unique;
// }
function nomor_tanda_terima_tagihan($jenis_invoice, $tanggal_terima)
{
    $tanggalSekarang = date('Y-m-d');
    $tahunSekarang = date('Y');
    $tanggalReset = '2025-03-10';
    if ($tanggalSekarang < $tanggalReset) {
        $dataCount = 1;
    } else {
        $dataCount = TandaTerimaTagihan::whereDate('created_at', '>=', $tanggalReset)
            ->count() + 1;
    }
    $no = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique = $no . '/IP/TT/' . $jenis_invoice . '/' . $tanggal_terima . '/' . $tahunSekarang;
    return $unique;
}

function nomor_tanda_terima_tagihan_petty_cash($jenis_barang, $jenis_invoice)
{
    $dataCount = TandaTerimaTagihan::where('jenis_barang', $jenis_barang)->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = $jenis_barang . '.' . $no . '/IP/TT/' . $jenis_invoice . '/' . date('m') . '/'. date('Y');
    return $unique;
}

function nomor_tanda_terima_tagihan_memo()
{
    $currentYear = date('Y');
    $currentMonth = date('m');
    $dataCount = TandaTerimaTagihan::where('status', TandaTerimaTagihan::STATUS_MEMO)->whereYear('created_at', $currentYear)->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = $no . '/MR/' . $currentMonth . '/' . $currentYear;
    return $unique;
}

function nomor_lpu($jenis_lpu, $deptCode)
{
    $currentYear = date('Y');
    $currentMonth = date('m');

    if ($jenis_lpu === 'LOS') {
        $dataCount = Lpu::where('department', $deptCode)
            ->where('nomor_lpu', 'LIKE', '%LOS%')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count() + 1;

        $no = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
        $unique = $deptCode . '-LPU-LOS/' . date('m/Y') . '/' . $no;
    } else {
        $dataCount = Lpu::where('department', $deptCode)
            ->whereNot('nomor_lpu', 'LIKE', '%LOS%')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count() + 1;

        $no = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
        $unique = $deptCode . '-LPU/' . date('m/Y') . '/' . $no;
    }

    return $unique;
}

function nomor_retur_eksternal()
{
    $dataCount = ReturEksternal::all()->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = 'RE' . Carbon::now()->format('y') . date('m') . $no;
    return $unique;
}

function nomor_retur_internal()
{
    $dataCount = ReturInternal::all()->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = 'RI' . Carbon::now()->format('y') . date('m') . $no;
    return $unique;
}

function nomorPiutang()
{
    $dataCount = Piutang::all()->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = 'PI' . Carbon::now()->format('y') . date('m') . $no;
    return $unique;
}

function nomorPenjualan()
{
    $dataCount = Penjualan::all()->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = 'PJ' . Carbon::now()->format('y') . date('m') . $no;
    return $unique;
}

function no_good_receipt($data)
{
    // $dataCount = GoodReceive::all()->count() + 1;
    $dataCount = GoodReceive::where('jenisBarang', $data)->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    $unique    = $data . date('Y') . date('m') . $no;
    return $unique;
}

// function no_spk($data)
// {
//     $dataCount = SpkMaterial::count() + 1;
//     $no        = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
//     $unique    = $data . date('y') . date('m') . $no;
//     return $unique;
// }

function no_spk($type_spk, $id_spk)
{
    $currentYearMonth = date('ym');

    if ($type_spk == "ST" || $type_spk == "PT") {
        $lastEntry = SpkFiberbeam::where('type_spk', $type_spk)
            ->where('created_at', 'like', date('Y-m') . '%')
            ->where('id_spk', $id_spk)
            ->orderBy('created_at', 'desc')
            ->first();
        $dataCount = SpkFiberbeam::where('type_spk', $type_spk)
            ->where('created_at', 'like', date('Y-m') . '%')
            ->where('id_spk', $id_spk)
            ->count();
    } else {
        $lastEntry = SpkMaterial::where('type_spk', $type_spk)
            ->where('created_at', 'like', date('Y-m') . '%')
            ->where('id_spk', $id_spk)
            ->orderBy('created_at', 'desc')
            ->first();
        $dataCount = SpkMaterial::where('type_spk', $type_spk)
            ->where('created_at', 'like', date('Y-m') . '%')
            ->where('id_spk', $id_spk)
            ->count();
    }

    if ($lastEntry) {
        preg_match('/(\d{3})(\((\d+)\))?$/', $lastEntry->no_spk, $matches);

        $baseNumber = $matches[1] ?? '001';

        $sequence = $dataCount + 1;

        $suffix = "({$sequence})";
    } else {
        $dataCount = SpkMaterial::where('type_spk', $type_spk)->count() + 1;
        $baseNumber = str_pad($dataCount, 3, '0', STR_PAD_LEFT);
        $suffix = '';
    }

    $unique = "{$type_spk}{$currentYearMonth}{$baseNumber}{$suffix}";
    return $unique;
}


function no_asset($data,$sub=null,$no_head=null)
{
    if ($sub) {
        if ($sub=='Head') {
            $dataCount = DaftarAsset::where('pilihan', 'Head')->count() + 1;
            $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
            $unique    = $data . '-' . $no;
        } else{
            $dataCount = DaftarAsset::where('pilihan', 'Sub')->whereRaw("SUBSTRING_INDEX(no_asset, '-', LENGTH(no_asset) - LENGTH(REPLACE(no_asset, '-', ''))) = ?", [$no_head])->count() + 1;
            $unique    = $no_head . '-' . $dataCount;
        }
    } else{
        $dataCount = DaftarAsset::whereNull('pilihan')->count() + 1;
        $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
        $unique    = $data . '-' . $no;
    }

    return $unique;
}

function no_perlengkapan($data,$sub=null)
{
    if ($sub) {
        if ($sub=='Head') {
            $dataCount = DaftarPerlengkapan::where('pilihan', 'Head')->count() + 1;
            $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
            $unique    = $data . '-' . $no;
        } else{
            $dataCount = DaftarPerlengkapan::where('pilihan', 'Sub')->whereRaw("SUBSTRING_INDEX(no_asset, '-', LENGTH(no_asset) - LENGTH(REPLACE(no_asset, '-', ''))) = ?", [$no_head])->count() + 1;
            $unique    = $no_head . '-' . $dataCount;
        }
    } else{
        $dataCount = DaftarPerlengkapan::whereNull('pilihan')->count() + 1;
        $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
        $unique    = $data . '-' . $no;
    }

    return $unique;
}

function no_bpb($department, $bankIdPengirim, $tgl_pengeluaran_bank)
{
    $carbonDate = Carbon::parse($tgl_pengeluaran_bank);
    $current_year = $carbonDate->format('Y');
    $current_month = $carbonDate->format('m');
    $account_bank = AccountBank::find($bankIdPengirim);

    $last_bpb = BuktiPengeluaranBank::where('nama_bank', $account_bank->id_account_bank)
        ->where('kode_department', $department)
        ->whereYear('tgl_pengeluaran_bank', $current_year)
        ->whereMonth('tgl_pengeluaran_bank', $current_month)
        ->count() + 1;

    $last_bpb_no = str_pad($last_bpb, 4, '0', STR_PAD_LEFT);

    $unique = $account_bank->nama_bank . '/' .
                $account_bank->nama_pemilik . '/' .
                $account_bank->currency . '/' .
                substr($account_bank->nomor_rekening, -4) . '/' .
                $current_month . '/' .
                $current_year . '/' .
                $last_bpb_no;

    return $unique;
}

function no_pembayaran_bpb($department)
{
    $current_year       = date('Y');
    $current_month      = date('m');
    $last_bpb    = BuktiPengeluaranBank::where('kode_department', $department)->whereYear('tgl_pengeluaran_bank', $current_year)->whereMonth('tgl_pengeluaran_bank', $current_month)->count() + 1;
    $last_bpb_no = $last_bpb;
    if(strlen($last_bpb_no) == 1) {
        $last_bpb_no = '000' . $last_bpb_no;
    } elseif(strlen($last_bpb_no) == 2) {
        $last_bpb_no = '00' . $last_bpb_no;
    } elseif(strlen($last_bpb_no) == 3) {
        $last_bpb_no = '0' . $last_bpb_no;
    }
    $unique    = $department . '/BPB/' . $current_month . '/' . $current_year . '/' . $last_bpb_no;
    return $unique;
}

function no_pembayaran_bmb($department)
{
    $current_year       = date('Y');
    $current_month      = date('m');
    $last_bpb    = BuktiMasukBank::where('kode_department', $department)->whereYear('tgl_masuk_bank', $current_year)->whereMonth('tgl_masuk_bank', $current_month)->count() + 1;
    $last_bpb_no = $last_bpb;
    if(strlen($last_bpb_no) == 1) {
        $last_bpb_no = '000' . $last_bpb_no;
    } else{
        $last_bpb_no = str_pad($last_bpb_no, 4, '0', STR_PAD_LEFT);
    }
    $unique    = $department . '/BMB/' . $current_month . '/' . $current_year . '/' . $last_bpb_no;
    return $unique;
}

function no_bmb($department, $bankIdPenerima, $tgl_masuk_bank)
{
    $carbonDate = Carbon::parse($tgl_masuk_bank);
    $current_year = $carbonDate->format('Y');
    $current_month = $carbonDate->format('m');
    $account_bank = AccountBank::find($bankIdPenerima);
    $additional_count = 1;
    if (strtoupper($account_bank->nama_pemilik) === 'PT INTEC PERSADA') {
        $additional_count = 1;
    }
    $last_bpb = BuktiMasukBank::where('nama_bank', $account_bank->id_account_bank)
        ->where('kode_department', $department)
        ->whereYear('tgl_masuk_bank', $current_year)
        ->whereMonth('tgl_masuk_bank', $current_month)
        ->count() + $additional_count;
    $last_bpb_no = str_pad($last_bpb, 4, '0', STR_PAD_LEFT);
    $unique = $account_bank->nama_bank . '/' .
                $account_bank->nama_pemilik . '/' .
                $account_bank->currency . '/' .
                substr($account_bank->nomor_rekening, -4) . '/' .
                $current_month . '/' .
                $current_year . '/' .
                $last_bpb_no;
    return $unique;
}

// function no_bmb($bank)
// {
//     $current_year       = date('Y');
//     $current_month      = date('m');
//     $last_bpb    = BuktiMasukBank::where('nama_bank', $bank)->whereMonth('tgl_masuk_bank', $current_month)->count() + 1;
//     $last_bpb_no = $last_bpb;
//     if(strlen($last_bpb_no) == 1) {
//         $last_bpb_no = '000' . $last_bpb_no;
//     } elseif(strlen($last_bpb_no) == 2) {
//         $last_bpb_no = '00' . $last_bpb_no;
//     } elseif(strlen($last_bpb_no) == 3) {
//         $last_bpb_no = '0' . $last_bpb_no;
//     }
//     $unique    = $bank . '/BMB/' . $current_month . '/' . $current_year . '/' . $last_bpb_no;
//     return $unique;
// }

function getRomawi($bln)
{
    switch($bln) {
        case 1:
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
    }
}

function getCharNumber($number){
    if($number<=9){
        return '000'.$number;
    } else if($number>=10 && $number <= 99){
        return '00'.$number;
    } else if($number>=100 && $number <= 999){
        return '0'.$number;
    } else {
        return $number;
    }
}

function resetNumberFormat($number){
    $data=str_replace('.','',$number);
    return str_replace(',','.',$data);
}
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }
    return $temp;
}

function terbilang2($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}


function no_urut_penerimaan_barang()
{
    $dataCount = PenerimaanBarang::whereMonth('created_at', date('m'))->count() + 1;
    $no        = str_pad($dataCount, 4, '0', STR_PAD_LEFT);
    return $no;
}
function decode_data($data){
    $decode='';
    if (isset($data)){
        $surveyor = explode(",",$data);
        $index = 1;
        foreach ($surveyor as $value){
            $decode.="$index . $value<br>";
            $index++;
        }
    }
    return $decode;
}
function addSpaceBeforeCapital($string) {
    return preg_replace('/([a-z])([A-Z])/', '$1 $2', $string);
}

function br2nl($string) {
    return preg_replace('/<br\\s*?\/??>/i', '', $string);
}

function compressImage($source, $destination, $quality) {
    // Get image info
    $imgInfo = getimagesize($source);
    $mime = $imgInfo['mime'];

    // Create a new image from file
    switch($mime){
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;
        default:
            $image = imagecreatefromjpeg($source);
    }

    // Save image
    imagejpeg($image, $destination, $quality);

    // Return compressed image
    return $destination;
}

function hitung_hari($date1, $date2) {
    $dt1 = date_create($date1);
    $dt2 = date_create($date2);

    $selisih  = date_diff( $dt1, $dt2 );

    return $selisih->days;
}

function convertHoursToDays($hours) {
    $days = floor($hours / 24);
    $remainingHours = $hours % 24;
    // dd($remainingHours);
    return "$days Hari $remainingHours Jam";
}

// function convertHoursToDaysInIzin($hours)
// {
//     if ($hours < 8) {
//         return number_format($hours, 1) . " Jam";
//     }
//     $days = floor($hours / 8);
//     $remainingHours = fmod($hours, 8);

//     return "$days Hari " . number_format($remainingHours, 1) . " Jam";
// }

// function convertHoursToDaysInIzin($tgl_mulai, $tgl_selesai)
// {
//     $start_date = new DateTime($tgl_mulai);
//     $end_date = new DateTime($tgl_selesai);

//     $interval = $start_date->diff($end_date);
//     $hours = ($interval->days * 24) + $interval->h + ($interval->i / 60);

//     if ($start_date->format('Y-m-d') == $end_date->format('Y-m-d')) {
//         if ($hours == 8 || $hours == 9) {
//             return "1 Hari";
//         } elseif ($hours < 1) {
//             $minutes = $hours * 60;
//             return number_format($minutes, 0) . " Menit";
//         } else {
//             return number_format($hours, 1) . " Jam";
//         }
//     } else {
//         $days = $interval->days;

//         if ($start_date->format('H:i') != '00:00' && $end_date->format('H:i') != '00:00') {
//             $days += 1;
//         }

//         return "$days Hari";
//     }
// }
function convertHoursToDaysInIzin($tgl_mulai, $tgl_selesai)
{
    $start_date = new DateTime($tgl_mulai);
    $end_date = new DateTime($tgl_selesai);

    $interval = $start_date->diff($end_date);
    $totalHours = ($interval->days * 24) + $interval->h + ($interval->i / 60);

    $excluded_hours = [12];
    $excluded_hours_count = 0;

    $current_date = clone $start_date;

    while ($current_date < $end_date) {
        if (in_array($current_date->format('H'), $excluded_hours)) {
            $excluded_hours_count += 1;
        }
        $current_date->add(new DateInterval('PT1H'));
    }

    $totalHours -= $excluded_hours_count;

    if ($start_date->format('Y-m-d') == $end_date->format('Y-m-d')) {
        if ($totalHours == 8 || $totalHours == 9) {
            return "1 Hari";
        } elseif ($totalHours < 1) {
            $minutes = $totalHours * 60;
            return number_format($minutes, 0) . " Menit";
        } else {
            return number_format($totalHours, 1) . " Jam";
        }
    } else {
        $days = $interval->days;

        if ($start_date->format('H:i') != '00:00' && $end_date->format('H:i') != '00:00') {
            $days += 1;
        }

        return "$days Hari";
    }
}

function tanggalMerah($value) {
    date_default_timezone_set("Asia/Jakarta");
    $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json"), true);

    if (isset($array[$value]) && $array[$value]["holiday"]) {
        if (isset($array[$value]["summary"]) && is_array($array[$value]["summary"])) {
            foreach ($array[$value]["summary"] as $summary) {
                if (strpos(strtolower($summary), "cuti bersama") !== false) {
                    return false;
                }
            }
        }
        return true;
    } elseif (date("D", strtotime($value)) === "Sun" || date("D", strtotime($value)) === "Sat") {
        return true;
    } else {
        return false;
    }
}

function parseBiayaEkspedisi($biaya)
{
    $biaya = str_replace(['Rp ', '.'], '', $biaya);
    return (int)$biaya;
}
