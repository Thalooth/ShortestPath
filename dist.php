
<?php set_time_limit(3600);
  $final=0;
  $names=$_POST['a'];
  foreach($_POST['a']as $val){
    if($val!="")
      $final=$final+1;
  } 
  $graph=array(array(0));
  for($i=0;$i<$final;$i++){
    $d=$_POST["d".$i];
    for($j=0;$j<$final;$j++){
      $graph[$i][$j]=$d[$j];
    }
  }
$path=array(1);
for($i=2;$i<$final;$i++)
  array_push($path,$i);
$minpath=$path;
$count = $final-2;
$total = 1;
for ($x=$final; $x>=1; $x--)
  $total = $total * $x;
$distance=0;
$min=1000000;
$i = $count;
$check=0;
for($m=1;$m<=$total;$m++){
  $flag=true;
  if($graph[0][$path[0]]<=0){
    $flag=false;
  }
  for($k=1;$k<$final-1;$k++){
  if($graph[$path[$k-1]][$path[$k]]<=0)
    $flag=false;
  }
  if($flag==true){
    if($graph[$path[$count]][0]>0){
      $distance=$distance+$graph[0][$path[0]];
      for($j=1;$j<$final-1;$j++){
          $distance=$distance+$graph[$path[$j-1]][$path[$j]];
      }
        $distance=$distance+$graph[$path[$count]][0];
        $check=$check+1;
        if($min>$distance){
          $minpath=$path;
          $min=$distance;
        }
      }
    }
  $i = $count;
  while ($i > 0 and $path[$i - 1] >= $path[$i])
      $i=$i-1;
  $distance=0;
  if ($i <= 0) 
      break;
  $p=$path[$i];
  $j = $count;
  if($min<=$distance){
    if($path[$p]==$v)
      $i=$i-1;
  }
  while ($path[$j] <= $path[$i - 1]) {
    $j=$j-1;
  }
  $temp = $path[$i - 1];
  $path[$i - 1] = $path[$j];
  $path[$j] = $temp;
  $j = $count;
  while ($i < $j) {
    $temp = $path[$i];
    $path[$i] = $path[$j];
    $path[$j] = $temp;
    $i=$i+1;
    $j=$j-1;
  }
}
if($check==0){
	echo "No routes found";
	exit();
}
else{
	echo "Minimum Distance Route:<br> ".$names[0]." - ";
	for($j=0;$j<$final-1;$j++)
    echo $names[$minpath[$j]]." - ";
	echo $names[0]." : Distance = ".$min."<br>";
}
?> 