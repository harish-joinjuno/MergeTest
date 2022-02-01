<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $published_content
 * @property string $working_content
 * @property string $section_name
 * @property string $target_page
 * @property Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PageSection extends Model
{
    const PAGE_CAMPUS_AMBASSADOR_DASHBOARD = 'Campus Ambassador Dashboard';
    const PAGE_BAR_LOAN_STATUS             = 'Bar Loan Status';
    const PAGE_ELIGIBILITY                 = 'Eligibility';
    const PAGE_FIXED_VS_VARIABLE           = 'Fixed vs Variable';

    protected $fillable = [
        'working_content',
        'published_content',
        'section_name',
        'target_page',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
