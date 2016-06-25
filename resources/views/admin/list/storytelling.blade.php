@extends('admin.dashboard-layout')
@section('content')
  <div class="row storytelling-list">
    <div class="col-xs">
      @foreach ($stories as $story)
        <div class="row story">
          <div class="col-xs">
            <div class="row middle-xs story__header">
              <h2>{{$story->title}}</h2>
              <span><a href="/admin/storytelling/edit/{{$story->id}}"><i class="material-icons">create</i></a></span></a>
            </div>
            <div class="row story__content">
              <a href="/admin/storytelling/edit/{{$story->id}}" class="col-md-6 col-sm-8 col-xs-12 story__cover" style="background-image: url('{{$story->cover}}')"></a>
              <div class="col-xs-6 story__text">
                <span class="row slogan">{{$story->summary}}</span>
                <ul class="list">
                  @foreach ($story->list_item as $item_list)
                    <li class="list__item">{{$item_list->name}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@stop
