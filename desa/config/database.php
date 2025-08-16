<?php
// -------------------------------------------------------------------------
//
// Letakkan username, password dan database sebetulnya di file ini.
// File ini JANGAN di-commit ke GIT. TAMBAHKAN di .gitignore
// -------------------------------------------------------------------------

// Data Konfigurasi MySQL yang disesuaikan

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'perwira';
$db['default']['password'] = 'eyJpdiI6IlNQZUpFT1oxQUlidHBlbWdLekh5Qnc9PSIsInZhbHVlIjoiSmE4UUF4bDNsSUhDNjJIMWVpN0s1SWowTlRKVUhYalVDUFVaR2dhMzVWZz0iLCJtYWMiOiJiZmExNmQ5MTYzZjJiYzc0ZWE1NTI0ODIyZDY1YWU0MmY3MzY3NmE3MGY5NDY1YmM3Yjg5OTI1NGQ1MTY4MGYxIiwidGFnIjoiIn0=';
$db['default']['port']     = 3306;
$db['default']['database'] = 'opensid';
//$db['default']['dbcollat'] = 'utf8_general_ci';

/*
| Untuk setting koneksi database 'Strict Mode'
| Sesuaikan dengan ketentuan hosting
*/
$db['default']['stricton'] = true;