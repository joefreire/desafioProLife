<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">
                        <router-link to="/form">Entre em contato</router-link>
                        
                        <h3>Lista de contatos</h3>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>IP de origem</th>
                                <th>Data/hora de envio</th>
                                <th>Arquivo</th>
                            </tr>
                            </thead>
                            <tr v-for="contato in contatos" :key='contato.id'>
                                <td>{{ contato.nome }}</td>
                                <td>{{ contato.email }}</td>
                                <td>{{ contato.telefone }}</td>
                                <td>{{ contato.ip_origem}}</td>
                                <td>{{ contato.created_at}}</td>
                                <td><a :href="contato.url_arquivo" v-if="contato.url_arquivo">
                                    <font-awesome-icon icon="file-alt" />
                                </a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                contatos: []
            }
        },
        methods: {
            getContatos() {
                this.$root.$data.isLoading = true
                axios.get('/api/contato')
                .then(({data}) => {
                    this.contatos = data
                    this.$root.$data.isLoading = false
                }).catch(() => {
                    this.$root.$data.isLoading = false
                })
            }
        },
        mounted() {
            this.getContatos()
        }
    }
</script>
