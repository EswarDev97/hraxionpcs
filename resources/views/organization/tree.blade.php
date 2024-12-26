<!-- resources/views/organization/tree.blade.php -->
<ul>
    <li>
        <div class="employee">
            <span class="employee-name">{{ $tree['name'] }}</span> - <span class="employee-position">{{ $tree['position'] }}</span>
        </div>
        @if (!empty($tree['subordinates']))
            <ul>
                @foreach ($tree['subordinates'] as $subordinate)
                    @include('organization.tree', ['tree' => $subordinate])
                @endforeach
            </ul>
        @endif
    </li>
</ul>
