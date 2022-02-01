<?php

use App\Redirects\RedirectToUserProfileEndScreen;
use App\Content;
use App\Question;
use App\QuestionFlow;
use App\QuestionPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuestionFlowRelatedTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Undergrad and Grad Student Loans
        $flow                    = new QuestionFlow;
        $flow->name              = 'Student Loan Flow';
        $flow->slug              = 'student-loan';
        $flow->template          = 'version-1';
        $flow->start_sequence    = null;
        $flow->complete_sequence = [
            \App\Jobs\CompleteFlow\MarkSignUpProgressComplete::class,
            \App\Jobs\CompleteFlow\AddToAcademicYearStudentLoan::class,
        ];
        $flow->after_completion_redirect_to = RedirectToUserProfileEndScreen::class;
        $flow->save();

        $page                         = new QuestionPage;
        $page->sort_order             = $flow->questionPages->count() + 1;
        $page->name                   = 'What kind of loan are you looking for?';
        $page->slug                   = 'loan-type';
        $page->question_flow_id       = $flow->id;
        $page->hide_submission_button = true;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'card-radio';
        $question->question_option      = \App\QuestionOptions\UndergraduateGraduate::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'loan_type';
        $question->label                = 'What kind of loan are you looking for?';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->save();

        $page                         = new QuestionPage;
        $page->sort_order             = $flow->questionPages->count() + 1;
        $page->name                   = 'When do you need the loan?';
        $page->slug                   = 'when-do-you-need-the-loan';
        $page->hide_submission_button = true;
        $page->question_flow_id       = $flow->id;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'list-radio';
        $question->question_option      = \App\QuestionOptions\AcademicYears::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'academic_year_id';
        $question->label                = 'When do you need the loan?';
        $question->persist_response     = \App\PersistResponse\PersistInQuestionResponderOnly::class;
        $question->save();


        $page                   = new QuestionPage;
        $page->sort_order       = $flow->questionPages->count() + 1;
        $page->name             = 'Personal Information';
        $page->slug             = Str::slug($page->name);
        $page->question_flow_id = $flow->id;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\StudentParent::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'role';
        $question->label                = 'Are you a student or a parent?';
        $question->placeholder          = 'Select your role';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'first_name';
        $question->validation_rules     = 'required';
        $question->placeholder          = 'First Name';
        $question->label                = 'Your First Name';
        $question->persist_response     = \App\PersistResponse\PersistOnUserModel::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'last_name';
        $question->label                = 'Your Last Name';
        $question->placeholder          = 'Last Name';
        $question->validation_rules     = 'required';
        $question->persist_response     = \App\PersistResponse\PersistOnUserModel::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'searchable-dropdown';
        $question->question_option      = \App\QuestionOptions\CitizenshipStatus::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'immigration_status';
        $question->placeholder          = 'Select your citizenship status';
        $question->label                = 'Your Citizenship Status';
        $question->validation_rules     = 'required';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->tooltip              = 'Some lenders only lend to US Citizens or US Permanent Residents. Therefore, we ask for this information to determine who we can negotiate with to get you the best deal.';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\Country::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'country_of_citizenship_id';
        $question->label                = 'Country of Citizenship';
        $question->validation_rules     = 'required_if:immigration_status,International';
        $question->placeholder          = 'Select your country of citizenship';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->visibility_policy    = \App\VisibilityPolicies\IfCitizenshipIsInternational::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\Country::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'country_of_residence_id';
        $question->label                = 'Country of Residence';
        $question->validation_rules     = 'required_if:immigration_status,International';
        $question->placeholder          = 'Select your country of residence';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->visibility_policy    = \App\VisibilityPolicies\IfCitizenshipIsInternational::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'phone_number';
        $question->label                = 'Your Phone Number (Optional)';
        $question->placeholder          = 'Phone Number';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\HeardFromOptions::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'heard_from_option_id';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'How did you hear about us?';
        $question->validation_rules     = 'required';
        $question->placeholder          = 'Select one of the options';
        $question->save();

        $page                   = new QuestionPage;
        $page->sort_order       = $flow->questionPages->count() + 1;
        $page->name             = 'Undergraduate Information';
        $page->slug             = Str::slug($page->name);
        $page->skip_policy      = \App\SkipPolicies\IfLoanTypeGraduate::class;
        $page->question_flow_id = $flow->id;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'searchable-dropdown';
        $question->question_option      = \App\QuestionOptions\University::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'university_id';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'University';
        $question->placeholder          = 'Select your university';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'searchable-dropdown';
        $question->question_option      = \App\QuestionOptions\UndergraduateDegree::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'degree_id';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Degree';
        $question->validation_rules     = 'required';
        $question->placeholder          = 'Select your degree';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'graduation_year';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Graduation Year';
        $question->placeholder          = 'Graduation Year';
        $question->validation_rules     = 'required';
        $question->save();

        $page                   = new QuestionPage;
        $page->sort_order       = $flow->questionPages->count() + 1;
        $page->name             = 'Graduate Information';
        $page->slug             = Str::slug($page->name);
        $page->skip_policy      = \App\SkipPolicies\IfLoanTypeUndergraduate::class;
        $page->question_flow_id = $flow->id;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\University::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'grad_university_id';
        $question->placeholder          = 'Select your University';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'University';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\GraduateDegree::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'grad_degree_id';
        $question->validation_rules     = 'required';
        $question->placeholder          = 'Select your Degree';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Degree';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'grad_graduation_year';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Graduation Year';
        $question->placeholder          = 'Graduation Year';
        $question->validation_rules     = 'required';
        $question->save();

        $page                   = new QuestionPage;
        $page->sort_order       = $flow->questionPages->count() + 1;
        $page->name             = 'Financial Information';
        $page->slug             = Str::slug($page->name);
        $page->question_flow_id = $flow->id;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\CreditScore::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'credit_score';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Your Credit Score';
        $question->placeholder          = 'Select your credit score';
        $question->validation_rules     = 'required';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'annual_income';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Your Annual Income (USD)';
        $question->helper_text          = 'Most students enter $0 and many members with $0 get the lowest rates offered.';
        $question->tooltip              = 'How much will you earn in the next 12 months?';
        $question->placeholder          = 'Annual Income';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\YesNoMaybe::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'cosigner_status';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Do you have a co-signer?';
        $question->placeholder          = 'Select your Co-signer Status';
        $question->validation_rules     = 'required';
        $question->tooltip              = 'A co-signer is a person who is obligated to pay back the loan just as you, the borrower, are obligated to pay. A co-signer could be your spouse, a parent, or a friend.';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'searchable-dropdown';
        $question->question_option      = \App\QuestionOptions\CitizenshipStatus::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'cosigner_immigration_status';
        $question->placeholder          = "Select your co-signer's citizenship status";
        $question->label                = "Co-signer's Citizenship Status";
        $question->validation_rules     = 'required_if:cosigner_status,Yes';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->tooltip              = 'Some lenders only lend to US Citizens or US Permanent Residents. Therefore, we ask for this information to determine who we can negotiate with to get you the best deal.';
        $question->visibility_policy    = \App\VisibilityPolicies\IfCosignerStatusIsYes::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\CreditScore::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'cosigner_credit_score';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = "Co-signer's Credit Score";
        $question->placeholder          = "Select your co-signer's credit score";
        $question->validation_rules     = 'required_if:cosigner_status,Yes';
        $question->visibility_policy    = \App\VisibilityPolicies\IfCosignerStatusIsYes::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'cosigner_annual_income';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = "Co-signer's Annual Income (USD)";
        $question->placeholder          = "Annual Income";
        $question->tooltip              = 'How much will your co-signer earn in the next 12 months?';
        $question->validation_rules     = 'required_if:cosigner_status,Yes';
        $question->visibility_policy    = \App\VisibilityPolicies\IfCosignerStatusIsYes::class;
        $question->save();


        //Refinance
        $flow                    = new QuestionFlow;
        $flow->name              = 'Student Loan Refinancing';
        $flow->slug              = 'student-loan-refinancing';
        $flow->template          = 'version-1';
        $flow->start_sequence    = null;
        $flow->complete_sequence = [
            \App\Jobs\CompleteFlow\MarkSignUpProgressComplete::class,
            \App\Jobs\CompleteFlow\AddToAcademicYearRefinance::class,
        ];
        $flow->after_completion_redirect_to = \App\Redirects\RedirectToRefinanceEndScreen::class;
        $flow->save();

        $page                   = new QuestionPage;
        $page->sort_order       = $flow->questionPages->count() + 1;
        $page->name             = 'Personal Information';
        $page->slug             = 'personal-information-refinance';
        $page->question_flow_id = $flow->id;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'first_name';
        $question->validation_rules     = 'required';
        $question->placeholder          = 'First Name';
        $question->label                = 'Your First Name';
        $question->persist_response     = \App\PersistResponse\PersistOnUserModel::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'last_name';
        $question->label                = 'Your Last Name';
        $question->placeholder          = 'Last Name';
        $question->validation_rules     = 'required';
        $question->persist_response     = \App\PersistResponse\PersistOnUserModel::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'searchable-dropdown';
        $question->question_option      = \App\QuestionOptions\CitizenshipStatus::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'immigration_status';
        $question->placeholder          = 'Select your citizenship status';
        $question->label                = 'Your Citizenship Status';
        $question->validation_rules     = 'required';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->tooltip              = 'Some lenders only lend to US Citizens or US Permanent Residents. Therefore, we ask for this information to determine who we can negotiate with to get you the best deal.';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\Country::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'country_of_citizenship_id';
        $question->label                = 'Country of Citizenship';
        $question->validation_rules     = 'required_if:immigration_status,International';
        $question->placeholder          = 'Select your country of citizenship';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->visibility_policy    = \App\VisibilityPolicies\IfCitizenshipIsInternational::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\Country::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'country_of_residence_id';
        $question->label                = 'Country of Residence';
        $question->validation_rules     = 'required_if:immigration_status,International';
        $question->placeholder          = 'Select your country of residence';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->visibility_policy    = \App\VisibilityPolicies\IfCitizenshipIsInternational::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'phone_number';
        $question->label                = 'Your Phone Number (Optional)';
        $question->placeholder          = 'Phone Number';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\HeardFromOptions::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'heard_from_option_id';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'How did you hear about us?';
        $question->validation_rules     = 'required';
        $question->placeholder          = 'Select one of the options';
        $question->save();

        $page                   = new QuestionPage;
        $page->sort_order       = $flow->questionPages->count() + 1;
        $page->name             = 'Financial Information';
        $page->slug             = 'financial-information-refinance';
        $page->question_flow_id = $flow->id;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\CreditScore::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'credit_score';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Your Credit Score';
        $question->placeholder          = 'Select your credit score';
        $question->validation_rules     = 'required';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'annual_income';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Your Annual Income (USD)';
        $question->helper_text          = 'Most students enter $0 and many members with $0 get the lowest rates offered.';
        $question->tooltip              = 'How much will you earn in the next 12 months?';
        $question->placeholder          = 'Annual Income';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\YesNoMaybe::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'cosigner_status';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Do you have a co-signer?';
        $question->placeholder          = 'Select your Co-signer Status';
        $question->validation_rules     = 'required';
        $question->tooltip              = 'A co-signer is a person who is obligated to pay back the loan just as you, the borrower, are obligated to pay. A co-signer could be your spouse, a parent, or a friend.';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'searchable-dropdown';
        $question->question_option      = \App\QuestionOptions\CitizenshipStatus::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'cosigner_immigration_status';
        $question->placeholder          = "Select your co-signer's citizenship status";
        $question->label                = "Co-signer's Citizenship Status";
        $question->validation_rules     = 'required_if:cosigner_status,Yes';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->tooltip              = 'Some lenders only lend to US Citizens or US Permanent Residents. Therefore, we ask for this information to determine who we can negotiate with to get you the best deal.';
        $question->visibility_policy    = \App\VisibilityPolicies\IfCosignerStatusIsYes::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\CreditScore::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'cosigner_credit_score';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = "Co-signer's Credit Score";
        $question->placeholder          = "Select your co-signer's credit score";
        $question->validation_rules     = 'required_if:cosigner_status,Yes';
        $question->visibility_policy    = \App\VisibilityPolicies\IfCosignerStatusIsYes::class;
        $question->save();

        $question                       = new Question;
        $question->type                 = 'text';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'cosigner_annual_income';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = "Co-signer's Annual Income (USD)";
        $question->placeholder          = "Annual Income";
        $question->tooltip              = 'How much will your co-signer earn in the next 12 months?';
        $question->validation_rules     = 'required_if:cosigner_status,Yes';
        $question->visibility_policy    = \App\VisibilityPolicies\IfCosignerStatusIsYes::class;
        $question->save();

        $page                   = new QuestionPage;
        $page->sort_order       = $flow->questionPages->count() + 1;
        $page->name             = 'Refinancing Information';
        $page->slug             = 'refinance-information';
        $page->question_flow_id = $flow->id;
        $page->save();

        $content              = new Content;
        $content->name        = 'title';
        $content->body        = $page->name;
        $content->parent_id   = $page->id;
        $content->parent_type = QuestionPage::class;
        $content->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\ExistingStudentLoanTypeOptions::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'refinance_loan_type';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'What kind of loans are you looking to refinance?';
        $question->placeholder          = 'Select one of the options';
        $question->validation_rules     = 'required';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\YesNoBoolean::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'is_currently_employed';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Are you currently employed?';
        $question->placeholder          = 'Select one of the options';
        $question->validation_rules     = 'required';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'dropdown';
        $question->question_option      = \App\QuestionOptions\YesNoBoolean::class;
        $question->question_page_id     = $page->id;
        $question->field_name           = 'have_job_start_date';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'Do you have an offer letter with a start date?';
        $question->placeholder          = 'Select one of the options';
        $question->visibility_policy    = \App\VisibilityPolicies\IfCurrentlyEmployedIsNo::class;
        $question->validation_rules     = 'required_if:is_currently_employed,0';
        $question->save();

        $question                       = new Question;
        $question->type                 = 'date';
        $question->question_page_id     = $page->id;
        $question->field_name           = 'job_start_date';
        $question->persist_response     = \App\PersistResponse\PersistOnUserProfileModel::class;
        $question->label                = 'What is your start date?';
        $question->visibility_policy    = \App\VisibilityPolicies\IfHasJobStartDateYes::class;
        $question->validation_rules     = 'required_if:have_job_start_date,1';
        $question->save();


        $flow->refresh();
    }
}

