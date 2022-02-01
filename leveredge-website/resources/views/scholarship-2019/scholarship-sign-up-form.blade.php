<form action="{{ url('/scholarship-2019') }}" method="post">
    @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>

            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter Name">
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
            @endif

        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Enter Email">

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
            @endif

        </div>

        <!-- Type -->
        <div class="form-group">
            <label for="type">{{ __('Type') }}</label>

            <select id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                <option @if( old('type') == "Domestic Student" ) selected @endif value="Domestic Student">Domestic Student</option>
                <option @if( old('type') == "International Student" ) selected @endif value="International Student">International Student</option>
            </select>

            @if ($errors->has('type'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
            @endif

        </div>


        <div class="form-group">
            <label for="university">{{ __('University') }}</label>

            {{ Form::select('university', [
                'Alabama' => 'Alabama',
                'Albany' => 'Albany',
                'Arizona' => 'Arizona',
                'Arizona Phoenix' => 'Arizona Phoenix',
                'Arizona State University' => 'Arizona State University',
                'Arkansas' => 'Arkansas',
                'Baylor University' => 'Baylor University',
                'Boston College' => 'Boston College',
                'Boston University' => 'Boston University',
                'Brigham Young University' => 'Brigham Young University',
                'Brown-Alpert' => 'Brown-Alpert',
                'Buffalo-Jacobs' => 'Buffalo-Jacobs',
                'California Northstate' => 'California Northstate',
                'Caribe' => 'Caribe',
                'Carnegie Mellon' => 'Carnegie Mellon',
                'Case Western Reserve' => 'Case Western Reserve',
                'Central Michigan' => 'Central Michigan',
                'Chicago-Pritzker' => 'Chicago-Pritzker',
                'Cincinnati' => 'Cincinnati',
                'Colorado' => 'Colorado',
                'Columbia University' => 'Columbia University',
                'Cooper Rowan' => 'Cooper Rowan',
                'Cornell-Weill' => 'Cornell-Weill',
                'Cornell University' => 'Cornell University',
                'Creighton' => 'Creighton',
                'CUNY' => 'CUNY',
                'Dartmouth University' => 'Dartmouth University',
                'Drexel University' => 'Drexel University',
                'Duke University' => 'Duke University',
                'East Carolina-Brody' => 'East Carolina-Brody',
                'Eastern Virginia' => 'Eastern Virginia',
                'East Tennessee-Quillen' => 'East Tennessee-Quillen',
                'Einstein' => 'Einstein',
                'Emory University' => 'Emory University',
                'Florida Atlantic University' => 'Florida Atlantic University',
                'Florida International University' => 'Florida International University',
                'Florida State University' => 'Florida State University',
                'Fordham University' => 'Fordham University',
                'Geisinger Commonwealth' => 'Geisinger Commonwealth',
                'Georga Tech' => 'Georga Tech',
                'George Mason University' => 'George Mason University',
                'Georgetown University' => 'Georgetown University',
                'George Washington University' => 'George Washington University',
                'Georgia Augusta' => 'Georgia Augusta',
                'Harvard University' => 'Harvard University',
                'Hawaii-Burns' => 'Hawaii-Burns',
                'Hofstra Northwell' => 'Hofstra Northwell',
                'Howard University' => 'Howard University',
                'Indiana University' => 'Indiana University',
                'Iowa-Carver' => 'Iowa-Carver',
                'Jefferson-Kimmel' => 'Jefferson-Kimmel',
                'Johns Hopkins' => 'Johns Hopkins',
                'Kansas' => 'Kansas',
                'Loma Linda' => 'Loma Linda',
                'Louisville' => 'Louisville',
                'Loyola-Stritch' => 'Loyola-Stritch',
                'LSU New Orleans' => 'LSU New Orleans',
                'LSU Shreveport' => 'LSU Shreveport',
                'Marshall-Edwards' => 'Marshall-Edwards',
                'Maryland' => 'Maryland',
                'Massachusetts' => 'Massachusetts',
                'Mayo' => 'Mayo',
                'MC Georgia Augusta' => 'MC Georgia Augusta',
                'MC Wisconsin' => 'MC Wisconsin',
                'Meharry' => 'Meharry',
                'Mercer' => 'Mercer',
                'Miami-Miller' => 'Miami-Miller',
                'Michigan State University' => 'Michigan State University',
                'Minnesota' => 'Minnesota',
                'Mississippi' => 'Mississippi',
                'Missouri Columbia' => 'Missouri Columbia',
                'Missouri Kansas City' => 'Missouri Kansas City',
                'MIT' => 'MIT',
                'Morehouse' => 'Morehouse',
                'Mount Sinai-Icahn' => 'Mount Sinai-Icahn',
                'MU South Carolina' => 'MU South Carolina',
                'Nebraska' => 'Nebraska',
                'Nevada Las Vegas' => 'Nevada Las Vegas',
                'Nevada Reno' => 'Nevada Reno',
                'New York Medical College' => 'New York Medical College',
                'New York University' => 'New York University',
                'North Dakota' => 'North Dakota',
                'Northeast Ohio' => 'Northeast Ohio',
                'Northwestern University' => 'Northwestern University',
                'NYU' => 'NYU',
                'Oakland Beaumont' => 'Oakland Beaumont',
                'Ohio State University' => 'Ohio State University',
                'Oklahoma' => 'Oklahoma',
                'Olin University' => 'Olin University',
                'Penn State University' => 'Penn State University',
                'Pittsburgh' => 'Pittsburgh',
                'Ponce' => 'Ponce',
                'Puerto Rico' => 'Puerto Rico',
                'Quinnipiac-Netter' => 'Quinnipiac-Netter',
                'Rice University' => 'Rice University',
                'Rush' => 'Rush',
                'Rutgers - RW Johnson' => 'Rutgers - RW Johnson',
                'Rutgers New Jersey' => 'Rutgers New Jersey',
                'Saint Louis' => 'Saint Louis',
                'San Juan Bautista' => 'San Juan Bautista',
                'South Alabama' => 'South Alabama',
                'South Carolina Greenville' => 'South Carolina Greenville',
                'South Dakota-Sanford' => 'South Dakota-Sanford',
                'Southern Cal-Keck' => 'Southern Cal-Keck',
                'Southern Illinois' => 'Southern Illinois',
                'Southern Methodist University' => 'Southern Methodist University',
                'Stanford University' => 'Stanford University',
                'Stony Brook' => 'Stony Brook',
                'SUNY Downstate' => 'SUNY Downstate',
                'SUNY Upstate' => 'SUNY Upstate',
                'Temple University' => 'Temple University',
                'Tennessee' => 'Tennessee',
                'Texas A&M' => 'Texas A&M',
                'Texas Tech' => 'Texas Tech',
                'Toledo' => 'Toledo',
                'Tufts University' => 'Tufts University',
                'Tulane University' => 'Tulane University',
                'University Kentucky' => 'University Kentucky',
                'University of Alabama' => 'University of Alabama',
                'University of Arizona' => 'University of Arizona',
                'University of California--Berkeley' => 'University of California--Berkeley',
                'University of California--Davis' => 'University of California--Davis',
                'University of California--Irvine' => 'University of California--Irvine',
                'University of California--Los Angeles' => 'University of California--Los Angeles',
                'University of California--Riverside' => 'University of California--Riverside',
                'University of California--San Diego' => 'University of California--San Diego',
                'University of California--San Francisco' => 'University of California--San Francisco',
                'University of Central Florida' => 'University of Central Florida',
                'University of Chicago' => 'University of Chicago',
                'University of Colorado--Boulder' => 'University of Colorado--Boulder',
                'University of Connecticut' => 'University of Connecticut',
                'University of Florida' => 'University of Florida',
                'University of Georgia' => 'University of Georgia',
                'University of Illinois' => 'University of Illinois',
                'University of Illinois - Urbana Champaign' => 'University of Illinois - Urbana Champaign',
                'University of Indiana' => 'University of Indiana',
                'University of Iowa' => 'University of Iowa',
                'University of Maryland' => 'University of Maryland',
                'University of Michigan' => 'University of Michigan',
                'University of Michigan--Ann Arbor' => 'University of Michigan--Ann Arbor',
                'University of Minnesota' => 'University of Minnesota',
                'University of New Mexico' => 'University of New Mexico',
                'University of North Carolina--Chapel Hill' => 'University of North Carolina--Chapel Hill',
                'University of Notre Dame' => 'University of Notre Dame',
                'University of Oregon' => 'University of Oregon',
                'University of Pennsylvania' => 'University of Pennsylvania',
                'University of Rochester' => 'University of Rochester',
                'University of South Carolina' => 'University of South Carolina',
                'University of Southern California' => 'University of Southern California',
                'University of Tennessee' => 'University of Tennessee',
                'University of Texas--Austin' => 'University of Texas--Austin',
                'University of Utah' => 'University of Utah',
                'University of Virginia' => 'University of Virginia',
                'University of Washington' => 'University of Washington',
                'University of Wisconsin' => 'University of Wisconsin',
                'University of Wisconsin--Madison' => 'University of Wisconsin--Madison',
                'USF-Morsani' => 'USF-Morsani',
                'UT Austin' => 'UT Austin',
                'UT Austin-Dell' => 'UT Austin-Dell',
                'UT Dallas' => 'UT Dallas',
                'UT Houston-McGovern' => 'UT Houston-McGovern',
                'UT HSC San Antonio' => 'UT HSC San Antonio',
                'UT Medical Branch' => 'UT Medical Branch',
                'UT Rio Grande Valley' => 'UT Rio Grande Valley',
                'UT Southwestern' => 'UT Southwestern',
                'UT Utah' => 'UT Utah',
                'Vanderbilt University' => 'Vanderbilt University',
                'Vermont-Larner' => 'Vermont-Larner',
                'Virginia Commonwealth' => 'Virginia Commonwealth',
                'Virginia Tech Carilion' => 'Virginia Tech Carilion',
                'Wake Forest University' => 'Wake Forest University',
                'Washington and Lee University' => 'Washington and Lee University',
                'Washington State-Floyd' => 'Washington State-Floyd',
                'Washington University Saint Louis' => 'Washington University Saint Louis',
                'Wayne State' => 'Wayne State',
                'Western Michigan-Stryker' => 'Western Michigan-Stryker',
                'West Virginia' => 'West Virginia',
                'William & Mary' => 'William & Mary',
                'Wright State-Boonshoft' => 'Wright State-Boonshoft',
                'WV Marshall-Edwards' => 'WV Marshall-Edwards',
                'Yale University' => 'Yale University'
            ], null, [
                'placeholder' => 'Select a University',
                'class' => ('form-control' . ($errors->has('university') ? ' is-invalid' : ''))
            ]) }}

            @if ($errors->has('university'))
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('university') }}</strong>
                                        </span>
            @endif

        </div>

        <div class="form-group">

            <label for="program">{{ __('Degree') }}</label>

            {{ Form::select('program', [
                'Undergraduate' => 'Undergraduate',
                'MBA' => 'MBA',
                'JD' => 'JD',
                'MD' => 'MD',
                'Dentistry' => 'Dentistry',
                'Dual Degree' => 'Dual Degree',
                'Other' => 'Other'
            ], null, [
                'placeholder' => 'Select a Degree',
                'class' => ('form-control' . ($errors->has('program') ? ' is-invalid' : ''))
            ]) }}

            @if ($errors->has('program'))
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('program') }}</strong>
                                        </span>
            @endif

        </div>


        <div class="form-group">
            <label for="graduation_year">{{ __('Graduation Year') }}</label>

            {{ Form::selectRange('graduation_year', 2004, 2024, null, [
                'placeholder' => 'Select Year',
                'class' => ('form-control' . ($errors->has('graduation_year') ? ' is-invalid' : ''))
            ]) }}

            @if ($errors->has('graduation_year'))
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('graduation_year') }}</strong>
                                        </span>
            @endif

        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
</form>
