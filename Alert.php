<?php
class Alert{
    static $errors = array();

    /**
    *
    * Add message to the alert
    *
    * @param array $message  contains the messages for the alert
    * @return boolean
    */
    public static function addMessage($message){
        self::$errors[] = $message;
        return true;
    }

    /**
    *
    * Get messages added to the alert
    *
    * @return array with messages
    */
    public function getMessages(){
        return self::$errors;
    }

	/**
    *
    * Create Alert for client
    *
    * @param string $type  contains the type for the alert
    * @return boolean
    */
    public static function set($type="info", int $time=10000){
        $data="";
        $message = implode("<br />", self::$errors);
        if($type=="info"){
            $data.="  $('.alert-info').show();\n";
            $data.="  $('.alert_text').html('$message');\n";
        }
        if($type=="success"){
            $data.="  $('.alert-success').show();\n";
            $data.="  $('.alert_text').html('$message');\n";
        }
        if($type=="warning"){
            $data.="  $('.alert-warning').show();\n";
            $data.="  $('.alert_text').html('$message');\n";
        }
        if($type=="danger"){
            $data.="  $('.alert-danger').show();\n";
            $data.="  $('.alert_text').html('$message');\n";
        }
        $data.="setTimeout(\"$('.alert').hide();\",{$time});\n";
        $_SESSION['data_alert'] = $data;
        return true;
    }


    /**
    *
    * Print alerts
    *
    * @return html data
    */
    public static function print(){
        $data = "<div class=\"alert alert-info\" role=\"alert\"><span class=\"alert_text\"></span></div>\n";
        $data .= "<div class=\"verticalcenter alert alert-success\" role=\"alert\"><span class=\"alert_text\"></span></div>\n";
        $data .= "<div class=\"alert alert-warning\" role=\"alert\"><span class=\"alert_text\"></span></div>\n";
        $data .= "<div class=\"alert alert-danger\" role=\"alert\"><span class=\"alert_text\"></span></div>\n";
		if (!empty($_SESSION['data_alert'])) {
		    $data .= "<script type=\"text/javascript\">\n";
		    $data .= "  $(document).ready(function() {\n";
		    $data .= $_SESSION['data_alert'];
		    $data .= "  });\n";
		    $data .= "</script>\n";
			unset($_SESSION['data_alert']);
		}
        return $data;
    }

}
