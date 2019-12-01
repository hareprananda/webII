<html>
<h1>Ini adalah form </h1>
<form action="{{url('/formapi')}}" method="post">
@csrf
<input type="email" placeholder="email..." name="email">
<input type="password" placeholder="Password..." name="password">
<button type="submit">Submit</button>
</form>

</html>