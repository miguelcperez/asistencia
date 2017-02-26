<template>
    <div class="container">
        <div class="row text-center">
            <h1>Registro de Asistencia</h1>
        </div>
        <hr>
        <div class="row">
            <table class="table table-bordered">
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
                <tr>
                    <td>Pepito</td>
                    <td>7:20 a.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td>12:45 p.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Pepito</td>
                    <td>7:20 a.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td>12:45 p.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Pepito</td>
                    <td>7:20 a.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td>12:45 p.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Pepito</td>
                    <td>7:20 a.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td>12:45 p.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Pepito</td>
                    <td>7:20 a.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td>12:45 p.m.</td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Marcar
                        </button>
                    </td>
                    <td><input type="checkbox"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        data: function () {
            return {
                holi: 'Boli'
            };
        },
        mounted: function() {
            console.log('Component mounted.')
        }
    }
</script>
