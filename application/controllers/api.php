<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->database();
	}


	public function name_categoria($id){
		$cats = array('perro', 'gato');

		return $cats[$id];
	}


	public function name_tipo($id){
		$tipos = array('bebe', 'adulto');
		return $tipos[$id];
	}



	public function name_estado($id){
		$estados = array('activo', 'inactivo');
		return $estados[$id];
	}


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function mascotas(){

		$res = array();


	$data = $this->db->get('mascotas')->result();
	
	foreach ($data as $item) {
		array_push($res, array('id'=> $item->id,'imagen'=>$item->imagenes ,'nombre'=>$item->nombre, 'estado'=> $this->name_estado($item->estado),'estado_id' => $item->estado,'tipo'=>$this->name_tipo($item->tipo), 'tipo_id' => $item->tipo ,'categoria' => $this->name_categoria($item->categoria), 'categoria_id' => $item->categoria));
	}


	echo json_encode($res);

	}

	public function delete($id){

		$this->db->query("delete from mascotas where id = '".$id."'");
	echo json_encode(array('result'=>'success'));
	

	}

	public function save(){


	$data['nombre'] = $_POST['name'];
	$data['estado'] = $_POST['estado'];
	$data['tipo'] = $_POST['tipo'];
	$data['categoria'] = $_POST['category'];	
	$data['imagenes'] = $_POST['imagen'];	

	if($_POST['id'] == ''){

	$this->db->insert('mascotas', $data);
	}else{

	$this->db->where('id', $_POST['id']);
	$this->db->update('mascotas', $data);

	}

	echo json_encode(array('result'=>'success'));

	}

}

