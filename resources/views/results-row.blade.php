@php
    $score = $test->total_points / $test->total_symbols * 100;
    $scorePercentil = $test->percentil() * 100;
    $scoreAvg = $allTests->sum('total_points') / $allTests->sum('total_symbols') * 100;
    $scoreMedian = $allTests->get()->median('total_points') / $test->total_symbols * 100;

    $passedSame = $test->passed_same;
    $passedSameAvg = $allTests->avg('passed_same');
    $passedSameMedian = $allTests->get()->median('passed_same');

    $clickedOrdinary = $test->clicked_ordinary;
    $clickedOrdinaryAvg = $allTests->avg('clicked_ordinary');
    $clickedOrdinaryMedian = $allTests->get()->median('clicked_ordinary');
@endphp
<tr>
    <th>{{ $test->created_at }}</th>

    <td @class([
        'bg-info-content',
        'bg-success-content' => ($score > $scoreAvg && $score > $scoreMedian),
        'bg-warning-content' => ($score < $scoreAvg && $score < $scoreMedian),
    ])>
        {{ round($score, 1) }}
    </td>
    <td>{{ round($scorePercentil, 1) }}</td>
    <td>{{ round($scoreAvg, 1) }}</td>
    <td>{{ round($scoreMedian, 1) }}</td>

    <td @class([
        'bg-info-content',
        'bg-success-content' => ($passedSame < $passedSameAvg && $passedSame < $passedSameMedian),
        'bg-warning-content' => ($passedSame > $passedSameAvg && $passedSame > $passedSameMedian),
    ])>
        {{ $passedSame }}
    </td>
    <td>{{ round($passedSameAvg, 1) }}</td>
    <td>{{ round($passedSameMedian, 1) }}</td>

    <td @class([
        'bg-info-content',
        'bg-success-content' => ($clickedOrdinary < $clickedOrdinaryAvg && $clickedOrdinary < $clickedOrdinaryMedian),
        'bg-warning-content' => ($clickedOrdinary > $clickedOrdinaryAvg && $clickedOrdinary > $clickedOrdinaryMedian),
    ])>
        {{ $clickedOrdinary }}
    </td>
    <td>{{ round($clickedOrdinaryAvg, 1) }}</td>
    <td>{{ round($clickedOrdinaryMedian, 1) }}</td>
</tr>
