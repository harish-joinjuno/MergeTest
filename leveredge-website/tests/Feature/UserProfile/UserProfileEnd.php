<?php

namespace Tests\Feature\UserProfile;

use App\Role;
use App\UserProfile;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfileEnd extends FeatureTest
{
    /** @test */
    public function it_should_fail_if_user_not_authenticated()
    {
        $response = $this
            ->get(route('user-profile.end'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('login', [
            'next' => route('user-profile.end'),
        ]);

        $this->assertEquals(urldecode($expected), $actual);
    }

//    /** @test */
//    public function it_should_render_properly()
//    {
//        $user = (new UserBuilder())
//            ->withEmail()
//            ->withPassword()
//            ->withRoleName(Role::ROLE_NAME_BORROWER)
//            ->get();
//
//        (new UserProfileBuilder())
//            ->withUser($user)
//            ->withRole(UserProfile::ROLE_STUDENT)
//            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD)
//            ->save()
//            ->get();
//
//        $this
//            ->actingAs($user)
//            ->get(route('user-profile.end'))
//            ->assertSuccessful()
//            ->assertSee('Thank you for sharing');
//    }

}
