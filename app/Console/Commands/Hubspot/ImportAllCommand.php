<?php

namespace App\Console\Commands\Hubspot;

use Illuminate\Console\Command;

class ImportAllCommand extends Command
{
    protected $signature = 'hubspot-import:all';

    protected $description = 'Importation des entreprises et des contacts depuis Hubspot';

    public function handle(): void
    {

        $this->info('Importation des données depuis Hubspot');

        // Importation des entreprises
        if ($this->call('hubspot-import:companies')) {
            $this->info('Importation des entreprises terminée');
        } else {
            $this->error('Erreur lors de l\'importation des entreprises');
        }

        // Importation des contacts
        if ($this->call('hubspot-import:contacts')) {
            $this->info('Importation des contacts terminée');
        } else {
            $this->error('Erreur lors de l\'importation des contacts');
        }
    }
}
