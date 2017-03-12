<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Registro de Asistencia
                    <span class="pull-right today" v-text="today"></span>
                </h1>
            </div>
        </div>
        <hr>
        
        <div class="row" v-show="modal">
            <h3 v-text="name"></h3>
            <div class="form-group">
                <div class="input-group">
                    <input type="hidden" v-text="id" name="idPersonal" v-model="id">
                    <input type="text" class="form-control" v-model="code" placeholder="INGRESE CÓDIGO">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" @click="codeValidate">VERIFICAR</button>
                    </span>
                </div>
            </div>
        </div>

        <div class="alert alert-success" v-show="alert">
            <p class="text-center" v-text="alert"></p>
        </div>

        <div class="row">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Trabajador</th>
                        <th>Hora de Entrada</th>
                        <th>Acción</th>
                        <th>Hora de Salida</th>
                        <th>Acción</th>
                        <!-- <th>Justificar</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <td v-text="user.name"></td>
                        <td v-text="formatTime(user.entry)"></td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                    @click="showModal(user, 'entry')"
                                    :disabled="user.entry ? true : false">
                                Marcar
                            </button>
                        </td>
                        <td v-text="formatTime(user.exit)"></td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                    @click="showModal(user, 'exit')"
                                    data-target=".modal"
                                    :disabled="user.exit ? true : false">
                                Marcar
                            </button>
                        </td>
                        <!-- <td>
                            <input v-model="user.justify" type="checkbox">
                            <input type="hidden" v-model="user.code">
                        </td> -->
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script type="text/babel">
    import moment from 'moment';

    export default {
        data: function () {
            return {
                today: '',
                users: [],
                code: '',
                modal: false,
                type: '',
                name: '',
                alert: '',
                id: ''
            };
        },
        mounted: function() {
            this.loadData();

            moment.locale('es');
            this. today = moment().format('dddd, LTS');

            setInterval(function () {
                this. today = moment().format('dddd, LTS');
            }.bind(this), 1000);
        },
        methods: {
            loadData: function () {
                this.$http.get('/personal/today').then(response => {
                    response.body.forEach(user => {
                        user.justify = false;
                    });

                    this.users = response.body;
                });
            },

            showModal: function (user, type) {
                this.name = user.name;
                this.id = user.id;
                this.type = type;
                this.modal = true;
            },
            checkIn: function (id) {
                this.$http.post('/personal/check-in', {
                    id: id
                }).then(response => {
                    this.loadData();
                    this.alert = 'Entrada registrada!';

                    setTimeout(function () {
                        this.alert = '';
                    }.bind(this), 3000);
                });
            },
            checkOut: function (id) {
                this.$http.post('/personal/check-out', {
                    id: id
                }).then(response => {
                    this.loadData();
                    this.alert = 'Salida registrada!';

                    setTimeout(function () {
                        this.alert = '';
                    }.bind(this), 3000);
                });
            },
            codeValidate: function () {
                this.$http.post('/personal/validate', {code: this.code, id: this.id})
                        .then(response => {
                            console.log(response.body);
                            this.code = '';
                            this.modal = false;

                            if (this.type == 'entry') {
                                this.checkIn(response.body.user.id);
                            } else {
                                this.checkOut(response.body.user.id);
                            }
                        }).catch(response => {
                            console.log(response.body);
                            this.code = '';
                            alert('Codigo incorrecto!');
                        });
            },
            formatTime: function (date) {
                if (date == null) {
                    return '';
                }

                return moment(date).format('h:mm:ss a');
            },
        }
    }
</script>

<style>
    .today {
        text-transform: capitalize;
    }
</style>