<?php

return [

    'laurel_road_loan_status' => [
        'loan_documentation_pending'          => 'LoanDocumentationPending',
        'decision_pending'                    => 'DecisionPending',
        'approved'                            => 'Approved',
        'school_certification_pending_school' => 'SchoolCertificationPendingSchool',
        'certified'                           => 'Certified',
        'loan_approved'                       => 'Signed the Loan',
        'denied'                              => 'Denied',
        'cancelled'                           => 'Cancelled',
    ],

    'earnest_loan_status' => [
        'loan_approved' => 'Signed the Loan',
    ],

    'immigration_status_options' => [
        'U.S. Citizen or U.S. Permanent Resident',
        'Conditional U.S. Permanent Resident',
        'Other',
    ],

    'application_status_options' => [
        ['Yet to Apply', false, false],
        ['Applied - Waiting on Decisions', false, false],
        ['Admitted - Undecided', false, true],
        ['Admitted - Program Selected', true, true],
        ['Current Student', true, true],
        ['Graduated', true, false],
        ['Other', false, true],
    ],

    'enrollment_status_options' => [
        'Full-Time',
        'Half-Time',
        'Part-Time',
        'Other',
    ],

    'degree_format_options' => [
        'On Campus',
        'Online',
        'Blended',
        'Other',
    ],

    'credit_score_options'    => [
        'Above 800',
        '750 - 799',
        '700 - 749',
        '650 - 699',
        '550 - 649',
        'Below 550',
        'Unknown',
        "I don't have a Credit Score",
    ],

    // Format
    // [ Status , Ask for Cosigner Credit Score ]
    'cosigner_status_options' => [
        ["No", false],
        ["Maybe", false],
        ["Yes", true],
    ],

    // MailChimp Tags
    'mailchimp_tags'          => [
        'lead'                  => 'lead',
        'registration_complete' => 'registration_complete',
        'profile_complete'      => 'profile_complete',
    ],

    // User Roles
    'role_options'            => [
        'Student',
        'Parent',
    ],

];
