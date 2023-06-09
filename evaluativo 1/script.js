$(document).ready(function() {
    var employees = [];
    $('#saveEmployeeButton').click(function() {
        var nombre = $('#nombre').val();
        var edad = $('#edad').val();
        var estadoCivil = $('#estadoCivil').val();
        var sexo = $('#sexo').val();
        var sueldo = $('#sueldo').val();

        if (nombre === '' || edad === '' || estadoCivil === '' || sexo === '' || sueldo === '') {
            alert('Por favor, completa todos los campos.');
            return;
        }
        var employee = {
            nombre: nombre,
            edad: edad,
            estadoCivil: estadoCivil,
            sexo: sexo,
            sueldo: sueldo
        };
        employees.push(employee);
        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: { employees: employees },
            dataType: 'json',
            success: function(response) {
                var newRow = '';
                for (var i = 0; i < response.employees.length; i++) {
                    newRow += '<tr><td>' + response.employees[i].nombre + '</td><td>' + response.employees[i].edad + '</td><td>' + response.employees[i].estadoCivil + '</td><td>' + response.employees[i].sexo + '</td><td>' + response.employees[i].sueldo + '</td></tr>';
                }
                $('#employeeTable tbody').html(newRow);

                $('#results').html(response.resultados);
            },
            error: function() {
                alert('Error en la solicitud AJAX.');
            }
        });
        $('#employeeForm')[0].reset();
    });
});
