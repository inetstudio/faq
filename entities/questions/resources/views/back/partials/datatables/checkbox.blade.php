<div class="i-checks">
    <input type="checkbox" name="questions[]" class="{{ isset($id) ? 'group-element' : '' }}" id="question_{{ $id ?? 'all' }}" value="{{ $id ?? 'all' }}" />
</div>
