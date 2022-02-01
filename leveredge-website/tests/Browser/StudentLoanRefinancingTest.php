<?php


namespace Tests\Browser;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\DomesticRefiInformation;
use Tests\Browser\Pages\LoanType;
use Tests\Browser\Pages\NegotiationGroups\FirstRepublicAndLaurelRoadDeal;
use Tests\Browser\Pages\NegotiationGroups\FirstRepublicAndLaurelRoadLandingPage;
use Tests\Browser\Pages\NegotiationGroups\LandingPage;
use Tests\Browser\Pages\NegotiationGroups\LaurelRoadDeal;
use Tests\Browser\Pages\NegotiationGroups\RefinanceNonMedicalInFrCitiesMedical;
use Tests\Browser\Pages\NegotiationGroups\RefinanceNonMedicalOutsideFRCitiesLoanAmount;
use Tests\Browser\Pages\NegotiationGroups\RefinanceNonMedicalOutsideFRCitiesMedical;
use Tests\Browser\Pages\NegotiationGroups\RefinanceNonMedicalOutsideFRCitiesThreeQuestions;
use Tests\Browser\Pages\NegotiationGroups\RefinanceNonMedicalOutsideFRCitiesZipCode;
use Tests\Browser\Pages\RefinanceDomesticFinancialInformation;
use Tests\Browser\Pages\RefinanceEndScreenNoJobPage;
use Tests\Browser\Pages\RefinanceFinancialInformation;
use Tests\Browser\Pages\RefinancePersonalInformation;
use Tests\Browser\Pages\RefinancingInformationPage;
use Tests\Browser\Pages\RefinancingQuestionFlowPage;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\UserProfileEnd;

class StudentLoanRefinancingTest extends FlowBase
{
    public function testRefinanceFlowWithNotCurrentlyEmployedWithNoJobDate()
    {
        $email     = $this->faker->unique()->email;
        $password  = $this->faker->password(8);
        $firstName = $this->faker->firstName;
        $lastName  = $this->faker->lastName;

        $this->browse(function (Browser $browser) use ($email, $password, $firstName, $lastName) {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit(new Register)
                ->createAccount($email, $password)
                ->on(new LoanType)
                ->loanRefinance()
                ->on(new RefinancePersonalInformation)
                ->fillPersonalInformationAsStudent($firstName, $lastName)
                ->on(new RefinanceFinancialInformation)
                ->fillAboutInformation()
                ->on(new DomesticRefiInformation)
                ->privateAndEmployed()
                ->on(new RefinanceDomesticFinancialInformation)
                ->withoutCosigner()
                ->on(new UserProfileEnd)
                ->assertRefiDomesticNoJobNoCosigner()
                ->on(new RefinanceNonMedicalOutsideFRCitiesThreeQuestions)
                ->continue()
                ->on(new RefinanceNonMedicalOutsideFRCitiesLoanAmount)
                ->provideLoanAmount()
                ->on(new RefinanceNonMedicalOutsideFRCitiesZipCode)
                ->provideZipCode()
                ->on(new RefinanceNonMedicalOutsideFRCitiesMedical)
                ->chooseMedicalProfession()
                ->on(new LandingPage)
                ->waitForLocation('/member/negotiation-group/15/laurel-road-deal')
                ->on(new LaurelRoadDeal);
        });
    }

    public function testRefinanceFlowWithNotCurrentlyEmployedWithNoJobDateInFrCities()
    {
        $email     = $this->faker->unique()->email;
        $password  = $this->faker->password(8);
        $firstName = $this->faker->firstName;
        $lastName  = $this->faker->lastName;

        $this->browse(function (Browser $browser) use ($email, $password, $firstName, $lastName) {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit(new Register)
                ->createAccount($email, $password)
                ->on(new LoanType)
                ->loanRefinance()
                ->on(new RefinancePersonalInformation)
                ->fillPersonalInformationAsStudent($firstName, $lastName)
                ->on(new RefinanceFinancialInformation)
                ->fillAboutInformation()
                ->on(new DomesticRefiInformation)
                ->privateAndEmployed()
                ->on(new RefinanceDomesticFinancialInformation)
                ->withoutCosigner()
                ->on(new UserProfileEnd)
                ->assertRefiDomesticNoJobNoCosigner()
                ->on(new RefinanceNonMedicalOutsideFRCitiesThreeQuestions)
                ->continue()
                ->on(new RefinanceNonMedicalOutsideFRCitiesLoanAmount)
                ->provideLoanAmount()
                ->on(new RefinanceNonMedicalOutsideFRCitiesZipCode)
                ->provideInFRZipCode()
                ->on(new RefinanceNonMedicalInFrCitiesMedical())
                ->chooseMedicalProfession()
                ->on(new FirstRepublicAndLaurelRoadLandingPage)
                ->waitForLocation('/member/negotiation-group/14/first-republic-and-laurel-road')
                ->on(new FirstRepublicAndLaurelRoadDeal);
        });
    }

    public function testRefinanceFlowWithNotCurrentlyEmployedWithNoJobDateAsLoggedOutUser()
    {
        $email     = $this->faker->unique()->email;
        $firstName = $this->faker->firstName;
        $lastName  = $this->faker->lastName;

        $this->browse(function (Browser $browser) use ($email, $firstName, $lastName) {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit(new RefinancingQuestionFlowPage)
                ->waitForLocation('/question-flow/student-refi-with-intl/personal-information-refinance-with-intl')
                ->on(new RefinancePersonalInformation)
                ->fillPersonalInformationAsStudent($firstName, $lastName, $email)
                ->on(new RefinanceFinancialInformation)
                ->fillAboutInformation()
                ->on(new DomesticRefiInformation)
                ->privateAndEmployed()
                ->on(new RefinanceDomesticFinancialInformation)
                ->withoutCosigner()
                ->on(new UserProfileEnd)
                ->assertRefiDomesticNoJobNoCosigner()
                ->on(new RefinanceNonMedicalOutsideFRCitiesThreeQuestions)
                ->continue()
                ->on(new RefinanceNonMedicalOutsideFRCitiesLoanAmount)
                ->provideLoanAmount()
                ->on(new RefinanceNonMedicalOutsideFRCitiesZipCode)
                ->provideZipCode()
                ->on(new RefinanceNonMedicalOutsideFRCitiesMedical)
                ->chooseMedicalProfession()
                ->on(new LandingPage)
                ->waitForLocation('/member/negotiation-group/15/laurel-road-deal')
                ->on(new LaurelRoadDeal);
        });
    }

    public function testRefinanceFlowWithNotCurrentlyEmployedWithNoJobDateInFrCitiesAsLoggedOutUser()
    {
        $email     = $this->faker->unique()->email;
        $firstName = $this->faker->firstName;
        $lastName  = $this->faker->lastName;

        $this->browse(function (Browser $browser) use ($email, $firstName, $lastName) {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit(new RefinancingQuestionFlowPage)
                ->waitForLocation('/question-flow/student-refi-with-intl/personal-information-refinance-with-intl')
                ->on(new RefinancePersonalInformation)
                ->fillPersonalInformationAsStudent($firstName, $lastName, $email)
                ->on(new RefinanceFinancialInformation)
                ->fillAboutInformation()
                ->on(new DomesticRefiInformation)
                ->privateAndEmployed()
                ->on(new RefinanceDomesticFinancialInformation)
                ->withoutCosigner()
                ->on(new UserProfileEnd)
                ->assertRefiDomesticNoJobNoCosigner()
                ->on(new RefinanceNonMedicalOutsideFRCitiesThreeQuestions)
                ->continue()
                ->on(new RefinanceNonMedicalOutsideFRCitiesLoanAmount)
                ->provideLoanAmount()
                ->on(new RefinanceNonMedicalOutsideFRCitiesZipCode)
                ->provideInFRZipCode()
                ->on(new RefinanceNonMedicalInFrCitiesMedical())
                ->chooseMedicalProfession()
                ->on(new FirstRepublicAndLaurelRoadLandingPage)
                ->waitForLocation('/member/negotiation-group/14/first-republic-and-laurel-road')
                ->on(new FirstRepublicAndLaurelRoadDeal);
//                ->on(new RefinanceEndScreenNoJobPage);
        });
    }
}
