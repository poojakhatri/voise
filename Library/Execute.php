<?php

  include_once LIBRARY_PATH.'Database.php';

  class Execute{

    public function __construct(){
      $urlInput = $this->getURLPath();
      $url = explode('/',$urlInput);
      $apiName = $url[0];


      $params = json_decode(file_get_contents("php://input"));

      $apiPath = API_PATH.DIRECTORY_SEPARATOR.$apiName.'.php';

      if (file_exists($apiPath)) {
        include_once $apiPath;
      } else {
        echo json_encode(['error'=> 'API Not exists']);
        exit;
      }

      $config = $this->getConfig();

      $dbConfig = $config['dbConnection'];

      $lib = [
        'database' => new Database($dbConfig)
      ];

      new $apiName($apiName, $params, $lib);

    }

    private function getConfig(){
      return json_decode(file_get_contents(LIBRARY_PATH.'config.json'),true);
    }

    private function getURLPath(){

		$url = parse_url($_SERVER['REQUEST_URI']);
		$path = isset($url['path']) ? $url['path'] : '';

		// Path Splitting
		if (isset($_SERVER['SCRIPT_NAME'][0])) {
			if (strpos($path, $_SERVER['SCRIPT_NAME']) === 0) {
				$path = (string) substr($path, strlen($_SERVER['SCRIPT_NAME']));
			} else if (strpos($path, dirname($_SERVER['SCRIPT_NAME'])) === 0){
				$path = (string) substr($path, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}
		return substr($path, 1);
	}

  }

?>
