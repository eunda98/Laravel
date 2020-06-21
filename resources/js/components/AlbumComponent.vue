<template>
    <div>
        <form @submit.prevent="editaralbum(album)" v-if="editarActivo">

            <h3>Actualizar albúm</h3>
            <input type="text" placeholder="Identificación" class="form-control mb-2" v-model="album.alb_id">

            <input type="text" placeholder="Nombre" class="form-control mb-2" v-model="album.alb_nom">

            <input type="text" placeholder="Descripción" class="form-control mb-2" v-model="album.alb_des">

            <button class="btn btn-danger" type="submit">Actualiar</button>
        </form>
        
        <form @submit.prevent="agregar" v-else>

            <h3>Agragar albúm</h3>
            <input type="text" placeholder="Identificación" class="form-control mb-2" v-model="album.alb_id">

            <input type="text" placeholder="Nombre" class="form-control mb-2" v-model="album.alb_nom">

            <input type="text" placeholder="Descripción" class="form-control mb-2" v-model="album.alb_des">

            <button class="btn btn-success" type="submit">Insertar</button>
        </form>

        <hr class="mt-3">
        <h3>Lista de albumes</h3>
        <ul class="list-group m-2">
            <li class="list-group-item" v-for="(item, index) in albumes" :key="index">
                <span class="badge badge-primary float-right">{{item.updated_at}}</span>
                <p>Identificación: {{item.alb_id}}</p>
                <p>Nombre: {{item.alb_nom}}</p>
                <p>Apellido: {{item.alb_des}}</p>
                <button class="btn btn-primary btn-sm" @click="eliminaralbum(item, index)"> Eliminar </button>
                <button class="btn btn-warning btn-sm" @click="editarformulario(item, index)"> Editar </button>
            </li>

        </ul>

    </div>
</template>

<script>
export default {
    data(){
        return{
            albumes: [],
            album: {alb_id:'', alb_nom:'', alb_des:''},
            editarActivo: false
        }
    },
    created(){
        axios.get('/albumes').then( res => {
             this.albumes = res.data;
         })
    },
    methods: {
        editarformulario(item){
            this.editarActivo=true;
            this.album.alb_id = item.alb_id;
            this.album.alb_nom = item.alb_nom;
            this.album.alb_des = item.alb_des;
            this.album.id = item.id;
            },
            editaralbum(item){
            const params = {alb_id: this.album.alb_id, alb_nom: this.album.alb_nom, alb_des: this.album.alb_des};
            axios.put(`/albumes/${item.id}`, params).then(res => {
                const index = this.albumes.findIndex(albumBuscar => albumBuscar.id === res.data.id)

                this.album[index] = res.data;

                axios.get('/albumes').then(res => {
                        this.albumes = params;
                    })
            })
        },
        agregar(){
            
            // console.log(this.album.alb_id, this.album.alb_nom, this.album.alb_des);   
            const params = {alb_id: this.album.alb_id, alb_nom: this.album.alb_nom, alb_des: this.album.alb_des}
            this.album.alb_id = '';
            this.album.alb_nom = '';
            this.album.alb_des = '';

            axios.post('/albumes', params).then(res => {
                this.albumes.push(res.data)
            })
        }, 
        eliminaralbum(item, index){
             axios.delete(`/albumes/${item.id}`).then(() =>{
             this.albumes.splice(index,1);
        })
        }
    }
    
}
</script>