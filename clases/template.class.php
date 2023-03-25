<?php
/**
 * @package inventariocorporativo
 */

class gb_template {


  var $template = array();
  var $root_dir;
  var $mensaje;

  function __construct($path) {
    $this->root_dir = $path;
  }
  
  function gb_templates($path='') {
    $this->root_dir = $path;
  }
  
  function errores($error) {
    global $url;
    eval("\$error_html = \"" . $this->get_template('errores.php') . "\";");
    return $error_html;
  }
  
  function mensajes($mensaje) {
    global $url;
    eval("\$error_html = \"" . $this->get_template('mensajes.php') . "\";");
    return $error_html;
  }
  
  function set_rootdir($tpl_dir) {
    if (!is_dir($tpl_dir)) {
      echo "Directorio incorrecto: $tpl_dir<br>";
      return false;
    }
    $this->root_dir = $tpl_dir;
    return true;
  }
  
  function get_content() {
    if (!isset($this->error)) {
      include "$this->root_dir/config.inc.php";
      $this->error =& $error;
    }
    return $this->error;
  }
  
  function get_content2() {
    if (!isset($this->mensaje)) {
      include "$this->root_dir/config.inc.php";
      $this->mensaje =& $mensaje;      
    }
    return $this->mensaje;
  }

  function get_template($tpl) {
//    echo "$tpl<br>";
    if(!isset($this->template["$this->root_dir/$tpl"])) {
      $filename = "$this->root_dir/$tpl";

      if (file_exists("$filename")) {
        $fd = fopen ($filename, "r");
        $this->template["$this->root_dir/$tpl"] = fread ($fd, filesize ($filename));
        fclose ($fd);
        $this->template["$this->root_dir/$tpl"] = str_replace("\"", "\\\"", $this->template["$this->root_dir/$tpl"]);
      } 
      else {
        echo "No se encontr&oacute; $filename";
      }
    }
    return $this->template["$this->root_dir/$tpl"];
  }

   function get_templateModulo($tpl) {
    // "$tpl<br>";
    if(!isset($this->template["$this->root_dir/$tpl"])) {
      $filename = "$this->root_dir/$tpl";
     $filename="../../".$filename;
      if (file_exists("$filename")) {
        $fd = fopen ($filename, "r");
        $this->template["$this->root_dir/$tpl"] = fread ($fd, filesize ($filename));
        fclose ($fd);
        $this->template["$this->root_dir/$tpl"] = str_replace("\"", "\\\"", $this->template["$this->root_dir/$tpl"]);
      } else {
        echo "No se encontr&oacute; $filename";
      }
    }
    return $this->template["$this->root_dir/$tpl"];
  }

  function get_template_objeto($oObjeto, $strTemplate, $arrExtraInfo = "") {
    $arrMapping = $oObjeto->__MappingThis();
    foreach($arrMapping as $k => $v) {
      eval("\$$k = \$oObjeto->$v;");
    }
    
    if(is_array($arrExtraInfo)) {
      foreach($arrExtraInfo as $k => $v) {
        $$k = $v;
      }
    }
    eval("\$strRes = \"" . $this->get_template($strTemplate) . "\";");
    return $strRes;
  }
}

?>