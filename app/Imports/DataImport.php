<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date; // Import Date class

class DataImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        $header = $collection->first()->toArray(); // First row as headers
        $data = $collection->slice(1)->map(function ($row) use ($header) {
            $rowArray = $row->toArray();

            // Convert Excel date fields
            if (isset($rowArray[1]) && is_numeric($rowArray[1])) { 
                $rowArray[1] = Date::excelToDateTimeObject($rowArray[1])->format('d-M-Y'); // Change 'd-M-Y' as needed
            }
            if (isset($rowArray[7]) && is_numeric($rowArray[7])) {
                $rowArray[7] = Date::excelToDateTimeObject($rowArray[7])->format('d-M-Y');
            }

            return array_combine($header, $rowArray);
        });

        // dd($data->toArray()); // Outputs the formatted data
        echo "<pre>"; print_r($data->toArray()); exit;
    }
}

