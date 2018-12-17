"parts":
[
@foreach($dataContents as $dataContent)
    {
    "type": "{{\App\Models\LessonDetail::TYPE[$dataContent->type]}}",
    "path": "{{$dataContent->lessonDetailName}}",
    "title": "{{$dataContent->lessonDetailTitle}}",
    "outline": "{{$dataContent->lessonDetailOutline}}",
    "guide": {
    "title": "{{$dataContent->lessonContentTitle}}",
    "contents": [
    {{json_encode($dataContent->lessonContentContent,JSON_UNESCAPED_UNICODE)}}
    ]
    }
    },
@endforeach
]

{{--"data": [--}}
{{--{--}}
{{--@foreach($dataDapAns as $dataDapAn)--}}
    {{--@if($dataDapAn->type == 3)--}}
        {{--"answer_last": false,--}}
        {{--"question": "{{$dataDapAn->lessonContentQuestion}}",--}}
        {{--"answer": "{{$dataDapAn->lessonAnswer}}",--}}
        {{--"wrong": [--}}
        {{--"Vì mẹ không đưa cậu đến trường",--}}
        {{--"Vì mẹ không cho Trạch ngủ nướng",--}}
        {{--"Vì mẹ mắng bạn Trạch"--}}
        {{--]--}}
    {{--@endif--}}
{{--@endforeach--}}
{{--},--}}
{{--]--}}