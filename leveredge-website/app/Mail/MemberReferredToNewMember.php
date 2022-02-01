<?php

namespace App\Mail;

use App\Affiliate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberReferredToNewMember extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $new_member;

    /**
     * MemberReferredToNewMember constructor.
     * @param $referrer
     * @param $new_member
     */
    public function __construct($new_member)
    {
        $this->new_member = $new_member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $referrer = Affiliate::findOrFail( $this->new_member->referred_by_id );

        $data = [];

        if(isset($referrer->name)){
            $data['referrer_name'] = $referrer->name;
        }

        if(isset($this->new_member->name)){
            $data['new_member_name'] = $this->new_member->name;
        }

        if(isset($referrer->code)){
            $data['referrer_code'] = $referrer->code;
        }

        if(isset($this->new_member->code)){
            $data['new_member_code'] = $this->new_member->code;
        }

        $data['referrer_total_referrals'] = count($referrer->referredSubscribers);

        return $this
            ->from('support@leveredge.org', 'LeverEdge')
            ->subject('You were referred by a Friend')
            ->markdown('emails.affiliate.member_referred_to_new_member',$data);
    }
}
