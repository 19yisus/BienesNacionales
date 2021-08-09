<?php
  $url = explode('/', $_SERVER['SCRIPT_NAME']);
  $string_url = "";
  $host_string = $_SERVER['HTTP_HOST'];
  $port_string = $_SERVER['SERVER_PORT'];

  foreach($url as $item){
    if($item != "index.php"){
      $string_url .= $item."/";
    }else{
      break;
    }
  }

  define('URL',"http://$host_string:$port_string$string_url");
echo constant('URL');

  define('App_name',['Bienes','Nacionales']);
  
  define('DBHOST','pgsql');
  define('HOST','localhost');
  define('DBNAME', 'BienesNacionales');
  define('CHARSET','utf8mb4');
  define('USER','postgres');
  define('PASS','123456');
