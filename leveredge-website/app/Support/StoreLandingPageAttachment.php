<?php


namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreLandingPageAttachment
{
    /**
     * Store the incoming file upload.
     *
     * @param  Request  $request
     * @param  Model  $model
     * @return array
     */
    public function __invoke(Request $request, Model $model)
    {
        return [
            'logo'      => $request->logo->store('/landing-pages', 's3_app_public'),
            'logo_name' => $request->logo->getClientOriginalName(),
        ];
    }
}
