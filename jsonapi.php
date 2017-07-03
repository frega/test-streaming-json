<?php
$sleep_factor = 1000000;
$how_many_embedded = 5;
$data_size = 4096;

function fakework($n) {
  global $sleep_factor;
  usleep($n  * $sleep_factor);
}

$random_data = bin2hex(openssl_random_pseudo_bytes($data_size));

header('Content-Type: application/json;');
echo '{"data": "'  . $random_data . '",' . "\n";
fakework(3);
flush();
echo '"embedded": [';
flush();
for ($i=1; $i<=$how_many_embedded; $i++) {
  fakework(3);
  $random_data = bin2hex(openssl_random_pseudo_bytes($data_size));
  echo '{"example": "' . $random_data . '"}';
  if ($i<$how_many_embedded) { echo ",\n"; }
  flush();
}
echo "]}";
