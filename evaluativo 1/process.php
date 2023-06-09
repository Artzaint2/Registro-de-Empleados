<?php
$employees = $_POST['employees'];

$response = array(
    'employees' => $employees,
    'resultados' => ''
);

$totalFemenino = 0;
$totalHombresCasados = 0;
$totalMujeresViudas = 0;
$totalHombres = 0;
$sumaEdadHombres = 0;

foreach ($employees as $emp) {
    if ($emp['sexo'] === 'femenino') {
        $totalFemenino++;
    }

    if ($emp['sexo'] === 'masculino') {
        $totalHombres++;
        $sumaEdadHombres += $emp['edad'];

        if ($emp['estadoCivil'] === 'casado' && $emp['sueldo'] === 'mas2500') {
            $totalHombresCasados++;
        }
    }

    if ($emp['sexo'] === 'femenino' && $emp['estadoCivil'] === 'viudo' && $emp['sueldo'] !== 'menos1000') {
        $totalMujeresViudas++;
    }
}

$promedioEdadHombres = $totalHombres > 0 ? $sumaEdadHombres / $totalHombres : 0;

$response['resultados'] = "
    <p>Total de empleados del sexo femenino: $totalFemenino</p>
    <p>Total de hombres casados que ganan más de 2500 Bs.: $totalHombresCasados</p>
    <p>Total de mujeres viudas que ganan más de 1000 Bs.: $totalMujeresViudas</p>
    <p>Edad promedio de los hombres: $promedioEdadHombres</p>";

echo json_encode($response);
?>
