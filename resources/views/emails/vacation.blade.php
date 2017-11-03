<p>Vacation request from {{$vacation->user->name}}</p></br>
<p>From {{$vacation->from_date}} to {{$vacation->to_date}}</p></br>
<a href="http://127.0.0.1:8000/api/vacation-approve/{{$vacation->id}}">Approve vacation</a>