<?php

namespace App\Console\Commands\Hubspot;

use App\Contracts\HubspotServiceInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Console\Command;

class ImportCompaniesCommand extends Command
{
    protected $signature = 'hubspot-import:companies {--contacts : Importe les contacts}';

    protected $description = 'Importation des entreprises depuis Hubspot';

    public function handle(
        CompanyRepositoryInterface $companyRepository,
        ContactRepositoryInterface $contactRepository,
        HubspotServiceInterface $hubspotService
    ): void
    {
        $this->info('Importation des entreprises depuis Hubspot');

        // Wipe des 2 bases de données
        $contactRepository->truncate();
        $companyRepository->truncate();

        // Récupération des entreprises depuis Hubspot
        $companies = $hubspotService->getCompanies();

        // Pour chaque entreprise
        foreach ($companies as $company) {
            $this->info('Importation de l\'entreprise ' . $company['properties']['name']);

            // Vérification de la présence des données obligatoires
            if (!isset($company['properties']['name'])) {
                $this->error('Erreur lors de l\'importation de l\'entreprise : le nom est obligatoire');
                continue;
            }
            // Vérification que la date de création de l'entreprise est bin supérieure au 09 juin 2021
            if (($company['created_at'])->getTimestamp() < strtotime('2021-06-09')) {
                $this->error('Erreur lors de l\'importation de l\'entreprise ' . $company['properties']['name'] . ' : la date de création est inférieure au 09 juin 2021');
                continue;
            }
            $this->info('Date de création de l\'entreprise ' . $company['properties']['name'] . ' : ' . ($company['created_at'])->format('d/m/Y'));

            // Création de l'entreprise
            try {
                $companyRepository->create([
                    'id'                    => $company['id'],
                    'name'                  => $company['properties']['name'],
                    'description'           => $company['properties']['description'],
                    'phone'                 => $company['properties']['phone'],
                    'industry'              => $company['properties']['industry'],
                    'number_employees'      => $company['properties']['numberofemployees'],
                    'annual_revenue'        => $company['properties']['annualrevenue'],
                    'website'               => $company['properties']['website'],
                    'city'                  => $company['properties']['city'],
                    'country'               => $company['properties']['country'],
                    'zip'                   => $company['properties']['zip'],
                    'created_at'            => $company['created_at'],
                    'updated_at'            => $company['updated_at'],
                ]);
            } catch (\Exception $e) {
                $this->error('Erreur lors de l\'importation de l\'entreprise ' . $company['properties']['name'] . ' : ' . $e->getMessage());
                \Log::error($e->getMessage(), ['trace' => $e->getTraceAsString(), 'company' => $company]);
                continue;
            }

            $this->info('Importation de l\'entreprise ' . $company['properties']['name'] . ' terminée');

        }

        $this->info('Importation des entreprises depuis Hubspot terminée');

        // Importation des contacts si l'option --contacts est présente
        if ($this->option('contacts')) {
            $this->call('hubspot-import:contacts');
        }
        // Proposition d'importation des contacts
        elseif ($this->confirm('Voulez-vous importer les contacts ?', true)) {
            $this->call('hubspot-import:contacts');
        }
    }
}
