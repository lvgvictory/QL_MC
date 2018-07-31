<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h4>{!!$tieuchuan->ten_tieu_chuan!!}</h4>
    <h5>Mở đầu</h5>
    <p>{!!$tieuchuan->mo_dau!!}</p>
    @php
        $count = 0;
    @endphp
    @foreach($tieuchuan->tieuchis as $tieuchi)
        <h5 style="font-style: italic;">{!!$tieuchi->ten_tieu_chi!!}</h5>
        <h5>1. Mô tả</h5>
        <p>{!!$tieuchi->mo_ta!!}</p>
        <h5>2. Điểm mạnh</h5>
        <p>{!!$tieuchi->diem_manh!!}</p>
        <h5>3. Những tồn tại</h5>
        <p>{!!$tieuchi->nhung_ton_tai!!}</p>
        <h5>4. Kế hoạch cải tiến</h5>
        <p>{!!$tieuchi->ke_hoach_cai_tien!!}</p>
        <h5>5. Tự đánh giá: {!!$tieuchi->tu_danh_gia === 1 ? 'Đạt' : 'Không đạt'!!}</h5>
        @php
            if ($tieuchi->tu_danh_gia === 1) {
                $count++;
            }
        @endphp
    @endforeach
    <h5>Kết luận</h5>
    <p>{!!$tieuchuan->ket_luan!!}</p>
    <h5>Số tiêu chí đạt: {{$count}}/{{$tieuchuan->tieuchis->count()}}</h5>
</body>
</html>

<?php

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=download.doc");
header("Pragma: no-cache");
header("Expires: 0");