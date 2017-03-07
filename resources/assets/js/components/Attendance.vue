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

        <div class="row">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>Trabajador</th>
                        <th>Hora de Entrada</th>
                        <th>Acción</th>
                        <th>Hora de Salida</th>
                        <th>Acción</th>
                        <th>Justificar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <td v-text="user.name"></td>
                        <td v-text="formatTime(user.entry)"></td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                    @click="checkIn(user)"  data-target=".modal"
                                    :disabled="user.entry ? true : false">
                                Marcar
                            </button>
                        </td>
                        <td v-text="formatTime(user.exit)"></td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                    @click="checkOut(user)" data-target=".modal"
                                    :disabled="user.exit ? true : false">
                                Marcar
                            </button>
                        </td>
                        <td>
                            <input v-model="user.justify" type="checkbox">
                            <input type="hidden" v-model="user.code">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" v-text="title"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="/" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="Code" class="col-sm-4 control-label">Codigo</label>
                                <div class="col-sm-8">
                                    <input type="text" v-model="code" id="Code" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="codeValidate(code)">Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
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
                disabledCheckIn: false,
                disabledCheckOut: false
            };
        },
        mounted: function() {
            this.$http.get('/personal/today').then(response => {
                response.body.forEach(user => {
                    user.justify = false;
                });

                this.users = response.body;
            });

            moment.locale('es');
            this. today = moment().format('dddd, LTS');

            setInterval(function () {
                this. today = moment().format('dddd, LTS');
            }.bind(this), 1000);
        },
        methods: {
            checkIn: function (user) {
                this.title = user.name;
                this.$http.post('/personal/check-in', {
                    id: user.id
                }).then(response => {
                    user.entry = moment(response.body.created_at).format('LT');
                });
            },
            checkOut: function (user) {
                this.$http.post('/personal/check-out', {
                    id: user.id
                }).then(response => {
                    user.exit = moment(response.body.created_at).format('LT');
                });
            },
            formatTime: function (date) {
                if (date == null) {
                    return '';
                }

                return moment(date).format('h:mm:ss a');
            },
            codeValidate: function (code) {

            }
        },
        computed: {

        }
    }
</script>

<style>
    .today {
        text-transform: capitalize;
    }
</style>