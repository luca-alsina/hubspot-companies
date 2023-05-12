<?php

namespace App\Console\Commands\Hubspot;

use App\Contracts\HubspotServiceInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Console\Command;

class ImportContactsCommand extends Command
{
    protected $signature = 'hubspot-import:contacts';

    protected $description = 'Importation des contacts depuis Hubspot';

    public function handle(
        ContactRepositoryInterface $contactRepository,
        CompanyRepositoryInterface $companyRepository,
        HubspotServiceInterface $hubspotService
    ): void
    {

        $this->info('Importation des contacts depuis Hubspot');

    }
}
