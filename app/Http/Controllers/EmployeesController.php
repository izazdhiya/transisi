<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesRequest;
use App\Imports\EmployeeImport;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class EmployeesController extends Controller
{
    protected $employeeModel;

    public function __construct()
    {
        $this->middleware('auth');
        $this->employeeModel = new Employees();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = $this->employeeModel->paginate(5);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeesRequest $request)
    {
        try {
            DB::beginTransaction();

            $employeeId = $request->employeeId;
            $data = [
                'name'      => $request->name,
                'email'     => $request->email,
                'company_id'   => $request->company_id,
            ];

            if ($employeeId) {
                $this->employeeModel->updateData($employeeId, $data);
            } else {
                $this->employeeModel->create($data);
            }

            DB::commit();

            return redirect()->route('employee.index')->with('success', 'Employee successfully saved');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in Employees store method: ' . $th->getMessage());
            return redirect()->route('employee.index')->with('error', 'Employee failed to save');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = $this->employeeModel->getEmployeeById($id);
        return view('employee.form', compact('employee'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->employeeModel->deleteEmployeeById($id);

            DB::commit();

            return redirect()->route('employee.index')->with('success', 'Employee successfully deleted');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in Employees destroy method: ' . $th->getMessage());
            return redirect()->route('employee.index')->with('error', 'Employee failed to delete');
        }
    }

    public function exportEmployee(Request $request)
    {
        try {
            $companyId = $request->company_id;
            $employees = $this->employeeModel->getDataExport($companyId);

            if (count($employees) != 0) {
                $pdf = PDF::loadView('employee.pdf', ['employees' => $employees]);

                $pdf->setOption('enable-local-file-access', true);
                $pdf->download('employee.pdf');

                return $pdf->download('employee.pdf');
            } else {
                return redirect()->route('employee.index')->with('warning', 'No data will be exported');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in importEmployee method: ' . $th->getMessage());
            return redirect()->route('employee.index')->with('error', 'Data failed to export');
        }     
    }

    public function importEmployee(Request $request)
    {
        try {
            DB::beginTransaction();

            $file = $request->file('file_employee');
            Excel::import(new EmployeeImport, $file);

            DB::commit();

            return redirect()->route('employee.index')->with('success', 'Data successfully imported');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in importEmployee method: ' . $th->getMessage());
            return redirect()->route('employee.index')->with('error', 'Data failed to import');
        }
    }
}
