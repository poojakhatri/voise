<?php
  define('API_PATH',_definingFolder('API'));
  define('LIBRARY_PATH',_definingFolder('Library'));

  function _definingFolder($folderName){
  	return (($_temp = realpath($folderName)) !== FALSE)
  		? $_temp.DIRECTORY_SEPARATOR
  		: strtr(rtrim($folderName, '/\\'),'/\\',DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
  }

  include_once LIBRARY_PATH.'Execute.php';
  new Execute();

?>
