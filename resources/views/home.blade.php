@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="pinBoot">
        @foreach($lists as $list)
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $list->name }}</div>
                <div class="panel-body">
                    <ul id="{{ $list->id }}-items">
                        <script>

                            var refresh = function() {
                                $.ajax({
                                    'url': '/items/{{ $list->id }}',
                                    'type': 'GET',
                                    'success': function (data) {
                                        for (item in data) {
                                            if (data[item].completed) {
                                                $('#{{ $list->id }}-items')
                                                    .append('<li class="list-unstyled">' +
                                                        '<input type="checkbox" checked class="item" id="' + data[item].id + '">' + data[item].description + '</input></li>');
                                            }
                                            else {
                                                $('#{{ $list->id }}-items')
                                                    .append('<li class="item list-unstyled">' +
                                                        '<input type="checkbox" class="item" id="' + data[item].id + '">' + data[item].description + '</input></li>');
                                            }
                                        }
                                    }
                                });
                            }
                            refresh();

                        </script>
                        <li id="new-task-wrap"><input type="text" id="new-task" name="{{ $list->id }}" class="list-unstyled" placeholder="New Task"></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <script>

        $(document).ready(function () {
            $(':checkbox').change(function () {
                console.log('changed');
                $.ajax({
                    'url': '/items/toggle/',
                    'type': 'POST',
                    'data':
                        {
                            id: $(this).attr('id'),
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                    'success': function (data) {
                        console.log(data);
                    }
                });
            });

            $('#new-task').keypress(function(e){
                var key = e.which;
                if(key == 13) {
                    console.log($(this).val());
                    console.log($(this).attr('name'));
                    console.log('{!! csrf_token() !!}');
                    $.ajax({
                        'url': '/items',
                        'type': 'POST',
                        'data':
                            {
                                des: $(this).val(),
                                list: $(this).attr('name'),
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                        'success': function(data){
                            if(data=='success'){
                                $(this).val("");
                                location.reload();
                            }
                        }
                    });

                }
            });


        });


    </script>
</div>
@endsection
