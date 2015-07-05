<script src="{{asset('js/bootstrap-confirmation.js')}}"></script>
<script type="text/javascript">
$(function() {
$('.b-remove').confirmation({
      onConfirm: function() {
        var url = $(this).data('href');
        // Get the token
        var token = $(this).data('delete');
        // Create a form element
        var $form = $('<form/>', {action: url, method: 'post'});

        // Add the token hidden input
        var $inputToken = $('<input/>', {type: 'hidden', name: '_token', value: token});
        // Append the inputs to the form, hide the form, append the form to the <body>, SUBMIT !
        $form.append($inputToken).hide().appendTo('body').submit();
      },
      onCancel: function() {
        $('.b-remove').confirmation('destroy');
      }
    });
});
</script>