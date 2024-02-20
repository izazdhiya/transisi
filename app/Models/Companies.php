<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];
    
    public function employee()
    {
        return $this->hasMany(Employees::class, 'company_id');
    }

    public function updateData($companyId, $data)
    {
        $company = $this->find($companyId);
        $company->update($data);
        return $company;
    }

    public function getCompanyById($id)
    {
        $company = $this->find($id);
        return $company;
    }

    public function deleteCompanyById($id)
    {
        $company = $this->find($id);
        $company->employee()->delete();
        $company->delete();

        return $company;
    }
}
