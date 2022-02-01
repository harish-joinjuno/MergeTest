@extends('template.public')

@section('content')




    <div class="jumbotron bg-white mt-0 mb-0 pt-0 pb-0" id="modern-hero">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>How much could college cost for your kids?</h1>
                    <h2>We looked into the cost of tuition at 100 national universities for the past ten years to find out.</h2>

                    <p class="tips">
{{--                        <img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                        The average school has increased tuition + fees by 30% over the last decade, even after accounting for inflation
                    </p>

                    <p class="tips mt-3 mt-md-0">
{{--                        <img src="{{ url('/img/check-mark.png') }}" class="d-inline" height="12px">--}}
                        If we don’t slow that down, the average school in our dataset will cost twice as much for your kids as it does today
                    </p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <form class="form" id="navigate_to_university_page" method="get" action="">
                                <div class="form-group">
                                    <label for="university">See what could happen</label>
                                    <select name="university" class="form-control" id="university" onChange="changeAction()">
                                        <option>Select your University</option>
                                        @foreach($universities as $university)
                                            <option value="{{ url('/college-costs/' . $university->slug)  }}">{{ $university->university_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Check it Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="jumbotron bg-light-grey mt-0 mb-0 pt-0 pb-0">

    <div class="container d-none d-md-block">
        <div class="row">
            <div class="col-12">
                <table class="table-borderless table-striped" id="top-twenty-schools-cost">

                    <colgroup>
                        <col style="width: 1%">
                        <col style="width: 20%" />
                        <col style="width: 20%" />
                        <col style="width: 5%" />
                        <col style="width: 20%" />
                        <col style="width: 20%" />
                    </colgroup>

                    <tr class="bg-transparent">
                        {{--<td class=""></td>--}}
                        <td colspan="3" class="text-left bg-transparent">
                            <h4 class="common-question-heading"><span class="brand-color">20 Most Expensive Schools Today</span></h4>
                        </td>
                        <td class=""></td>
                        <td colspan="2" class="text-left bg-transparent">
                            <h4 class="common-question-heading"><span class="brand-color">20 Most Expensive Schools For Your Kids</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <th class="text-left">School</th>
                        <th class="text-center">2017/18 Cost<br> in 2019 Dollars</th>
                        <th></th>
                        <th class="text-left">School</th>
                        <th class="text-center">2045/46 Cost<br>in 2019 Dollars <a href="#how-we-calculated-it">*</a></th>
                    </tr>

                    <tr><td>1</td><td>Columbia</td><td class="text-center">$58K</td><td></td><td>William and Mary</td><td class="text-center">$156K</td></tr>
                    <tr><td>2</td><td>U Chicago</td><td class="text-center">$57K</td><td></td><td>Texas Christian</td><td class="text-center">$141K</td></tr>
                    <tr><td>3</td><td>Tufts</td><td class="text-center">$55K</td><td></td><td>SMU</td><td class="text-center">$141K</td></tr>
                    <tr><td>4</td><td>USC</td><td class="text-center">$55K</td><td></td><td>Baylor</td><td class="text-center">$133K</td></tr>
                    <tr><td>5</td><td>Carnegie Mellon</td><td class="text-center">$55K</td><td></td><td>Illinois IofT</td><td class="text-center">$126K</td></tr>
                    <tr><td>6</td><td>Brandeis</td><td class="text-center">$55K</td><td></td><td>U Chicago</td><td class="text-center">$118K</td></tr>
                    <tr><td>7</td><td>UPenn</td><td class="text-center">$54K</td><td></td><td>Columbia</td><td class="text-center">$116K</td></tr>
                    <tr><td>8</td><td>Duke</td><td class="text-center">$54K</td><td></td><td>Fordham</td><td class="text-center">$107K</td></tr>
                    <tr><td>9</td><td>GW</td><td class="text-center">$54K</td><td></td><td>USC</td><td class="text-center">$105K</td></tr>
                    <tr><td>10</td><td>Brown</td><td class="text-center">$54K</td><td></td><td>Dartmouth</td><td class="text-center">$104K</td></tr>
                    <tr><td>11</td><td>Dartmouth</td><td class="text-center">$54K</td><td></td><td>Cornell</td><td class="text-center">$103K</td></tr>
                    <tr><td>12</td><td>BC</td><td class="text-center">$54K</td><td></td><td>Northeastern</td><td class="text-center">$103K</td></tr>
                    <tr><td>13</td><td>Tulane</td><td class="text-center">$54K</td><td></td><td>Duke</td><td class="text-center">$102K</td></tr>
                    <tr><td>14</td><td>Cornell</td><td class="text-center">$54K</td><td></td><td>Brandeis</td><td class="text-center">$101K</td></tr>
                    <tr><td>15</td><td>Northwestern</td><td class="text-center">$54K</td><td></td><td>BC</td><td class="text-center">$100K</td></tr>
                    <tr><td>16</td><td>SMU</td><td class="text-center">$53K</td><td></td><td>UPenn</td><td class="text-center">$99K</td></tr>
                    <tr><td>17</td><td>Rensselaer</td><td class="text-center">$53K</td><td></td><td>Rice</td><td class="text-center">$99K</td></tr>
                    <tr><td>18</td><td>Georgetown</td><td class="text-center">$53K</td><td></td><td>Tufts</td><td class="text-center">$99K</td></tr>
                    <tr><td>19</td><td>Johns Hopkins</td><td class="text-center">$53K</td><td></td><td>CalTech</td><td class="text-center">$98K</td></tr>
                    <tr><td>20</td><td>BU</td><td class="text-center">$53K</td><td></td><td>Northwestern</td><td class="text-center">$97K</td></tr>
                </table>
            </div>
        </div>
    </div>

    </div>


    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-light-grey">
    <div class="container d-md-none">
        <div class="row">
            <div class="col-12">
                <table class="table-borderless table-striped" id="top-twenty-schools-cost">

                    <colgroup>
                        <col style="width: 1%">
                        <col style="width: 20%" />
                        <col style="width: 20%" />
                    </colgroup>

                    <tr class="bg-transparent">
                        <td colspan="3" class="text-center">
                            <h4 class="common-question-heading"><span class="brand-color">20 Most Expensive Schools Today</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <th class="text-left">School</th>
                        <th class="text-center">2017/18 Cost<br> in 2019 Dollars</th>
                    </tr>

                    <tr><td>1</td><td>Columbia</td><td class="text-center">$58K</td></tr>
                    <tr><td>2</td><td>U Chicago</td><td class="text-center">$57K</td></tr>
                    <tr><td>3</td><td>Tufts</td><td class="text-center">$55K</td></tr>
                    <tr><td>4</td><td>USC</td><td class="text-center">$55K</td></tr>
                    <tr><td>5</td><td>Carnegie Mellon</td><td class="text-center">$55K</td></tr>
                    <tr><td>6</td><td>Brandeis</td><td class="text-center">$55K</td></tr>
                    <tr><td>7</td><td>UPenn</td><td class="text-center">$54K</td></tr>
                    <tr><td>8</td><td>Duke</td><td class="text-center">$54K</td></tr>
                    <tr><td>9</td><td>GW</td><td class="text-center">$54K</td></tr>
                    <tr><td>10</td><td>Brown</td><td class="text-center">$54K</td></tr>
                    <tr><td>11</td><td>Dartmouth</td><td class="text-center">$54K</td></tr>
                    <tr><td>12</td><td>BC</td><td class="text-center">$54K</td></tr>
                    <tr><td>13</td><td>Tulane</td><td class="text-center">$54K</td></tr>
                    <tr><td>14</td><td>Cornell</td><td class="text-center">$54K</td></tr>
                    <tr><td>15</td><td>Northwestern</td><td class="text-center">$54K</td></tr>
                    <tr><td>16</td><td>SMU</td><td class="text-center">$53K</td></tr>
                    <tr><td>17</td><td>Rensselaer</td><td class="text-center">$53K</td></tr>
                    <tr><td>18</td><td>Georgetown</td><td class="text-center">$53K</td></tr>
                    <tr><td>19</td><td>Johns Hopkins</td><td class="text-center">$53K</td></tr>
                    <tr><td>20</td><td>BU</td><td class="text-center">$53K</td></tr>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <table class="table-borderless table-striped" id="top-twenty-schools-cost">

                    <colgroup>
                        <col style="width: 1%">
                        <col style="width: 20%" />
                        <col style="width: 20%" />
                    </colgroup>

                    <tr class="bg-transparent">
                        <td colspan="3" class="text-center">
                            <h4 class="common-question-heading"><span class="brand-color">20 Most Expensive Schools For Your Kids</span></h4>
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <th class="text-left">School</th>
                        <th class="text-center">2045/46 Cost<br>in 2019 Dollars</th>
                    </tr>

                    <tr><td>1</td><td>William and Mary</td><td class="text-center">$156K</td></tr>
                    <tr><td>2</td><td>Texas Christian</td><td class="text-center">$141K</td></tr>
                    <tr><td>3</td><td>SMU</td><td class="text-center">$141K</td></tr>
                    <tr><td>4</td><td>Baylor</td><td class="text-center">$133K</td></tr>
                    <tr><td>5</td><td>Illinois IofT</td><td class="text-center">$126K</td></tr>
                    <tr><td>6</td><td>U Chicago</td><td class="text-center">$118K</td></tr>
                    <tr><td>7</td><td>Columbia</td><td class="text-center">$116K</td></tr>
                    <tr><td>8</td><td>Fordham</td><td class="text-center">$107K</td></tr>
                    <tr><td>9</td><td>USC</td><td class="text-center">$105K</td></tr>
                    <tr><td>10</td><td>Dartmouth</td><td class="text-center">$104K</td></tr>
                    <tr><td>11</td><td>Cornell</td><td class="text-center">$103K</td></tr>
                    <tr><td>12</td><td>Northeastern</td><td class="text-center">$103K</td></tr>
                    <tr><td>13</td><td>Duke</td><td class="text-center">$102K</td></tr>
                    <tr><td>14</td><td>Brandeis</td><td class="text-center">$101K</td></tr>
                    <tr><td>15</td><td>BC</td><td class="text-center">$100K</td></tr>
                    <tr><td>16</td><td>UPenn</td><td class="text-center">$99K</td></tr>
                    <tr><td>17</td><td>Rice</td><td class="text-center">$99K</td></tr>
                    <tr><td>18</td><td>Tufts</td><td class="text-center">$99K</td></tr>
                    <tr><td>19</td><td>CalTech</td><td class="text-center">$98K</td></tr>
                    <tr><td>20</td><td>Northwestern</td><td class="text-center">$97K</td></tr>
                </table>
            </div>
        </div>

    </div>
    </div>

    @include('data.university-financial.select-university')

    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-light-grey">
        @include('data.university-financial.how-we-got-there')
    </div>



    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Learn more about your University</h2>
                <div class="separator"></div>
            </div>

            <div class="col-12 col-md-6">
                <ul>
                    @foreach($universities as $university)
                        @if($loop->iteration <= 50)
                        <li>
                            <a href="{{ '/college-costs/' . $university->slug }}">{{ $university->university_name }}</a>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="col-12 col-md-6">
                <ul>
                    @foreach($universities as $university)
                        @if($loop->iteration > 50)
                            <li>
                                <a href="{{ '/college-costs/' . $university->slug }}">{{ $university->university_name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
    </div>





@endsection
