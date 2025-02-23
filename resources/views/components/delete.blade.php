<form {{$attributes}} method="POST" style="margin-bottom: 0px;">
    @csrf
    @method('DELETE')
    <button class="form_btn" type="submit" onclick="return confirm('Are you sure you want to delete this status?');">
        <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
    </button>
</form>
