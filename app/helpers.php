<?php

use App\Models\Settings;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

function nb($num){
  return  'Rp '.number_format($num,0,'.',',');
}
function calculatePages($currentPage, $totalPages, $pagesToShow = 10){
    $startPage = max(1, floor(($currentPage - 1) / $pagesToShow) * $pagesToShow + 1);
    $lastPage = min($startPage + $pagesToShow - 1, $totalPages);

    // Menyesuaikan lastPage jika currentPage berada di awal atau akhir blok
    if ($currentPage % $pagesToShow == 0 && $lastPage < $totalPages) {
        $lastPage++;
    }

    return [
        'startPage' => $startPage,
        'lastPage' => $lastPage,
    ];
}
function toCamelCase($str) {
    $str = ucwords(str_replace(['_', ' '], ' ', $str));
    $str = lcfirst(str_replace(' ', '', $str));
    return $str;
}
function Inv()
{
    // Get the current year, month, and day
    $year = date('Y');
    $month = date('m');
    $day = date('d');

    // Get the total number of invoices for the current year (you may replace this logic with your own)
    $currentYear = Carbon::now()->year;

    // Retrieve invoices for the current year using whereYear
    $totalInvoices = Transaction::whereYear('created_at', $currentYear)->count();

    // Increment the total number of invoices by 1 and format it with leading zeros
    $formattedTotal = str_pad($totalInvoices + 1, 4, '0', STR_PAD_LEFT);

    // Create the invoice number
    $invoiceNumber = 'TRX' . $year . $month . $day . $formattedTotal;

    return $invoiceNumber;
}
function df($date)
{
   return date(' D, d M Y',strtotime($date));
}
function dt($date)
{
   return date('d M Y H:i:s',strtotime($date));
}
function dates($date)
{
   return date('d M Y',strtotime($date));
}
function status($id){
    if($id){
        return "<span style='color:#2D9596'>ACTIVE</span>";
    }else{
        return "<span style='color:#FF8F8F'>NONACTIVE</span>";
    }
}
function due($date){
    $threeDaysAfterNow = $date->addDays(3);

    // Format the date as "Month day, year"
    $formattedDate = df($threeDaysAfterNow);
    return $formattedDate;
}
function app_data($arr){
    $settings = Settings::where('group','BANK')->get();
    $app = [];
    foreach ($settings as $val) {
        $app[$val->key] = $val->value;
    }
    $apps = Settings::where('group','APP')->get();
    foreach ($apps as $ap) {
        $app[$ap->key] = $ap->value;
    }
    $data['app'] = Settings::find('APP_NAME')->first()->value;
    $data['bank_account'] = [
        ['bank'=>$app['BANK_NAME'],'no'=>$app['BANK_NUM'],'detail'=>$app['BANK_ACC']],
    ];
    $data['invoice_note'] = " All payments should be made in rupiah <small>(Rp.)</small>. <br> If payment is not received within 3 days after invoice create, the invoice will be automatically canceled. <br> Please include the invoice number in the reference when making the payment. <br>Themes will be delivered/performed upon receipt of payment. <br>";
    $data['address'] = $app['APP_ADDRESS'];
    $data['phone'] = $app['APP_MOBILE'];
    $data['email'] = $app['APP_MAIL'];
    return $data[$arr] ?? 'UNDECLARED';
}
function userIMG($user_id,$clasName=''){
    $idStr = (string) $user_id;

    // Get the length of the ID
    $length = strlen($idStr);

    // If the ID is not empty, return the last digit
    if ($length > 0) {
        $no =  (int) substr($idStr, -1);
    } else {
        // If the ID is empty, return 0
        $no = 0;
    }
    $imagePath = asset('ava/'.$no.'.jpg');
    return "<img src='$imagePath' alt='userImage' class='$clasName'>";
}