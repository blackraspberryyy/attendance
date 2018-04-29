<style>
    /*Styles here*/
    #confirm{
        margin-top:40px;
        padding-left: 80px;
        padding-right: 80px;
    }
    #modal_student_name{
        font-weight:bold;
    }
</style>
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
                    $('#modal_student_picture').attr("src", "<?= base_url() ?>images/student/" + result.student_number + ".JPG");
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

<div class = "container-fluid content">
    <div class="row align-items-center">
        <div class="col"></div>
        <div class="col-sm-4">
            <img src="<?= base_url() ?>images/logo/feuheader.png" style="margin-left:-80px; " height="100"/>
            <br><br><br>
            <center>
                <h1 style="color:lightgray;">"Professional Rights</h1>
                <h3 style="color:lightgray;">and</h3>
                <h1 style="color:lightgray;">Privileges Convention</h1>
                <h3 style="color:lightgray;">2018"</h3>
            </center>
        </div>
        <div class="col"></div>

    </div>
    <div class = "row align-items-center"  style="margin-top:305px;">
        <div class="col"></div>
        <div class="col-sm-4 text-center" style="margin-top:-340px;" >
           
            <form method = "POST">
                <div class="form-group">
                    <label for="student_number" style="color:white;">Student Number</label>
                    <input name = "student_number" maxlength="9" autofocus = "" autocomplete = "off" type="text" class="form-control" onkeypress = 'return keypresshandler(event)' id="student_number" aria-describedby="emailHelp" placeholder="Enter Student Number">
                    <small id="emailHelp" class="form-text" style="color:white">Registration will be available for PROFETHICS W31 students only.</small>
                </div>
                <button type="submit" id = "confirm" class="btn btn-primary">Register</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
    <img src="<?= base_url() ?>images/logo/logo.png" style="margin-top:-140px; " height="150"/>
    <img src="<?= base_url() ?>images/logo/feulogo.png" class="pull-right"  style="margin-top:-140px; " height="150"/>
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
                    <img id = "modal_student_picture" class="card-img-top" src="<?= base_url() ?>images/student/default.gif" alt="Student Image">
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
