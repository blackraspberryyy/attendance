<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            "order": [[1, "asc"]]
        });
    });
</script>
<script>
    $(document).on('click', '#remove_attendance', function (e) {
        e.preventDefault();
        $.ajax({
            "method": "POST",
            "url": '<?= base_url() ?>' + "registration/remove_attendance",
            "dataType": "JSON",
            data: {
                student_id: $("#student_number").html()
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
    <div class = "row">
        <div class = "col"></div>
        <div class = "col-sm-10">
            <div class="card mt-5">
                <div class="card-header">
                    <i class = "fa fa-user"></i> Attendance
                </div>
                <div class="card-body">
                    <?php if (empty($students)): ?>
                        <div class = "mx-auto text-center">
                            <img src = "<?= base_url() ?>images/extras/really.jpg" class ="img-responsive" width = "200"><br>
                            <h4 class = "display-4">No one attended yet</h4>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Student ID.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Registered At</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($students as $student): ?>
                                            <span class = "d-none" id = "student_number" name = "student_number"><?=$student->student_id?></span>
                                            <tr>
                                                <td><?= $student->student_id ?></td>
                                                <td><?= $student->student_lastname . ", " . $student->student_firstname . " " . $student->student_middlename ?></td>
                                                <td><?= $student->student_course ?></td>
                                                <td><?= date("m/d/Y G:i:s", $student->student_registeredAt) ?></td>
                                                <td class = "text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button class = "btn btn-primary">Print Certificate</button>
                                                        <button class = "btn btn-danger" title = "Remove Attendance" data-toggle="modal" data-target="#remove_attendance"><i class = "fa fa-times"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <div class="modal fade" id="remove_attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Removing Attendance</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to remove the attendance of:</p>
                                                        <div class="card mx-auto" style="width: 25rem;">
                                                            <img id = "modal_student_picture" class="card-img-top" src="<?= base_url() ?>images/student/<?= $student->student_id ?>.JPG" alt="Student Image">
                                                            <div class="card-body">
                                                                <p class="card-text" id = "modal_student_name"><b><?= $student->student_lastname . ", " . $student->student_firstname . " " . $student->student_middlename ?></b></p>
                                                                <p id = "modal_student_number"><?= $student->student_id ?></p>
                                                                <small class = "text-muted" id = "modal_student_course"><?= $student->student_course ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        <button type="button" class="btn btn-danger" id = "remove_attendance">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class = "col"></div>
    </div>
</div>


