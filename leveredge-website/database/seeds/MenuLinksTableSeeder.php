<?php

use App\MenuLink;
use Illuminate\Database\Seeder;

class MenuLinksTableSeeder extends Seeder
{
    public function run()
    {
        $this->authDropdown();
        $this->authHeader();
        $this->header();
        $this->company();
        $this->copyright();
        $this->product();
    }

    private function header()
    {
        $link        = new MenuLink();
        $link->menu  = 'header';
        $link->href  = '/negotiated-in-school-deal';
        $link->label = 'Graduate Student Loan';
        $link->save();

        $parent         = new MenuLink();
        $parent->weight = 1;
        $parent->menu   = 'header';
        $parent->href   = '#';
        $parent->label  = 'About Us';
        $parent->save();

        $links = [
            ['label' => 'Our Track Record', 'weight' => '0', 'href' => 'https://leveredge.org/our-track-record'],
            ['label' => 'Our Story', 'weight' => '0', 'href' => 'https://leveredge.org/our-story'],
            ['label' => 'Careers', 'weight' => '0', 'href' => 'https://jobs.lever.co/leveredge'],
            ['label' => 'Reviews', 'weight' => '1', 'href' => 'https://app.leveredge.org/reviews'],
            ['label' => 'Press', 'weight' => '3', 'href' => 'https://leveredge.org/press'],
            ['label' => 'Contact Us', 'weight' => '5', 'href' => 'https://leveredge.org/contact'],
        ];

        foreach ($links as $data) {
            $link       = new MenuLink();
            $link->menu = 'header';

            $link->weight = $data['weight'];
            $link->href   = $data['href'];
            $link->label  = $data['label'];

            $link->parent_id = $parent->id;
            $link->save();
        }

        $parent         = new MenuLink();
        $parent->weight = 1;
        $parent->menu   = 'header';
        $parent->href   = '#';
        $parent->label  = 'Learn More';
        $parent->save();

        $links = [
            ['label' => 'Compare Student Loans', 'weight' => '0', 'href' => '/student-loan-comparison-calculator'],
            ['label' => 'Switch Lenders', 'weight' => '0', 'href' => '/negotiated-in-school-deal/how-to-switch-loan-provider'],
        ];

        foreach ($links as $data) {
            $link       = new MenuLink();
            $link->menu = 'header';

            $link->weight = $data['weight'];
            $link->href   = $data['href'];
            $link->label  = $data['label'];

            $link->parent_id = $parent->id;
            $link->save();
        }
    }

    private function copyright()
    {
        $links = [
            ['label' => 'How We Make Money', 'href' => 'https://leveredge.org/how-we-make-money'],
            ['label' => 'Terms Of Use', 'href' => 'https://leveredge.org/terms-of-use'],
            ['label' => 'Privacy', 'href' => 'https://leveredge.org/privacy'],
        ];

        foreach ($links as $data) {
            $link        = new MenuLink();
            $link->menu  = 'copyright';
            $link->href  = $data['href'];
            $link->label = $data['label'];
            $link->save();
        }
    }

    private function company()
    {
        $links = [
            ['label' => 'Our Story', 'href' => 'https://leveredge.org/our-story'],
            ['label' => 'Our Track Record', 'href' => 'https://leveredge.org/our-track-record'],
            ['label' => 'Reviews', 'href' => '/reviews'],
            ['label' => 'Careers', 'href' => 'https://jobs.lever.co/leveredge'],
            ['label' => 'Contact', 'href' => 'https://leveredge.org/contact'],
        ];

        foreach ($links as $data) {
            $link        = new MenuLink();
            $link->menu  = 'company';
            $link->href  = $data['href'];
            $link->label = $data['label'];
            $link->save();
        }
    }

    private function authHeader()
    {
        $links = [
            ['label' => 'Profile', 'href' => '/user-profile'],
        ];

        foreach ($links as $data) {
            $link        = new MenuLink();
            $link->menu  = 'auth_header';
            $link->href  = $data['href'];
            $link->label = $data['label'];
            $link->save();
        }
    }

    private function product()
    {
        $links = [
            ['label' => 'Graduate Student Loan', 'href' => '/negotiated-in-school-deal'],
        ];

        foreach ($links as $data) {
            $link        = new MenuLink();
            $link->menu  = 'product';
            $link->href  = $data['href'];
            $link->label = $data['label'];
            $link->save();
        }
    }

    private function authDropdown()
    {
        $links = [
            ['label' => 'Dashboard', 'href' => '/home'],
            ['label' => 'Update Profile', 'href' => '/user-profile/loan-type'],
            ['label' => 'Referral Program', 'href' => '/referral-program'],
        ];

        foreach ($links as $data) {
            $link        = new MenuLink();
            $link->menu  = 'auth_dropdown';
            $link->href  = $data['href'];
            $link->label = $data['label'];
            $link->save();
        }
    }
}
