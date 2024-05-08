@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Quotations</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total Price</th>
                            <th>Taxable Price</th>
                            <th>Tax Price</th>
                            <th>Editable</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotations as $quotation)
                            <tr>
                                <td>{{ $quotation->id }}</td>

                                <td>{{ $quotation->total_price }}</td>
                                <td>{{ $quotation->taxable_price }}</td>
                                <td>{{ $quotation->tax_price }}</td>
                                <td>{{ $quotation->is_editable ? 'Yes' : 'No' }}</td>

                                <td>
                                    @if (auth()->user()->is_admin)
                                        <form action="{{ route('quotations.edit', $quotation) }}"
                                              method="GET"
                                              class="d-inline">
                                            @csrf

                                            <button type="submit"
                                                    class="btn btn-link"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </form>
                                    @endif
                                    <form action="{{ route('quotations.destroy', $quotation) }}"
                                          method="POST"
                                          style="display: inline;"
                                          onsubmit="return confirm('Are you sure you want to delete this quotation?')"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-link"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
