<?php


namespace App\Contracts;


interface ScholarshipsInterface
{
    const ELIGIBLE_GENDERS = [
        'All'    => 'All',
        'male'   => 'Male',
        'female' => 'Female'
    ];

    const ELIGIBLE_PROTECTED_CLASSES = [
        'All'                                           => 'All',
        'Native Americans'                              => 'Native Americans',
        'Latinos (including Puerto Ricans)'             => 'Latinos (including Puerto Ricans)',
        'African Americans'                             => 'African Americans',
        'Asian Americans'                               => 'Asian Americans',
        'Arab and other Middle Eastern Americans'       => 'Arab and other Middle Eastern Americans',
        "Native Hawai'ians and other Pacific Islanders" => "Native Hawai'ians and other Pacific Islanders",
        'Alaska Natives'                                => 'Alaska Natives',
        'LGBTQ'                                         => 'LGBTQ',
        'Jewish'                                        => 'Jewish',
        'Christian'                                     => 'Christian',
        'Disability'                                    => 'Disability',
        'Methodist'                                     => 'Methodist',
        'Military'                                      => 'Military'
    ];

    const STATES = [
        'AL' => "Alabama",
        'AK' => "Alaska",
        'AZ' => "Arizona",
        'AR' => "Arkansas",
        'CA' => "California",
        'CO' => "Colorado",
        'CT' => "Connecticut",
        'DE' => "Delaware",
        'DC' => "District Of Columbia",
        'FL' => "Florida",
        'GA' => "Georgia",
        'HI' => "Hawaii",
        'ID' => "Idaho",
        'IL' => "Illinois",
        'IN' => "Indiana",
        'IA' => "Iowa",
        'KS' => "Kansas",
        'KY' => "Kentucky",
        'LA' => "Louisiana",
        'ME' => "Maine",
        'MD' => "Maryland",
        'MA' => "Massachusetts",
        'MI' => "Michigan",
        'MN' => "Minnesota",
        'MS' => "Mississippi",
        'MO' => "Missouri",
        'MT' => "Montana",
        'NE' => "Nebraska",
        'NV' => "Nevada",
        'NH' => "New Hampshire",
        'NJ' => "New Jersey",
        'NM' => "New Mexico",
        'NY' => "New York",
        'NC' => "North Carolina",
        'ND' => "North Dakota",
        'OH' => "Ohio",
        'OK' => "Oklahoma",
        'OR' => "Oregon",
        'PA' => "Pennsylvania",
        'RI' => "Rhode Island",
        'SC' => "South Carolina",
        'SD' => "South Dakota",
        'TN' => "Tennessee",
        'TX' => "Texas",
        'UT' => "Utah",
        'VT' => "Vermont",
        'VA' => "Virginia",
        'WA' => "Washington",
        'WV' => "West Virginia",
        'WI' => "Wisconsin",
        'WY' => "Wyoming"
    ];
}
