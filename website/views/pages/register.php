<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $idstudent = $_POST['idstudent'];
    $faculty = $_POST['faculty'];
    $birthday = $_POST['birthday'];
    $per_email = $_POST['per_email'];
    $phone = $_POST['phone'];
    $facebook = $_POST['facebook'];
    $team = $_POST['team'];
    $resolution = $_POST['resolution'];
    $content1 = $_POST['content1'];
    $content2 = $_POST['content2'];
    $content3 = $_POST['content3'];
    $content4 = $_POST['content4'];
    $content5 = $_POST['content5'];
    $content6 = $_POST['content6'];

    $register = $manageRegister->setRegister(
        $fullname,
        $idstudent,
        $faculty,
        $birthday,
        $per_email,
        $phone,
        $facebook,
        $team,
        $resolution,
        $content1,
        $content2,
        $content3,
        $content4,
        $content5,
        $content6
    );
}

if (isset($register)) {
    echo $register;
}
?>

<section class="breadcrumb_section">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="?q=homepage">Trang chủ</a></li>
                <li class="active"><a href="#!">Đăng ký thành viên</a></li>
            </ol>
        </div>
    </div>
</section>

<div class="container">
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <h1 class="text-center title_page">ĐĂNG KÝ THÀNH VIÊN</h1>
        </div>
        <!-- row -->
    </div>
    <?php
    $query = "SELECT `level` FROM `tbl_checkregister`";
    $result = $db->select($query);
    $value = $result->fetch_assoc();

    if ($value['level'] == "1") {
    ?>
        <form action="?q=register" method="POST">
            <div class="row" style="margin-bottom: 5px;">
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="fullname">Họ và Tên <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="fullname" placeholder="Nguyễn Văn A" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="idstudent">Mã số sinh viên <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="idstudent" placeholder="51xxxxxx" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="faculty">Bạn thuộc khoa nào? <span style="color: red;">*</span></label>
                        <select name="faculty" class="form-control form-control-sm" required>
                            <option selected value="">---Chọn khoa---</option>
                            <option value="Công nghệ thông tin">Công nghệ thông tin</option>
                            <option value="Dược">Dược</option>
                            <option value="Điện - Điện tử">Điện - Điện tử</option>
                            <option value="Giáo dục quốc tế">Giáo dục quốc tế</option>
                            <option value="Kế toán">Kế toán</option>
                            <option value="Khoa học thể thao">Khoa học thể thao</option>
                            <option value="Khoa học ứng dụng">Khoa học ứng dụng</option>
                            <option value="Khoa học xã hội và nhân văn">Khoa học xã hội và nhân văn</option>
                            <option value="Kỹ thuật công trình">Kỹ thuật công trình</option>
                            <option value="Luật">Luật</option>
                            <option value="Môi trường và bảo hộ lao động">Môi trường và bảo hộ lao động</option>
                            <option value="Mỹ thuật công nghiệp">Mỹ thuật công nghiệp</option>
                            <option value="Ngoại ngữ">Ngoại ngữ</option>
                            <option value="Quản trị kinh doanh">Quản trị kinh doanh</option>
                            <option value="Tài chính - Ngân hàng">Tài chính - Ngân hàng</option>
                            <option value="Toán - Toán thống kê">Toán - Toán thống kê</option>
                            <option value="Lao động công đoàn">Lao động công đoàn</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 5px;">
                <div class="col-md-12">
                    <h2>1. Thông tin cá nhân</h2>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="birthday">Ngày sinh <span style="color: red;">*</span></label>
                        <input type="date" class="form-control" name="birthday" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="per_email">Email cá nhân <span style="color: red;">*</span></label>
                        <input type="email" class="form-control" name="per_email" placeholder="nguyenvana@gmail.com" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="phone">Số điện thoại <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="phone" placeholder="03770xxxxx" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="facebook">Link facebook <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="facebook" placeholder="https://www.facebook.com/nguyenvana" required>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 5px;">
                <div class="col-md-12">
                    <h2>2. Đăng ký tham gia câu lạc bộ LSA</h2>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="team">Bạn sẽ chọn ban nào? <span style="color: red;">*</span></label>
                        <select name="team" class="form-control form-control-sm" required>
                            <option selected value="">---Chọn ban---</option>
                            <option value="Ban hành chính">Ban hành chính</option>
                            <option value="Ban nhân sự">Ban nhân sự</option>
                            <option value="Ban truyền thông">Ban truyền thông</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="content1">Bạn biết đến LSA là từ đâu? <span style="color: red;">*</span></label>
                        <textarea class="form-control" name="content1" rows="2" placeholder="Câu trả lời của bạn" required></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="content2">Tại sao bạn lại chọn ban này? <span style="color: red;">*</span></label>
                        <textarea class="form-control" name="content2" rows="2" placeholder="Câu trả lời của bạn" required></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="content3">Bạn đã có kinh nghiệm trong công việc này chưa? <span style="color: red;">*</span></label>
                        <textarea class="form-control" name="content3" rows="2" placeholder="Câu trả lời của bạn" required></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="content4">Bạn mong muốn điều gì sau khi tham gia câu lạc bộ? <span style="color: red;">*</span></label>
                        <textarea class="form-control" name="content4" rows="2" placeholder="Câu trả lời của bạn" required></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="content5">Bạn có sở trường gì không?</label>
                        <textarea class="form-control" name="content5" rows="2" placeholder="Câu trả lời của bạn"></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13.5px;" for="content6">Sở đoản của bạn là gì?</label>
                        <textarea class="form-control" name="content6" rows="2" placeholder="Câu trả lời của bạn"></textarea>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="form-group">
                        <label style="font-size: 13.5px; text-align: justify;" for="resolution">Bạn có đồng ý cam kết sẵn sàng tham gia khi câu lạc bộ có các hoạt động hoặc trong trường hợp khẩn cấp bạn sẽ có mặt góp sức không? <span style="color: red;">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="resolution" id="resolution1" value="1" required>
                            <label class="form-check-label" for="resolution1">Đồng ý cam kết</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="resolution" id="resolution2" value="0" required>
                            <label class="form-check-label" for="resolution2">Không đống ý cam kết</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h6 style="color: red; font-size: 18px; font-weight: bold;">Lưu ý:</h6>
                    <p style="color: red; font-size: 15px;">Trước khi gửi form đăng ký các bạn vui lòng kiểm tra thật kỹ nội dung và không được bỏ trống các câu hỏi có dấu (*) giúp BTC nhé.</p>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <button style="margin-top: 10px; margin-right: 10px;" class="btn btn-danger" type="reset">Hủy tất cả câu trả lời</button>
                    <button style="margin-top: 10px;" class="btn btn-primary" type="submit">Đăng ký thành viên</button>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <p>Hiện tại form đăng ký đã đóng!</p>
    <?php } ?>
</div>