<?php

namespace App\Policies;

use App\Models\Provider;
use App\Models\ProviderService;

class ProviderServicePolicy
{
    public function manage(Provider $provider, ProviderService $providerService): bool
    {
        return (int) $providerService->provider_id === (int) $provider->id;
    }
}
