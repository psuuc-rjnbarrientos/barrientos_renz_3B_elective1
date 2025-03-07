@extends('master')

@section('title')
    <title>Order</title>
@endsection

@section('content')
    <h1>Order Information</h1>
    <form>
        <table>
            <tr>
                <td><label>Customer ID:</label></td>
                <td><input type="text" value="{{ $customerId }}" readonly></td>
            </tr>

            <tr>
                <td><label>Name:</label></td>
                <td><input type="text" value="{{ $name }}" readonly></td>
            </tr>

            <tr>
                <td><label>Order No:</label></td>
                <td><input type="text" value="{{ $orderNo }}" readonly></td>
            </tr>

            <tr>
                <td><label>Date:</label></td>
                <td><input type="text" value="{{ $date }}" readonly></td>
            </tr>
        </table>
    </form>
@endsection