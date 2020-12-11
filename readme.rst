Crud en vuejs codeigniter mysql

Instalacion:

1. Edite el archivo /application/config/config.php 

y cambie el valor de la variable url_base

$config['base_url'] = 'http://tu servidor web';


2. importe el archivo sql que se encuentra en la carpeta /sql a su base de datos mysql

3. Edite el archivo /application/config/database.php 

y cambie el usuario , password, y base de datos para conectar la app a su motor mysql


$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost', <--- edite
	'username' => 'root',   <--- edite
	'password' => '',  <--- edite
	'database' => 'mascotas', <--- edite 
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
