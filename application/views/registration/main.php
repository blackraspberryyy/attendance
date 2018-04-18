<script>
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        $.ajax({
            "method": "POST",
            "url": '<?= base_url() ?>' + "registration/confirm",
            "dataType": "JSON",
            data: {
                student_id: $("#student_number").val()
            },
            success: function (result) {
                if (result.success) {
                    remove_error("#student_number");
                    $('.modal').modal('toggle');
                    $('#modal_student_picture').attr("src", "<?=base_url()?>images/student/"+result.student_number+".JPG");
                    $('#modal_student_name').html(result.student_name);
                    $('#modal_student_number').html(result.student_number);
                    $('#modal_student_course').html(result.student_course);
                } else {
                    show_error(result.text, $("#student_number"));
                }
                console.log(result);
            },
            error: function (result) {
                console.log(result);
            }
        });
    });

    $(document).on('click', '#register', function (e) {
        e.preventDefault();
        $.ajax({
            "method": "POST",
            "url": '<?= base_url() ?>' + "registration/register",
            "dataType": "JSON",
            data: {
                student_id: $("#student_number").val()
            },
            success: function (result) {
                if (result.success) {
                    location.reload();
                    console.log(result);
                } else {
                    console.log(result);
                }
            },
            error: function (result) {
                console.log(result);
            }
        });
    });
</script>

<div class = "container-fluid">
    <div class = "row align-items-center" style = "height:100vh;">
        <div class="col"></div>
        <div class="col-sm-4 text-center">
            <form method = "POST">
                <div class="form-group">
                    <label for="student_number">Student Number</label>
                    <input name = "student_number" maxlength="9" autofocus = "" autocomplete = "off" type="text" class="form-control" onkeypress = 'return keypresshandler(event)' id="student_number" aria-describedby="emailHelp" placeholder="Enter Student Number">
                    <small id="emailHelp" class="form-text text-muted">Registration will be available for PROFETHICS W31 students only.</small>
                </div>
                <button type="submit" id = "confirm" class="btn btn-outline-primary">Register</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<!-- CONFIRMATION MESSAGE -->
<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style = "background:#ddd;">
                <div class="card mx-auto" style="width: 25rem;">
                    <img id = "modal_student_picture" class="card-img-top" src="<?= base_url() ?>images/student/default.gif" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text" id = "modal_student_name"></p>
                        <p id = "modal_student_number"></p>
                        <small class = "text-muted" id = "modal_student_course"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Nope</button>
                <button type="button" class="btn btn-outline-primary" id = "register">Yep, that's me.</button>
            </div>
        </div>
    </div>
</div>

<script>
    function keypresshandler(event) {
        var charCode = event.keyCode;
        //Non-numeric character range
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
    }
</script>