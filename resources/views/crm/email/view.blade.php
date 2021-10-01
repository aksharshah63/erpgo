<dl class="row p-2">
        <div class="col-6">
            <span class="text-sm text-muted p-2">{{ __('Email') }}</span>
            <span class="d-block h6 mb-0 p-2"><a href="mailto:{{ $email->email }}">{{ $email->email }}</a></span>
        </div>
        <div class="col-6">
            <span class="text-sm text-muted p-2">{{ __('Subject') }}</span>
            <span class="d-block h6 mb-0 p-2">{{ $email->subject }}</span>
        </div>
</dl>
<dl class="row p-2">
    <div class="col-12">
        <span class="text-sm text-muted p-2">{{ __('Description') }}</span>
        <span class="d-block h6 mb-0 p-2">{!! $email->description !!}</span>
    </div>
</dl>

