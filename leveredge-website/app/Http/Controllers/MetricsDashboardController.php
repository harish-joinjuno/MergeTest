<?php

namespace App\Http\Controllers;

use App\AccessTheDeal;
use App\AnalyticsSource;
use App\Deal;
use App\DealStatus;
use App\LeveredgeRewardClaim;
use App\User;
use App\UserProfile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetricsDashboardController extends Controller
{
    public function index()
    {
        return view('admin.metrics.index');
    }

    public function dailyPerformance()
    {
        $sources = AnalyticsSource::all();

        $userRegistrationByDay = $this->fillMissingDatesWithZero(UserProfile::selectRaw('date(created_at) as date, count(id) as total')
            ->groupBy('date')
            ->whereDate('created_at','>',Carbon::now()->subDays(31))
            ->orderBy('date','asc')
            ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $userRegistrationByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($userRegistrationByDay,7));


        $refinanceUserRegistrationByDay = $this->fillMissingDatesWithZero(UserProfile::selectRaw('date(created_at) as date, count(id) as total')
            ->groupBy('date')
            ->whereDate('created_at','>',Carbon::now()->subDays(31))
            ->where('loan_type','refinance')
            ->orderBy('date','asc')
            ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $refinanceUserRegistrationByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceUserRegistrationByDay,7));

        $clicksByDay = $this->fillMissingDatesWithZero(AccessTheDeal::selectRaw('date(created_at) as date, count(id) as total')
            ->groupByRaw('date')
            ->whereDate('created_at','>',Carbon::now()->subDays(31))
            ->orderBy('date','asc')
            ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $clicksByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($clicksByDay,7));

        $uniqueClicksByDay = $this->fillMissingDatesWithZero(AccessTheDeal::selectRaw('date(created_at) as date, count(distinct user_id) as total')
            ->groupByRaw('date')
            ->whereDate('created_at','>',Carbon::now()->subDays(31))
            ->orderBy('date','asc')
            ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $uniqueClicksByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($uniqueClicksByDay,7));


        $totalUsers        = UserProfile::count();
        $totalDealClicks   = AccessTheDeal::count();
        $totalBeyondClicks = AccessTheDeal::where('loan_status_id','<>',DealStatus::CLICKED_TO_PROVIDER_ID)->count();
        $totalSigned       = AccessTheDeal::where('loan_status_id',DealStatus::SIGNED_THE_LOAN)->sum('loan_amount');

        $totalUniqueDealClicks   = AccessTheDeal::distinct('user_id')->count('user_id');
        $totalUniqueBeyondClicks = AccessTheDeal::where('loan_status_id','<>',DealStatus::CLICKED_TO_PROVIDER_ID)->distinct('user_id')->count('user_id');
        $totalUniqueSigned       = AccessTheDeal::where('loan_status_id',DealStatus::SIGNED_THE_LOAN)->sum('loan_amount');

        $deals = Deal::all();

        $clicksByDeal = DB::table('access_the_deals')
            ->selectRaw('deals.name as name, count(access_the_deals.id) as total')
            ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
            ->groupByRaw('name')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->name => $item->total];
            })
            ->toArray();

        $beyondClickByDeal = DB::table('access_the_deals')
            ->selectRaw('deals.name as name, count(access_the_deals.id) as total')
            ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
            ->where('loan_status_id','<>',DealStatus::CLICKED_TO_PROVIDER_ID)
            ->groupByRaw('name')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->name => $item->total];
            })
            ->toArray();

        $signedOrCertifiedByDeal = DB::table('access_the_deals')
            ->selectRaw('deals.name as name, count(access_the_deals.id) as total')
            ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
            ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
            ->orWhere('loan_status_id', DealStatus::CERTIFIED)
            ->groupByRaw('name')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->name => $item->total];
            })
            ->toArray();

        $signedOrCertifiedAmountByDeal = DB::table('access_the_deals')
            ->selectRaw('deals.name as name, sum(access_the_deals.loan_amount) as total')
            ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
            ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
            ->orWhere('loan_status_id', DealStatus::CERTIFIED)
            ->groupByRaw('name')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->name => $item->total];
            })
            ->toArray();


        $refinanceSignUpsYesterdayBySource = UserProfile::selectRaw('analytics_source_id ,count(id) as total')
            ->whereDate('created_at',  Carbon::now()->subDays(1)->format('Y-m-d'))
            ->groupBy('analytics_source_id')
            ->get()
            ->keyBy('analytics_source_id');

        $refinanceSignUpsEightDaysAgoBySource = UserProfile::selectRaw('analytics_source_id ,count(id) as total')
            ->whereDate('created_at',  Carbon::now()->subDays(8)->format('Y-m-d'))
            ->groupBy('analytics_source_id')
            ->get()
            ->keyBy('analytics_source_id');

        $refinanceClicksYesterdayBySource =
            DB::table('access_the_deals')
                ->selectRaw('analytics_source_id, count(distinct access_the_deals.user_id) as total')
                ->leftJoin('users','users.id','=','access_the_deals.user_id')
                ->leftJoin('user_profiles','user_profiles.user_id','=','users.id')
                ->leftJoin('deals','access_the_deals.deal_id','=','deals.id')
                ->groupBy('user_profiles.analytics_source_id')
                ->where('deal_type_id',4)
                ->whereDate('access_the_deals.created_at', Carbon::now()->subDays(1)->format('Y-m-d'))
                ->get()
                ->keyBy('analytics_source_id');

        $refinanceClicksEightDaysAgoBySource =
            DB::table('access_the_deals')
                ->selectRaw('analytics_source_id, count(distinct access_the_deals.user_id) as total')
                ->leftJoin('users','users.id','=','access_the_deals.user_id')
                ->leftJoin('user_profiles','user_profiles.user_id','=','users.id')
                ->leftJoin('deals','access_the_deals.deal_id','=','deals.id')
                ->groupBy('user_profiles.analytics_source_id')
                ->where('deal_type_id',4)
                ->whereDate('access_the_deals.created_at', Carbon::now()->subDays(8)->format('Y-m-d'))
                ->get()
                ->keyBy('analytics_source_id');


        $signedLoansByDay =
            $this->fillMissingDatesWithZero(
            AccessTheDeal::selectRaw('date(signed_on) as date, count(id) as total')
            ->orderBy('date','asc')
            ->groupBy('date')
            ->whereDate('signed_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
            ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $signedLoansByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($signedLoansByDay,7));

        $signedLoanAmountsByDay =
            $this->fillMissingDatesWithZero(
            AccessTheDeal::selectRaw('date(signed_on) as date, sum(coalesce(loan_amount,estimated_loan_amount)) as total')
                ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
                ->orderBy('date','asc')
                ->groupBy('date')
                ->whereDate('signed_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $signedLoanAmountsByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($signedLoanAmountsByDay,7));

        $appliedLoansByDay =
            $this->fillMissingDatesWithZero(
            AccessTheDeal::selectRaw('date(applied_on) as date, count(id) as total')
                ->orderBy('date','asc')
                ->groupBy('date')
                ->whereDate('applied_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $appliedLoansByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($appliedLoansByDay,7));

        $appliedLoanAmountsByDay =
            $this->fillMissingDatesWithZero(
            AccessTheDeal::selectRaw('date(applied_on) as date, sum(coalesce(loan_amount,estimated_loan_amount)) as total')
                ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
                ->orderBy('date','asc')
                ->groupBy('date')
                ->whereDate('applied_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $appliedLoanAmountsByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($appliedLoanAmountsByDay,7));

        $userRegistrationByDayBySource = [];
        $uniqueClicksByDayBySource     = [];
        $appliedLoansByDayBySource     = [];
        $signedLoansByDayBySource      = [];

        $userRegistrationByDayBySourceMovingAverage = [];
        $uniqueClicksByDayBySourceMovingAverage     = [];
        $appliedLoansByDayBySourceMovingAverage     = [];
        $signedLoansByDayBySourceMovingAverage      = [];

        $combinedUsersClicksAppliedAndSignedBySourceMovingAverage = [];

        /** @var AnalyticsSource $source */
        foreach ($sources as $source) {
            $source_id                                    = $source->id;
            $userRegistrationByDayBySource[$source->name] = $this->fillMissingDatesWithZero(UserProfile::selectRaw('date(created_at) as date, count(id) as total')
                ->groupBy('date')
                ->whereDate('created_at','>',Carbon::now()->subDays(31))
                ->where('analytics_source_id',$source_id)
                ->orderBy('date','asc')
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

            $userRegistrationByDayBySourceMovingAverage[$source->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($userRegistrationByDayBySource[$source->name],7));

            $uniqueClicksByDayBySource[$source->name] = $this->fillMissingDatesWithZero(AccessTheDeal::selectRaw('date(access_the_deals.created_at) as date, count(distinct access_the_deals.user_id) as total')
                ->leftJoin('user_profiles','user_profiles.user_id','=','access_the_deals.user_id')
                ->groupByRaw('date')
                ->whereDate('access_the_deals.created_at','>',Carbon::now()->subDays(31))
                ->where('user_profiles.analytics_source_id',$source_id)
                ->orderBy('date','asc')
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

            $uniqueClicksByDayBySourceMovingAverage[$source->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($uniqueClicksByDayBySource[$source->name],7));

            $appliedLoansByDayBySource[$source->name] =
                $this->fillMissingDatesWithZero(
                    AccessTheDeal::selectRaw('date(applied_on) as date, count(access_the_deals.id) as total')
                        ->leftJoin('user_profiles','user_profiles.user_id','=','access_the_deals.user_id')
                        ->orderBy('date','asc')
                        ->groupBy('date')
                        ->where('user_profiles.analytics_source_id',$source_id)
                        ->whereDate('applied_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                        ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

            $appliedLoansByDayBySourceMovingAverage[$source->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($appliedLoansByDayBySource[$source->name],7));

            $signedLoansByDayBySource[$source->name] =
                $this->fillMissingDatesWithZero(
                    AccessTheDeal::selectRaw('date(signed_on) as date, count(access_the_deals.id) as total')
                        ->leftJoin('user_profiles','user_profiles.user_id','=','access_the_deals.user_id')
                        ->orderBy('date','asc')
                        ->groupBy('date')
                        ->where('user_profiles.analytics_source_id',$source_id)
                        ->whereDate('signed_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                        ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

            $signedLoansByDayBySourceMovingAverage[$source->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($signedLoansByDayBySource[$source->name],7));

            $combinedUsersClicksAppliedAndSignedBySourceMovingAverage[$source->name] = $this->combineCollections(
                [$userRegistrationByDayBySourceMovingAverage[$source->name], $uniqueClicksByDayBySourceMovingAverage[$source->name], $appliedLoansByDayBySourceMovingAverage[$source->name], $signedLoansByDayBySourceMovingAverage[$source->name]],
                ['Users Registered', 'Unique Clicks', 'Applied Loans (#)', 'Signed Loans (#)']
            );
        }

        $refinanceSignedLoansByDay =
            $this->fillMissingDatesWithZero(
            AccessTheDeal::selectRaw('date(signed_on) as date, count(id) as total')
                ->whereHas('deal',function(Builder $query) {
                    $query->where('deal_type_id',4);
                })
                ->orderBy('date','asc')
                ->groupBy('date')
                ->whereDate('signed_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $refinanceSignedLoansByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceSignedLoansByDay,7));

        $refinanceSignedLoanAmountsByDay =
            $this->fillMissingDatesWithZero(
            AccessTheDeal::selectRaw('date(signed_on) as date, sum(coalesce(loan_amount,estimated_loan_amount)) as total')
                ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
                ->where('deal_type_id',4)
//                ->whereHas('deal',function(Builder $query) {
//                    $query->where('deal_type_id',4);
//                })
                ->orderBy('date','asc')
                ->groupBy('date')
                ->whereDate('signed_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $refinanceSignedLoanAmountsByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceSignedLoanAmountsByDay,7));

        $refinanceAppliedLoansByDay =
            $this->fillMissingDatesWithZero(
            AccessTheDeal::selectRaw('date(applied_on) as date, count(id) as total')
                ->whereHas('deal',function(Builder $query) {
                    $query->where('deal_type_id',4);
                })
                ->orderBy('date','asc')
                ->groupBy('date')
                ->whereDate('applied_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $refinanceAppliedLoansByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceAppliedLoansByDay,7));

        $refinanceAppliedLoanAmountsByDay =
            $this->fillMissingDatesWithZero(
            AccessTheDeal::selectRaw('date(applied_on) as date, sum(coalesce(loan_amount,estimated_loan_amount)) as total')
                ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
                ->where('deal_type_id',4)
//                ->whereHas('deal',function(Builder $query) {
//                    $query->where('deal_type_id',4);
//                })
                ->orderBy('date','asc')
                ->groupBy('date')
                ->whereDate('applied_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

        $refinanceAppliedLoanAmountsByDayMovingAverageSevenDays = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceAppliedLoanAmountsByDay,7));


        $refinanceSignedLoansByDayBySource        = [];
        $refinanceSignedLoanAmountsByDayBySource  = [];
        $refinanceAppliedLoansByDayBySource       = [];
        $refinanceAppliedLoanAmountsByDayBySource = [];

        $refinanceSignedLoansByDayBySourceMovingAverage        = [];
        $refinanceSignedLoanAmountsByDayBySourceMovingAverage  = [];
        $refinanceAppliedLoansByDayBySourceMovingAverage       = [];
        $refinanceAppliedLoanAmountsByDayBySourceMovingAverage = [];

        $combinedRefinanceAppliedAndSignedLoansByDayBySourceMovingAverage       = [];
        $combinedRefinanceAppliedAndSignedLoanAmountsByDayBySourceMovingAverage = [];


        foreach ($sources as $source) {
            $refinanceSignedLoansByDayBySource[$source->name] =
            $this->fillMissingDatesWithZero(
                AccessTheDeal::selectRaw('date(signed_on) as date, count(id) as total')
                    ->whereHas('deal',function(Builder $query) {
                        $query->where('deal_type_id',4);
                    })
                    ->whereDate('signed_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                    ->whereHas('user',function(Builder $query) use ($source) {
                        $query->whereHas('profile',function(Builder $query) use ($source) {
                            $query->where('analytics_source_id',$source->id);
                        });
                    })
                    ->groupBy('date')
                    ->orderBy('date','asc')
                    ->get()
                ,Carbon::now()->subDays(30),Carbon::now()->subDays(1)
            );

            $refinanceSignedLoansByDayBySourceMovingAverage[$source->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceSignedLoansByDayBySource[$source->name],7));

            $refinanceSignedLoanAmountsByDayBySource[$source->name] =
                $this->fillMissingDatesWithZero(
                AccessTheDeal::selectRaw('date(signed_on) as date, sum(coalesce(loan_amount,estimated_loan_amount)) as total')
                    ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
                    ->where('deal_type_id',4)
//                    ->whereHas('deal',function(Builder $query) {
//                        $query->where('deal_type_id',4);
//                    })
                    ->whereDate('signed_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                    ->whereHas('user',function(Builder $query) use ($source) {
                        $query->whereHas('profile',function(Builder $query) use ($source) {
                            $query->where('analytics_source_id',$source->id);
                        });
                    })
                    ->groupBy('date')
                    ->orderBy('date','asc')
                    ->get()
                    ,Carbon::now()->subDays(30),Carbon::now()->subDays(1)
                );

            $refinanceSignedLoanAmountsByDayBySourceMovingAverage[$source->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceSignedLoanAmountsByDayBySource[$source->name],7));

            $refinanceAppliedLoansByDayBySource[$source->name] =
                $this->fillMissingDatesWithZero(
                AccessTheDeal::selectRaw('date(applied_on) as date, count(id) as total')
                    ->whereHas('deal',function(Builder $query) {
                        $query->where('deal_type_id',4);
                    })
                    ->whereDate('applied_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                    ->whereHas('user',function(Builder $query) use ($source) {
                        $query->whereHas('profile',function(Builder $query) use ($source) {
                            $query->where('analytics_source_id',$source->id);
                        });
                    })
                    ->groupBy('date')
                    ->orderBy('date','asc')
                    ->get()
                    ,Carbon::now()->subDays(30),Carbon::now()->subDays(1)
                );

            $refinanceAppliedLoansByDayBySourceMovingAverage[$source->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceAppliedLoansByDayBySource[$source->name],7));

            $refinanceAppliedLoanAmountsByDayBySource[$source->name] =
                $this->fillMissingDatesWithZero(
                AccessTheDeal::selectRaw('date(applied_on) as date, sum(coalesce(loan_amount,estimated_loan_amount)) as total')
                    ->leftJoin('deals','deals.id','=','access_the_deals.deal_id')
                    ->where('deal_type_id',4)
//                    ->whereHas('deal',function(Builder $query) {
//                        $query->where('deal_type_id',4);
//                    })
                    ->whereDate('applied_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                    ->whereHas('user',function(Builder $query) use ($source) {
                        $query->whereHas('profile',function(Builder $query) use ($source) {
                            $query->where('analytics_source_id',$source->id);
                        });
                    })
                    ->groupBy('date')
                    ->orderBy('date','asc')
                    ->get()
                    ,Carbon::now()->subDays(30),Carbon::now()->subDays(1)
                );

            $refinanceAppliedLoanAmountsByDayBySourceMovingAverage[$source->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($refinanceAppliedLoanAmountsByDayBySource[$source->name],7));

            $combinedRefinanceAppliedAndSignedLoansByDayBySourceMovingAverage[$source->name] = $this->combineCollections(
                [$refinanceAppliedLoansByDayBySourceMovingAverage[$source->name],$refinanceSignedLoansByDayBySourceMovingAverage[$source->name]],
                ['Applied Loans', 'Signed Loans']
            );

            $combinedRefinanceAppliedAndSignedLoanAmountsByDayBySourceMovingAverage[$source->name] = $this->combineCollections(
                [$refinanceAppliedLoanAmountsByDayBySourceMovingAverage[$source->name],$refinanceSignedLoanAmountsByDayBySourceMovingAverage[$source->name]],
                ['Applied Loans ($)', 'Signed Loans ($)']
            );
        }

        $combinedUsersClicksAppliedAndSigned              = $this->combineCollections(
            [$userRegistrationByDay, $uniqueClicksByDay, $appliedLoansByDay, $signedLoansByDay],
            ['Users Registered', 'Unique Clicks', 'Applied Loans (#)', 'Signed Loans (#)']
        );

        $combinedUsersClicksAppliedAndSignedMovingAverage = $this->combineCollections(
            [$userRegistrationByDayMovingAverageSevenDays, $uniqueClicksByDayMovingAverageSevenDays, $appliedLoansByDayMovingAverageSevenDays, $signedLoansByDayMovingAverageSevenDays],
            ['Users Registered', 'Unique Clicks', 'Applied Loans (#)', 'Signed Loans (#)']
        );


        $combinedAppliedAndSignedAmountsMovingAverage = $this->combineCollections(
            [$refinanceAppliedLoanAmountsByDayMovingAverageSevenDays,$refinanceSignedLoanAmountsByDayMovingAverageSevenDays,$this->getGoal(Carbon::now()->subDays(23),Carbon::now()->subDays(1))],
            ['Applied Loans ($)', 'Signed Loans ($)','Goal']
        );

        return view('admin.metrics.daily-performance')
            ->with(compact([
                'userRegistrationByDay',
                'totalUsers',
                'totalDealClicks',
                'totalBeyondClicks',
                'totalSigned',
                'totalUniqueDealClicks',
                'totalUniqueBeyondClicks',
                'totalUniqueSigned',
                'deals',
                'clicksByDeal',
                'beyondClickByDeal',
                'signedOrCertifiedByDeal',
                'signedOrCertifiedAmountByDeal',
                'userRegistrationByDayMovingAverageSevenDays',
                'clicksByDay',
                'clicksByDayMovingAverageSevenDays',
                'uniqueClicksByDay',
                'uniqueClicksByDayMovingAverageSevenDays',
                'refinanceUserRegistrationByDay',
                'refinanceUserRegistrationByDayMovingAverageSevenDays',
                'sources',
                'refinanceSignUpsYesterdayBySource',
                'refinanceSignUpsEightDaysAgoBySource',
                'refinanceClicksYesterdayBySource',
                'refinanceClicksEightDaysAgoBySource',
                'signedLoansByDay',
                'signedLoanAmountsByDay',
                'appliedLoansByDay',
                'appliedLoanAmountsByDay',
                'refinanceSignedLoansByDay',
                'refinanceSignedLoanAmountsByDay',
                'refinanceAppliedLoansByDay',
                'refinanceAppliedLoanAmountsByDay',

                'signedLoansByDayMovingAverageSevenDays',
                'signedLoanAmountsByDayMovingAverageSevenDays',
                'appliedLoansByDayMovingAverageSevenDays',
                'appliedLoanAmountsByDayMovingAverageSevenDays',

                // To be Plotted
                'refinanceSignedLoansByDayMovingAverageSevenDays',
                'refinanceSignedLoanAmountsByDayMovingAverageSevenDays',
                'refinanceAppliedLoansByDayMovingAverageSevenDays',
                'refinanceAppliedLoanAmountsByDayMovingAverageSevenDays',

                'refinanceSignedLoansByDayBySource',
                'refinanceSignedLoanAmountsByDayBySource',
                'refinanceAppliedLoansByDayBySource',
                'refinanceAppliedLoanAmountsByDayBySource',

                // Multiple To be Plotted
                'refinanceSignedLoansByDayBySourceMovingAverage',
                'refinanceSignedLoanAmountsByDayBySourceMovingAverage',
                'refinanceAppliedLoansByDayBySourceMovingAverage',
                'refinanceAppliedLoanAmountsByDayBySourceMovingAverage',

                'combinedUsersClicksAppliedAndSigned',
                'combinedUsersClicksAppliedAndSignedMovingAverage',
                'combinedRefinanceAppliedAndSignedLoansByDayBySourceMovingAverage',
                'combinedRefinanceAppliedAndSignedLoanAmountsByDayBySourceMovingAverage',
                'combinedAppliedAndSignedAmountsMovingAverage',

                'userRegistrationByDayBySource',
                'uniqueClicksByDayBySource',
                'appliedLoansByDayBySource',
                'signedLoansByDayBySource',
                'userRegistrationByDayBySourceMovingAverage',
                'uniqueClicksByDayBySourceMovingAverage',
                'appliedLoansByDayBySourceMovingAverage',
                'signedLoansByDayBySourceMovingAverage',
                'combinedUsersClicksAppliedAndSignedBySourceMovingAverage',

            ]));
    }

    public function dealPerformance()
    {
        $deals = Deal::all();

        $uniqueClicksByDayByDeal              = [];
        $uniqueClicksByDayByDealMovingAverage = [];

        $applicationsByDayByDeal              = [];
        $applicationsByDayByDealMovingAverage = [];

        $signedLoansByDayByDeal              = [];
        $signedLoansByDayByDealMovingAverage = [];

        $combinedMetricsByDeal              = [];
        $combinedMetricsByDealMovingAverage = [];

        foreach ($deals as $deal) {
            $uniqueClicksByDayByDeal[$deal->name] = $this->fillMissingDatesWithZero(AccessTheDeal::selectRaw('date(created_at) as date, count(distinct user_id) as total')
                ->where('deal_id',$deal->id)
                ->whereDate('created_at','>',Carbon::now()->subDays(31))
                ->groupBy('date')
                ->orderBy('date','asc')
                ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

            $uniqueClicksByDayByDealMovingAverage[$deal->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($uniqueClicksByDayByDeal[$deal->name],7));

            $applicationsByDayByDeal[$deal->name] =
                $this->fillMissingDatesWithZero(
                    AccessTheDeal::selectRaw('date(applied_on) as date, count(id) as total')
                        ->where('deal_id',$deal->id)
                        ->whereDate('applied_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                        ->groupBy('date')
                        ->orderBy('date','asc')
                        ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

            $applicationsByDayByDealMovingAverage[$deal->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($applicationsByDayByDeal[$deal->name],7));

            $signedLoansByDayByDeal[$deal->name] =
                $this->fillMissingDatesWithZero(
                    AccessTheDeal::selectRaw('date(signed_on) as date, count(id) as total')
                        ->where('deal_id',$deal->id)
                        ->whereDate('signed_on','>', Carbon::now()->subDays(31)->format('Y-m-d'))
                        ->groupBy('date')
                        ->orderBy('date','asc')
                        ->get(),Carbon::now()->subDays(30),Carbon::now()->subDays(1));

            $signedLoansByDayByDealMovingAverage[$deal->name] = $this->fillMissingDatesWithZero($this->calculateMovingAverage($signedLoansByDayByDeal[$deal->name],7));

            $combinedMetricsByDeal[$deal->name] = $this->combineCollections(
                [$uniqueClicksByDayByDeal[$deal->name],$applicationsByDayByDeal[$deal->name],$signedLoansByDayByDeal[$deal->name]],
                ['Unique Clicks','Applied Loans','Signed Loans']
            );

            $combinedMetricsByDealMovingAverage[$deal->name] = $this->combineCollections(
                [$uniqueClicksByDayByDealMovingAverage[$deal->name],$applicationsByDayByDealMovingAverage[$deal->name],$signedLoansByDayByDealMovingAverage[$deal->name]],
                ['Unique Clicks','Applied Loans','Signed Loans']
            );
        }

        return view('admin.metrics.deal-performance')->with(compact(
            [
                'combinedMetricsByDeal',
                'combinedMetricsByDealMovingAverage',
            ]
        ));
    }

    public function rewardMetrics()
    {
        $deals = Deal::all();


        $usersWithSignedLoansByDeal                  = [];
        $usersWithRewardClaimsForDeal                = [];
        $claimsByDeal                                = [];
        $rewardClaimForDealWithCompletedDistribution = [];
        $usersWithUnpaidClaimAndSignedLoan = [];

        foreach ($deals as $deal) {
            $usersWithSignedLoansByDeal[$deal->name] = User::whereHas('accessTheDeals',function($query) use ($deal) {
                $query->where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
                    ->where('deal_id',$deal->id);
            })->count();

            $usersWithRewardClaimsForDeal[$deal->name] = User::whereHas('rewardClaims',function($query) use ($deal) {
                $query->where('deal_id',$deal->id);
            })->count();

            $claimsByDeal[$deal->name] = LeveredgeRewardClaim::where('deal_id',$deal->id)->count();

            $rewardClaimForDealWithCompletedDistribution[$deal->name] = LeveredgeRewardClaim::where('deal_id',$deal->id)
                ->whereHas('distributions',function($query) {
                    $query->where('payment_completed',true);
                })->count();

            $usersWithUnpaidClaimAndSignedLoan[$deal->name] = User::whereHas('accessTheDeals',function($query) use ($deal) {
                $query->where('deal_id',$deal->id)
                    ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN);
            })->whereHas('rewardClaims',function($query) use ($deal) {
                $query->where('deal_id',$deal->id)
                    ->whereDoesntHave('distributions',function($query) {
                        $query->where('payment_completed',true);
                    });
            })->count();
        }

        return view('admin.metrics.reward-metrics')->with(compact([
            'deals',
            'usersWithSignedLoansByDeal',
            'usersWithRewardClaimsForDeal',
            'claimsByDeal',
            'rewardClaimForDealWithCompletedDistribution',
            'usersWithUnpaidClaimAndSignedLoan'
        ]));
    }

    /**
     * @param $collection
     * @param $daysToAverage
     * @return array
     */
    private function calculateMovingAverage ($collection, $daysToAverage)
    {
        $array = $collection->mapWithKeys(function($item) {
            return [$item['date'] => $item['total']];
        })->toArray();

        $keys   = array_keys($array);

        $return_value = [];

        foreach ($keys as $index => $key) {
            if ($index < $daysToAverage) {
                continue;
            }

            array_push($return_value,
                [
                    'date'  => $key,
                    'total' => round(array_sum(array_slice($array,$index - $daysToAverage + 1, $daysToAverage)) / $daysToAverage,2),
                ]);
        }

        return $return_value;
    }

    // Assumed Collection has Date and Total
    // Further Assumes Collection is Ordered By Date

    /**
     * @param $collection
     * @param string|null $startDate
     * @param string|null $endDate
     * @return \Illuminate\Support\Collection
     */
    private function fillMissingDatesWithZero($collection, $startDate = null, $endDate = null)
    {
        if (!is_object($collection)) {
            $collection = collect($collection);
        }

        if (!is_null($startDate)) {
            $first_date = $startDate;
        } else {
            if ($collection->count()) {
                $first_date = Carbon::createFromFormat('Y-m-d', $collection->first()['date']);
            } else {
                return $collection;
            }
        }

        if (!is_null($endDate)) {
            $last_date = $endDate;
        } else {
            if ($collection->count()) {
                $last_date  = Carbon::createFromFormat('Y-m-d', $collection->last()['date']);
            } else {
                return $collection;
            }
        }

        $date_range = [];

        for ($currentDate = $first_date; $currentDate->lessThanOrEqualTo($last_date); $currentDate = $currentDate->copy()->addDays(1)) {
            $date_range[] = $currentDate;
        }

        $return_value = collect([]);
        foreach ($date_range as $date) {
            if (!$collection->contains('date',$date->format('Y-m-d'))) {
                $return_value->push(['date' => $date->format('Y-m-d') , 'total' => 0]);
            } else {
                $return_value->push(
                    ['date' => $date->format('Y-m-d'), 'total' => $collection->firstWhere('date',$date->format('Y-m-d'))['total'] ]
                );
            }
        }

        $return_value = $return_value->sortBy('date');

        return $return_value;
    }

    private function combineCollections($collections,$collectionNames)
    {
        // Check if each collection has the same size
        foreach ($collections as $index => $collection) {
            if (!is_object($collection)) {
                $collections[$index] = collect($collection);
                $collection          = $collections[$index];
            }

            if ($index == 0) {
                $expectedCount = $collection->count();
            } else {
                if ($collection->count() != $expectedCount) {
                    \throwException('Unable to combine collections with different lengths');
                }
            }
        }

        // Check if each collection has values for the same dates
        foreach ($collections as $index => $collection) {
            if ($index == 0) {
                $expectedDates = $collection->pluck('date');
            } else {
                if ( count(array_diff($collection->pluck('date')->toArray(),$expectedDates->toArray()))) {
                    throwException('Unable to combine collections with different dates');
                }
            }
        }

        if (count($collections) != count($collectionNames)) {
            throwException('Number of Collection Names do not match Collections Provided');
        }

        $returnArray = [];
        foreach ($collection->pluck('date') as $date) {
            $array         = [];
            $array['date'] = $date;
            foreach ($collectionNames as $index => $collectionName) {
                $array[$collectionName] = $collections[$index]->firstWhere('date','=',$date)['total'];
            }
            array_push($returnArray,$array);
        }

        return collect($returnArray);
    }

    /**
     * @param Carbon $first_date
     * @param Carbon $last_date
     * @param int $goal
     * @return \Illuminate\Support\Collection
     */
    private function getGoal(Carbon $first_date, Carbon $last_date, $goal = 1000000)
    {
        for ($currentDate = $first_date; $currentDate->lessThanOrEqualTo($last_date); $currentDate = $currentDate->copy()->addDays(1)) {
            $date_range[] = $currentDate;
        }

        $return_value = collect([]);
        foreach ($date_range as $date) {
            $return_value->push(
                [
                    'date'  => $date->format('Y-m-d'),
                    'total' => $goal,
                ]
            );
        }

        $return_value = $return_value->sortBy('date');

        return $return_value;
    }
}
