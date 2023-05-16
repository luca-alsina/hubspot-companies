<?php

namespace Tests\Feature;

use App\Http\Controllers\CompanyController;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;
use Mockery;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    private CompanyRepositoryInterface $companyRepository;
    private CompanyController $companyController;

    protected function setUp(): void
    {
        parent::setUp();

        // Mocking the CompanyRepositoryInterface
        $this->companyRepository = Mockery::mock(CompanyRepositoryInterface::class);

        // Creating an instance of the CompanyController
        $this->companyController = new CompanyController($this->companyRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function test_index()
    {
        // Mocking des données
        $companies = new Collection([
            new Company(['id' => 1, 'name' => fake()->company()]),
            new Company(['id' => 2, 'name' => fake()->company()]),
        ]);
        $industries = [fake()->sentence(2), fake()->word()];

        // Expecting the CompanyRepositoryInterface methods to be called
        $this->companyRepository->shouldReceive('getAll')->once()->andReturn($companies);
        $this->companyRepository->shouldReceive('getIndustries')->once()->andReturn($industries);

        // Vérification que la méthode Inertia::render est appelée avec les bons paramètres
        Inertia::shouldReceive('render')
            ->once()
            ->with('Companies/List', ['companies' => CompanyResource::collection($companies), 'industries' => $industries])
            ->andReturn(Mockery::mock(Response::class));

        // Request à la méthode index
        $response = $this->companyController->index();

        // Test que la réponse est bien une instance de Response
        $this->assertInstanceOf(Response::class, $response);

    }

    public function test_search_by_industry()
    {
        // Mocking data
        $companies = new Collection([
            new Company(['id' => 1, 'name' => fake()->company()]),
            new Company(['id' => 2, 'name' => fake()->company()]),
        ]);
        $industry = fake()->sentence(2);

        // Expecting the CompanyRepositoryInterface method to be called
        $this->companyRepository->shouldReceive('searchBy')->once()->with('industry', $industry)->andReturn($companies);

        // Making the request to the searchByIndustry method
        $response = $this->companyController->searchByIndustry($industry);

        // Asserting the response
        $this->assertInstanceOf(AnonymousResourceCollection::class, $response);
        $this->assertEquals(2, count($response->collection));
    }

    public function test_show()
    {
        // Mocking data
        $companyId = 1;
        $company = new Company(['id' => 1, 'name' => fake()->company()]);

        // Expecting the CompanyRepositoryInterface method to be called
        $this->companyRepository->shouldReceive('findById')->once()->with($companyId)->andReturn($company);

        // Making the request to the show method
        $response = $this->companyController->show($companyId);

        // Asserting the response
        $this->assertInstanceOf(CompanyResource::class, $response);
        $this->assertEquals($companyId, $response->id);
    }
}
