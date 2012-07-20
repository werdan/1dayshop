<?php 
$profiler=Zend_Registry::get('dbProfiler');
echo "<div class=box style=\"font-family: Courier New; font-size: 11px\">";
$time = 0;
foreach ( $profiler as $event ) {
$time += $event -> getElapsedSecs ();
echo "<b><font color=red>".$event ->getName () . "</font></b> [" . sprintf ("%f", $event -> getElapsedSecs ()) . "]<br>\n";
echo $event ->getQuery () . "<br>\n";
$params = $event ->getParams ();
if( ! empty ( $params )) {
    var_dump ( $params );
    echo "<br>";
    }
}
echo "<br><b>Total time : " . $time . "</b><br>\n";
echo "</div>";
?>