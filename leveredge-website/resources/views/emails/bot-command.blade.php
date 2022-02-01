<p>Hi Max,</p>

<p>
    The following ip addresses were added to the internal ip addresses table as potential bots:
</p>

<p>
    @foreach($iias as $iia)
        <a href="{{ url('/nova/resources/internal-ip-addresses/' . $iia->id) }}">{{ $iia->ip }}</a> <br />
    @endforeach
</p>

<p>
    Thanks,<br/>
    IdentifyBot Command
</p>
