<?php
/**
 * ADMİN PANELİ - ÇIKIŞ
 * Antalya Korsan Taksi
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

session_start();

// Tüm session verilerini temizle
$_SESSION = array();

// Session cookie'sini sil
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Session'ı yok et
session_destroy();

// Login sayfasına yönlendir
header('Location: index.php?logout=success');
exit;
