<?php /* Template Name: Contact */ ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/assets/css/contact.css'; ?>">
<?php get_header(); ?>
<div class="box">
    <div class="up">
        <!-- info Box -->
        <div class="contact info">
            <div class="infoBox">
                <div class="title">
                    <h2>THÔNG TIN LIÊN HỆ</h2>
                </div>
                <div class="describe">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, quaerat, culpa eveniet ipsa
                        saepe veritatis sunt in odit non numquam, error ab. Iste architecto, labore aliquid explicabo
                        quia maxime laborum?
                    </p>
                </div>
                <div class="information">
                    <div class="info-a">
                        <div class="">
                            <span>Địa chỉ</span>
                            <p>19 Quảng Đức, Vĩnh Hải, Nha Trang, Khánh Hòa, Việt Nam</p>
                        </div>
                        <div class="">
                            <span>Email</span>
                            <a href="#">dang.vu@vnresource.org</a>
                        </div>
                    </div>
                    <div class="info-b">
                        <div class="">
                            <span>Liên hệ</span>
                            <a href="#">078 2824 3334 </a>
                        </div>
                        <!-- Social Media Links -->
                        <div class="">
                            <span>Mạng xã hội</span>
                            <ul class="sci">
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- img -->
        <div class="contact img">
            <img src="imgs/back.jpg" alt="">
        </div>
    </div>
    <div class="bottom">
        <!-- Map -->
        <div class="contact map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.4685337198457!2d109.19400067185484!3d12.2842023879715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317067fb81334de5%3A0x3a082abb20dbfe92!2zMTkgUXXhuqNuZyDEkOG7qWMsIFbEqW5oIEjhuqNpLCBOaGEgVHJhbmcsIEtow6FuaCBIw7JhIDY1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1709089281172!5m2!1svi!2s"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- Form -->
        <div class="contact form">
            <h3>LIÊN HỆ</h3>
            <hr>
            <form action="" method="post">
                <div class="formBox">
                    <div class="row100">
                        <div class="inputBox">
                            <input type="text" placeholder=" ">
                            <span>Họ tên</span>
                        </div>
                    </div>
                    <div class="row50">
                        <div class="inputBox">
                            <input type="text" placeholder=" ">
                            <span>Email</span>
                        </div>
                        <div class="inputBox">
                            <input type="text" placeholder=" ">
                            <span>Điện thoại</span>
                        </div>
                    </div>
                    <div class="row100">
                        <div class="inputBox">
                            <textarea name="" id="" cols="30" rows="10" placeholder=" "></textarea>
                            <span>Nội dung</span>
                        </div>
                    </div>
                    <div class="row100">
                        <div class="inputBox">
                            <input type="submit" name="" id="" value="Gửi nội dung">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php get_footer(); ?>