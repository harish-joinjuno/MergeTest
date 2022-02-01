<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MagicLoginLinksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MagicLoginLinkDownloadRequest;
use App\MagicLoginLink;
use App\Repositories\Contracts\MagicLoginLinkRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class MagicLinkExportController extends Controller
{
    protected $magicLoginLinkRepo;

    public function __construct(MagicLoginLinkRepositoryInterface $magicLoginLinkRepo)
    {
        $this->magicLoginLinkRepo = $magicLoginLinkRepo;
    }

    public function show()
    {
        return view('admin.exports.magic-links')
            ->with([
                'magicLoginLinks' => $this->magicLoginLinkRepo->all(),
            ]);
    }

    public function download(MagicLoginLinkDownloadRequest $request)
    {
        return $this->magicLoginLinkRepo->exportAsCsv($request->magic_login_link_id);
    }
}
