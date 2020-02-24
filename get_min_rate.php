<?php
header('Content-Type: application/json');

class Result {
	public $minval;
}

$rate_type = $_GET['rate_type'] ;


if (!empty($rate_type) AND ($rate_type=='eur' OR $rate_type=='usd' OR $rate_type == 'gbp')) {

  
  $url_array = array( 'http://www.mocky.io/xv2/5d19ec692f00002c00fd7324' ,  'http://www.mocky.io/v2/5d19ec932f00004e00fd7326' ) ;

    $length = count($url_array) ;
    for( $i = 0; $i < $length ; ++$i ) {

	$url  = $url_array[$i] ;
	$json  = file_get_contents($url);
    $array = json_decode($json, true);
    $rate_array = array();
           
     if (!empty($array)) {
          foreach ($array as $item) {
              if ( $item['code'] == $rate_type ) {
                  array_push($rate_array, $item["rate"]);
              }
          }
      }
    
    }

	$result = new Result();
	if (!empty($rate_array))
		$result->minval = min($rate_array);


	echo json_encode($result);
}
else {
	echo "Please enter an acceptable rate type !";
}

?>

