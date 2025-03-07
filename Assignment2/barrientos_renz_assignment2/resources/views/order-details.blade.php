@extends('master')

@section('title')
    <title>Order Details</title>
@endsection

@section('content')
    <h1>Order Details</h1>
    <form>
        <table>
            <tr>
                <td><label>Transaction No:</label></td>
                <td><input type="text" value="{{ $transNo }}" readonly></td>
            </tr>

            <tr>
                <td><label>Order No:</label></td>
                <td><input type="text" value="{{ $orderNo }}" readonly></td>
            </tr>

            <tr>
                <td><label>Item ID:</label></td>
                <td><input type="text" value="{{ $itemId }}" readonly></td>
            </tr>

            <tr>
                <td><label>Name:</label></td>
                <td><input type="text" value="{{ $name }}" readonly></td>
            </tr>

            <tr>
                <td><label>Price:</label></td>
                <td><input type="text" value="{{ $price }}" readonly></td>
            </tr>

            <tr>
                <td><label>Quantity:</label></td>
                <td><input type="text" value="{{ $qty }}" readonly></td>
            </tr>
        </table>
    </form>
@endsection