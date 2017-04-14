<?php
$data_bulan = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugin/contextmenu/dist/jquery.contextMenu.min.css') ?>">
<script src="<?php echo base_url('assets/plugin/contextmenu/dist/jquery.contextMenu.min.js') ?>"></script>
<div class="row">
    <div class="col-md-5">
        <form class="form-horizontal" method="post" action="<?= site_url('monitoring'); ?>">
            <input type="hidden" name="ambildata" value="yes">
            <div class="panel panel-default">
                <div class="panel-heading">Daily Monitoring</div>
                <div class="panel-body">

                    <div class="form-group form-inline">
                        <label class="form-label col-md-2">Month:</label>
                        <select name="month" class="form-control" id="month">
                            <?php
                            foreach ($data_bulan as $key => $value) {
                                if ($key == $month) {
                                    echo "<option value='$key' selected='selected'>" . $value . "</option>";
                                } else {
                                    echo "<option value='$key'>" . $value . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom:0px;">
                        <label class="form-label col-md-2">Year:</label>
                        <input id="year" class="form-control" type="text" name="year" maxlength="4" style="width: 90px;" value="<?= $year ?>" required="required">
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
                    <button type="button" id="addnew" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Add Daily Monitoring</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <table>
            <tr>
                <td><div style="width:40px; height:30px;background-color: red;"></div></td>
                <td width="10px"></td>
                <td><b>Mati Total</b></td>
            </tr>
            <tr>
                <td><div style="width:40px; height:30px;background-color: yellow;"></div></td>
                <td width="10px"></td>
                <td><b>Mati/Rusak</b></td>
            </tr>
            <tr>
                <td><div style="width:40px; height:30px;background-color: green;"></div></td>
                <td width="10px"></td>
                <td><b>Hidup</b></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4"><?php
        if ($_SESSION) {
            echo $this->session->flashdata('msg');
        }
        ?></div>
</div>
<div class="row">
    <div class="col-md-12" id="data">
        <?php
        if (count($rowdata) == 0) {
            echo "<div class='label label-danger'>No Data</div>";
        } else {
            $jumhari = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $gethari = array();
            for ($t = 1; $t <= $jumhari; $t++) {
                $tgl = $year . '-' . $month . '-' . ($t < 10 ? '0' . $t : $t);
                array_push($gethari, $tgl);
            }
            ?>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead style="background: #F8F8F8;">
                        <tr>
                            <th colspan="<?= 6 + $jumhari; ?>">Data CCTV (<?= $data_bulan[$month]; ?> - <?= $year; ?>)</th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>IP Address</th>
                            <th>Model</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Recorder</th>

                            <?php
                            for ($i = 1; $i <= $jumhari; $i++) {
                                echo "<th width='20px'>" . $i . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rowdata as $key => $value) {

                            echo "<tr>";
                            echo "<td>" . ($key + 1) . "</td>";
                            echo "<td>" . $value->ip . "</td>";
                            echo "<td>" . $value->nm_model . "</td>";
                            echo "<td>" . $value->location . "</td>";
                            echo "<td>" . $value->nm_type . "</td>";
                            echo "<td>" . $value->nm_recorder . "</td>";
                            foreach ($gethari as $y => $hvalue) {
                                $ada = false;
                                $libur = false;
                                $weekday = date('w', strtotime($hvalue));
                                foreach ($value->monitoring as $y => $mvalue) {
                                    if ($mvalue->date_monitoring == $hvalue) {
                                        $ada = true;
                                        break;
                                    }
                                }
                                foreach ($value->holiday as $y => $lvalue) {
                                    if ($lvalue->date_holiday == $hvalue) {
                                        $libur = true;
                                        break;
                                    }
                                }
                                if ($ada) {
                                    switch ($mvalue->status) {
                                        case 'M':
                                            echo "<td class='cell' bgcolor='red' data-toggle='tooltip' data-placement='left' title='$mvalue->remark' data-container='body' data-id='$mvalue->id_monitoring'>" . "</td>";
                                            break;
                                        case 'K':
                                            echo "<td class='cell' bgcolor='yellow' data-toggle='tooltip' data-placement='left' title='$mvalue->remark' data-container='body' data-id='$mvalue->id_monitoring'>" . "</td>";
                                            break;
                                        default:
                                            echo "<td class='cell' bgcolor='green' data-toggle='tooltip' data-placement='left' title='$mvalue->remark' data-container='body' data-id='$mvalue->id_monitoring'>" . "</td>";
                                            break;
                                    }
                                } elseif ($libur) {
                                    echo "<td bgcolor='silver' data-toggle='tooltip' data-placement='left' title='$lvalue->nm_holiday' data-container='body'>" . "</td>";
                                } elseif ($weekday == 0 or $weekday == 6) {
                                    echo "<td bgcolor='pink'>" . "</td>";
                                } else {
                                    echo "<td>" . "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <form method="post" action="<?= site_url('monitoring/export_to_excel'); ?>">
                        <input type="hidden" name="month" value="<?= $month ?>">
                        <input type="hidden" name="year" value="<?= $year ?>">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-book"></span> Export to Excel</button>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('#addnew').click(function () {
        window.location.replace("<?= site_url('monitoring/add'); ?>");
    });

    $('select#month').change(function () {
        $('#data').html('');
    });
    $('#year').on('input', function () {
        $('#data').html('');
    });
    // Click Kanan
    $(function () {
        $.contextMenu({
            selector: 'td.cell',
            callback: function (key) {
                var id = $(this).data('id');
                var base = "<?php echo base_url(); ?>";
                if (key == 'edit') {
                    window.location.replace(base + "monitoring/edit/" + id);
                } else if (key == 'delete') {
                    var conf = confirm('Apakah data ini ingin dihapus?');
                    if (conf) {
                        window.location.replace(base + "monitoring/delete/" + id);
                    }
                }
            },
            items: {
                "edit": {name: "Edit", icon: "edit"},
                "delete": {name: "Delete", icon: "delete"},
                "sep1": "---------",
                "quit": {name: "Quit", icon: "quit"}
            }
        })
    });
</script>