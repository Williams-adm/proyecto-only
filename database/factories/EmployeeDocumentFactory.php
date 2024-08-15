<?php

namespace Database\Factories;

use App\Models\Employee;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeDocument>
 */
class EmployeeDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static $employeeDocs = [];

    public function definition(): array
    {
        if(empty(self::$employeeDocs)){
            $employees = Employee::orderby('id')->pluck('id')->toArray();
            $docType = ['cv', 'COPIA DE DI', 'otros'];
            foreach ($employees as $employee_id){
                foreach($docType as $docTypes){
                    self::$employeeDocs[] = ['employee_id' => $employee_id , 'document_type' => $docTypes];
                }
            }
        }
        /* dd($employeeDoc); */
        $randomIndex = array_rand(self::$employeeDocs);
        $selectDoc = self::$employeeDocs[$randomIndex];
        unset (self::$employeeDocs[$randomIndex]);
        self::$employeeDocs = array_values(self::$employeeDocs);

        $employee_id = $selectDoc['employee_id'];
        $document_type = $selectDoc['document_type'];

        $employeesSearch = Employee::find($employee_id);

        $fulltname = $employeesSearch->name . '-' . $employeesSearch->paternal_surname . '-' . $employeesSearch->maternal_surname;
        $documentName = 'EmployeeDocument/' . Str::slug($document_type . '-' . $fulltname) . '.pdf';
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);
        $content = "<h1>Empleado ID: " . $employee_id . "</h1><p>Tipo de Documento: " . $document_type . "</p><p>" .
            $this->faker->paragraph(4) . "</p>";
        $dompdf->loadHtml($content);
        $dompdf->render();
        $output = $dompdf->output();

        Storage::put('public/' . $documentName, $output);

        return [
            'document_type' => strtoupper($document_type),
            'document_path' => $documentName,
            'employee_id' => $employee_id
        ];
    }
}
