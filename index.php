<?php

$data = <<<'EOD'
X, -9\\\10\100\-5\\\0\\\\, A
Y, \\13\\1\, B
Z, \\\5\\\-3\\2\\\800, C
EOD;

$baris = explode("\n", $data); 

$output = array();

foreach ($baris as $line) {
    $trim = array_map('trim', explode(',', $line)); 

    $pertama = $trim[0];
    $kedua = preg_replace('/\\\\+/', ',', $trim[1]);
    $ketiga = $trim[2];

    $values = explode(',', $kedua); 
    sort($values, 1); 

    $counter = 1;
    foreach ($values as $value) {
        if(is_numeric($value)){
          $output[] = $pertama . ', ' . $value . ', ' . $ketiga . ', ' . $counter;
          $counter++;
        }
    }
}

usort($output, function ($x, $y) {
    $xValue = intval(explode(',', $x)[1]);
    $yValue = intval(explode(',', $y)[1]);

    if ($xValue == $yValue) {
        return 0;
    }

    return ($xValue < $yValue) ? -1 : 1;
});

foreach ($output as $line) {
    echo $line . PHP_EOL;
}
?>