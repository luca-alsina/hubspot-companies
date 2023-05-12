<?php

namespace App\Contracts;

use HubSpot\Discovery\Discovery;

interface HubspotServiceInterface
{
    public function __construct(Discovery $hubspot);

    public function getCompanies(): array;

    public function getContactsByCompanyId(int $id): array;

}
