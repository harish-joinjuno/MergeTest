<?php

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\Events\UpdateSociallyPowered;
use App\NegotiationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::any('sandbox', 'SandboxController');
Route::any('/webhooks/twilio', 'Webhooks\TwilioWebhookController')->name('webhook.twilio');
Route::any('/webhook/ses-bounce','Webhooks\SesWebhookController@registerBounce');
Route::any('/webhook/ses-complaint','Webhooks\SesWebhookController@registerComplaint');
Route::any('/webhook/ses-open-or-click','Webhooks\SesWebhookController@registerOpenOrClick');
Route::any('/webhooks/mailchimp','Webhooks\MailChimpWebhookController');
Route::any('/webhooks/facebook','Webhooks\FacebookController');

Route::post('/webhook/bold', 'Webhooks\BoldWebhookController@store')->middleware('bold');
Route::any('/webhooks/calendly', 'Webhooks\CalendlyWebhookController');

Route::get('investor-dashboard','InvestorDashboardController@index');




Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/home/v2', 'WelcomeController@indexV2')->name('welcome.v2');
Route::get('/our-story', 'WelcomeController@ourStory');
Route::get('/contact', 'WelcomeController@contact');
Route::get('/about-us', 'WelcomeController@aboutUs');

Route::get('/leveredge-is-now-juno', 'WelcomeController@brandTransition');

//Route::get('/data-transparency','DataTransparencyController@index');
//Route::get('/data-transparency/submit-a-quote','DataTransparencyController@showSubmitQuote');
//Route::post('/data-transparency/submit-a-quote','DataTransparencyController@storeSubmitQuote');

//Route::get('earnest-hand-off-2','DealHandOffController@earnestHandOffTwo');

Route::get('/accessibility','WelcomeController@accessibility');


Route::get('/partner','WelcomeController@partnerships');
Route::get('/p/{landingPage}', 'WelcomeController@getPartnerships')->middleware('check-partnerships-referral');



Route::get('/loans/undergraduate','WelcomeController@undergraduate');
Route::get('/loans/undergraduate/temple','WelcomeController@temple');
Route::get('/loans/undergraduate/temple/v2','WelcomeController@templeV2');
Route::get('/loans/graduate','WelcomeController@graduate');
Route::get('/loans/refinance','WelcomeController@refinance');
Route::get('/loans/refinance/v2','WelcomeController@refinanceV2');
Route::get('/loans/refinance/v3','WelcomeController@refinanceV3');
Route::get('/loans/refinance/v4','WelcomeController@refinanceV4');
Route::get('/loans/refinance/v5','WelcomeController@refinanceV5');
Route::get('/loans/refinance/v6','WelcomeController@refinanceV6');
Route::get('/loans/refinance/v7','WelcomeController@refinanceV7');
Route::get('/loans/refinance/v8','WelcomeController@refinanceV8');
Route::get('/loans/parent-undergraduate','WelcomeController@parentUndergraduate');


//// TODO: Only for Testing. Remove after Testing
//Route::get('/loans/earnest-graduate-deal','WelcomeController@earnestGraduateDeal');
//Route::get('/loans/commonbond-mba-deal','WelcomeController@commonbondMbaDeal');
//Route::get('/loans/credible-graduate-deal','WelcomeController@credibleGraduateDeal');

/*
 * Voila Campaign Page Merge. Lots of Integration Issues (like Header and Footer)
 */
//Route::get('/campaign',function() {
//    return view('campaign');
//});

Route::get('fixed-vs-variable-20-21','WelcomeController@fixedVsVariable');
Route::get('federal-vs-private-20-21','WelcomeController@privateVsFederal');

Route::get('/join/in-school/law','WelcomeController@redirectToHome');

Route::get('/reviews', 'WelcomeController@reviews');
Route::get('/press', 'WelcomeController@press');
Route::get('/our-track-record', 'WelcomeController@ourTrackRecord');
Route::get('/how-it-works', 'WelcomeController@howItWorks');
Route::get('/covid-no-deadline','WelcomeController@covidNoDeadline');
Route::get('/recommendations','WelcomeController@recommendations');
Route::get('/templates','WelcomeController@templates');
Route::get('/blog/matt','WelcomeController@blogMatt');
Route::get('/eligibility', 'WelcomeController@eligibility');

Route::get('/federal-loan-tracker', 'FederalLoanTrackerController@index');
Route::post('/federal-loan-tracker', 'FederalLoanTrackerController@register');

// Blog
Route::group(['prefix' => 'financial-literacy'], function () {
    Route::get('/', 'BlogPostController@index')->name('blog.financial-literacy');
    Route::get('/{slug}', 'BlogPostController@show')->name('blog.financial-literacy.post');
    ;
});

// Insurance Routes
Route::group(['prefix' => 'insurance'], function () {
    Route::get('/international-health', 'InsuranceController@internationalHealth');
    Route::get('/international-health-terms','InsuranceController@internationalHealthTerms');
});

Route::get('/opt-in-for-fall-2020/confirm-loan-amount','Fall2020OptInController@showConfirmLoanAmount');
Route::post('/opt-in-for-fall-2020/confirm-loan-amount','Fall2020OptInController@storeLoanAmount');
Route::get('/opt-in-for-fall-2020/confirm-profile','Fall2020OptInController@showConfirmProfile');
Route::post('/opt-in-for-fall-2020/confirm-profile','Fall2020OptInController@updateProfile');
Route::get('/opt-in-for-fall-2020/all-set','Fall2020OptInController@showAllSet');
Route::get('/opt-in-for-fall-2020/{user}', 'Fall2020OptInController@index')->name('fall-2020-opt-in.index');

Route::get('/opt-in-for-refinance/confirm-loan-amount','RefinanceOptInController@showConfirmLoanAmount');
Route::post('/opt-in-for-refinance/confirm-loan-amount','RefinanceOptInController@storeLoanAmount');
Route::get('/opt-in-for-refinance/confirm-profile','RefinanceOptInController@showConfirmProfile');
Route::post('/opt-in-for-refinance/confirm-profile','RefinanceOptInController@updateProfile');
Route::get('/opt-in-for-refinance/all-set','RefinanceOptInController@showAllSet');
Route::get('/opt-in-for-refinance/{user}', 'RefinanceOptInController@index')->name('refinance-opt-in.index');

Route::get('/get-my-deal/please-login','DealShowcaseController@pleaseLogin');
Route::get('/get-my-deal/{user}','DealShowcaseController@getMyDeal')->name('get-my-deal.index');
Route::get('/get-my-refinance-deal/{user}','DealShowcaseController@getMyRefinanceDeal')->name('get-my-refinance-deal.index');
Route::get('/international-deal/{user}', 'DealShowcaseController@getInternationalDeal')->name('international-email.index');
Route::get('/refinance-deal-2020/{user}', 'DealShowcaseController@getNonMedicalInFrOrSplash')->name('non-medical-in-fr-or-splash.index');
Route::get('/international-students-deal/{user}', 'DealShowcaseController@getInternationalStudentsWithNoUniversity')->name('international-students-with-no-university.index');


Route::get('/financial-aid-tracker', 'FinancialAidTrackerController@index');
Route::post('/financial-aid-tracker', 'FinancialAidTrackerController@store')->name('financial-aid-tracker.store');
Route::post('/financial-aid-tracker/chart-data', 'FinancialAidTrackerController@getChartData');

Route::get('compare-law-school-offers','CompareLawSchoolOffersController@index');
Route::get('compare-law-school-offers/results','CompareLawSchoolOffersController@showResults');
Route::post('compare-law-school-offers/download-results','CompareLawSchoolOffersController@downloadResults');

Route::get('google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('google/callback', 'Auth\LoginController@handleProviderGoogleCallback');
Route::get('facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');
Route::get('doximity', 'Auth\LoginController@redirectToDoximityProvider');
Route::get('doximity/callback', 'Auth\LoginController@handleDoximityProviderCallback');
Route::get('/socials/email', 'Auth\LoginController@showEmailForm');
Route::post('/socials/email', 'Auth\LoginController@storeEmailFromSocial')->name('socials.email');


Route::get('competition/verify-email','SchoolVsSchoolCompetitionController@showVerifyEmailRequest');
Route::get('competition-entrant/{competition_entrant_id}','SchoolVsSchoolCompetitionController@showEntrant');
Route::post('competition-entrant/{competition_entrant_id}','SchoolVsSchoolCompetitionController@savePartyHost');
Route::get('competition/verify-email/{verification_code}','SchoolVsSchoolCompetitionController@verifyEmail');
Route::get('competition/{competition_entrant_id}/last-step','SchoolVsSchoolCompetitionController@showLastStep');
Route::post('competition/{competition_entrant_id}/last-step','SchoolVsSchoolCompetitionController@saveName');
Route::post('competition/{competition_entrant_id}/share-via-email', 'SchoolVsSchoolCompetitionController@shareViaEmail');
Route::get('competition/{competition_id}','SchoolVsSchoolCompetitionController@showCompetition');
Route::post('competition/{competition_id}','SchoolVsSchoolCompetitionController@registerEntrantToCompetition');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('register-referral', 'RegisterReferralController@showReferralRegistrationForm')->name('register.referral')->middleware('guest');
Route::post('register-referral', 'RegisterReferralController@registerForReferralProgram')->middleware('guest');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/new/{user}', 'Auth\NewPasswordController')->name('password.new');
Route::post('password/new', 'Auth\NewPasswordController@store')->name('password.new_store')->middleware('auth');
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('/marketing-emails-unsubscribe', 'UnsubscribeController@manualUnsubscribe')->name('marketing-email-unsubscribe');
//Route::post('update-calendly-events', 'UserProfileController@updateCalendlyEvent');


Route::get('/test-prep/college-test-prep','TestPrepController@collegeTestPrep');
Route::get('/test-prep/college-test-prep/v1','TestPrepController@bulkBuyV1');
Route::get('/test-prep/college-test-prep/v2','TestPrepController@bulkBuyV2');
Route::get('/test-prep/college-test-prep/v3','TestPrepController@bulkBuyV3');
Route::get('/test-prep/bar-prep','BarPrepController@index');
Route::get('/test-prep/bar-prep/success','BarPrepController@success')->middleware('redirect-users-with-bar-prep-app-started');

Route::group(['prefix' => 'group'], function () {
    Route::get('/undergraduate', 'GroupCampaignController@undergraduate')->name('group.undergrad');
    Route::get('/graduate', 'GroupCampaignController@graduate')->name('group.grad');
    Route::get('/mba', 'GroupCampaignController@mba')->name('group.mba');
});

Route::get('/negotiated-in-school-deal', 'ExpiredDealController@index')->name('negotiated-in-school-deal');

Route::get('/negotiated-in-school-deal/how-to-switch-loan-provider', 'InSchoolController@showHowToSwitchLoanProvider');

Route::get('/credible-in-school', 'InSchoolController@redirectToCredible');

Route::get('/federal-vs-negotiated-deal-calculator', 'CalculatorController@showFederalVsNegotiatedCalculator');
Route::get('/student-loan-comparison-calculator', 'CalculatorController@showStudentLoanComparisonCalculator');
Route::get('/commonbond-mba-loan-calculator', 'CalculatorController@showCommonbondMbaCalculator');
Route::get('/federal-student-loan-cost-calculator', 'CalculatorController@showFederalStudentLoanCost');
Route::get('/calculator/graduate/compare-my-options', 'CalculatorController@compareMyOptions');
Route::get('/calculator/refinance/compare-my-options', 'CalculatorController@compareMyRefinanceOptions');


Route::get('/affiliate-tracking.png', function () {
    return response()->file(public_path('img/tracking-pixel.png'));
});
Route::get('/tracking-pixel.png', function () {
    return response()->file(public_path('img/tracking-pixel.png'));
});


/*
 * Subscription Controller
 * TODO: Move this inside their login portal
 * TODO: Come up with an overall strategy for managing unsubscribe requests: marketing emails, account emails, etc.
 * TODO: We should not be using the MailChimp unsubscribe function that unsubscribes a user from everything
 * TODO: We should use a more granular strategy.
 */
Route::get('/unsubscribe', 'UnsubscribeController@index');
Route::get('/unsubscribe/success', 'UnsubscribeController@success');
Route::post('/unsubscribe', 'UnsubscribeController@update');


/*
 * Make An Informed Decision - Campaign
 * Fall 2019 Campaign to encourage students to post about their experience in a group chat of students
 * TODO: Feature this page more prominently in the associated email.
 * TODO: Implement this as something that gets tracked so we know which users used it, redeemed reward etc.
 */
Route::get('/make-an-informed-decision', function () {
    return view('make-an-informed-decision');
});
Route::get('/make-an-informed-decision-health', function () {
    return view('make-an-informed-decision-health');
});
/*
 * College Costs Database
 */
Route::get('/college-costs', 'UniversityFinancialDataController@showSummary');
Route::get('/college-costs/{university_slug}', 'UniversityFinancialDataController@showSchoolData');
Route::post('/college-costs', 'UniversityFinancialDataController@showSummary');
Route::post('/college-costs/{university_slug}', 'UniversityFinancialDataController@showSchoolData');


/*
 * Legal Related Pages
 */
Route::get('/legal', function () {
    return view('legal/home');
});
Route::get('/privacy', function () {
    return view('legal/privacy');
});
Route::get('/terms-of-use', function () {
    return view('legal/terms-of-use');
});
Route::get('/how-we-make-money', function () {
    return view('legal/how-we-make-money');
});
Route::get('leveredge-rewards/terms',function() {
    return view('member.leveredge-rewards.terms');
});
Route::get('leveredge-rewards/terms-refinance',function() {
    return view('member.leveredge-rewards.terms-refinance');
});
Route::get('/2020rewardsprogram','RewardsProgramController@redirectToRewardsClaimForm');

/*
 * Mailing List Download
 * TODO: Send Laurel Road an updated mailing list to get maximum revenue from partnership
 */
Route::get('mailing-list-download/student-loan', 'MailingListDownloadController@downloadStudentLoanList');

/*
 * Home page (for borrowers, lenders, partners, everyone)
 * Post Login
 */
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['logged-in'])->prefix('member/partners')->group(function () {
    Route::post('claims', 'PartnerClaimController@store')->name('partner.claim.store');
});

/*
 * Post-Login Partner Routes
 */

// Mark Task Complete Route (for Campus Ambassador Tasks)
Route::get('/mark-task-complete/{task}', 'CampusAmbassadorTaskController@showMarkTaskCompleteForm')->name('campus-ambassador-tasks.mark-complete');
Route::post('/mark-task-complete/{task}', 'CampusAmbassadorTaskController@markTaskComplete');


/*
 * Partnership Pages
 * TODO: Move into Users Table (as partners)
 * TODO: Consolidate into simpler routes
 * TODO: Create dedicated landing pages (if appropriate)
 * TODO: Move away from access codes to affiliate codes, we are no longer tracking access codes
 */

Route::get('/negotiated-in-school-deal/accepted', 'RedirectController@redirectAcceptedMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/clearadmit',
    'RedirectController@redirectClearAdmitMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/gmat-club', 'RedirectController@redirectGMATClubMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/princeton-review',
    'RedirectController@redirectPrincetonReviewMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/princetonreview',
    'RedirectController@redirectPrincetonReviewMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/kaplan', 'RedirectController@redirectKaplanMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/wsj',
    'RedirectController@redirectWallStreetJournalMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/above-the-law',
    'RedirectController@redirectAboveTheLawMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/blueprint', 'RedirectController@redirectBluePrintMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/gmac', 'RedirectController@redirectGMACMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/mlt', 'RedirectController@redirectMLTMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/poets-and-quants',
    'RedirectController@redirectPoetsAndQuantsMembersToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/fb', 'RedirectController@redirectFacebookToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/ivy-advisors', 'RedirectController@redirectIvyAdvisorsToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/nagps', 'RedirectController@redirectNAGPSToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/duke-law', 'RedirectController@redirectDukeLawToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/cornell-law', 'RedirectController@redirectCornellLawToStudentLoanDeal');
Route::get('/negotiated-in-school-deal/columbia-med', 'RedirectController@redirectColumbiaMedToStudentLoanDeal');


/*
 * Archive Earnest Deal, Redirect Users to Home Page
 */
Route::get('/negotiated-refinance-deal', 'ExpiredDealController@index');
Route::get('/negotiated-refinance-deal/*', 'ExpiredDealController@index');


/*
 * Partnerships
 */
Route::get('/nagps', 'PartnershipController@nagps');
Route::get('/spivey-consulting', 'PartnershipController@spivey');
Route::get('/above-the-law', 'PartnershipController@aboveTheLaw');



Route::get('/fall-2020-campaign', 'WelcomeController@showFall2020Campaign');
Route::get('/refinance-campaign','WelcomeController@showRefinanceCampaign');
Route::get('/refinance-campaign-for-ada','WelcomeController@showRefinanceCampaignForAda');
Route::get('/future-fall-2020-campaign', 'WelcomeController@showFutureFall2020Campaign');

/**
 * File handle routes
 */
Route::get('download', 'FileController@download')->middleware('auth')->name('files.download');
Route::post('file-upload', 'FileController@upload');


/*
 * Adding Temporary Redirects for Schools
 */
Route::get('/school/{school}', 'WelcomeController@temporaryRedirectToHome');

Route::get('/loans/international-refinance','WelcomeController@internationalRefinance');

Route::middleware(['logged-in','rp-member'])->prefix('member')->group(function() {
    Route::get('/referral-program', 'ReferralProgramController@index');
    Route::get('/referral-program/{id}', 'ReferralProgramController@show');
    Route::post('/referral-program-reward-claim', 'ReferralProgramController@storeRewardClaim');
    Route::post('/share-via-email', 'ReferralProgramController@shareViaEmail')->name('share-via-email');
});
Route::get('/member/delete-account/success','DeleteAccountController@success')->name('member.delete-account-success');
Route::middleware(['logged-in','borrower'])->prefix('member')->group(function () {
    Route::get('/dashboard', 'MemberDashboardController')->name('member.dashboard');
    Route::get('/delete-account','DeleteAccountController@show')->name('member.delete-account');
    Route::post('/delete-account','DeleteAccountController@delete')->name('member.remove-account');
    Route::post('/dismiss-notification/{actionNotification}', 'MemberDashboardController@dismissNotification');
    Route::post('/join-negotiation-group','NegotiationGroupUserController@join');
    Route::post('/leave-negotiation-group','NegotiationGroupUserController@leave');

    Route::get('/academic-year-21-22/post-auth', 'WelcomeController@academicYear2122');
    Route::get('/academic-year-21-22-undergraduate/post-auth', 'WelcomeController@academicYear2122Undergraduate');
    Route::get('/academic-year-21-22-graduate/post-auth', 'WelcomeController@academicYear2122Graduate');
    Route::get('/academic-year-21-22-mba/post-auth', 'WelcomeController@academicYear2122Mba');
    Route::get('/international-academic-year-21-22/post-auth', 'WelcomeController@internaltionalAcademicYear2122');
    Route::get('/international-refi/post-auth','WelcomeController@internationalRefinancePostAuth');

    Route::get('/test-prep/college-test-prep/post-auth','TestPrepController@collegeTestPrepPostAuth');

    Route::get('/academic-year/{academicYear}', 'MemberDashboardController@redirectToNegotiationGroup');

    Route::get('screenshot-reward','ScreenshotClaimController@index');
    Route::post('screenshot-reward','ScreenshotClaimController@store');

    Route::get('/deal/{deal_slug}/hand-off','DealHandOffController@handOff');

    Route::get('/reward-claim', 'RewardsProgramController@getRewardClaim');
    Route::post('/reward-claim', 'RewardsProgramController@postRewardClaim');
    Route::get('/reward-claim/success', 'RewardsProgramController@success');
    Route::get('/reward-claim/success/v2', 'RewardsProgramController@successV2');
    Route::get('/reward-claim/success/v3', 'RewardsProgramController@successV3');
    Route::post('/get-reward-amount', 'RewardsProgramController@getRewardAmount');
//    Route::get('refinance-schedule-call', 'UserProfileController@refinanceScheduleCall')->name('refinance.schedule-call');

    Route::group(['prefix' => 'negotiation-group/{id}'],function() {
        Route::get('/','DealShowcaseController@showRecommendedDeal');
        Route::get('/fixed-deal','DealShowcaseController@showRecommendedFixedDeal');
        Route::get('/variable-deal','DealShowcaseController@showRecommendedVariableDeal');

        Route::get('/earnest-graduate-deal','DealShowcaseController@earnestGraduateDeal');
        Route::get('/earnest-undergraduate-deal','DealShowcaseController@earnestUndergraduateDeal');
//        Route::get('/commonbond-mba-deal','DealShowcaseController@commonbondMbaDeal');
        Route::get('/credible-graduate-deal','DealShowcaseController@credibleGraduateDeal');
        Route::get('/earnest-refinance-with-rewards-20','DealShowcaseController@earnestRefinanceDealWithNormalRewards');
        Route::get('/earnest-refinance-with-rewards-20-other-states','DealShowcaseController@earnestRefinanceDealWithAlternateRewards');
        Route::get('/gbg-health-insurance-deal','DealShowcaseController@showGbgHealthInsuranceDeal');

        Route::get('/first-republic-refinance-deal','DealShowcaseController@firstRepublicRefinanceDeal');
        Route::get('/alternate-options','DealShowcaseController@showAlternateToFirstRepublicRefinanceDeal');
        Route::get('/first-republic-and-laurel-road','DealShowcaseController@showFirstRepublicAndLaurelRoad');
        Route::get('/laurel-road-deal','DealShowcaseController@showLaurelRoadDeal');

        Route::get('/recommended-deals','DealShowcaseController@showRecommendedDeals');
        Route::get('/recommended-deals/{version}','DealShowcaseController@showRecommendedDealsExperiment');

        Route::get('/pre-deal-recommendation-questions','PreDealRecommendationQuestionsController@showStartPage');
        Route::get('/pre-deal-recommendation-questions/co-signer-question','PreDealRecommendationQuestionsController@showCosignerQuestionPage');
        Route::post('/pre-deal-recommendation-questions/co-signer-question','PreDealRecommendationQuestionsController@storeCosignerInformation');
        Route::get('/pre-deal-recommendation-questions/variable-rates-page','PreDealRecommendationQuestionsController@showVariableRatesPage');
        Route::post('/pre-deal-recommendation-questions/variable-rates-page','PreDealRecommendationQuestionsController@storeVariableRateInformation');
        Route::get('/pre-deal-recommendation-questions/landing','PreDealRecommendationQuestionsController@showLandingPage');

        Route::get('/refinance-deal-recommendation-questions','RefinanceDealRecommendationQuestionsController@showStartPage');
        Route::get('/refinance-deal-recommendation-questions/loan-amount','RefinanceDealRecommendationQuestionsController@showLoanAmountQuestionPage');
        Route::post('/refinance-deal-recommendation-questions/loan-amount','RefinanceDealRecommendationQuestionsController@storeLoanAmount');
        Route::get('/refinance-deal-recommendation-questions/zip-code','RefinanceDealRecommendationQuestionsController@showZipCodeQuestionPage');
        Route::post('/refinance-deal-recommendation-questions/zip-code','RefinanceDealRecommendationQuestionsController@storeZipCode');
        Route::get('/refinance-deal-recommendation-questions/medical','RefinanceDealRecommendationQuestionsController@showMedicalQuestionPage');
        Route::post('/refinance-deal-recommendation-questions/medical','RefinanceDealRecommendationQuestionsController@storeMedical');
        Route::get('/refinance-deal-recommendation-questions/landing','RefinanceDealRecommendationQuestionsController@showLandingPage');
    });
});

//New Refi Flow routes
Route::get('/test/refinance', 'NewRefiFlowController@getRedirectUrl');
Route::get('/refi-fast-flow', 'NewRefiFlowController@newRefiFlow');
Route::group(['prefix' => 'fast-flow'], function () {
    Route::post('answers', 'NewRefiFlowController@postAnswers')->name('fast-flow-answers');
    Route::get('deal', 'NewRefiFlowController@showDeal');
    Route::get('laurel-road', 'NewRefiFlowController@showLaurelRoadEmailPrompt');
    Route::post('name-email', 'NewRefiFlowController@updateNameAndEmail')->name('fast-flow-name-and-email');
    Route::get('skip-step', 'NewRefiFlowController@skipEmailStep');
    Route::get('earnest', 'NewRefiFlowController@showEarnestEmailPrompt');
    Route::get('splash', 'NewRefiFlowController@showSplashEmailPrompt');
});


// Partner Routes
Route::middleware(['logged-in','shehzan'])->prefix('admin/partners')->group(function () {
    Route::get('/create', 'Admin\PartnerController@show')->name('admin.partner.create');
    Route::post('/create', 'Admin\PartnerController@store')->name('admin.partner.store');
    Route::post('/partner-type/store', 'Admin\PartnerController@partnerTypeStore')->name('admin.partner-type.store');
    Route::post('/contract-type/store', 'Admin\PartnerController@contractTypeStore')->name('admin.contract-type.store');
});


Route::get('admin/credible-attribution-issues-v2','CredibleAttributionController@indexV2');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    Route::get('/metrics','MetricsDashboardController@index');
    Route::get('/metrics/daily-performance','MetricsDashboardController@dailyPerformance');
    Route::get('/metrics/deal-performance','MetricsDashboardController@dealPerformance');
    Route::get('/metrics/reward-metrics','MetricsDashboardController@rewardMetrics');

    Route::get('credible-attribution-issues','CredibleAttributionController@index');

    Route::get('credible-attribution-potential-cases','CredibleAttributionController@potentialCases');

    Route::get('gbg/import','Admin\GbgImportController@index');
    Route::post('gbg/import', 'Admin\GbgImportController@import')->name('gbg.import');
    Route::post('gbg/match','Admin\GbgImportController@match');

    // Normal routes
    Route::get('/dashboard', 'AdminDashboardController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'marketing-emails'], function () {
        Route::get('', 'AdminMarketingEmailsController@index')->name('admin-marketing-emails');
        Route::get('download', 'AdminMarketingEmailsController@download')->name('download-marketing-emails');
        Route::get('add-new-rows', 'AdminMarketingEmailsController@addNewRows')->name('add-new-rows');
        Route::get('download-template', 'AdminMarketingEmailsController@downloadTemplate')->name('download-marketing-emails-template');
        Route::post('upload-template', 'AdminMarketingEmailsController@uploadTemplate')->name('upload-template');
        Route::get('delete-rows', 'AdminMarketingEmailsController@deleteRows')->name('delete-rows');
        Route::get('download-delete-template', 'AdminMarketingEmailsController@downloadDeleteRows')->name('download-delete-rows-tempate');
        Route::post('upload-delete-template', 'AdminMarketingEmailsController@uploadDeleteTemplate')->name('upload-delete-template');
    });

    Route::get('view-user-by-phone-number', 'AdminTwilioMessageHistoryController@index');
    Route::post('view-user-by-phone-number', 'AdminTwilioMessageHistoryController@search')->name('admin-user-search-by-phone');

    Route::group(['prefix' => 'imports'], function () {
        Route::get('/', 'AdminDashboardController@getImports');
        Route::get('tracked-links', 'AdminDashboardController@importTrackedLinks');
        Route::get('access-the-deals', 'Admin\AccessTheDealController@index')->name('admin.imports.access-the-deals');
        Route::get('access-the-deals-template', 'Admin\AccessTheDealController@template')->name('admin.imports.access-the-deals-template');
        Route::post('access-the-deals', 'Admin\AccessTheDealController@import')->name('admin.imports.access-the-deals.upload');
        Route::get('facebook-ad-metrics','FacebookAdMetricsImportController@getFacebookAdMetrics');
        Route::get('facebook-ad-metrics-template', 'FacebookAdMetricsImportController@getFacebookAdMetricsTemplate')->name('facebook_ad_metrics.template');
        Route::post('facebook-ad-metrics', 'FacebookAdMetricsImportController@importFacebookAdMetrics')->name('facebook_ad_metrics.import');
        Route::get('laurel-road-refinance-report','LaurelRoadRefinanceReportImportController@show');
        Route::post('laurel-road-refinance-report','LaurelRoadRefinanceReportImportController@import')->name('laurel_road_refinance_report.import');
        Route::get('disclosure-details-repayment-plans','Admin\DisclosureDetailsController@show');
        Route::post('disclosure-details-repayment-plans','Admin\DisclosureDetailsController@import')->name('disclosure_details_repayment_plans.import');
    });

    Route::get('exports/checkbook','CheckbookDetailsController@getCheckbook');
    Route::get('exports/checkbook-report', 'CheckbookDetailsController@getCheckbookReport')->name('checkbook.report');

    Route::get('exports/magic-links','Admin\MagicLinkExportController@show')->name('admin.magic-links');
    Route::post('exports/magic-links','Admin\MagicLinkExportController@download')->name('admin.magic-links.download');


    Route::get('match-laurel-road-refinance-reports','LaurelRoadRefinanceReportImportController@showMatches');
    Route::post('match-laurel-road-refinance-reports','LaurelRoadRefinanceReportImportController@saveMatch');

    Route::get('/missing-access-the-deals-dates','MissingAccessTheDealsDatesController@index');
    Route::get('/join-juno-migrations', 'JoinJunoMigrationsController@getMigrations');
    Route::post('/join-juno-migrations/{joinJunoMigration}', 'JoinJunoMigrationsController@updateMigration');
});


Route::get('/scholarship-databases', 'SearchScholarshipController@index');
Route::get('/browse-mba-scholarships/{school}', function ($school) {
    return redirect("/search-mba-scholarships/{$school}", 301);
});
Route::get('/search-mba-scholarships', 'SearchScholarshipController@searchMbaScholarships');
Route::get('/search-mba-scholarships/{school}', 'SearchScholarshipController@searchMbaScholarshipsForSchool');

Route::get('/browse-law-scholarships/{school}', function ($school) {
    return redirect("/search-law-scholarships/{$school}", 301);
});
Route::get('/search-law-scholarships', 'SearchScholarshipController@searchLawScholarships');
Route::get('/search-law-scholarships/{school}', 'SearchScholarshipController@searchLawScholarshipsForSchool');
Route::get('/general-scholarships', 'SearchScholarshipController@generalScholarships');
Route::get('/search-general-scholarships', 'SearchScholarshipController@searchGeneralScholarships');

Route::group(['prefix' => 'press-releases'], function () {
    Route::get('', 'PressReleaseController@index');
    Route::get('/{id}', 'PressReleaseController@detailed')->name('press-releases-detailed');
});
Route::group(['prefix' => 'helpscout'], function() {
    Route::post('send-message', 'HelpScoutController@sendMessage');
    Route::post('member', 'HelpScoutController@getMember');
});

Route::get('variable-forecast', function () {
    return view('variable-forecast');
});

Route::get('/law-student-loan-guide', function () {
    return view('law-student-loan-guide');
});

Route::get('campaigns/test', 'WelcomeController@testCampaign');

Route::get('loans/auto-refinance', 'AutoRefinanceController@index')->name('auto-refinance.index');
Route::get('loans/auto-refinance/v2', 'AutoRefinanceController@indexv2');
Route::get('loans/auto-refinance/v3', 'AutoRefinanceController@indexv3');
Route::get('loans/auto-refinance/v4', 'AutoRefinanceController@indexv4');
Route::get('loans/auto-refinance/v5', 'AutoRefinanceController@indexv5');
Route::get('loans/auto-refinance/v6', 'AutoRefinanceController@indexv6');
Route::get('loans/auto-refinance/v7', 'AutoRefinanceController@indexv7');
Route::get('loans/auto-refinance/v8', 'AutoRefinanceController@indexv8');
Route::get('loans/auto-refinance/v9', 'AutoRefinanceController@indexv9');
Route::get('loans/auto-refinance/redirect', 'AutoRefinanceController@getRedirectUrl')->name('auto_refinance-get_redirect');
Route::get('/loans/auto-refinance/post-auth','AutoRefinanceController@autoRefinancePostAuth')->middleware('redirect-users-without-complete-application');
Route::get('/loans/auto-refinance/post-auth/v2','AutoRefinanceController@autoRefinancePostAuthLeaderboard')->middleware('redirect-users-without-complete-application');
Route::get('/loans/auto-refinance/post-auth/v3','AutoRefinanceController@autoRefinancePostAuthVisualized')->middleware('redirect-users-without-complete-application');

Route::group(['prefix' => 'loans/auto-refinance/get-started','middleware'=>'redirect-users-with-complete-application'], function () {
    Route::get('/end', 'AutoRefinanceController@getEndScreen')->name('auto_refinance_end_screen');
    Route::get('{version}', 'AutoRefinanceController@start')->name('auto_refinance-start');
    Route::post('vehicle_details', 'AutoRefinanceController@saveVehicleInfo')->name('auto_refinance-save_vehicle_details');
    Route::get('{version}/payment_info', 'AutoRefinanceController@paymentInfo')->name('auto_refinance-payment_info');
    Route::post('payment_info', 'AutoRefinanceController@savePaymentInfo')->name('auto_refinance-save_payment_info');
    Route::get('{version}/personal_info', 'AutoRefinanceController@personalInfo')->name('auto_refinance-personal_info');
    Route::post('personal_info', 'AutoRefinanceController@savePersonalInfo')->name('auto_refinance-save_personal_info');
    Route::get('{version}/housing_info', 'AutoRefinanceController@housingInfo')->name('auto_refinance-housing_info');
    Route::post('housing_info', 'AutoRefinanceController@saveHousingInfo')->name('auto_refinance-save_housing_info');
    Route::get('{version}/employment_info', 'AutoRefinanceController@employmentInfo')->name('auto_refinance-employment_info');
    Route::post('employment_info', 'AutoRefinanceController@saveEmploymentInfo')->name('auto_refinance-save_employment_info');
    Route::get('{version}/password', 'AutoRefinanceController@password')->name('auto_refinance-password');
    Route::post('password', 'AutoRefinanceController@savePassword')->name('auto_refinance-save_password');
    Route::get('{version}/ssn', 'AutoRefinanceController@ssn')->name('auto_refinance-ssn_info');
    Route::post('ssn', 'AutoRefinanceController@saveSsn')->name('auto_refinance-save_ssn_info');
    Route::get('{version}/done', 'AutoRefinanceController@done')->name('auto_refinance-done');
    //v2
    //Route::get('/v2', 'AutoRefinanceController@index');
});


Route::get('payments-test-prep','TestPrepPaymentTestController@show');
Route::get('payments-test-prep/payment','TestPrepPaymentTestController@paymentInfo');
Route::get('payments/failed','TestPrepPaymentTestController@fail');

Route::get('scholarship','ScholarshipController@index');
Route::get('scholarship/terms','ScholarshipController@terms');
Route::get('scholarship/holiday-giveaway-terms','ScholarshipController@holidayGiveawayTerms');
Route::get('scholarship/{scholarship}','ScholarshipController@show');
Route::post('scholarship/{scholarship}','ScholarshipController@saveEntrant');
Route::get('scholarship/{scholarship}/entrant/{scholarshipEntrant}','ScholarshipController@success');


//New user flow routes

Route::group(['prefix' => 'user-profile', 'middleware' => ['logged-in','borrower']], function () {
    Route::get('loan-type', 'UserLoanTypeController@index')->name('user-profile.loan-type');
    Route::post('loan-type', 'UserLoanTypeController@storeLoanType')->name('user-profile.choose-loan-type');
    Route::get('end', 'EndScreenController')->name('user-profile.end');
    Route::get('refinance/end', 'EndScreenController@refinanceEndScreen')->name('user-profile.refinance-end');
    Route::get('{any}', function() {
        return redirectWithQueryParams(route('user-profile.loan-type'));
    })->where('{any}', '*');
});

Route::get('question-flow/{questionFlow}', 'QuestionFlowController@questionFlowStartPage');
Route::get('question-flow/{questionFlow}/{questionPage}','QuestionFlowController@show');
Route::post('question-flow/{questionFlow}/{questionPage}','QuestionFlowController@save');
Route::post('record-response','SaveQuestionResponse');

Route::get('magic-link/{magicLoginLink}/{user}','MagicLoginLinkController@redirect')->name('magic-login-link');

Route::post('track-event', 'TrackEventController');

Route::group(['prefix' => 'leave-negotiation-group', 'middleware' => ['logged-in', 'borrower']], function () {
    Route::get('/', 'LeaveNegotiationGroup2122Controller@index');
    Route::post('/', 'LeaveNegotiationGroup2122Controller@leave');
    Route::get('/success', 'LeaveNegotiationGroup2122Controller@success');
});

/**
 * Socially Powered Routes
 */
Route::group(['prefix' => 'socially-powered'], function () {
    Route::post('/store', 'SociallyPoweredController@store');
    Route::get('/{accessTheDealId}/redirect', 'SociallyPoweredController@redirectToLender');
    Route::post('/deals', 'SociallyPoweredController@getDealsDetails');
});

Route::prefix('robo-refi')->group(function () {
    Route::get('/', 'RoboRefiController@show');
    Route::post('/', 'RoboRefiController@save');
    Route::get('/success/{id}','RoboRefiController@success');
});

Route::fallback(function() {
    $redirect = \App\Redirect::whereFrom(request()->getPathInfo())->firstOrFail();

    if ($redirect->with_query_parameters) {
        return redirectWithQueryParams($redirect->to);
    }

    return redirect()->to($redirect->to,$redirect->code);
});

Route::get('/loans/graduate-old', function () {
    return view('graduate-old');
});

Route::get('/loans/undergraduate-old', function () {
    return view('undergraduate-old');
});

Route::get('fall-2020-campaign-old', function () {
    $negotiationGroup = NegotiationGroup::where('slug','general-group-20-21')->first();
    return view('fall-2020-campaign-old', compact('negotiationGroup'));
});
