<p>Hi there 👋</p>
<p>We're Juno, we just launched at {{ $competition->colloquial_name_one }} and {{ $competition->colloquial_name_two }} and we’re giving away $500 in scholarships.</p>
<p>The rules are simple. We created a competition between {{ $competition->colloquial_name_one }} and {{ $competition->colloquial_name_two }} to see who can reach {{ $competition->target_number_of_students }} sign ups to competition first and {{ $competition->number_of_prizes }} students from the winning campus will receive ${{ $competition->first_prize_amount }} scholarships each!</p>
<p>Don’t let {{ $competition->colloquial_name_two }} win! Go and sign up <a href="{{ url("/competition/$competition->id") }}">here.</a></p>
<p>
Best,<br/>
Team Juno
</p>
<p>You are receiving this email because you were referred by ({{ $email }})</p>
