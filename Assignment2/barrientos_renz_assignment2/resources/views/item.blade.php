@extends('master')

@section('title')
    <title>Item</title>
@endsection

@section('content')
    <h1>Item Information</h1>
    <form>
        <table>
            <tr>
                <td><label>Item No:</label></td>
                <td><input type="text" value="{{ $itemNo }}" readonly></td>
            </tr>

            <tr>
                <td><label>Name:</label></td>
                <td><input type="text" value="{{ $name }}" readonly></td>
            </tr>

            <tr>
                <td><label>Price:</label></td>
                <td><input type="text" value="{{ $price }}" readonly></td>
            </tr>
        </table>
    </form>
@endsection