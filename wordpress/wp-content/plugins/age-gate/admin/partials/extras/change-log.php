<?php


$readme = file_get_contents(AGE_GATE_DIR . 'README.txt');


$startsAt = strpos($readme, "== Changelog ==") + strlen("== Changelog ==");
$endsAt = strpos($readme, "== Upgrade Notice ==", $startsAt);
$result = substr($readme, $startsAt, $endsAt - $startsAt);

// headlines
$s = array('===','==','=' );
$r = array('h2' ,'h3','h4');
for ( $x = 0; $x < sizeof($s); $x++ ){
  $result = preg_replace('/(.*?)'.$s[$x].'(?!\")(.*?)'.$s[$x].'(.*?)/', '$1<'.$r[$x].'>$2</'.$r[$x].'>$3', $result);
}


// ul lists 
$s = array('\*','\+','\-');
for ( $x = 0; $x < sizeof($s); $x++ ){
  $result = preg_replace('/^['.$s[$x].'](\s)(.*?)(\n|$)/m', '<li>$2</li>', $result);
}
$result = preg_replace('/\n<li>(.*?)/', '<ul class="ul-disc"><li>$1', $result);
$result = preg_replace('/(<\/li>)(?!<li>)/', '$1</ul>', $result);

echo $result;

