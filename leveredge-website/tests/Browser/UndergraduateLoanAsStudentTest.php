<?php


namespace Tests\Browser;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\EarnestUndergraduateDealPage;
use Tests\Browser\Pages\Fall2021AndBeyondEndScreen;
use Tests\Browser\Pages\FinancialsInformation;
use Tests\Browser\Pages\LoanType;
use Tests\Browser\Pages\LoanTypeAcademicYear;
use Tests\Browser\Pages\PersonalInformation;
use Tests\Browser\Pages\ProfileEndSuccessPageSingleDeal;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\StudentLoan;
use Tests\Browser\Pages\StudentLoanQuestionFlowPage;
use Tests\Browser\Pages\UndergraduateInformation;

class UndergraduateLoanAsStudentTest extends FlowBase
{
    public function testUndergraduateLoanAsStudentRightNow()
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
                ->assertPageIsLoaded()
                ->studentLoans()
                ->on(new StudentLoan)
                ->assertStudentLoansPageIsLoaded()
                ->undergradLoad()
                ->on(new LoanTypeAcademicYear)
                ->assertAcademicYearPageIsLoaded()
                ->clickRightNow()
                ->on(new PersonalInformation)
                ->assertPersonalInformationPageIsLoaded()
                ->fillPersonalInformationAsStudent($firstName, $lastName)
                ->on(new UndergraduateInformation)
                ->fillBasicGraduateInformation()
                ->on(new FinancialsInformation)
                ->fillFinancialsInformationAsStudent()
                ->on(new ProfileEndSuccessPageSingleDeal)
                ->checkTheDeal()
                ->on(new EarnestUndergraduateDealPage);
        });
    }

    public function testUndergraduateLoanAsStudentWinterSpring2021()
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
                ->assertPageIsLoaded()
                ->studentLoans()
                ->on(new StudentLoan)
                ->assertStudentLoansPageIsLoaded()
                ->undergradLoad()
                ->on(new LoanTypeAcademicYear)
                ->assertAcademicYearPageIsLoaded()
                ->clickWinterSpring2021()
                ->on(new PersonalInformation)
                ->assertPersonalInformationPageIsLoaded()
                ->fillPersonalInformationAsStudent($firstName, $lastName)
                ->on(new UndergraduateInformation)
                ->fillBasicGraduateInformation()
                ->on(new FinancialsInformation)
                ->fillFinancialsInformationAsStudent()
                ->on(new ProfileEndSuccessPageSingleDeal)
                ->checkTheDeal()
                ->on(new EarnestUndergraduateDealPage);
        });
    }

    public function testUndergraduateLoanAsStudentSummer2021()
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
                ->assertPageIsLoaded()
                ->studentLoans()
                ->on(new StudentLoan)
                ->assertStudentLoansPageIsLoaded()
                ->undergradLoad()
                ->on(new LoanTypeAcademicYear)
                ->assertAcademicYearPageIsLoaded()
                ->clickSummer2021()
                ->on(new PersonalInformation)
                ->assertPersonalInformationPageIsLoaded()
                ->fillPersonalInformationAsStudent($firstName, $lastName)
                ->on(new UndergraduateInformation)
                ->fillBasicGraduateInformation()
                ->on(new FinancialsInformation)
                ->fillFinancialsInformationAsStudent()
                ->on(new ProfileEndSuccessPageSingleDeal)
                ->checkTheDeal()
                ->on(new EarnestUndergraduateDealPage);
        });
    }

    public function testUndergraduateLoanAsStudentFall2021AndBeyond()
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
                ->assertPageIsLoaded()
                ->studentLoans()
                ->on(new StudentLoan)
                ->assertStudentLoansPageIsLoaded()
                ->undergradLoad()
                ->on(new LoanTypeAcademicYear)
                ->assertAcademicYearPageIsLoaded()
                ->clickFall2021AndBeyond()
                ->on(new PersonalInformation)
                ->assertPersonalInformationPageIsLoaded()
                ->fillPersonalInformationAsStudent($firstName, $lastName)
                ->on(new UndergraduateInformation)
                ->fillBasicGraduateInformation()
                ->on(new FinancialsInformation)
                ->fillFinancialsInformationAsStudent()
                ->on(new Fall2021AndBeyondEndScreen);
        });
    }

    public function testUndergraduateLoanAsStudentRightNowAsLoggedOutUser()
    {
        $email     = $this->faker->unique()->email;
        $firstName = $this->faker->firstName;
        $lastName  = $this->faker->lastName;

        $this->browse(function (Browser $browser) use ($email, $firstName, $lastName) {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit(new StudentLoanQuestionFlowPage)
                ->waitForLocation('/question-flow/student-loan/loan-type')
                ->on(new StudentLoan)
                ->assertStudentLoansPageIsLoaded()
                ->undergradLoad()
                ->on(new LoanTypeAcademicYear)
                ->assertAcademicYearPageIsLoaded()
                ->clickRightNow()
                ->on(new PersonalInformation)
                ->assertPersonalInformationPageIsLoaded()
                ->fillPersonalInformationAsStudent($firstName, $lastName, $email)
                ->on(new UndergraduateInformation)
                ->fillBasicGraduateInformation()
                ->on(new FinancialsInformation)
                ->fillFinancialsInformationAsStudent()
                ->on(new ProfileEndSuccessPageSingleDeal)
                ->checkTheDeal()
                ->on(new EarnestUndergraduateDealPage);
        });
    }

    public function testUndergraduateLoanAsStudentWinterSpring2021AsLoggedOutUser()
    {
        $email     = $this->faker->unique()->email;
        $firstName = $this->faker->firstName;
        $lastName  = $this->faker->lastName;

        $this->browse(function (Browser $browser) use ($email, $firstName, $lastName) {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit(new StudentLoanQuestionFlowPage)
                ->waitForLocation('/question-flow/student-loan/loan-type')
                ->on(new StudentLoan)
                ->assertStudentLoansPageIsLoaded()
                ->undergradLoad()
                ->on(new LoanTypeAcademicYear)
                ->assertAcademicYearPageIsLoaded()
                ->clickWinterSpring2021()
                ->on(new PersonalInformation)
                ->assertPersonalInformationPageIsLoaded()
                ->fillPersonalInformationAsStudent($firstName, $lastName, $email)
                ->on(new UndergraduateInformation)
                ->fillBasicGraduateInformation()
                ->on(new FinancialsInformation)
                ->fillFinancialsInformationAsStudent()
                ->on(new ProfileEndSuccessPageSingleDeal)
                ->checkTheDeal()
                ->on(new EarnestUndergraduateDealPage);
        });
    }

    public function testUndergraduateLoanAsStudentSummer2021AsLoggedOutUser()
    {
        $email     = $this->faker->unique()->email;
        $firstName = $this->faker->firstName;
        $lastName  = $this->faker->lastName;

        $this->browse(function (Browser $browser) use ($email, $firstName, $lastName) {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit(new StudentLoanQuestionFlowPage)
                ->waitForLocation('/question-flow/student-loan/loan-type')
                ->on(new StudentLoan)
                ->assertStudentLoansPageIsLoaded()
                ->undergradLoad()
                ->on(new LoanTypeAcademicYear)
                ->assertAcademicYearPageIsLoaded()
                ->clickSummer2021()
                ->on(new PersonalInformation)
                ->assertPersonalInformationPageIsLoaded()
                ->fillPersonalInformationAsStudent($firstName, $lastName, $email)
                ->on(new UndergraduateInformation)
                ->fillBasicGraduateInformation()
                ->on(new FinancialsInformation)
                ->fillFinancialsInformationAsStudent()
                ->on(new ProfileEndSuccessPageSingleDeal)
                ->checkTheDeal()
                ->on(new EarnestUndergraduateDealPage);
        });
    }

    public function testUndergraduateLoanAsStudentFall2021AndBeyondAsLoggedOutUser()
    {
        $email     = $this->faker->unique()->email;
        $firstName = $this->faker->firstName;
        $lastName  = $this->faker->lastName;

        $this->browse(function (Browser $browser) use ($email, $firstName, $lastName) {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit(new StudentLoanQuestionFlowPage)
                ->waitForLocation('/question-flow/student-loan/loan-type')
                ->on(new StudentLoan)
                ->assertStudentLoansPageIsLoaded()
                ->undergradLoad()
                ->on(new LoanTypeAcademicYear)
                ->assertAcademicYearPageIsLoaded()
                ->clickFall2021AndBeyond()
                ->on(new PersonalInformation)
                ->assertPersonalInformationPageIsLoaded()
                ->fillPersonalInformationAsStudent($firstName, $lastName, $email)
                ->on(new UndergraduateInformation)
                ->fillBasicGraduateInformation()
                ->on(new FinancialsInformation)
                ->fillFinancialsInformationAsStudent()
                ->on(new Fall2021AndBeyondEndScreen);
        });
    }
}
