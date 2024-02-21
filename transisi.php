<?php
//  1: PHP DASAR

$nilai = "72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86";

$arrayNilai = explode(" ", $nilai);

$arrayNilai = array_map('intval', $arrayNilai);
rsort($arrayNilai);

$rataRata = array_sum($arrayNilai) / count($arrayNilai);
echo "Rata-rata nilai: " . $rataRata . "<br>";

$nilaiTertinggi = array_slice($arrayNilai, 0, 7);
echo "7 Nilai Tertinggi: " . implode(", ", $nilaiTertinggi) . "<br>";

$nilaiTerendah = array_slice($arrayNilai, -7, 7);
echo "7 Nilai Terendah: " . implode(", ", $nilaiTerendah) . "<br>";

// 2. PHP DASAR

function jumlahHurufKecil($string) {
    $jumlahHurufKecil = 0;

    for ($i = 0; $i < strlen($string); $i++) {
        if (ctype_lower($string[$i])) {
            $jumlahHurufKecil++;
        }
    }

    $output = '"' . $string . '" mengandung ' . $jumlahHurufKecil . ' buah huruf kecil.';
    return $output;
}

$inputString = "TranSISI";
$output = jumlahHurufKecil($inputString);
echo $output;


// 3. PHP DASAR

function generateNGrams($text, $n)
{
    $tokens = explode(' ', $text);

    $ngrams = [];
    for ($i = 0; $i < count($tokens) - $n + 1; $i++) {
        $ngram = implode(' ', array_slice($tokens, $i, $n));
        $ngrams[] = $ngram;
    }

    return $ngrams;
}

$string = "Jakarta adalah ibukota negara Republik Indonesia";

$unigrams = generateNGrams($string, 1);
echo "Unigram: " . implode(', ', $unigrams) . "\n";

$bigrams = generateNGrams($string, 2);
echo "Bigram: " . implode(', ', $bigrams) . "\n";

$trigrams = generateNGrams($string, 3);
echo "Trigram: " . implode(', ', $trigrams) . "\n";

// 4. PHP DASAR

function generateTable() {
    $table = '<table border="1">';

    for ($i = 1; $i <= 8; $i++) {
        $table .= '<tr>';

        for ($j = 1; $j <= 8; $j++) {
            $class = isHighlighted($i, $j) ? 'highlight' : '';
            $table .= '<td class="' . $class . '">' . (($i - 1) * 8 + $j) . '</td>';
        }

        $table .= '</tr>';
    }

    $table .= '</table>';

    return $table;
}

function isHighlighted($row, $column) {
    $blackRows = [0, 1, 3, 4, 6, 7];
    $blackColumns = [1, 2, 3, 5, 6, 8];

    return in_array($row, $blackRows) && in_array($column, $blackColumns);
}

echo generateTable();

// 5. PHP DASAR

function encryptString($input)
{
    $output = '';

    for ($i = 0; $i < strlen($input); $i++) {
        $char = $input[$i];

        if ($char >= 'A' && $char <= 'Z') {
            $encryptedChar = chr(((ord($char) - 65 + 1) % 26) + 65);
            $output .= $encryptedChar;
        } elseif ($char >= 'a' && $char <= 'z') {
            $encryptedChar = chr(((ord($char) - 97 + 1) % 26) + 97);
            $output .= $encryptedChar;
        } else {
            $output .= $char;
        }
    }

    return $output;
}

$inputString = "DFHKNQ";
$encryptedString = encryptString($inputString);

echo "Input: $inputString\n";
echo "Encrypted Output: $encryptedString\n";
