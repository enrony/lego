<template>
    <div>
        <div class="d-flex justify-content-end mb-4">
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit">
                   Nuevo usuario
               </button>
            </div>
        </div>
        <form method="POST" v-on:submit.prevent="editUsuario()">
			<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Usuario</h5>
							<button class="close" type="button" @click='cerrar' data-bs-dismiss="modal" aria-label="Close">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="codigo">Cedula:</label>
                                    <input type="text" :disabled='activar' name="identification" maxlength="25" class="form-control" v-model="dataUsuarios.identification">
                                    <span v-for="error in errors" class="text-danger">{{ error.identification }}</span><br>
                                </div>
                                <div class="col-6">
                                    <label for="nombre">Nombres:</label>
                                    <input type="text" name="nombre" maxlength="100" class="form-control" v-model="dataUsuarios.names">
                                    <span v-for="error in errors" class="text-danger">{{ error.names }}</span><br>
                                </div>
                                <div class="col-6">
                                    <label for="descripcion">Apellidos:</label>
                                    <input type="text" name="descripcion" maxlength="100" class="form-control" v-model="dataUsuarios.surnames">
                                    <span v-for="error in errors" class="text-danger">{{ error.surnames }}</span><br>
                                </div>
                                <div class="col-6">
                                    <label for="descripcion">Email:</label>
                                    <input type="text" :disabled='activar' name="descripcion" maxlength="150" class="form-control" v-model="dataUsuarios.email">
                                    <span v-for="error in errors" class="text-danger">{{ error.email }}</span><br>
                                </div>
                                <div class="col-6">
                                    <label for="descripcion">Celular:</label>
                                    <input type="text" name="descripcion" maxlength="100" class="form-control" v-model="dataUsuarios.cell_phone">
                                    <span v-for="error in errors" class="text-danger">{{ error.cell_phone }}</span><br>
                                </div>
                                <div class="col-6">
                                    <label for="descripcion">País:</label>
                                    <select name="bodega" class="form-control" v-model="dataUsuarios.country">
                                        <option value="">Seleccione</option>
                                        <option v-for="(country, index) in countries" v-bind:value="index">{{ country.country }}</option>
                                    </select>
                                    <span v-for="error in errors" class="text-danger">{{ error.country }}</span><br>
                                </div>
                                <div class="col-6">
                                    <label for="descripcion">Categoría:</label>
                                    <select name="bodega" class="form-control" v-model="dataUsuarios.id_category">
                                        <option value="">Seleccione</option>
                                        <option v-for="(category, index) in categories" v-bind:value="category.id">{{ category.name }}</option>
                                    </select>
                                    <span v-for="error in errors" class="text-danger">{{ error.id_category }}</span><br>
                                </div>
                                <div class="col-12">
                                    <label for="descripcion">Dirección:</label>
                                    <textarea name="" id="" cols="30" rows="3" class="form-control" v-model="dataUsuarios.address"></textarea>
                                    <span v-for="error in errors" class="text-danger">{{ error.address }}</span><br>
                                </div>
                            </div>
														

							<!-- <label for="existencia">Existencia:</label>
							<input type="text" name="existencia" class="form-control" v-model="newExistencia">
							<span v-for="error in errors" class="text-danger" >{{ error.existencia }}</span><br> -->

							<!-- <label for="bodega">Bodega:</label>							
							<select name="bodega" class="form-control" v-model="newBodega">
								<option value="">Seleccione</option>
								<option v-for="bodega in bodegas" v-bind:value="bodega.id">{{ bodega.nombre +' - '+ bodega.id}}</option>
							</select>
							<span v-for="error in errors" class="text-danger">{{ error.id_bodega }}</span>
							<label for="estatus">Estado de producto</label>
							<select name="estatus" class="form-control" v-model="newEstatus">
								<option value="1">Pendiente</option>
								<option value="2">Activo</option>
								<option value="3">Inactivo</option>
							</select> -->
						</div>
						<div class="modal-footer">
							<input type="submit" value="Guardar" class="btn btn-primary" name="">
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
</template>

<script>
export default {
    props:['dataUsuariosProp', 'countries', 'categories'],
    data(){
        return {              
            errors:[],    
            dataUsuarios:{
                identification:'',
                names:'',
                surnames:'',
                address:'',
            }        
        }
    },
    watch: {
        dataUsuariosProp: function(){
            this.dataUsuarios = Object.assign({}, this.dataUsuariosProp)
        }
    },
    computed: {
        activar: function(){
            if( typeof this.dataUsuarios.id == 'undefined'){
                return false;
            }
            return true;
        }
    },
    methods: {
        cerrar: function(){
            this.errors = [];
            this.dataUsuarios = {}
            this.$parent.dataUsuariosProp = [];
        },
        editUsuario:function(){
            // console.log(this.dataUsuarios)
            axios.post('/usuarios/store', this.dataUsuarios).then(
                response => {
                    this.errors = [];
                    this.dataUsuarios = {};
                    this.$emit('lista');
                    this.$parent.dataUsuariosProp = [];
                    $('#edit').modal('hide')
                    alert("Registro guardado con éxito.");
                }
            ).catch(error => {
                this.errors = error.response.data;
            });
        },
    },
    
}
</script>

<style scoped>

</style>