<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompaniesRequest;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompaniesController extends Controller
{
    protected $companyModel;

    public function __construct()
    {
        $this->middleware('auth');
        $this->companyModel = new Companies();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->companyModel->paginate(5);
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompaniesRequest $request)
    {
        try {
            DB::beginTransaction();

            $companyId = $request->companyId;
            $data = [
                'name'      => $request->name,
                'email'     => $request->email,
                'website'   => $request->website,
            ];

            if ($companyId) {
                if ($request->hasFile('logo')) {
                    $logo = $request->logo->store('company/', 'public');
                    $data['logo'] = $logo;
                }

                $this->companyModel->updateData($companyId, $data);
            } else {
                $logo = $request->logo->store('company/', 'public');
                $data['logo'] = $logo;

                $this->companyModel->create($data);
            }

            DB::commit();

            return redirect()->route('company.index')->with('success', 'Company successfully saved');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in Companies store method: ' . $th->getMessage());
            return redirect()->route('company.index')->with('error', 'Company failed to save');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = $this->companyModel->getCompanyById($id);
        return view('company.form', compact('company'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->companyModel->deleteCompanyById($id);

            DB::commit();

            return redirect()->route('company.index')->with('success', 'Company successfully deleted');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error in Companies destroy method: ' . $th->getMessage());
            return redirect()->route('company.index')->with('error', 'Company failed to delete');
        }
    }

    public function getCompanyOptions(Request $request)
    {
        try {
            $query = $request->input('q');
            $page = $request->input('page') ?? 1;
            $perPage = 5;

            $pagination = true;

            $companies = $this->companyModel->getCompany($query, $page, $perPage);
            return response()->json(['items' => $companies['data'], 'total_count' => $companies['total'], 'pagination' => $pagination]);
        } catch (\Throwable $th) {
            Log::error('Error in getCompanyOptions method: ' . $th->getMessage());

            $pagination = false;

            return response()->json(['items' => [], 'total_count' => 0, 'pagination' => $pagination]);
        }
    }

    public function getCompanyDetail(Request $request)
    {
        $company = $this->companyModel->getCompanyById($request->id);
        return response()->json($company);
    }
}
