@extends('master')

@section('title')
    <title>Customer</title>
@endsection

@section('content')
    <h1>Customer Information</h1>
    <form>
        <table>
            <tr>
                <td><label>Customer ID:</label></td>
                <td><input type="text" value="{{ $id }}" readonly></td>
            </tr>

            <tr>
                <td><label>Name:</label></td>
                <td><input type="text" value="{{ $name }}" readonly></td>
            </tr>

            <tr>
                <td><label>Address:</label></td>
                <td><input type="text" value="{{ $address }}" readonly></td>
            </tr>
        </table>
    </form>
@endsection
