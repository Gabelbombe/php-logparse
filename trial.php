<?php
$f = 'input/pipeline.log';
$m = [
  1 => 'Code commit',
  2 => 'Build Package',
  3 => 'Deploy package',
];

$l=[];
$i=1;
$c=0;

foreach (array_filter(explode("\n", file_get_contents($f))) AS $a)
{
  preg_match('/\s([0-9{1,}])\|([0-9]{1})\|([0-9]{1})\|([0-9]{1})/', $a, $o, PREG_OFFSET_CAPTURE);  //array position
  preg_match('/\[(.*)\]/',                                          $a, $d, PREG_OFFSET_CAPTURE);  //time capture
  preg_match('/\]\s(.*)\:/',                                        $a, $v, PREG_OFFSET_CAPTURE);  //verbosity

  $RUN = $o[1][0];
  $TST = $o[2][0];
  $STP = $o[3][0];
  $VAL = $o[4][0];

  if ($RUN != $c)
  {
    $i=($VAL?$i:1); //continue reporting
    $c=$RUN;        //break
  }

  // log everything jic
  $l[$RUN][$TST][$STP] = [
    'STRING'  => $a,
    'STAMP'   => $d[1][0],
    'VERBOSE' => $v[1][0],
    'STATUS'  => ($VAL?'Fail':'Pass'),
  ];

  if ($i) echo "Pipeline run $RUN: {$m[$TST]} - Test $STP: " . ($VAL?'Fail':'Pass') . "\n";
  if ($VAL)
  {
    echo "Pipeline run $RUN: Failed\n"; $i=0;
  }
}

//print_r($l);
