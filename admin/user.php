<?php
   $kue = "SELECT * FROM user";
   $datas = query($kue);
   $i = 1;
?>
<div class="container-sm pt-4">
    <table class="table mx-auto">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama user</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($datas as $dat) {
            ?>
            <tr>
                <td scope="row"><?= $i++ ?></td>
                <td><?= $dat['username'] ?></td>
                <td><?= $dat['role'] ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>