@extends('master')
@section('content')
<html>
  <head>
    <meta charset="utf-8">
    <title>Poi PDF</title>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">  
  </head>
<body>
<h4>{{$locations->lokasi}}</h4>
<div id ="img"><img src="{{$det->image}}" width="640" height="580"></div>
<div id ="keterangan">{{$det->keterangan}}</div>
</body>
</html>
