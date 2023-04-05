<div class="modal fade" id="history" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">История</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(!\Auth::user()->getHistory->isEmpty())
                    @foreach(\Auth::user()->getHistory->reverse() as $history)
                        <p><a href="{{ route('historyDz', ['dz_id' => $history->dz_id]) }}">{{ $history->title }} (Дата: {{ \Carbon\Carbon::parse($history->created_at)->format('d.m.Y H:i')}})</a></p>
                    @endforeach
                @else
                    <p>Истории нет.</p>
                @endif
            </div>
        </div>
    </div>
</div>
