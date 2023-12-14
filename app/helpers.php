<?php

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
function due($date){
    $threeDaysAfterNow = $date->addDays(3);

    // Format the date as "Month day, year"
    $formattedDate = df($threeDaysAfterNow);
    return $formattedDate;
}
function app_data($arr){
    $data['bank_account'] = [
        ['bank'=>'BANK BRI','no'=>'469601006057537','detail'=>'a/n I Gede Miarta Yasa'],
        // ['bank'=>'CIMB Niaga','no'=>'706968169000','detail'=>'a/n I Gede Miarta Yasa'],
        ['bank'=>'GOPAY/DANA','no'=>'081529963914','detail'=>'a/n I Gede Miarta Yasa']
    ];
    $data['invoice_note'] = " All payments should be made in rupiah <small>(Rp.)</small>. <br> If payment is not received within 3 days after invoice create, the invoice will be automatically canceled. <br> Please include the invoice number in the reference when making the payment. <br>Themes will be delivered/performed upon receipt of payment. <br>";
    $data['address'] = " Ruko Mulyosari Tengah, Blok 95 J No.5 Jl. Mulyosari tengah, <br> Kalisari, Kec. Mulyorejo Kota Surabaya, Jawa Timur";
    $data['phone'] = "(+62) 815 2996 3914";
    return $data[$arr] ?? 'UNDECLARED';
}