<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Panel mascotas</title>

<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


<script src="https://cdn.jsdelivr.net/npm/vue"></script>

</head>
<body>
<h1>Gestion mascota</h1>



<div id="app" class="container">
<div class="row">
	<div class="col-md-6">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mascotaModal">
Agregar mascota</button></div>
	<div class="col-md-6"><select id="sfilter" class="form-control">
<option value="">Filtrar Todas</option>
<option value="1">Activas</option>
<option value="0">Inactivas</option>
</select>
</div>
</div>
<br>


<br>
<table class="table">
	<thead>
	<th>#</th>
	<th>Foto</th>
	<th>Nombre</th>
	<th>Tipo</th>
	<th>Estado</th>
	<th>Categoria</th>
	<th>Opciones</th>
	</thead>
	<tbody>
		<tr v-for="mascota in mascotas">
			<td>{{mascota.id}}</td>
			<td><img :src="mascota.imagen" style="width: 40px; height: 40px"></td>
			<td>{{mascota.nombre}}</td>
			<td>{{mascota.tipo}}</td>
			<td>{{mascota.estado}}</td>
			<td>{{mascota.categoria}}</td>
			<td><button class="btn btn-success" @click="editMascota(mascota)">Editar</button><button class="btn btn-danger" @click="borrarMascota(mascota)">Eliminar</button></td>
		</tr>
	</tbody>
</table>


</div>

<div id="frm">
<form-mascota></form-mascota>
</div>
</body>

</html>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>

<script type="text/javascript">
	
				function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imagen_m').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }


	$(document).ready(function($){
	

$('#sfilter').change(function(){

app.get_mascotas($(this).val())

})


	//formulario

	Vue.component('form-mascota',{
		data:{
			name:'',
			tipo:'',
			categoria:'',
			estado:'1',
			imagenes:''
		},
		template:'<!-- Modal --><div class="modal fade" id="mascotaModal" tabindex="-1" aria-labelledby="mascotaLabel" aria-hidden="true"> <div class="modal-dialog">    <div class="modal-content"> <div class="modal-header"><h5 class="modal-title" id="mascotaLabel">Formulario Mascota</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div> <form id="fmas"><div class="modal-body"><div class="form-group"><label>Nombre</label><input v-model="name" type="text" name="name" class="form-control" minlength="3" required></div><div class="form-group"><label>Tipo</label><select class="form-control" id="tipo_m" name="tipo"><option value="">Seleccione...</option>	<option value="0">Bebe</option><option value="1">Adulto</option></select></div><div class="form-group"><label>Estado</label>	<select class="form-control" name="estado"><option value="">Seleccione...</option>	<option value="0">Activo</option><option value="1">Inactivo</option></select></div><div class="form-group"><label>Categoria</label><select class="form-control" name="category"><option value="">Seleccione...</option>	<option value="0">Perro</option><option value="1">Gato</option></select></div><div class="form-group"><label>Images</label><input type="file" name="imagen" id="imgInp" class="form-control"><br><img src="" class="img-resposive" id="imagen_m" style="width: 50%; height: 150px"></div></div> <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button><button type="button" @click="crearMascota" class="btn btn-primary">Guardar</button></div><input type="hidden" name="idm" id="id_m" value=""></form></div></div></div>',
		methods:{
			crearMascota: function(){

				$('#fmas').submit(function(e){
					e.preventDefault()

					if(!$(this).valid()) return false;

					var form_data = {
						id:$('#id_m').val(),
						name:$('#fmas [name="name"]').val(),
						tipo:$('#fmas [name="tipo"]').val(),
						estado:$('#fmas [name="estado"]').val(),
						category:$('#fmas [name="category"]').find('option:selected').val(),
						imagen:$('#imagen_m').prop('src')
					}



$.post("http://localhost/ciapi/index.php/api/save", form_data).then(function (response) {
 console.log(response); 

$('#fmas')[0].reset()
$('#imagen_m').prop('src','')
$('#mascotaModal').modal('hide')

app.get_mascotas()

},'json')




				})

				$('#fmas').submit()

			}
		},
		created: function(){
			
		}

	})


var mascota_inst = new Vue({el:'#frm'})



	$("#fmas").validate({
  rules: {
    name: "required",
    tipo: "required",
    category: "required",
    estado:"required"
  },
  messages: {
    name: "Por favor especifica el nombre de la mascota",
    tipo: "Selecciona el tipo de mascota",
    category: "Selecciona una categoria",
    estado: "Selecciona el estado"
  
  	}
	});



	})

	var app = new Vue({
		el: "#app",
		data: {
			mascotas:[]
		},
		created: function(){
			console.log("Iniciando ...");
			this.get_mascotas();
		},
		methods:{

			borrarMascota:function(mascota){


$.get("http://localhost/ciapi/index.php/api/delete/"+mascota.id).then(function (response) {
 console.log(response); 

app.get_mascotas()

},'json')
				
			},
			editMascota: function(mascota){
				console.log('m ',mascota.categoria_id);
				$('#mascotaModal').modal('show');
				
				setTimeout(function(){
				$('#id_m').val(mascota.id)

				$('#imgInp').change(function(){
     			readURL(this)
     			})
				

				$('#tipo_m option[value="'+mascota.tipo_id+'"]').prop('selected', true);
				$('#fmas [name="estado"]').val(mascota.estado_id);
				$('#fmas [name="category"]').find('[value='+mascota.categoria_id+']').prop('selected',true)

				$('#fmas [name="name"]').val(mascota.nombre)
				
				if(mascota.imagen != ''){
				$('#imagen_m').prop('src',mascota.imagen)
				}


			},500);

			},
			get_mascotas: function(filtro = ''){
				console.log("get rr mas", filtro)
				var flt = '';
				if(filtro != "" ){
					flt = filtro.toString();
				}else{
					flt = '';
				}

	axios.get("http://localhost/ciapi/index.php/api/mascotas/"+flt).then(response => (this.mascotas = response.data));

			}
		}
	});





</script>