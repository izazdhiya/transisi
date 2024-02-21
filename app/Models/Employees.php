<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'company_id',
        'email'
    ];

    public function company()
    {
        return $this->belongsTo(Companies::class);
    }

    public function updateData($employeeId, $data)
    {
        $employee = $this->find($employeeId);
        $employee->update($data);
        return $employee;
    }

    public function getEmployeeById($id)
    {
        $employee = $this->find($id);
        return $employee;
    }

    public function deleteEmployeeById($id)
    {
        $employee = $this->find($id);
        $employee->delete();

        return $employee;
    }

    public function getDataExport($companyId)
    {
        return $this->when($companyId, function ($query) use ($companyId) {
            return $query->where('company_id', $companyId);
        })->get();
    }

}
