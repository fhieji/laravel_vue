@if($answersCount > 0)

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . Str::plural('Answer',$question->answers_count) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach ($question->answers as $answer )

                    <div class="media mt-2">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This Answer is useful" 
                            class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id}}/vote" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votes-count">{{ $answer->votes_count }}</span>

                            <a title="This Answer is not useful" 
                            class="{{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id}}/vote" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                        
                        
                    </div>

                        <div class="media-body">
                            {{  $answer->body  }}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @if (Auth::user()->can('update', $answer))
                                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endif
                                        @if(Auth::user()->can('delete', $answer))
                                        <form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    @include('shared._author', [
                                        'model' => $answer,
                                        'label' => 'answered'
                                    ])
                                </div>
                            </div>
                            
                        </div>    
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif