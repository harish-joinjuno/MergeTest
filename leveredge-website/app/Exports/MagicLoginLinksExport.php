<?php

namespace App\Exports;

use App\MagicLoginLink;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MagicLoginLinksExport implements FromArray, WithHeadings, WithChunkReading
{
    use Exportable;

    public $magicLoginLinkId;

    public function __construct($magicLoginLinkId)
    {
        $this->magicLoginLinkId = $magicLoginLinkId;
    }

    public function array(): array
    {
        $magicLoginLink = MagicLoginLink::findOrFail($this->magicLoginLinkId);

        $users = User::all();

        $rows = [];
        foreach ($users as $user) {
            array_push($rows,
                [
                    $user->email,
                    $magicLoginLink->getLinkForUser($user),
                ]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Email',
            'Link'
        ];
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
