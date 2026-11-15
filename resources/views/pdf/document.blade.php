<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ config('app.name') }}</p>
    <table>
        @foreach ($rows as $label => $value)
            <tr>
                <th align="left">{{ $label }}</th>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
