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

  define('URL',"https://$host_string$string_url");

  define('App_name',['Bienes','Nacionales']);
  
  define('DBHOST','pgsql');
  define('HOST',$_SERVER['HTTP_HOST']);
  define('DBNAME', 'BienesNacionales');
  define('CHARSET','utf8mb4');
  define('USER','postgres');
  define('PASS','123456');
