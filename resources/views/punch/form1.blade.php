@if ($state != 2)
<div>
    {!! Form::label('punch_in','上班簽到時間：')!!}
    {!! Form::time('punch_in',$selectPunch_in)!!}
</div>
<div>
    {!! Form::label('punch_out','下班簽到時間：')!!}
    {!! Form::time('punch_out',$selectPunch_out)!!}
</div>
<div>
    {!! Form::label('note','備註：')!!}
    {!! Form::text('note',$selectPunch_note,array('placeholder'=>"給予時數原因，若無可免填"))!!}
</div>
@else
<div>
    上班簽到時間：{{$selectPunch_in}}
    {!! Form::hidden('punch_in',$selectPunch_in)!!}
</div>
<div>
    下班簽到時間：{{$selectPunch_out}}
    {!! Form::hidden('punch_out',$selectPunch_out)!!}
</div>
<div>
    {!! Form::label('note','備註：')!!}
    {!! Form::text('note',$selectPunch_note,array('placeholder'=>"給予時數原因，若無可免填"))!!}
</div>
@endif
<div>
    {!! Form::hidden('state', $state) !!}
    {!! Form::submit($submitButtonText,['class' => 'btn btn-primary btn-xl'])!!}
</div>
