<?php

namespace App\Http\Controllers;

use App\FaqGroup;
use App\NegotiationGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupCampaignController extends Controller
{
    //
    public function undergraduate()
    {
        return view('landing-pages.group.group')
            ->with(array_merge(
                $this->getApplicantData(NegotiationGroup::NG_DOMESTIC_GROUP_21_22),
                [
                    'dealLink' => url('/loans/undergraduate'),
                    'heading'  => 'Get a better deal<br>on student loans for fall 2021.',
                    'faqs'  => FaqGroup::find(FaqGroup::UNDERGRADUATE_PAGE)->questions,
                ]
            ));
    }

    public function graduate()
    {
        $defaultData                           = $this->getApplicantData(NegotiationGroup::NG_GRAD_21_22);
        $defaultData['completed_applications'] = $defaultData['completed_applications'] + NegotiationGroup::find(NegotiationGroup::NG_MBA_21_22)->users_count + 50;

        return view('landing-pages.group.group')
            ->with(array_merge(
                $defaultData,
                [
                    'dealLink' => url('/loans/graduate'),
                    'heading'  => 'Get a better deal<br>on grad student loans for fall 2021.',
                    'faqs'  => FaqGroup::find(FaqGroup::GRADUATE_PAGE)->questions,
                ]
            ));
    }

    public function mba()
    {
        return view('landing-pages.group.group')
            ->with(array_merge(
                $this->getApplicantData(NegotiationGroup::NG_MBA_21_22),
                [
                    'dealLink' => url('/loans/graduate'),
                    'heading'  => 'Get a better deal<br>on MBA student loans for fall 2021.',
                    'faqs'  => FaqGroup::find(FaqGroup::GRADUATE_PAGE)->questions,
                ]
            ));
    }

    /**
     * @param $negotiationGroup
     * @return array
     */
    private function getApplicantData($negotiationGroup): array
    {
        $goals = [
            22 => 10000,
            26 => 6000,
            27 => 8000,
        ];
        $completed_applications = NegotiationGroup::find($negotiationGroup)->users_count + 50;

        return [
            'total_applications'     => $goals[$negotiationGroup],
            'completed_applications' => $completed_applications,
            'days_to_go'             => Carbon::now()->diffInDays('Apr 15, 2021'),
        ];
    }
}
