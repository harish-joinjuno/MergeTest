<?php

namespace App\Http\Controllers\Webhooks;

use App\DisclosureDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisclosureInformationController extends Controller
{
    public function save(Request $request)
    {
        /** @var DisclosureDetail $disclosureDetails */
        $data                                 = json_decode(file_get_contents("php://input"));
        $disclosureDetails                    = DisclosureDetail::findOrFail($data->id);
        $disclosureDetails->response          = $data;
        $disclosureDetails->response_received = true;
        $disclosureDetails->update();

        return response([],200);
    }
}
