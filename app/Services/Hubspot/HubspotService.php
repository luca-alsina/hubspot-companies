<?php

namespace App\Services\Hubspot;

use App\Contracts\HubspotServiceInterface;
use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Discovery\Discovery;

class HubspotService implements HubspotServiceInterface
{

    /**
     * @param Discovery $hubspot Hubspot API Discovery Object
     */
    public function __construct(private readonly Discovery $hubspot)
    {}

    /**
     * @return array Companies from Hubspot
     */
    public function getCompanies(): array
    {
        // Récupération des entreprises
        return $this->hubspot->crm()->companies()->getAll(
            properties: ['name', 'description', 'website', 'industry', 'city', 'zip', 'country', 'numberofemployees', 'annualrevenue', 'description', 'phone', 'domain'],
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
