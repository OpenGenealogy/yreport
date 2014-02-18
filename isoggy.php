<?php
// read in index.txt (created by isoggy)
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
print count($isogg);
print "\n\n";


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
	$pos = $ydata[2];
	$val = @$isogg["$pos"]['ins'];
	//echo "$ydata[2] $ydata[3] $val\n";
	//print_r(@$isogg["$pos"]);
	if ($ydata[3] == $val) {
		$result[] = $isogg["$pos"]['sc']."\t".$pos."  \t"."$ydata[3]\t".$isogg["$pos"]['snp']."\t"."\n";	
	};
};
sort($result);
//print_r($result);	
foreach ($result as $r) {
	echo $r;
};	
