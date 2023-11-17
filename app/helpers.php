<?php
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