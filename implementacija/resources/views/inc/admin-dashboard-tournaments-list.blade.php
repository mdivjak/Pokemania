<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @auth
    @if (Auth::user()->bAdmin)
        @if (count($tournaments) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Tournament Name</th>
                        <th>End Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tournaments as $tournament)
                        <tr>
                            <td>{{$tournament->name}}</td>
                            <td>{{$tournament->endDate}}</td>
                            <td>
                                <a href="" class="btn btn-outline-primary float-right">Check Pending Registrations</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div>
                {{$tournaments->links()}}
            </div>
        @endif
    @endif
    @endauth
</div>