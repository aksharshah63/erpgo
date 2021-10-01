@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Journal Entry') }}
@endsection
@section('action-button')
    @can('Create Journal')
        <div class="row d-flex justify-content-end">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-12">
                <div class="all-button-box">
                    <a href="{{ route('journal_entries.create') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                        <i class="fas fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
            </div>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Journal ID') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Date') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Amount') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Description') }}</th>
                @if(Gate::check('Edit Journal') || Gate::check('Delete Journal'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($journalEntries as $journalEntry)
                <tr>
                    <td class="Id">
                        <a href="{{ route('journal_entries.show',$journalEntry->id) }}">{{AUth::user()->journalNumberFormat($journalEntry->journal_id) }}</a>
                    </td>
                    <td>{{\App\Utility::getDateFormated($journalEntry->date) }}</td>
                    <td>
                        {{ \Auth::user()->priceFormat($journalEntry->totalCredit())}}
                    </td>
                    <td>{{!empty($journalEntry->description)?$journalEntry->description:'-'}}</td>
                    @if(Gate::check('Edit Journal') || Gate::check('Delete Journal'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Journal')
                                    <a href="{{ route('journal_entries.edit',$journalEntry->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan
                                @can('Delete Journal')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $journalEntry->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['journal_entries.destroy', $journalEntry->id], 'id' => 'delete-form-' . $journalEntry->id]) }}
                                    {{ Form::close() }}
                                @endcan
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
