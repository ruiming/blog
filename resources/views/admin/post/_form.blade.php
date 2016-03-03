@include('editor::head')
    <input type="text" class="form-underline" name="title" placeholder="title" autofocus id="title" value="{{$title}}">
    <div class="editor">
        <textarea name="contents" rows="20" id="myEditor">{{$content}}</textarea>
    </div>
    <div class="form-group" style="margin:0">
        <select name="archive" id="archive" class="archive_select">
            @foreach ($archives as $onearchive)
                <option @if (in_array($archive, $onearchive)) selected @endif value="{{ $onearchive['name'] }}">
                    {{ $onearchive["name"] }}
                </option>
            @endforeach
        </select>
        <div class="checkbox">
            <label><input type="checkbox" name="is_draft" {{ checked($is_draft)}}>草稿?</label>
        </div>
    </div>