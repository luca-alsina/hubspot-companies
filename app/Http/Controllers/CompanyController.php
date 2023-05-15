<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{

    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {
    }

    public function index() : Response
    {
        $companies  = CompanyResource::collection($this->companyRepository->getAll());
        $industries = $this->companyRepository->getIndustries();

        return Inertia::render('Companies/List', compact('companies', 'industries'));
    }

/*    public function industries() : array
    {
        return $this->companyRepository->getIndustries();
    }*/

    public function searchByIndustry(string $industry) : AnonymousResourceCollection
    {

        $industry = urldecode($industry);

        return CompanyResource::collection($this->companyRepository->searchBy('industry', $industry));
    }

    public function show(int $company) : CompanyResource
    {
        return new CompanyResource($this->companyRepository->findById($company));
    }
}
