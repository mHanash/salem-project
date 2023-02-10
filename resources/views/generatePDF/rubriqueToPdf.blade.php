<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        table {

            border-collapse: collapse;
        }

        table thead tr th {
            border: 1px solid black !important;
            vertical-align: middle !important;
            text-align: center !important;
        }

        table tbody tr td {
            border: 1px solid black;
        }

        table tfoot tr td {
            border: 1px solid black;
        }

        table tbody,
        table thead {
            border: 1px solid black;
        }

        table thead tr {
            border: 1px solid black;
        }

        table tfoot tr {
            border: 1px solid black;
        }

        th,
        td {
            font-size: 13px;
            line-height: 14px;
            padding: 1.5px !important;
        }
    </style>
    <title>RAPPORT FINANCIER-{{ date('d-m-Y') }}</title>
</head>

<body>

    {{-- <script type="text/php">
        if ( isset($pdf) ) {
            $x = 310;
            $y = 793;
            $text = "{PAGE_NUM} / {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 8;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script> --}}
    <div class="container-full">
        <div style="width:100%;padding: 0 10px; display:inline-block" class="">
            <div style="height: 75px;float:left;width:40%;margin-right:30%" class="p-1 border border-dark rounded">
                <span style="font-weight: bold;font-size: 13px">GRAND SEMINAIRE INTERDIOCESSAIN</span> <br /><i
                    style="font-size: 12px">SAINT CYPRIEN/KIKWIT</i><br>
                <span style="font-size: 12px">B.P. /KKT</span>

            </div>
            <div style="text-align:right;height: 75px;float:right;width:30%" class="">
                <span style="font-size: 12px"> Date impression : {{ date('d-m-Y H:i') }}</span><br />
                <span style="font-size: 12px"> Imprimé par : {{ $user->beneficiary->name }}
                    {{ $user->beneficiary->lastname }}</span>
            </div>
        </div>
        <div style="text-align:center;">
            <span style="font-weight: bold">PREVISION BUGDETAIRE </span> {{ $budgeting->startYear->year }} -
            {{ $budgeting->endYear->year }}
        </div>
        <hr style="background-color: black">

        <section class="mt-2">
            <table style="width:20%; margin-bottom:10px">
                <thead>
                    <tr>
                        <th colspan="2">Taux de change</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($toCurrencies as $item)
                        <tr>
                            <td>1{{ $item->currency }}</td>
                            <td>{{ $item->pivot->rate . $budgeting->currency->currency }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table bordered class="table" style="border: 1px solid black">
                <thead>
                    <tr style="border: 1px solid black">
                        <th rowspan="2" style="width: 2%;" scope="col">#</th>
                        <th rowspan="2" style="width: 38%" scope="col">Rubrique</th>
                        <th colspan="{{ count($toCurrencies) + 1 }}" style="" scope="col">Débit</th>
                        <th colspan="{{ count($toCurrencies) + 1 }}" style="" scope="col">Crédit</th>
                    <tr style="border: 1px solid black">
                        <th style="text-align:center;width: 10%">{{ $budgeting->currency->currency }}</th>
                        @foreach ($toCurrencies as $val)
                            <th style="text-align:center;width: 10%">{{ $val->currency }}</th>
                        @endforeach
                        <th style="text-align:center;width: 10%">{{ $budgeting->currency->currency }}</th>
                        @foreach ($toCurrencies as $val2)
                            <th style="text-align:center;width: 10%">{{ $val2->currency }}</th>
                        @endforeach
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @if ($datas)
                        @php
                            $i = 0;
                            $totDeb = 0;
                            $totCre = 0;
                        @endphp
                        @foreach ($datas as $item)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td scope="row">{{ $i }}</td>
                                <td>{{ $item['name'] }}</td>
                                @if ($item['state'] == 1)
                                    @php
                                        $totCre += $item['amount'];
                                    @endphp
                                    <td style="text-align:right">-</td>
                                    @foreach ($toCurrencies as $val)
                                        <td style="text-align:right">-</td>
                                    @endforeach
                                    <td style="text-align:right">
                                        {{ number_format($item['amount'], 2, ',', '.') }}</td>
                                    @foreach ($toCurrencies as $val)
                                        <td style="text-align:right">
                                            {{ number_format($item['amount'] / $val->pivot->rate, 2, ',', '.') }}</td>
                                    @endforeach
                                @else
                                    @php
                                        $totDeb += $item['amount'];
                                    @endphp
                                    <td style="text-align:right">
                                        {{ number_format($item['amount'], 2, ',', '.') }}</td>
                                    @foreach ($toCurrencies as $val)
                                        <td style="text-align:right">
                                            {{ number_format($item['amount'] / $val->pivot->rate, 2, ',', '.') }}</td>
                                    @endforeach
                                    <td style="text-align:right">-</td>
                                    @foreach ($toCurrencies as $val)
                                        <td style="text-align:right">-</td>
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">TOTAL</td>
                        <td style="text-align:right">{{ number_format($totDeb, 2, ',', '.') }}</td>
                        @foreach ($toCurrencies as $item)
                            <td style="text-align:right">{{ number_format($totDeb / $item->pivot->rate, 2, ',', '.') }}
                            </td>
                        @endforeach
                        <td style="text-align:right">{{ number_format($totCre, 2, ',', '.') }}</td>
                        @foreach ($toCurrencies as $item)
                            <td style="text-align:right">{{ number_format($totCre / $item->pivot->rate, 2, ',', '.') }}
                            </td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
            {{--<h5 style="color: red">Reste</h5>
            <ul>
                <li>{{ number_format($totCre - $totDeb, 2, ',', '.') }}
                    {{ $budgeting->currency->currency }}</li>
                @foreach ($toCurrencies as $item)
                    <li>{{ number_format(($totCre - $totDeb) / $item->pivot->rate, 2, ',', '.') }}
                        {{ $item->currency }}</li>
                @endforeach
            </ul>--}}
        </section>
        <footer style="width:100%;position: absolute;bottom: 0px">
            <div style="width:100%;font-size: 11px; display:inline-block">
                <div style="width:50%;float:left;">Salem FIN v{{ env('APP_VERSION') }}</div>
                <div style="width:50%;float:right"></div>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
