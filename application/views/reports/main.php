<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            "order": [[1, "asc"]]
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
                            <img src = "<?= base_url()?>images/extras/really.jpg" class ="img-responsive" width = "200"><br>
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
                                        <tr>
                                            <td><?= $student->student_id ?></td>
                                            <td><?= $student->student_lastname . ", " . $student->student_firstname . " " . $student->student_middlename ?></td>
                                            <td><?= $student->student_course ?></td>
                                            <td><?= $student->student_registeredAt ?></td>
                                            <td class = "text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class = "btn btn-primary">Print Certificate</button>
                                                </div>
                                                
                                            </td>
                                        </tr>
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
