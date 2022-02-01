<?php


namespace App\Repositories;


use App\Exports\MagicLoginLinksExport;
use App\MagicLoginLink;
use App\Repositories\Contracts\MagicLoginLinkRepositoryInterface;
use Maatwebsite\Excel\Excel;

class MagicLoginLinkRepository extends Repository implements MagicLoginLinkRepositoryInterface
{
    protected $model = MagicLoginLink::class;

    public function exportAsCsv(int $id)
    {
        return (new MagicLoginLinksExport($id))->download('magic_login_links.csv', Excel::CSV);
    }
}
