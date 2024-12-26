@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'financial-requests'])

@section('_content')
<!DOCTYPE html>
<html>
<head>
    <title>Organization Tree</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .tree-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .tree {
            display: inline-block;
            white-space: nowrap;
        }

        .tree ul {
            display: flex;
            flex-direction: row;
            padding: 0;
            list-style-type: none;
            margin: 0;
        }

        .tree li {
            position: relative;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            background-color: #177385; /* Main color */
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            min-width: 180px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .tree li:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .tree li::before, .tree li::after {
            content: '';
            position: absolute;
            border: 2px solid #fff;
            border-radius: 50%;
            background-color: #fff;
            z-index: 1;
        }

        .tree li::before {
            top: 50%;
            left: -10px;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
        }

        .tree li::after {
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 8px;
            height: 8px;
        }

        .tree li:first-child::before {
            display: none;
        }

        .tree li:last-child::after {
            display: none;
        }

        .employee {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 5px;
        }

        .employee-position {
            font-size: 0.9em;
            font-style: italic;
        }

        /* Colors for different levels */
        .tree ul > li:nth-child(2n) {
            background-color: #1e8e9b; /* Darker shade */
        }

        .tree ul > li:nth-child(2n+1) {
            background-color: #0f5f6b; /* Darker shade */
        }

        /* Toggle Icon */
        .toggle-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.8em;
            color: rgba(255, 255, 255, 0.7);
            transition: transform 0.3s ease;
        }

        .parent.collapsed .toggle-icon {
            transform: rotate(-90deg);
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Company Organization Tree</h1>
    <div class="tree-container">
        @if (!empty($tree))
            <div class="tree">
                <ul>
                    @include('organization.tree', ['nodes' => $tree])
                </ul>
            </div>
        @else
            <p>No data available.</p>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tree li:has(ul)').addClass('parent').prepend('<span class="toggle-icon">▶</span>');
            $('.tree li.parent > .toggle-icon').click(function () {
                $(this).parent().toggleClass('collapsed');
                $(this).siblings('ul').slideToggle('fast');
            });
        });
    </script>
</body>
</html>
@endsection
