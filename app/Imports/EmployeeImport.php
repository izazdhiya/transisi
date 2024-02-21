<?php

namespace App\Imports;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmployeeImport implements ToCollection
{
    protected $employeeModel;
    protected $companyModel;

    public function __construct()
    {
        $this->employeeModel = new Employees();
        $this->companyModel = new Companies();
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row[0] == 'No') {
                continue;
            }

            $companyId = $this->companyModel->getCompanyIdByName($row[2]);

            if ($companyId) {
                $data = [
                    'name' => $row[1],
                    'company_id' => $companyId,
                    'email' => $row[3],
                ];
    
                $this->employeeModel->create($data);
            }
        }
    }

    /**
     * Set the chunk size for the import.
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 10;
    }
}
