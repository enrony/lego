<template>
    <div class='m-2'>        

        <usuarios-agregar @lista="listUsuarios" :dataUsuariosProp='dataUsuariosProp' :countries='countries' :categories='categories'></usuarios-agregar>
        <usuarios-listado @lista="listUsuarios" :usuarios='usuarios' :pagination='pagination'></usuarios-listado>
    </div>
</template>

<script>
import UsuariosListado from './UsuariosListado.vue';
export default {
  components: { UsuariosListado },
    data(){
        return {              
            pagination:{
                'total'	: 0,
                'current_page'	: 0,
                'per_page'	: 0,
                'last_page'	: 0,
                'from'	: 0,
                'to'	: 0,
            },
            errors:[],
            usuarios:[],
            dataUsuariosProp: [],
            countries: [],
            categories: [],
        }
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        editUsuario:function(){
            alert('Editar');
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
        },
        
    },
    created: function(){
        this.listUsuarios();
        // this.listBodegas();
    },
    mounted() {
        console.log('Component mounted.');
        
    },
    methods: {
        listUsuarios: async function(filtros='', page=''){
            var page2='';
				if(filtros.page){
					page2=filtros.page;
				}
            await this.listCategories();
            axios.get('/usuarios/lista?page='+page2).then( response => {
                this.usuarios = response.data.usuarios.data;
                this.pagination = response.data.pagination;
                this.countries = response.data.countries.data;
            });
        },    
        listCategories: function(){
            axios.get('/categorias/lista').then( response => {
                this.categories = response.data.categories
            })
        }    
    },
}
</script>

<style scoped>

</style>
