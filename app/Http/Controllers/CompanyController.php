<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{

    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {
    }

    public function index() : Response
    {
        $companies = CompanyResource::collection($this->companyRepository->getAll());

        return Inertia::render('Companies/List', compact('companies'));
    }

    public function show(Company $company)
    {
        return new CompanyResource($company);
    }
}
