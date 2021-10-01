<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Leave Date') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Leave Days') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Leave Reason') }}</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($leaveData as $leave)
                <tr>
                    <td>{{\App\Utility::getDateFormated($leave->from).' - '.\App\Utility::getDateFormated($leave->to)}}</td>
                    <td>{{ Utility::diffDate($leave->from,$leave->to,true) }}</td>
                    <td>{{ $leave->reason}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

