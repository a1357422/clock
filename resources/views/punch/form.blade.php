@guest
<div>
    {!! Form::label('cardID','打卡：')!!}
    {!! Form::text('cardID',null,array('autofocus','autocomplete'=>"off",'placeholder'=>"請刷卡或輸入學號，請先確認輸入法為英文",'size'=>35))!!}
</div>
@else
<div>
    {!! Form::label('name','工讀生：')!!}
    {!! Form::select('name',$tags)!!}
</div>
<div>
    {!! Form::label('date','日期：')!!}
    {!! Form::date('date',\Carbon\Carbon::now())!!}
</div>
<div>
    {!! Form::label('punch_in','上班簽到時間：')!!}
    {!! Form::time('punch_in',date('H:i'))!!}
</div>
<div>
    {!! Form::label('punch_out','下班簽到時間：')!!}
    {!! Form::time('punch_out',date('H:i'))!!}
</div>
<div>
    {!! Form::label('note','備註：')!!}
    {!! Form::text('note',null,array('placeholder'=>"給予時數原因，若無可免填"))!!}
</div>
@endguest
<div>
    {!! Form::submit($submitButtonText,['class' => 'btn btn-primary btn-xl'])!!}
</div>