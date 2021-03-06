@extends('layouts.master')

@section('title')
新規投稿 | Owl
@stop

@section('navbar-menu')
    @include('layouts.navbar-menu')
@stop

@section('contents-pagehead')
<p class="page-title">新規投稿</p>
@stop

@section('contents-main')

    <br />
    @if($errors->has('title'))
    <div class="alert alert-warning" role="alert">
        {{$errors->first('title')}}
    </div>
    @endif
    @if($errors->has('body'))
    <div class="alert alert-warning" role="alert">
        {{$errors->first('body')}}
    </div>
    @endif
    @if($errors->has('published'))
    <div class="alert alert-warning" role="alert">
        {{$errors->first('published')}}
    </div>
    @endif

    {{Form::open(array('url'=>'items','class'=>'form-items'))}}

            {{ HTML::gravator($User->email, 30,'mm','g','true',array('class'=>'media-object')) }}

    <div class="form-group">
        {{Form::label('title', 'タイトル')}}
        {{Form::text('title', isset($template->title) ? HTML::date_replace($template->title) : '' ,array('class'=>'form-control'))}}
    </div>

    <div class="form-group">
        {{Form::label('body', '本文')}}
        {{Form::textarea('body', isset($template->body) ? $template->body : '' ,array('class'=>'form-control', 'rows'=>'15', 'id' => 'item_text'))}}
    </div>

    <div class="form-group">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
            {{Form::label('published', '記事の公開設定：')}}
            {{Form::select('published', array('0' => '非公開', '1' => '限定公開', '2' => '公開'), '2')}}
            {{Form::submit('投稿',array('class'=>'btn btn-success btn-block'))}}
        </div>
    </div>

    {{Form::close()}}

    {{Form::open(array('url'=>'image/upload','class'=>'form-items', 'files' => true))}}
    <br />
    <div class="form-group">
        {{Form::label('image', '画像アップロード')}}
        {{Form::file('image', array('id' => 'file_id')) }}
    </div>
    {{Form::close()}}
@stop

@section('contents-sidebar')
<div class="sidebar-user">
    <div class="media">
        <a class="pull-left" href="#">
            {{ HTML::gravator($User->email, 30,'mm','g','true',array('class'=>'media-object')) }}
        </a>
        <div class="media-body">
            <h4 class="media-heading"><a href="/{{{$User->username}}}" class="username">{{{$User->username}}}</a></h4>
        </div>
    </div>
    <h5>最近の投稿</h5>
    <div class="sidebar-user-items">
        <ul>
        @foreach ($user_items as $item)
            <li><a href="{{ action('ItemController@show', $item->open_item_id) }}">{{{ $item->title }}}</a></li>
        @endforeach
        </ul>
    </div>
</div>
@stop

@section('addJs')
{{HTML::script('js/jquery.upload-1.0.2.min.js')}}
{{HTML::script('js/image.upload.js')}}
@stop
