@extends ('_layouts/master')

@section('title')
    Imprint
@stop

@section('body')
<section class="font-thin text-xs mb-4" lang="de">
    <h1 class="text-2xl">Impressum</h1>

    <h2 class="text-xl mb-2">
    Angaben gemäß § 5 TMG:
    </h2>

    <address class="font-mono font-normal mb-4">
    Stefan Graupner<br/>
    Leipziger Straße 41<br/>
    <br/>
    D-10117 Berlin
    </address>

    <dl class="table xs:w-full sm:w-1/3 md:w-3/4 mb-4">
        <div class="table-row">
            <dt class="table-cell pr-4 font-medium">Website:</dt>
            <dd class="table-cell">meanderingsoul.com</dd>
        </div>
        <div class="table-row">
            <dt class="table-cell pr-4 font-medium">E-Mail:</dt>
            <dd class="table-cell">
                efrane&#64;meanderingsoul.com<br class="sm:hidden"/>
                (<abbr title="Pretty good privacy" lang="en">PGP</abbr>-<span lang="en">Fingerprint</span>: 56AE 4A43 D25A 020F 0802 CCEF EC87 46AF 2F3A 3923)
            </dd>
        </div>
    </dl>

    <p>
    Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:<br/>
    s.o.
    </p>
</section>

<section class="text-2xs font-thin mb-4">
    This information is required by German Law and thus written in German.
</section>
@stop
