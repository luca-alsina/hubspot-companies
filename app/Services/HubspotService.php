<?php

namespace App\Services;

use App\Models\Company;
use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Discovery\Discovery;

class HubspotService
{

    /**
     * @var Discovery $hubspot Hubspot API
     */
    private readonly Discovery $hubspot;

    /**
     * @param string $apiKey Hubspot API Key
     */
    public function __construct(private readonly string $apiKey)
    {
        // Initialisation de l'API Hubspot avec la clé API
         $this->hubspot = \HubSpot\Factory::createWithAccessToken($this->apiKey);
    }

    /**
     * @return array Companies from Hubspot
     */
    public function getCompanies(): array
    {
        // Récupération des entreprises
        return $this->hubspot->crm()->companies()->getAll(
            properties: ['name', 'description', 'website', 'industry', 'city', 'zip', 'country', 'numberofemployees', 'annualrevenue', 'description', 'phone'],
            archived: false,
        );
    }

    /**
     * @param int $id Company ID
     * @throws ApiException If the company does not exist
     * @return array Companies from Hubspot
     */
    public function getContactsByCompanyId(int $id) : array
    {
        // Initialisation du filtre
        $filter = new \HubSpot\Client\Crm\Contacts\Model\Filter();
        $filter->setOperator('EQ');
        $filter->setPropertyName('associatedcompanyid');
        $filter->setValue($id);

        // Initialisation du groupe de filtres avec le filtre précédent
        $filterGroup = new \HubSpot\Client\Crm\Contacts\Model\FilterGroup();
        $filterGroup->setFilters([$filter]);

        // Initialisation de la requête de recherche
        $searchRequest = new \HubSpot\Client\Crm\Contacts\Model\PublicObjectSearchRequest();
        $searchRequest->setFilterGroups([$filterGroup]);
        $searchRequest->setProperties(['associatedcompanyid', 'email', 'firstname', 'lastname', 'phone', 'jobtitle']);

        // Récupération des contacts
        return $this->hubspot->crm()->contacts()->searchApi()->doSearch($searchRequest)['results'];
    }

}
