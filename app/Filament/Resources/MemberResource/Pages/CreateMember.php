<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;

    // redirect customization
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    // notification customization
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Member credated';
    }
}
