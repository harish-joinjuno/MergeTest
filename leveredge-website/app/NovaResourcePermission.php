<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovaResourcePermission extends Model
{
    const RESOURCE_LIST = [
        Degree::class                                   => 'Degrees',
        MenuLink::class                                 => 'Menu Links',
        PageSection::class                              => 'Page Sections',
        Role::class                                     => 'Roles',
        University::class                               => 'Universities',
        UserProfile::class                              => 'User Profiles',
        User::class                                     => 'Users',
        CampusAmbassadorTask::class                     => 'Campus Ambassador Tasks',
        CompletedCampusAmbassadorTask::class            => 'Completed Campus Ambassador Tasks',
        AccessTheDeal::class                            => 'Access The Deals',
        DealType::class                                 => 'Deal Types',
        Deal::class                                     => 'Deals',
        FeeType::class                                  => 'Fee Types',
        MarketingEmailTemplate::class                   => 'Marketing Email Templates',
        MarketingEmailUnsubscribe::class                => 'Marketing Email Unsubscribes',
        MarketingEmail::class                           => 'Marketing Emails',
        AcademicYear::class                             => 'Academic Years',
        NegotiationGroupAnnouncement::class             => 'Negotiation Group Announcements',
        NegotiationGroupEligibleProfile::class          => 'Negotiation Group Eligible Profiles',
        NegotiationGroupFaq::class                      => 'Negotiation Group Faqs',
        NegotiationGroupUser::class                     => 'Negotiation Group Users',
        FinancialAidTrackerEligibleProgram::class       => 'Financial Aid Tracker Eligible Programs',
        PressRelease::class                             => 'Press Releases',
        Press::class                                    => 'Presses',
        TrackedLink::class                              => 'Tracked Links',
        ContractType::class                             => 'Contract Types',
        LandingPage::class                              => 'Landing Pages',
        PartnerType::class                              => 'Partner Types',
        PaymentMethod::class                            => 'Payment Methods',
        Payment::class                                  => 'Payments',
        ReferralProgramEligibleProfile::class           => 'Referral Program Eligible Profiles',
        ReferralProgramUser::class                      => 'Referral Program Users',
        ReferralProgram ::class                         => 'Referral Programs',
        ReferralRewardClaim::class                      => 'Referral Reward Claims',
        LawScholarship::class                           => 'Law Scholarships',
        MbaScholarship::class                           => 'Mba Scholarships',
        NegotiationGroupFaqCategory::class              => 'Negotiation Group Faq Categories',
        NegotiationGroup::class                         => 'Negotiation Groups',
        LawSchool::class                                => 'Law Schools',
        PartnerProfile::class                           => 'Partner Profiles',
        NovaUser::class                                 => 'Nova Users',
        MailchimpAutomatedCampaign::class               => 'Mailchimp Automated Campaigns',
        LeveredgeRewardClaim::class                     => 'Leveredge Reward Claims',
        MailchimpAutomatedCampaignUser::class           => 'Mailchimp Automated Campaign User',
        File::class                                     => 'Files',
        HeardFromOption::class                          => 'Heard From Options',
        InternationalStudentHealthInsuranceClaim::class => 'International Student Health Insurance Claims',
        Metric::class                                   => 'Partnerships Metric',
        ContractTypeMetric::class                       => 'Partnerships Contract Type Metric',
        LeveredgeRewardDistribution::class              => 'Leveredge Reward Distributions',
        NegotiationGroupUserExclusion::class            => 'Negotiation Group User Exclusions',
        ScreenshotClaim::class                          => 'Screenshot Claims',
        Rate::class                                     => 'Rate',
        RateProperty::class                             => 'Rate Property',
        LandingPageTemplate::class                      => 'Landing Page Template',
        ScholarshipContent::class                       => 'Scholarship Content',
        ScholarshipEmail::class                         => 'Scholarship Email',
        ScholarshipEntrant::class                       => 'Scholarship Entrant',
        ScholarshipQuestion::class                      => 'Scholarship Question',
        ScholarshipTemplate::class                      => 'Scholarship Template',
        ScholarshipWinner::class                        => 'Scholarship Winner',
        Scholarship::class                              => 'Scholarship',
        FederalLoanTrackerEmail::class                  => 'Federal Loan Tracker Email',
        FederalLoanTracker::class                       => 'Federal Loan Tracker',
        CareerOneStopScholarship::class                 => 'Career One Stop Scholarship',
        ClientEvent::class                              => 'Client Event',
        Client::class                                   => 'Client',
        Content::class                                  => 'Content',
        DeleteRequest::class                            => 'Delete Request',
        FootNote::class                                 => 'Foot Note',
        MagicLoginLink::class                           => 'Magic Login Link',
        MailchimpAutomatedCampaignMailable::class       => 'Mailchimp Automated Campaign Mailable',
        NegotiationGroupUserLeave::class                => 'Negotiation Group User Leave',
        QuestionFlowResponder::class                    => 'Question Flow Responder',
        QuestionPageResponder::class                    => 'Question Page Responder',
        QuestionResponder::class                        => 'Question Responder',
        Redirect::class                                 => 'Redirect',
        SocialProvider::class                           => 'Social Provider',
        TableauDashboard::class                         => 'Tableau Dashboard',
        PartnerClaim::class                             => 'Partner Claim',
        QuestionFlow::class                             => 'Question Flow',
        QuestionPage::class                             => 'Question Page',
        Question::class                                 => 'Question',
        SchoolVsSchoolCompetitionEntrant::class         => 'School vs School Competition Entrant',
        SchoolVsSchoolCompetition::class                => 'School vs School Competition',
        UserProfileHeardFromOther::class                => 'User Profile Heard From Other',
    ];

    const PERMISSION_CRUD   = 'crud';

    const PERMISSION_READ   = 'read';

    const PERMISSION_CREATE = 'create';

    const PERMISSION_UPDATE = 'update';

    const PERMISSION_DELETE = 'delete';

    const PERMISSIONS       = [
        self::PERMISSION_CRUD   => 'Create, Read, Update, Delete',
        self::PERMISSION_READ   => 'Read Only',
        self::PERMISSION_CREATE => 'Create Only',
        self::PERMISSION_UPDATE => 'Update Only',
        self::PERMISSION_DELETE => 'Delete Only',
    ];

    public function novaUser()
    {
        return $this->belongsTo(NovaUser::class, 'user_id');
    }
}
