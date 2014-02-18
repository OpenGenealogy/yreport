<?php
// read in index.txt that was created by https://github.com/OpenGenealogy/isoggy
// and match with Y-chromosone data from 23andme
// Copyright 2014 Rob Hoare.  License: MIT.  
// https://github.com/OpenGenealogy/yreport
//
// this is just proof of concept code, I will totally restructure!
// ==================================
$indexfile = file('index.txt'); // read index (make into arg)
$row = 0;
foreach ($indexfile as $index) {
	if ($row > 0) {	
		list($snp,$sc,$alts,$rs,$pos,$mut) = explode('|',$index);
		if (is_numeric($pos)) { //has a position 
			if ($alts) { // alt names
				$snp = $snp.'; '.$alts;
				$snp = str_replace('; ','/',$snp);
			};	
			$m = explode('->',trim($mut));
			$isogg["$pos"]['snp'] = $snp;
			$isogg["$pos"]['sc'] = $sc;
			$isogg["$pos"]['rs'] = $rs;
			$isogg["$pos"]['del'] = $m[0];
			$isogg["$pos"]['ins'] = @$m[1];
		};	
	};
	$row++;
};
//print_r($isogg);
//print count($isogg);
//print "\n\n";


// ok, I've loaded the isogg data.  Now get my y dna:

$row = 0;
if (($handle = fopen("y.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
        if ($data[0][0] != '#') {
			$y[] = $data;
		};	
	};
};
//print_r($y);

// now read through y-dna and lookup in y-tree index file

foreach ($y as $ydata) {
	if ($ydata[1] == 'Y') {
	$pos = $ydata[2];
	$yval = $ydata[3]; 
} else { // another data format, missing the second column
	$pos = $ydata[1];
	$yval = $ydata[2]; 
};	
    $del = @$isogg["$pos"]['del'];	
	$val = @$isogg["$pos"]['ins'];		
	if (@$isogg["$pos"]['sc']) {
			$sc = $isogg["$pos"]['sc'];
			$snp = $isogg["$pos"]['snp'];
	} else {
		$sc = '';
		$snp = '';
	};		
	if ($yval == $val) {
		$true = 'YES';

	} else {
		$true = 'no';
	};	
	$len = 100+strlen($sc);
	$result[] = "$true$sc$pos|".$ydata[0]."\t".$pos."\t"."$yval\t$del->$val\t$true\t".$sc."\t".$snp."\t"."\n";	
	
};
sort($result);
//print_r($result);	
echo "rsid\tposition\tgeno\tmutation\ttrue\thaplogroup\tsnp\n";
foreach ($result as $r) {
	$e = explode('|',$r,2);
	echo $e[1];
};	
