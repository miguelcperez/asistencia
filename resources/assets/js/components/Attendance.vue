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
                        <td v-text="user.starts"></td>
                        <td>
                            <button type="button" class="btn btn-default" @click="checkIn(user)">Marcar</button>
                        </td>
                        <td v-text="user.ends"></td>
                        <td>
                            <button type="button" class="btn btn-default" @click="checkOut(user)">Marcar</button>
                        </td>
                        <td><input v-model="user.justify" type="checkbox"></td>
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
                users: []
            };
        },
        mounted: function() {
            this.$http.get('/personal/today').then(response => {
                response.body.forEach(user => {
                    user.starts = user.ends = '';
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
                alert('CheckIn');
            },
            checkOut: function (user) {
                alert('CheckOut');
            }
        }
    }
</script>

<style>
    .today {
        text-transform: capitalize;
    }
</style>