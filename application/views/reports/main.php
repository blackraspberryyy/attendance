<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            "order": [[1, "asc"]],
            "pageLength": 50
        });
    });
</script>
<div class = "container-fluid">
    <div class = "row" >
        <div class = "col"></div>
        <div class = "col-sm-11" >
            <div class="card mt-5" >
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
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Middlename</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Registered At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($students as $student): ?>
                                    <script>
                                        $(document).on('click', '#remove_attendance_<?= $student->student_id?>', function (e) {
                                            e.preventDefault();
                                            $.ajax({
                                                "method": "POST",
                                                "url": '<?= base_url() ?>' + "reports/remove_attendance",
                                                "dataType": "JSON",
                                                data: {
                                                    student_id: $("#student_number_<?= $student->student_id?>").html()
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
                                    <span class = "d-none" id = "student_number_<?= $student->student_id?>" name = "student_number"><?= $student->student_id ?></span>
                                    <tr>
                                        <td nowrap><?= $student->student_id ?></td>
                                        <td nowrap><?= $student->student_lastname?></td>
                                        <td nowrap><?= $student->student_firstname?></td>
                                        <td nowrap><?= $student->student_middlename ?></td>
                                        <td><?= $student->student_course ?></td>
                                        <td nowrap><?= $student->student_registeredAt == 0 ? "<span class = 'text-danger'>Not Registered</span>" : "<span class = 'text-success'>".date("F d, Y - h:i:s A", $student->student_registeredAt)."</span>" ?></td>
                                        <td class = "text-center">
                                            <?php if($student->student_isPresent == 1):?>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class = "btn btn-danger " title = "Remove Attendance" data-toggle="modal" data-target="#remove_attendance_modal_<?= $student->student_id?>"><i class = "fa fa-times"></i></button>
                                                </div>
                                            <?php else:?>
                                            --
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="remove_attendance_modal_<?= $student->student_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <button type="button" class="btn btn-danger" id = "remove_attendance_<?= $student->student_id?>">Yes</button>
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


