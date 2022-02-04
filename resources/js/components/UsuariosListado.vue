<template>
    <div>
        <table style="width: 100% !important;" class="table table-hover table-striped" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="ftope">
					<th>Cedula</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>País</th>
					<th>Dirección</th>
					<th>Celular</th>
					<th>Categoría</th>
					<th>Email</th>
					<th style="width:150px;">Editar</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="usuario in usuarios" v-bind:key="usuario.id">
					<td>{{usuario.identification}}</td>
					<td>{{usuario.names}}</td>
					<td>{{usuario.surnames}}</td>
					<td>{{usuario.country}}</td>
					<td>{{usuario.address}}</td>
					<td>{{usuario.cell_phone}}</td>
					<td>{{usuario.categoria.name}}</td>
					<td>{{usuario.email}}</td>
				     <td>
                         <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"  v-on:click='cargaUsuario(usuario)' data-bs-target="#edit">
						Editar</button>
						<button class="btn btn-danger btn-sm" v-on:click='deleteUsuario(usuario)'>Eliminar</button>
					</td>
				</tr>				 
			</tbody>
		</table>

        <nav>
			<ul class="pagination pg-blue">
				<li class="page-item" v-if="pagination.current_page>1">
				<a class="page-link" tabindex="-1" href="#" @click.prevent="changePage(pagination.current_page - 1)">Atrás</a>
				</li>
				<li class="page-item" v-for="(page, index) in pagesNumber" v-bind:class=" [page == isActived ? 'active':'']" :key='index'>
					<a class="page-link" href="#" @click.prevent="changePage(page)">{{page}}</a>
				</li>
				<!--li class="page-item active">
				<a class="page-link">2</a>
				</li>
				<li class="page-item"><a class="page-link">3</a></li-->
				<li class="page-item" v-if="pagination.current_page<pagination.last_page">
				<a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">Siguiente</a>
				</li>
			</ul>
		</nav>        

    </div>
</template>

<script>
export default {
    props:['usuarios', 'pagination'],
    data(){
        return {              
                       
        }
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        
        pagesNumber:function(){
            if(!this.pagination.to){
                return [];
            }
            var from = this.pagination.current_page - 2;
            console.log(from);

            if(from < 1){
                from = 1;
            }

            var to = from + (2 * 2);

            if(to >= this.pagination.last_page){
                to=this.pagination.last_page;
            }

            var pagesArray=[];

            while(from <= to){
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        }
    },
    created: function(){
        // this.listProductos();
        // this.listBodegas();
    },
    mounted() {
        console.log('Component mounted.');
        
    },
    methods: {
        changePage: function(page){
				
            this.pagination.current_page=page;
            //alert(page);
            const page2={
                'page':page,
            }
            this.$emit('lista', page2);
            /*bus.$emit('page', 2);
            bus.$on('page', function (id) {
                alert (id);
            });*/
        },
        deleteUsuario(usuario){
            	//alert(producto.id);
            	var url='/usuarios/'+usuario.id;
            	axios.delete(url).then(response => {
            		alert('Usuario eliminado')
                    const page2={
                        'page':this.pagination.current_page,
                    }
            		this.$emit('lista', page2);
            		//this.$emit('upEmpleado', empleado);
            	});
            },
            cargaUsuario: function(data){
                this.$parent.dataUsuariosProp = data;
            }
    },
}
</script>

<style scoped>

</style>
