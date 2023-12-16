@extends('dashboard.report.pdf.master')
@section('content')
    <table id="myTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>Notes</th>
                <th>TRX</th>
                <th>Customer</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($table as $t)
                @php
                    $total = 0;
                    $total += $t->amount;
                @endphp
                <tr>
                    <td>
                        <span style="color: gray"> {{ dt($t->created_at) }}</span>
                    </td>
                    <td>{!! $t->status() !!}</td>
                    <td>{{ $t->info }}</td>
                    <td>{{ $t->Invoice }}</td>
                    <td>{{ $t->customers->name }}</td>
                    <td>{{ nb($t->amount) }}</td>
                </tr>
            @endforeach
        </tbody>
        @if ($table->count() > 0)
            <tfoot>
                <tr style="background-color: #F3EEEA">
                    <td colspan="5" style="text-align: end">Total</td>
                    <td>{{ nb($total ?? 0) }}</td>
                </tr>
            </tfoot>
        @endif
    </table>
@endsection
