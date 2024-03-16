@extends('components.navbar')

@section('title')
    Competition Rank
@endsection

@section('content')
    <div class="container p-2 mt-2">
        @isset($teams)
            <h1 style="font-size:32px;color:#323842; font-weight:600;" class="mt-5 mb-4">Competitors Rank</h1>
            <table class="table table-striped text-center mb-4">
                <thead>
                    <th>RANK</th>
                    <th>TEAM NAME</th>
                    <th>TOTAL POINTS</th>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($teams); $i++)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $teams[$i] }}</td>
                            <td>{{ $points[$i] }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        @else
            <h1 style="font-size:32px;color:#323842; font-weight:600;" class="mt-5 mb-4 text-center">
                The competition will start when the number of participants is complete
            </h1>
        @endisset
    </div>
@endsection
