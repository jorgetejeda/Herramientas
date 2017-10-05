<?php 
class Herramientas
{
	# Esta herramienta es solo para ver el uso de la memoria
    # Al momento en que se correo el sistema
    public function usoMemoria()
    {
    	$size = memory_get_usage(true); 
    	$unit = array('b','kb','mb','gb','tb','pb');
    	return @round($size / pow( 1024, ( $i = floor( log( $size, 1024 ) ) ) ), 2) . ' ' . $unit[$i];
    }

	/**
	 *
	 * El tiempo que duraran las Cookies Activas
	 * @param	string 		$tiempo 	El tiempo que duraran las Cookies
	 * @return	void
	 */
    protected function expirationDate($time = "")
    {
    	switch ($time) 
    	{
    		case 'daily':
				$time = ( time() + ( 60 * 60 * 24 ) ); // en un día
    			break;
    		case 'monthly':
				$time = ( time() + ( 60 * 60 * 24 * 30 ) ); // en un mes
    			break;
    		case 'anually':
				$time = ( time() + ( 60 * 60 * 24 * 365 ) ); // en un año
    			break;
    		default:
    			echo "Something goes wrong.";
    			break;
    	}
		return $time;
    }

	/**
	 *
	 * El tiempo que duraran las Cookies Activas
	 * @param	string|mixed[]		$index		Indices y valores que tendran las cookies	
	 * @return	void
	 */
    public function setCookie($index = array())
    {
    	$time = $this->expirationDate('monthly');
    	foreach ($index as $key => $value) 
    		setcookie($key, $value, $time, '/'); 
    }

    public function cleanInput($index = array())
    {
        foreach ($index as $key => $value) 
            $index[$key] = htmlentities($index[$key]);
        return $index;
    }

    //Para cedulas dominicanas
    public function cedula($ced) 
    { 
        $c = str_replace("-","", $ced); 
        $cedula = substr($c,0, strlen($c) - 1); 
        $verify = substr($c,strlen($c) - 1, 1); 
        $sum = 0; 

        if(strlen($ced) < 13) 
            return false; 

        for ($i=0; $i < strlen($cedula); $i++) 
        { 
            $mod = ""; 
            $mod = (($i % 2) == 0) ? 1 : 2;

            $rest = substr($cedula,$i,1) * $mod; 

            if ($rest > 9) 
            { 
                $uno = substr($rest,0,1); 
                $dos = substr($rest,1,1); 
                $rest = $uno + $dos; 
            } 

            $sum += $rest; 
        } 

        $the_number = (10 - ($sum % 10)) % 10; 

        return ($the_number == $verify && substr($cedula,0,3) != "000") ? True : False;
    }

    public function sendMessageJson($bool = false, $message = "", $category = 0, $redirect = "")
    {
        echo (!empty($redirect)) ? json_encode(array("status"=>$bool, "message"=>$message, "url"=> $redirect ,"category"=>$category)) : json_encode(array("status"=>$bool, "message"=>$mensaje, "category"=>$category));
        exit;
    }

}


?>