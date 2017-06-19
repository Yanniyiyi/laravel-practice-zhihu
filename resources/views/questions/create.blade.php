@extends('layouts.app')

@section('content')
@include('vendor.ueditor.assets')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Question</div>

                <div class="panel-body">
                    <form action="/questions" method="post">
                        {!!csrf_field()!!}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Question title" id="title" value={{old('title')}}>
                            @if($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{$errors->first('title')}}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="form-group">
                             <script id="container" name="body" type="text/plain">
                                 {!!old('body')!!}
                             </script>
                        </div>
                        <div class="form-group">
                            <select name="topics[]" class="js-example-placeholder-multiple form-control" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default pull-right" type="submit">
                                Publish Question
                            </button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- 实例化编辑器 -->
@section('js')
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', Laravel.csrfToken); // 设置 CSRF token.
    });
    function formatTopic (topic) {
    return "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" +
        topic.name ? topic.name : "Laravel"   +
        "</div></div></div>";
}

function formatTopicSelection (topic) {
    return topic.name || topic.text;
}

$(".js-example-placeholder-multiple").select2({
    tags: true,
    placeholder: 'Please input topic',
    minimumInputLength: 2,
    ajax: {
        url: '/api/topics',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data, params) {
            return {
                results: data
            };
        },
        cache: true
    },
    templateResult: formatTopic,
    templateSelection: formatTopicSelection,
    escapeMarkup: function (markup) { return markup; }
});
</script>
@endsection
