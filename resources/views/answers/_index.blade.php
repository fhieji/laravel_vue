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
                        <a title="This answer is useful" href="vote-up">
                            <i class="fas fa-caret-up fa-3x"></i>
                        </a>
                        <span class="votes-count">1230</span>
                        <a title="This answer is not useful" href="vote-down off">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>
                        <a title="Mark this answer as best answer" href="{{ $answer->status }} mt-2">
                            <i class="fa-star"></i>
                            <span class="fas fa-check fa-2x">1234</span>
                        </a>
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
                                    <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
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