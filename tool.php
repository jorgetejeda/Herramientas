<?php 
class Tool
{
	# Esta herramienta es solo para ver el uso de la memoria
    # Al momento en que se correo el sistema
    public function memoryUsage()
    {
    	$size = memory_get_usage(true); 
    	$unit = array('b','kb','mb','gb','tb','pb');
    	return @round($size / pow( 1024, ( $i = floor( log( $size, 1024 ) ) ) ), 2) . ' ' . $unit[$i];
    }

    /**
     *
     * El tiempo que duraran las Cookies Activas
     * @param   string|mixed[]      $index      Indices y valores que tendran las cookies   
     * @return  void
     */
    public function setCookie($index = array())
    {
        $time = $this->expirationDate('monthly');
        foreach ($index as $key => $value) 
            setcookie($key, $value, $time, '/'); 
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

    public function sendMessageJson($bool = false, $category = 0, $message = "",  $redirect = "")
    {
        echo (!empty($redirect)) ? json_encode(array("status"=>$bool, "message"=>$message, "url"=> $redirect ,"category"=>$category)) : json_encode(array("status"=>$bool, "message"=>$mensaje, "category"=>$category));
        exit;
    }

    function cedula($ced) 
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

    public function extImages($files){
        // Formatos permitidos
        $mimetypes = array("image/jpeg", "image/JPEG", "image/pjpeg", "image/PJPEG", "image/jpg","image/JPG");
        foreach ($files["file"]["type"] as $key => $value) {
            //Verificamos que las extensiones son las correctas
            if (!in_array($value, $mimetypes))
                $msg[] = "ERROR: La imagen numero.". $key ." no tiene formato adecuado.";
        }
        if (isset($msg))
            return $msg;
        
    }

    public function uploadImages($files,$new_w,$destiny_thumbnail,$destiny){
        
        $i=0;
        foreach ($files["file"]["type"] as $key => $value){
            //echo $value;
        }

        foreach ($files["file"]["tmp_name"] as $k => $tmp_name) {

            switch ($value) {
                case 'image/jpeg':
                $img = imagecreatefromjpeg($tmp_name);
                break;
            case 'image/pjpeg':
                $img = imagecreatefromjpeg($tmp_name);
                break;
            case 'image/jpg':
                $img = imagecreatefromjpeg($tmp_name);
                break;
            }//swictcase


            $size = getimagesize($tmp_name);
            $width = $size[0];
            $height = $size[1];

            if (($new_w <= 0) || ($new_w > $width)) 
                $new_w = $width; 

            $new_h = ($width * ($new_w / $width)); 
            if ($width > $height) { 
                $new_width = $new_w; 
                $new_height = $height * ($new_h / $width); 
            } 

            if ($width < $height) { 
                $new_width = $width * ($new_w / $height); 
                $new_height = $new_h; 
            } 
            if ($width == $height) { 
                $new_width = $new_w; 
                $new_height = $new_h; 
            } 

            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresized($new_image, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            $name = $files['file']['name']; //nombre de la imagen
            $tmp = $files['file']['tmp_name']; // nombre temporal de la imagen
            $num = rand(0,999999);
            $fecha = date("dmY");
            $upfile = $fecha."_".$num."_".$name[$i]; //nuevo nombre de la imagen
            $data[] = $upfile; //Guardamos los nombres para enviarlos
            imagejpeg($new_image, $destiny_thumbnail . $upfile);
            
            move_uploaded_file($tmp[$i], $destiny . $upfile);
            
            $i++;

        }

        return $data;
    }

    public function extFiles($files){
        // Formatos permitidos
        $mimetypes = array("pdf", "PDF","docx","DOCX","doc","DOC","xlsx","XLSX");

        $extFiles = explode(".",$files["file"]["name"]);
        //$extFiles = implode(".", $files["file"]["name"]);
        
        //Verificamos que las extensiones son las correctas
        if (!in_array($extFiles[1], $mimetypes))
            $msg[] = "ERROR: El archivo Tiene una extension no valida '". $extFiles[1]."'";

        if (isset($msg))
            return $msg;
    }

    public function uploadFile($files,$destiny){
        
        $name = $files['file']['name']; //nombre de la imagen
        $name = str_replace(" ", "_", $name);
        $tmp = $files['file']['tmp_name']; // nombre temporal de la imagen
        $num = rand(0,999999);
        $fecha = date("dmY");
        $upfile = $fecha."_".$num."_".$name; //nuevo nombre de la imagen

        move_uploaded_file($tmp, $destiny . $upfile);

        return $upfile;
    }

}


?>