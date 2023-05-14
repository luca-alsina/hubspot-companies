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
        HubspotServiceInterface    $hubspotService
    ): void
    {
        $this->info('Importation des contacts depuis Hubspot');

        // Wipe de la base de données des contacts
        $contactRepository->truncate();

        // Récupération des contacts depuis Hubspot
        $this->info('Récupération des contacts depuis Hubspot');
        $contacts = $hubspotService->getContacts();
        $this->info('Nombre de contacts récupérés : ' . count($contacts));

        // Pour chaque contact
        foreach ($contacts as $contact) {
            $this->info('Importation du contact ' . $contact['properties']['firstname'] . ' ' . $contact['properties']['lastname']);

            // Demande de confirmation de l'entreprise d'importation du contact si l'entreprise est nulle
            if (!$contact['properties']['associatedcompanyid']) {
                $this->warn('Le contact ' . $contact['properties']['firstname'] . ' ' . $contact['properties']['lastname'] . ' n\'est associé à aucune entreprise. Début de la recherche d\'une entreprise correspondante');

                // TODO : Recherche d'une entreprise correspondante

                continue;
            }
            // Sinon récupération de l'entreprise associée au contact
            else {
                $contactCompany = $companyRepository->findById($contact['properties']['associatedcompanyid']);
            }

            // Vérification que la Company existe
            if (!$contactCompany) {
                $this->error('Erreur lors de l\'importation du contact ' . $contact['properties']['firstname'] . ' ' . $contact['properties']['lastname'] . ' : l\'entreprise avec l\'id ' . $contact['properties']['associatedcompanyid'] . ' n\'existe pas');
                continue;
            }

            // Définition de l'email de la company si le champ de l'email dans la company est vide
            if (!$contactCompany->email) {
                $this->info('Définition de l\'email de l\'entreprise ' . $contactCompany->name . ' : ' . $contact['properties']['email']);
                $contactCompany->email = $contact['properties']['email'];
                $contactCompany->save();
            }

            // Création du contact
            try {
                $contactRepository->create([
                    'id'            => $contact['id'],
                    'company_id'    => $contact['properties']['associatedcompanyid'],
                    'first_name'    => $contact['properties']['firstname'],
                    'last_name'     => $contact['properties']['lastname'],
                    'email'         => $contact['properties']['email'],
                    'phone'         => $contact['properties']['phone'],
                    'job_title'     => $contact['properties']['jobtitle'],
                    'created_at'    => $contact['created_at'],
                    'updated_at'    => $contact['updated_at'],
                ]);
            } catch (\Exception $e) {
                $this->error('Erreur lors de l\'importation du contact ' . $contact['properties']['firstname'] . ' ' . $contact['properties']['lastname'] . ' : ' . $e->getMessage());
                \Log::error('Erreur lors de l\'importation du contact ' . $contact['properties']['firstname'] . ' ' . $contact['properties']['lastname'] . ' : ' . $e->getMessage(), [
                    'contact' => $contact,
                    'exception' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                continue;
            }

        }
    }
}
