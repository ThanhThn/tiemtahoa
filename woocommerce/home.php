<?php /* Template Name: Home */?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/assets/css/home.css'; ?>">
<?php get_header(); ?>

<div class="slider-top">
    <div class="list-top">
        <?php
        $args = array(
            'post_type' => 'slider',
        );
        $query = new WP_Query($args);
        $count = 0;
        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post();
                $count++ ?>
                <div class="item">
                    <?php the_post_thumbnail(); ?>
                </div>
                <?php wp_reset_postdata();
            endwhile;
        endif; ?>
    </div>
    <!-- Button -->
    <div class="buttons">
        <button id="prevBtn"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="20" viewBox="0 0 11 20"
                fill="none">
                <path
                    d="M9.01617 19.6565C8.81075 19.6572 8.60779 19.6119 8.42219 19.5239C8.2366 19.436 8.07308 19.3076 7.94367 19.1483L1.30242 10.9075C1.10018 10.6618 0.989624 10.3535 0.989624 10.0354C0.989624 9.71723 1.10018 9.40897 1.30242 9.16321L8.17742 0.922436C8.41081 0.641952 8.74619 0.465566 9.10977 0.432081C9.47336 0.398597 9.83537 0.510756 10.1162 0.743886C10.397 0.977015 10.5736 1.31202 10.6071 1.6752C10.6406 2.03838 10.5283 2.39998 10.2949 2.68047L4.14867 10.0422L10.0887 17.404C10.2568 17.6056 10.3636 17.8511 10.3965 18.1114C10.4293 18.3718 10.3868 18.636 10.2739 18.873C10.1611 19.11 9.9827 19.3097 9.7598 19.4485C9.5369 19.5874 9.27884 19.6595 9.01617 19.6565Z"
                    fill="white" />
            </svg></button>
        <button id="nextBtn"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="20" viewBox="0 0 11 20"
                fill="none">
                <path
                    d="M1.74998 19.6563C1.42871 19.657 1.11736 19.5452 0.869978 19.3404C0.730748 19.2251 0.615658 19.0835 0.531299 18.9237C0.44694 18.7639 0.39497 18.5891 0.378366 18.4092C0.361761 18.2293 0.380849 18.0479 0.434535 17.8754C0.488222 17.7029 0.57545 17.5426 0.691228 17.4039L6.85123 10.0421L0.911229 2.6666C0.797013 2.52611 0.71172 2.36446 0.660251 2.19093C0.608783 2.01741 0.592154 1.83544 0.61132 1.65548C0.630486 1.47551 0.685069 1.30111 0.771933 1.14229C0.858797 0.983464 0.976229 0.843355 1.11748 0.730013C1.25974 0.604978 1.42635 0.510666 1.60683 0.452996C1.78732 0.395325 1.97779 0.375542 2.16629 0.394887C2.3548 0.414232 2.53726 0.472288 2.70224 0.565412C2.86721 0.658535 3.01114 0.784715 3.12498 0.936033L9.76623 9.17681C9.96847 9.42257 10.079 9.73083 10.079 10.049C10.079 10.3671 9.96847 10.6753 9.76623 10.9211L2.89123 19.1619C2.75329 19.3281 2.57807 19.4595 2.37978 19.5454C2.18149 19.6313 1.96572 19.6693 1.74998 19.6563Z"
                    fill="white" />
            </svg></button>
    </div>
    <!-- Dots -->
    <ul class="dots">
        <li class="active-dot"></li>
        <?php
        for ($i = 1; $i < $count; $i++) {
            echo "<li></li>";
        } ?>
    </ul>
</div>
<section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <!-- Categories -->
        <?php $product_categories = get_terms('product_cat'); ?>
        <h3>Categories</h3>
        <hr class="mx-auto">
        <p>Here you can check out our products categories</p>
    </div>
    <?php if ($product_categories) { ?>
        <div class="row mx-auto container-fluid">
            <?php foreach ($product_categories as $category) { ?>
                <div class="product text-center col-lg-3 co-md-4 col-sm-12">
                    <a href="<?php echo get_term_link($category) ?>">
                        <?php
                        $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);
                        if ($image) {
                            echo '<img src="' . $image . '" alt="' . $category->name . '" class="img-fluid mb-3">';
                        } ?>
                        <h5 class="p-name">
                            <?php echo $category->name ?>
                        </h5>
                        <button class="buy-btn">Shop now</button>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</section>

<!-- Banner -->
<section id="banner" class="my-5 py-5">
    <div class="container">
        <h4>MID SEASON'S SALE</h4>
        <h1>Autumn Collection <br> UP to 30% OFF</h1>
        <button class="text-uppercase">Shop now</button>
    </div>
</section>

<section>
    <!--testimonial--------->
    <div class="testimonial">
        <div class="small-container">
            <div class="row" style="width: 100%">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <h3>Sean Parker</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <h3>Mike Smith</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <h3>Sean Parker</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>