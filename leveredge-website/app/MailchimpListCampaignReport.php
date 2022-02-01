<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailchimpListCampaignReport
 * @package App
 * @property int $id
 * @property string $report_id
 * @property string $campaign_title
 * @property string $type
 * @property string $list_id
 * @property boolean $list_is_active
 * @property string $list_name
 * @property string $subject_line
 * @property string $preview_text
 * @property int $emails_sent
 * @property int $abuse_reports
 * @property int $unsubscribed
 * @property int $hard_bounces
 * @property int $soft_bounces
 * @property int $syntax_errors
 * @property int $forwards_count
 * @property int $opens_total
 * @property int $unique_opens
 * @property float $open_rate
 * @property int $clicks_total
 * @property int $unique_clicks
 * @property int $unique_subscriber_clicks
 * @property float $click_rate
 */
class MailchimpListCampaignReport extends Model
{
    protected $fillable = [
        'report_id',
        'campaign_title',
        'type',
        'list_id',
        'list_is_active',
        'list_name',
        'subject_line',
        'preview_text',
        'emails_sent',
        'abuse_reports',
        'unsubscribed',
        'hard_bounces',
        'soft_bounces',
        'syntax_errors',
        'forwards_count',
        'forwards_opens',
        'opens_total',
        'unique_opens',
        'open_rate',
        'clicks_total',
        'unique_clicks',
        'unique_subscriber_clicks',
        'click_rate',
    ];
}
