    <table class="table table-bordered table-hover table-sm" content="">
        @foreach($content as $tr)
            @foreach($tr as $ts)
                    <td>{!! $td !!}</td>
            @endforeach
        @endforeach
    </table>
